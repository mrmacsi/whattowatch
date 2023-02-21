<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserGenreSearchRequest;
use App\Http\Requests\UpdateUserGenreSearchRequest;
use App\Models\UserGenreSearch;

class UserGenreSearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreUserGenreSearchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserGenreSearchRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserGenreSearch  $userGenreSearch
     * @return \Illuminate\Http\Response
     */
    public function show(UserGenreSearch $userGenreSearch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserGenreSearch  $userGenreSearch
     * @return \Illuminate\Http\Response
     */
    public function edit(UserGenreSearch $userGenreSearch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserGenreSearchRequest  $request
     * @param  \App\Models\UserGenreSearch  $userGenreSearch
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserGenreSearchRequest $request, UserGenreSearch $userGenreSearch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserGenreSearch  $userGenreSearch
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserGenreSearch $userGenreSearch)
    {
        //
    }
}
