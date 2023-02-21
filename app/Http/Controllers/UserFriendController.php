<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserFriendRequest;
use App\Http\Requests\UpdateUserFriendRequest;
use App\Models\User;
use App\Models\UserDecision;
use App\Models\UserFriend;

class UserFriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $friends = UserFriend::with('friend')
        ->where('sender_id', '=', auth()->user()->id)
        ->orWhere('receiver_id', '=', auth()->user()->id)->get();
        return view('friends',['friends' => $friends,'value'=>route('friend.match',['user'=>auth()->user()])]);
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
     * @param  \App\Http\Requests\StoreUserFriendRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserFriendRequest $request)
    {
        $form = $request->except('_token');
        $form['receiver_id'] = auth()->user()->id;
        $form['sender_id'] = (int)$form['sender_id'];
        UserFriend::upsert($form,['sender_id','receiver_id']);
        return redirect()->route('friend.index')->with('success','Friend accepted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserFriend  $userFriend
     * @return \Illuminate\Http\Response
     */
    public function show(UserFriend $userFriend)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function match(User $user)
    {
        return view('match',['user' => $user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function matches(User $user)
    {
        $decisions = UserDecision::where('user_decisions.user_id',auth()->user()->id)
            ->with('show')
            ->join('user_decisions as friend_decisions','user_decisions.show_id','friend_decisions.show_id')
            ->where('user_decisions.decision',1)
            ->where('friend_decisions.user_id',$user->id)
            ->where('friend_decisions.decision',1)
            ->orderBy('user_decisions.id','desc')
            ->simplePaginate(10);
        return view('matches',['user' => $user, 'decisions' => $decisions]);
    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function share()
    {
        return view('share', ['value'=>route('friend.match',['user'=>auth()->user()])]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserFriend  $userFriend
     * @return \Illuminate\Http\Response
     */
    public function edit(UserFriend $userFriend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserFriendRequest  $request
     * @param  \App\Models\UserFriend  $userFriend
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserFriendRequest $request, UserFriend $userFriend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserFriend  $userFriend
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserFriend $userFriend)
    {
        //
    }
}
