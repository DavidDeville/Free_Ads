<?php

namespace App\Http\Controllers;

use App\Annonces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnoncesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function display_new_annonce()
    {
        $user_info = Auth::user();
        if(isset($user_info)) {
            return view('/annonces/new', ['user_info' => $user_info, 'connected_user_id' => $user_info->id ]);
        }
        else {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function send_new_annonce(Request $request)
    {
        // if(auth()->user()) {
        //     $data = request()->validate([
        //         'title' => ['required'],
        //         'description' => ['required'],
        //         'price' => ['required'],
        //         'images' => ['required'],
        //     ]);
        //     $data['user_id'] = Auth::user()->id;
        //     $user = Auth::user();
        //     Annonces::create($data);
            // $data = request()->validate([
            //     'title' => ['required'],
            //     'content' => ['required'],
            //     'tags' => ['required'],
            // ]);
            // $data['user_id'] = Auth::user()->id;
            // $user = Auth::user();
            // Annonces::create($data);
        // }
        // else {
        //     abort(404);
        // }
        

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
