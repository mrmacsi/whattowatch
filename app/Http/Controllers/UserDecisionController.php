<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserDecisionRequest;
use App\Http\Requests\UpdateUserDecisionRequest;
use App\Models\Show;
use App\Models\UserDecision;
use App\Models\UserGenre;
use App\Services\ShowService;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\DomCrawler\Crawler;

class UserDecisionController extends Controller
{
    public function __construct(protected ShowService $showService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userGenres = UserGenre::where('user_id', auth()->user()->id)->get();
        $showData = $this->showService->searchByUserGenres($userGenres->pluck('genre'));
        $friendDecisions = $this->showService->friendDecisions();
        $all = collect($showData)->merge($friendDecisions);
        $random = null;
        if ($all->count()>0) {
            $random = $all->random();
            $random = $this->showService->searchDetails($random);
        }
        return view('decide',['show' => $random,'userGenres' => $userGenres]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserDecisionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserDecisionRequest $request)
    {
        $userId = auth()->user()->id;
        $form = $request->except('_token');
        $data = [
            'user_id' => $userId,
            'show_id' => $form['show_id'],
            'decision' => $form['button'],
            'created_at' => now()
        ];
        UserDecision::insert($data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $userGenres = UserGenre::where('user_id', auth()->user()->id)->get();
        $decisionAll = UserDecision::where('user_id', auth()->user()->id)
            ->with('show')
            ->select('id','show_id','decision')
            ->orderBy('id','desc')
            ->simplePaginate(10);
        return view('decisions', ['userGenres' => $userGenres, 'decisions' => $decisionAll]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserDecision  $userDecision
     * @return \Illuminate\Http\Response
     */
    public function edit(UserDecision $userDecision)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserDecisionRequest  $request
     * @param  \App\Models\UserDecision  $userDecision
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserDecisionRequest $request, UserDecision $userDecision)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserDecision  $userDecision
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDecision $userDecision)
    {
        //
    }
}
