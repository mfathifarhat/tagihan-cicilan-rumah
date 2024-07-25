<?php

namespace App\Http\Controllers;

use App\Models\Cicilan;
use App\Models\Customer;
use App\Models\Pembayaran;
use App\Models\Rumah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::paginate(15);

        return view('admin.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $req)
    {
        $validate = $req->validate(
            [
                'name' => 'required',
                'password' => 'required',
                'email' => 'email|required|unique:users,email',
            ]
        );

        $latestAdmin = User::latest()->first();
        $latestKode = $latestAdmin->kode_admin;

        $number = (int) substr($latestKode, 3);
        $newKode = 'ADM' . str_pad($number + 1, 3, '0', STR_PAD_LEFT);

        $validate['kode_admin'] = $newKode;

        if($validate){
            User::create($validate);

            return Redirect::route('admin')->with('inputSuccess', 'success');
        }else{
            return redirect()->back();
        }

    }

    public function edit(User $user){
        return view('admin.edit', compact('user'));
    }

    public function update(User $user, Request $req){
        $validate = $req->validate(
            [
                'name' => 'required',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('customers')->ignore($user->id),
                    Rule::unique('users')->ignore($user->id)
                ],
            ]
        );

        if($validate){
            $user->update($validate);

            return Redirect::route('admin')->with('inputSuccess', 'success');
        }else{
            return redirect()->back();
        }
    }

    public function delete(User $user){
        $user->delete();

        return Redirect::route('admin')->with('deleteS', 'success');
    }

    public function search(Request $req){
        $admins = User::where('name', 'LIKE', "%$req->keyword%")->paginate(15);

        return view('admin.index', compact('admins'));
    }

    public function dashboard(){
        $cicilan = Cicilan::all();
        $pembayaran = Pembayaran::orderByDesc('created_at')->take(5)->get();
        $totalAdmin = User::all()->count();
        $totalRumah = Rumah::all()->count();
        $totalCustomer = Customer::all()->count();

        return view('dashboard.index', compact('cicilan', 'pembayaran', 'totalAdmin', 'totalRumah', 'totalCustomer'));
    }
}