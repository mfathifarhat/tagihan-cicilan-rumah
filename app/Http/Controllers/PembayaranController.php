<?php

namespace App\Http\Controllers;

use App\Models\Cicilan;
use App\Models\Customer;
use App\Models\Pembayaran;
use App\Models\Rumah;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::orderByRaw("CASE WHEN status = 'Sedang Diproses' THEN 1 ELSE 2 END")
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('transaksi.index', compact('pembayarans'));
    }

    public function bayardp()
    {
        return view('transaksi.bayardp');
    }

    public function search(Request $req)
    {
        $pembayarans = Pembayaran::whereHas('customer', function($query) use ($req) {
            $query->where('nama', 'LIKE', "%{$req->keyword}%");
        })->paginate(15);


        return view('transaksi.index', compact('pembayarans'));
    }

    public function storedp(Request $req)
    {
        $validator = $req->validate([
            'metode' => 'required',
            'bukti' => 'required',
        ]);

        $customer = Customer::create($req->session()->get('customer-data'));

        $cicilanData = $req->session()->get('cicilan-data');

        $cicilanData['customer_id'] = $customer->id;

        Cicilan::create($cicilanData);

        $rumah = Rumah::find($req->session()->get('customer-data')['rumah_id']);

        $rumah->status = 'Terjual';

        $rumah->save();

        $validator['customer_id'] = $customer->id;
        $validator['pembayaran'] = 'Uang Muka';
        $validator['nominal'] = $req->session()->get('cicilan-data')['dp'];
        $validator['status'] = 'Berhasil';

        $filename = $req->file('bukti')->store('image', 'public');

        $validator['bukti'] = $filename;

        Pembayaran::create($validator);
        if ($validator) {

            return Redirect::route('customer')->with('inputSuccess', 'success');
        } else {
            return redirect()->back();
        }
    }

    public function detail(Pembayaran $pembayaran)
    {
        return view('transaksi.detail', compact('pembayaran'));
    }

    public function update(Pembayaran $pembayaran, Request $req)
    {
        $validate = $req->validate(
            [
                'status' => 'required',
            ]
        );
        $validate['ket'] = $req->ket;
        $validate['user_id'] = Auth::user()->id;

        if ($validate) {
            $pembayaran->update($validate);

            if ($req->status == 'Berhasil') {
                $tagihan = Tagihan::find($pembayaran->tagihan_id);

                $tagihan->update([
                    'status' => 'Lunas'
                ]);

                if ($pembayaran->customer->cicilan->lunas()->count() >= $pembayaran->customer->cicilan->jangka_waktu * 12) {
                    $cicilan = $pembayaran->customer->cicilan;
                    $cicilan->status = 'Lunas';
                    $cicilan->save();
                }else{
                    $cicilan = $pembayaran->customer->cicilan;
                    $cicilan->status = 'Belum Lunas';
                    $cicilan->save();
                }


            }

            return Redirect::route('pembayaran')->with('inputSuccess', 'success');
        } else {
            return redirect()->back();
        }
    }
}
