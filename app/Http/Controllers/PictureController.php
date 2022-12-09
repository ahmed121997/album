<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Picture;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($album_id)
    {
        $album = Album::findOrFail($album_id);
        $all_albums = Album::all();
        $pictures =$album->pictures;

        return view('picture.show',['album'=>$album,'pictures'=>$pictures,'all_albums'=>$all_albums]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('picture.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request,$id)
    {

       $album = Album::findOrFail($id);

        $data = $this->saveMultipleImages($request,'images');
        foreach($data as $i){
            $album->pictures()->create([
                'name' => $i,
                'path' => 'images/'.$i,

            ]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function destroy( $picture)
    {
        $data = Picture::findOrFail($picture);
        $data->delete();
        return redirect()->back();
    }


    public function change_album(Request $request , $id){
         $request;
        $picture = Picture::findOrFail($id);
        $album = Album::findOrFail($request->album);
        $picture->update(['album_id'=>$request->album]);
        return redirect()->back();
    }

    function saveMultipleImages($request,$nameFile){
        if($request->hasfile($nameFile))
        {
            $i = 0;$data = [];
            foreach($request->file($nameFile) as $image)
            {
                $name=  time().'_'.$i.'.'.$image->getClientOriginalExtension();
                $image->move(public_path().'/images/', $name);
                $data[] = $name;$i++;
            }
            return $data;
        }
    }
}
