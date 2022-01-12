<?php

namespace App\Http\Controllers;

use App\Models\FriendShip;
use App\Models\User;
use Illuminate\Http\Request;

class FriendShipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //retrive all friends data 
        $allfriends = $this->allfriends();
        $allfriends_count = count($allfriends);

        //retrive pending friends who send me request but i no accepted
        $pending_friends = $this->pending_friends();
        $pending_friends_count = count($pending_friends);

        //retrive request friends who i send him request but he no accepted
        $request_friends = $this->request_friends();
        $request_friends_count = count($request_friends);

        if (!request()->getQueryString()) {
            $friends = $allfriends;
        }
        if (request()->query('friends') == 'pending') {
            $friends = $pending_friends;
        }
        if (request()->query('friends') == 'requests') {
            $friends = $request_friends;
        }
        //return $friends;
        return view('blogs.friendships.index', compact('friends', 'allfriends_count', 'pending_friends_count', 'request_friends_count'));
    }


    public function allfriends()
    {
        //retrive all friends data 
        $allfriends_data = auth()->user()->allFriends();
        $allfriends_collection = collect($allfriends_data);
        $allfriends = $allfriends_collection->filter(function ($value, $key) {
            return data_get($value, 'pivot.status') == 1;
        });
        return $allfriends->all();
    }

    public function pending_friends()
    {
        //retrive pending friends who send me request but i no accepted
        $pending_data = auth()->user()->allFriendshipRevarse;
        $pending_friends_collection = collect($pending_data);
        $pending_friends = $pending_friends_collection->filter(function ($value, $key) {
            return data_get($value, 'pivot.status') == 0;
        });
        return $pending_friends->all();
    }

    public function request_friends()
    {
        //retrive request friends who i send him request but he no accepted
        $request_data = auth()->user()->allFriendshipInverse;
        $request_friends_collection = collect($request_data);
        $request_friends = $request_friends_collection->filter(function ($value, $key) {
            return data_get($value, 'pivot.status') == 0;
        });
        return $request_friends->all();
    }


    public function current_user_find_friends()
    {
        if (request()->isMethod('POST')) {
            auth()->user()->allFriendshipInverse()->attach(['friend_id' => request()->friend_id]);
            return back()->with('success', 'Friend request send successfull!');
        }
        $exixts_friends = auth()->user()->allFriends()->pluck('id');
        $friends = User::where('status', 0)->whereNotIn('id', $exixts_friends)->latest()->get()->except(request()->query('id'));
        return view('blogs.friendships.findFriend', compact('friends'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FriendShip  $friendShip
     * @return \Illuminate\Http\Response
     */
    public function show(FriendShip $friendShip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FriendShip  $friendShip
     * @return \Illuminate\Http\Response
     */
    public function edit(FriendShip $friendShip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FriendShip  $friendShip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        FriendShip::find($id)->update(['status' => 1]);
        return back()->with('success', 'Friend list updated successfull!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FriendShip  $friendShip
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //return $id;
        $friend = FriendShip::find($id);
        $friend->forceDelete();
        return back()->with('success', 'Remove from friend list successfull!');
    }
}
