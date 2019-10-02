<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_info = Auth::user()->find($id);
        $connected_user_id = Auth::user()->id;
        //dd($user_info->password);
        return view('/user/read', ['user_info' => $user_info, 'user_id' => $id, 'connected_user_id' => $connected_user_id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $connected_user_id = Auth::user()->id;
        $user_info = Auth::user()->find($id);
        return view('/user/edit', ['user_info' => $user_info, 'connected_user_id' => $connected_user_id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_info = Auth::user()->find($id);
        $connected_user_id = Auth::user()->id;
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|max:255',
            'password' => 'required|min:8',
        ]);
        $data['password'] = Hash::make($data['password']);
        User::where('id', $user_info->id)->update($data);
        return view('/user/edit', ['success' => 'données modifiées', 'user_info' => $user_info, 'connected_user_id' => $connected_user_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
