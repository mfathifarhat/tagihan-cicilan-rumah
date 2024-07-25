<?php

namespace App\Http\Controllers;

use App\Exports\KwitansiExport;
use App\Models\Cicilan;
use App\Models\Customer;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller
{
    public function index()
    {
        $customer = Customer::find(Auth::guard('customer')->user()->id);

        return view('client.dashboard', compact('customer'));
    }

    public function riwayat()
    {
        $pembayarans = Pembayaran::select('pembayarans.*')
            ->join('tagihans', 'pembayarans.tagihan_id', '=', 'tagihans.id')
            ->where('pembayarans.customer_id', Auth::guard('customer')->user()->id)
            ->orderBy('tagihans.tahun', 'asc')
            ->orderBy('tagihans.bulan', 'asc')
            ->paginate(15);

        return view('client.riwayat', compact('pembayarans'));
    }

    public function cicilan()
    {
        $customer = Customer::find(Auth::guard('customer')->user()->id);

        return view('client.cicilan', compact('customer'));
    }

    public function bayar(Tagihan $tagihan)
    {
        return view('client.bayar', compact('tagihan'));
    }

    public function storeBayar(Request $req, $tagihan)
    {
        $tagihan = Tagihan::find($tagihan);

        $validate = $req->validate([
            'bukti' => 'required',
            'nominal' => 'required'
        ]);

        $filename = $req->file('bukti')->store('image', 'public');
        $validate['denda'] = $req->denda;
        $validate['bukti'] = $filename;
        $validate['tagihan_id'] = $tagihan->id;
        $validate['customer_id'] = Auth::guard('customer')->user()->id;



        Pembayaran::create($validate);

        return Redirect::route('client.cicilan')->with('inputSuccess', 'success');
    }

    public function detail(Pembayaran $pembayaran)
    {
        return view('client.detail', compact('pembayaran'));
    }

    public function riwayatPrint()
    {
        $cicilan = Cicilan::where('customer_id', Auth::guard('customer')->user()->id)->first();

        return view('client.riwayatprint', compact('cicilan'));
    }

    public function export()
    {
        return Excel::download(new KwitansiExport, 'Riwayat.xlsx');
    }

    public function kwitansi(Pembayaran $pembayaran)
    {
        return view('client.kwitansi', compact('pembayaran'));
    }
}
