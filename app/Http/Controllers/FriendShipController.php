<?php

namespace App\Http\Controllers;

use App\Models\FriendShip;
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
        $friends = auth()->user()->friendships();
        return view('blogs.friendships.index', compact('friends'));
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
    public function update(Request $request, FriendShip $friendShip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FriendShip  $friendShip
     * @return \Illuminate\Http\Response
     */
    public function destroy(FriendShip $friendShip)
    {
        //
    }
}
