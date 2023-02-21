<?php

namespace App\Services;

use App\Models\Show;
use App\Models\UserDecision;
use App\Models\UserFriend;
use App\Models\UserGenreSearch;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class ShowService
{
    public function __construct(protected Client $client)
    {
        $this->client = new Client([
            'headers' => [
                'User-Agent' => $_SERVER['HTTP_USER_AGENT'],
            ]
        ]);
    }

    public function searchByUserGenres($userGenres):array {
        $search = $userGenres->join(',');
        $searched = UserGenreSearch::where('user_id', auth()->user()->id)
            ->where('search', $search)
            ->orderBy('id','desc')
            ->get();
        $latest = $searched->first();
        $page = 0;
        if ($latest) {
            $page = $latest->page;
            $start = $latest->page * 50 + 1;
        } else {
            $start = 1;
        }
        if (!$latest || $latest->completed) {
            $request = $this->client->get('https://www.imdb.com/search/title/?genres='.$search.'&start='.$start);
            $response = $request->getBody();
            $html = $response->getContents();
            $crawler = new Crawler($html);
            $showData = $crawler->filter('div.lister-item')->each(function (Crawler $crawler) {
                $content = $crawler->filter('.lister-item-content');
                $title = $content->filter('.lister-item-header > a, span.lister-item-year');
                $duration = $content->filter('.text-muted .runtime');
                $genre = $content->filter('.text-muted .genre');
                $rating = $content->filter('.ratings-bar strong');
                $description = $content->filter('p.text-muted');
                return [
                    'show_id' => $crawler->filter('img')->image()->getNode()->getAttribute('data-tconst'),
                    'pic_src' => $crawler->filter('img')->image()->getNode()->getAttribute('loadlate'),
                    'title' => $title->eq(0)->text().' '.$title->eq(1)->text(),
                    'duration' => $duration->count()>0?$duration->text():null,
                    'genre' => $duration->count()>0?$genre?->text():null,
                    'rating' => $rating->count()>0?$rating?->text():null,
                    'description' => $description->count()>1?$description->eq(1)->text():null,
                ];
            });
            //remove the unknown pics
            $showData = collect($showData)->filter(function ($show){
                return $show['pic_src'] != "https://m.media-amazon.com/images/S/sash/NapCxx-VwSOJtCZ.png";
            })->toArray();

            Show::upsert($showData,'show_id');
            UserGenreSearch::insert([
                'user_id' => auth()->user()->id,
                'search' => $search,
                'show_ids' => json_encode(collect($showData)->pluck('show_id')->toArray()),
                'page' => $page + 1,
                'completed' => false,
            ]);
        } else {
            $showIds = json_decode($searched->first()->show_ids,true);
            $showData = Show::whereIn('show_id',$showIds)->get()->toArray();
        }
        /*
        UserDecision::insert(collect($showData)->map(function ($item){
            $return['user_id'] = auth()->user()->id;
            $return['show_id'] = $item['show_id'];
            $return['decision'] = rand(0,1);
            return $return;
        })->toArray());
        */
        $undecided = $this->getUndecidedShows($showData);
        if (count($undecided) == 0) {
            $latest->completed = 1;
            $latest->save();
            $undecided = $this->searchByUserGenres($userGenres);
        }
        return $undecided;
    }

    public function friendDecisions(){
        $user = auth()->user()->id;
        $friends = UserFriend::with('friend')
            ->where('receiver_id', '=', $user)
            ->orWhere('sender_id', '=', $user)->pluck('sender_id')->except($user)->toArray();
        $alreadyMatched = UserDecision::where('user_decisions.user_id',auth()->user()->id)
            ->join('user_decisions as friend_decisions','user_decisions.show_id','friend_decisions.show_id')
            ->whereIn('friend_decisions.user_id',$friends)
            ->pluck('user_decisions.show_id');
        $decisitons = UserDecision::whereIn('user_id', $friends)
            ->whereNotIn('show_id', $alreadyMatched)
            ->where('decision', 1)
            ->limit(10)->pluck('show_id')->toArray();
        $shows = Show::whereIn('show_id', $decisitons)->get()->toArray();
        return $shows;
    }

    public function searchDetails(array $random):array {
        if (isset($random['video_src']) || isset($random['quality_pic_src'])){
            return $random;
        }
        $request = $this->client->get("https://www.imdb.com/title/{$random['show_id']}/");
        $response = $request->getBody();
        $html = $response->getContents();
        $crawler = new Crawler($html);
        $picExists = $crawler->filter('.ipc-poster .ipc-image')->count() > 0;
        $clearPic = $picExists?
            $crawler->filter('.ipc-poster .ipc-image')?->image()->getNode()->getAttribute('src'):
            null;
        $video = json_decode($crawler->filter('#__NEXT_DATA__')->innerText());
        $edges = $video->props->pageProps->aboveTheFoldData->primaryVideos->edges;
        if (!isset($edges[0])){
            $videoUrl = null;
        } else {
            $node = $edges[0]->node;
            $videoUrl = $node->playbackURLs[0]->url;
        }
        $random['quality_pic_src'] = $clearPic;
        $random['video_src'] = $videoUrl;
        Show::upsert($random,'show_id');
        return $random;
    }

    public function getUndecidedShows(array $shows):array{
        $decisions = UserDecision::where('user_id', auth()->user()->id)->pluck('show_id')->toArray();
        $shows = collect($shows)->filter(function ($data) use ($decisions){
            return !in_array($data['show_id'],$decisions);
        });

        return $shows->toArray();
    }
}