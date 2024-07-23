<?php

namespace App\Http\Controllers;

use App\Models\Blok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BlokController extends Controller
{
    public function index(){
        $bloks = Blok::paginate(15);

        return view('blok.index', compact('bloks'));
    }

    public function create(){
        return view('blok.create');
    }

    public function store(Request $req)
    {
        $validate = $req->validate(
            [
                'blok' => 'required|unique:bloks',
                'alamat' => 'required',
            ]
        );

        if($validate){
            Blok::create($validate);

            return Redirect::route('blok')->with('inputSuccess', 'success');
        }else{
            return redirect()->back();
        }

    }

    public function edit(Blok $blok){
        return view('blok.edit', compact('blok'));
    }

    public function update(Blok $blok, Request $req){
        $validate = $req->validate(
            [
                'blok' => 'required|unique:bloks,blok,'.$blok->id,
                'alamat' => 'required',
            ]
        );

        if($validate){
            $blok->update($validate);

            return Redirect::route('blok')->with('inputSuccess', 'success');
        }else{
            return redirect()->back();
        }
    }

    public function delete(Blok $blok){
        $blok->delete();

        return Redirect::route('blok')->with('deleteS', 'success');
    }
}
