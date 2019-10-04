<?php

namespace App\Http\Controllers;

use App\Images;
use App\Annonces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
            return view('/annonces/new', ['user_info' => $user_info, 'connected_user_id' => $user_info->id]);
        }
        else {
            abort(404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function display_annonces()
    {
        $annonces = Annonces::get();
        // foreach($annonces as $annonce) {
        //     dd($annonce->users);
        // }
        //dd($annonces->users);
        $user_info = Auth::user()->id;
        //dd($user_info);
        return view('/annonces/read', ['annonces' => $annonces, 'connected_user_id' => $user_info]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function display_selected_annonce($id)
    {
        if(Annonces::find($id) == false) {
            abort(404);
        }
        if(Auth::user() == false) {
            return redirect('login');
        }
        else {
            $annonces = Annonces::where('id', $id)->get();
            $user_info = Auth::user()->id;
            return view('/annonces/annonce_read', ['annonces' => $annonces, 'connected_user_id' => $user_info]);
        }      
    }

    /**
     * Display the specified resource.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function display_annonce_edit($id)
    {
        if(Annonces::find($id) == false) {
            abort(404);
        }
        if(Auth::user() == false) {
            return redirect('login');
        }
        else {
            $annonces = Annonces::where('id', $id)->get();
            $user_info = Auth::user();
            return view('/annonces/edit', ['annonces' => $annonces, 'connected_user_id' => Auth::user()->id, 'user_info' => $user_info]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function send_new_annonce(Request $request, Annonces $annonce, Images $images)
    {
        if(auth()->user()) {
            $request->validate([
                'title' => 'string|max:255',
                'description' => 'string|max:255',
                'price' => 'max:9',
            ]);
            $annonce->title = $request->input('title');
            $annonce->description = $request->input('description');
            $annonce->price = $request->input('price');
            $annonce->user_id = Auth::user()->id;
            $annonce->save();
            if($request->hasFile('images')) {
                foreach($request->file('images') as $file) {
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $fileName = str_random(5)."-".date('his')."-".str_random(3).".".$extension;
                    $destinationPath = 'public/storage'.'/';
                    $fileNameWithExtension = $file->getClientOriginalName();
                    $path = base_path() . "/public/storage/";
                    $file->move($path, $fileName);
                    $images::create([
                        'annonce_id' => $annonce->id,
                        'images' => $fileName,
                    ]);
                }
            }
            return redirect('/annonces/new')->with('status', 'Votre annonce a bien été envoyée');
        }
        else {
            abort(404);
        }
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
    public function update_annonce(Request $request, $id, Images $images, Annonces $annonce)
    {
        $annonce_info = Annonces::find($id);
        $connected_user_id = Auth::user()->id;
        // foreach($annonce_info->images as $image) {
        //     $user_image = url('/storage') . '/' . $image->images;
        //     dd($user_image);
        // }
        if(auth()->user()) {
            $data = $request->validate([
                'title' => 'string|max:255',
                'description' => 'string|max:255',
                'price' => 'max:9'
            ]);
            $data['title'] = $request->input('title');
            $data['description'] = $request->input('description');
            $data['price'] = $request->input('price');
            Annonces::where('id', $annonce_info->id)->update($data);
            if($request->hasFile('images')) {
                foreach($annonce_info->images as $image) {
                    $annonceImage = public_path('/storage' . '/' . $image->images);
                    if (File::exists($annonceImage)) { // unlink or remove previous image from folder
                        unlink($annonceImage);
                        Images::where('annonce_id', $annonce_info->id)->delete();
                    }
                }
                foreach($request->file('images') as $file) {
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $fileName = str_random(5)."-".date('his')."-".str_random(3).".".$extension;
                    $destinationPath = 'public/storage'.'/';
                    $path = base_path() . "/public/storage/";
                    $file->move($path, $fileName);
                    $images::create([
                        'annonce_id' => $annonce_info->id,
                        'images' => $fileName,
                    ]);
                }
            }
            return redirect('/' . 'annonces/' . $annonce_info->id . '/edit')->with('status', 'Votre annonce a bien été mise à jour');
        }
        else {
            abort(404);
        }
        //return view('/user/edit', ['success' => 'Vos données ont été modifiées', 'user_info' => $user_info, 'connected_user_id' => $connected_user_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Images::where('annonce_id', $id)->delete();
        Annonces::where('id', $id)->delete();
        // Auth::User()->Images()->delete();
        // Auth::User()->Annonces()->delete();
        // return Redirect::to('/register');
        $user_info = Auth::user();
        if(isset($user_info)) {
            return view('/annonces/new', ['user_info' => $user_info, 'connected_user_id' => $user_info->id ]);
        }
        else {
            abort(404);
        }
    }
}
