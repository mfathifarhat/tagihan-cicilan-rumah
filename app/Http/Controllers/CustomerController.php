<?php

namespace App\Http\Controllers;

use App\Models\Cicilan;
use App\Models\Customer;
use App\Models\Rumah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(15);


        return view('customer.index', compact('customers'));
    }

    public function create()
    {
        $rumahs = Rumah::paginate(15);
        return view('customer.create', compact('rumahs'));
    }

    public function store(Request $req)
    {
        $combinedValidationRules = [
            'rumah_id' => 'required',
            'nama' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('customers'),
                Rule::unique('users')
            ],
            'password' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'harga_properti' => 'required',
            'dp' => 'required',
            'cicilan' => 'required',
            'jangka_waktu' => 'required',
        ];

        $validatedData = $req->validate($combinedValidationRules);

        if ($validatedData) {
            $customerData = [
                'rumah_id' => $validatedData['rumah_id'],
                'nama' => $validatedData['nama'],
                'email' => $validatedData['email'],
                'password' => $validatedData['password'],
                'alamat' => $validatedData['alamat'],
                'no_hp' => $validatedData['no_hp'],
            ];

            $cicilanData = [
                'harga_properti' => $validatedData['harga_properti'],
                'dp' => $validatedData['dp'],
                'cicilan' => $validatedData['cicilan'],
                'jangka_waktu' => $validatedData['jangka_waktu'],
            ];

            $customer = Customer::create($customerData);

            $cicilanData['customer_id'] = $customer->id;

            Cicilan::create($cicilanData);


            return Redirect::route('customer')->with('inputSuccess', 'success');
        } else {
            return redirect()->back();
        }
    }

    public function detail(Customer $customer)
    {
        return view('customer.detail', compact('customer'));
    }

    public function update(Customer $customer, Request $req)
    {
        $validate = $req->validate(
            [
                'nama' => 'required',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('customers')->ignore($customer->id),
                    Rule::unique('users')->ignore($customer->id),
                ],
                'alamat' => 'required',
                'no_hp' => 'required',
            ]
        );

        if ($validate) {
            $customer->update($validate);

            return Redirect::route('customer')->with('inputSuccess', 'success');
        } else {
            return redirect()->back();
        }
    }

    public function delete(Customer $customer)
    {

        $customer->delete();

        return Redirect::route('customer')->with('deleteS', 'success');
    }

    public function search(Request $req)
    {
        $customers = Customer::where('nama', 'LIKE', "%$req->keyword%")->paginate(15);


        return view('customer.index', compact('customers'));
    }
}
