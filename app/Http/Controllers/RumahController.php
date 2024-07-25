<?php

namespace App\Http\Controllers;

use App\Models\Rumah;
use Cloudinary\Api\Upload\UploadApi;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class RumahController extends Controller
{
    public function index()
    {
        $rumahs = Rumah::paginate(15);

        return view('rumah.index', compact('rumahs'));
    }

    public function create()
    {
        return view('rumah.create');
    }

    public function store(Request $req)
    {
        $validate = $req->validate(
            [
                'blok' => 'required',
                'jumlah_kamar' => 'required',
                'luas_tanah' => 'required',
                'luas_bangunan' => 'required',
                'harga' => 'required',
                'gambar' => 'required|image|mimes:jpeg,jpg,png,gif|max:2048'
            ]
        );

        $latestRumah = Rumah::where('blok', $req->blok)->latest()->first();
        if ($latestRumah) {
            $latestKode = $latestRumah->kode_rumah;

            $number = (int) substr($latestKode, 2);
            $newKode = $req->blok . str_pad($number + 1, 2, '0', STR_PAD_LEFT);
        }else{
            $newKode = $req->blok . "01";
        }

        $validate['kode_rumah'] = $newKode;

        if ($validate) {

            $filename = $req->file('gambar')->storeOnCloudinary()->getPublicId();
            $validate['gambar'] = $filename;

            Rumah::create($validate);

            return Redirect::route('rumah')->with('inputSuccess', 'success');
        } else {
            return redirect()->back();
        }
    }

    public function edit(Rumah $rumah)
    {
        return view('rumah.edit', compact('rumah'));
    }

    public function update(Rumah $rumah, Request $req)
    {
        $validate = $req->validate(
            [
                'jumlah_kamar' => 'required',
                'luas_tanah' => 'required',
                'luas_bangunan' => 'required',
                'harga' => 'required',
                'gambar' => 'image|mimes:jpeg,jpg,png,gif|max:2048'
            ]
        );


        if ($validate) {
            if ($req->file('gambar') != null) {
                Cloudinary::destroy($rumah->gambar);
                $filename = $req->file('gambar')->storeOnCloudinary()->getPublicId();

                $validate['gambar'] = $filename;
            }

            $rumah->update($validate);

            return Redirect::route('rumah')->with('inputSuccess', 'success');
        } else {
            return redirect()->back();
        }
    }

    public function delete(Rumah $rumah)
    {
        $rumah->delete();

        return Redirect::route('rumah')->with('deleteS', 'success');
    }

    public function search(Request $req)
    {
        $keyword = $req->keyword;


        $rumahs = Rumah::where('blok', 'LIKE', "%$keyword%")->paginate(15);

        return view('rumah.search', compact('rumahs'));
    }

    public function searchMain(Request $req)
    {
        $keyword = $req->keyword;


        $rumahs = Rumah::where('blok', 'LIKE', "%$keyword%")->paginate(15);

        return view('rumah.index', compact('rumahs'));
    }
}
