@extends('layout.app')
@section('title', 'Login')


@section('body')
{{-- {{dd(auth()->guard());}} --}}
    <div
        class="login min-vh-100 d-flex justify-content-center align-items-start align-items-lg-center align-items-md-center align-items-sm-center bg-light">
        <div class="row w-100 justify-content-center">
            <div class="col-lg-4 mt-4 mt-sm-0 col-md-6 col-sm-8 col-12 col-xl-4 col-xxl-3">
                <div class="card overflow-hidden border-0 shadow-lg">
                    <div class="card-body p-3 p-sm-4">
                        <h4 class="fw-bolder text-center text-primary px-5 mx-4">Tagihan Cicilan Rumah</h4>
                        <hr>
                        <form action="{{ route('auth') }}" class="no-alert" method="post">
                            @csrf
                            <div class="form-group mt-1 mt-sm-2">
                                <label class="form-label" for="email">Email</label>
                                <input class="form-control form-login w-100 d-block" autocomplete="off" type="text"
                                    name="email" id="email" autofocus>
                            </div>
                            <div class="form-group mt-1 mt-sm-2 mb-2">
                                <label class="form-label" for="password">Password</label>
                                <input class="form-control form-login w-100 d-block" autocomplete="off" type="password"
                                    name="password" id="password">
                            </div>
                            <button class="mt-1 mt-sm-5 btn rounded-1 btn-primary py-2 w-100 fw-bold">LOGIN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection