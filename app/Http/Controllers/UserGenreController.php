<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserGenreRequest;
use App\Http\Requests\UpdateUserGenreRequest;
use App\Models\User;
use App\Models\UserGenre;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\DomCrawler\Crawler;

class UserGenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Cache::has('genres')){
            $genreData = Cache::get('genres');
        } else {
            $client = new \GuzzleHttp\Client();
            $request = $client->get('https://www.imdb.com/feature/genre/?ref_=nv_ch_gr');// Url of your choosing
            $response = $request->getBody();
            $html = $response->getContents();
            $crawler = new Crawler($html);
            $genres = $crawler->filter('div.ninja_image img');
            $genreData = [];
            foreach ($genres as $genre) {
                $genreData[] = [
                    'src' => $genre->getAttribute('src'),
                    'title' => $genre->getAttribute('title'),
                ];
            }
            Cache::set('genres', $genreData);
        }
        $userGenres = UserGenre::where('user_id', auth()->user()->id)->get();
        return view('dashboard',['genres' => $genreData,'userGenres' => $userGenres]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserGenreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserGenreRequest $request)
    {
        $userId = auth()->user()->id;
        $selected = array_values($request->except('_token'));
        $genres = array_map(function($value) use ($userId) {
            return array('genre' => $value, 'user_id' => $userId);
        }, $selected);
        UserGenre::where('user_id',$userId)->delete();
        UserGenre::upsert($genres,['user_id']);
        Cache::delete('shows');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserGenre  $userGenre
     * @return \Illuminate\Http\Response
     */
    public function show(UserGenre $userGenre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserGenre  $userGenre
     * @return \Illuminate\Http\Response
     */
    public function edit(UserGenre $userGenre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserGenreRequest  $request
     * @param  \App\Models\UserGenre  $userGenre
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserGenreRequest $request, UserGenre $userGenre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserGenre  $userGenre
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserGenre $userGenre)
    {
        //
    }
}
