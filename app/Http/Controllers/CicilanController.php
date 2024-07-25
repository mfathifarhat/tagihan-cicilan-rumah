<?php

namespace App\Http\Controllers;

use App\Models\Cicilan;
use App\Models\Customer;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CicilanController extends Controller
{
    public function index()
    {
        $cicilans = Cicilan::paginate(15);


        return view('cicilan.index', compact('cicilans'));
    }

    public function detail(Cicilan $cicilan){
        return view('cicilan.detail', compact('cicilan'));
    }

    public function search(Request $req)
    {
        $cicilans = Cicilan::whereHas('customer', function($query) use ($req) {
            $query->where('nama', 'LIKE', "%{$req->keyword}%");
        })->paginate(15);


        return view('cicilan.index', compact('cicilans'));
    }


    public function pengingat(Customer $customer){
        $token = 'EZBLU_kFcfH+LLqtvjSA';
        $pesan = "Halo $customer->nama, kami ingin mengingatkan untuk selalu membayar cicilan rumah kamu sebelum jatuh tempo agar tidak terkena denda.";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('target' => $customer->no_hp, 'message' => $pesan),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;

        return redirect()->back()->with('messageSuccess', 'success');
    }

    public function pengingatJapo(Customer $customer){
        $token = 'EZBLU_kFcfH+LLqtvjSA';
        $pesan = "Halo $customer->nama, kami ingin menginformasikan bahwa kamu telah telat membayar cicilan! Denda terlambat setiap harinya adalah 1% dari harga rumah kamu. Jadi pastikan untuk segera membayar cicilan anda!";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('target' => $customer->no_hp, 'message' => $pesan),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;

        return redirect()->back()->with('messageSuccess', 'success');
    }

    public function storeTagihan(Customer $customer, Request $req){

        $validate = request()->validate([
            'bulan' => 'required',
        ]);
        list($year, $month) = explode('-', $req->bulan);
        $validate['bulan'] = $month;
        $validate['tahun'] = $year;

        $validate['cicilan_id'] = $customer->cicilan->id;

        Tagihan::create($validate);

        return redirect()->back()->with('inputSuccess', 'success');
    }

    public function delete(Tagihan $tagihan){
        $tagihan->delete();

        return redirect()->back()->with('deleteS', 'success');
    }
}
