@extends('layout.main')
@section('title', 'Bayar Uang Muka')
@section('bayar', 'active')
@section('bread', 'Bayar Uang Muka')

@section('content')
    <div class="card rounded-4 overflow-hidden">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="fs-14 fw-medium">Nama</div>
                        <div class="mt-2">{{ Session::get('customer-data')['nama'] }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="fs-14 fw-medium">Harga Properti</div>
                        <div class="mt-2">Rp {{  number_format(Session::get('cicilan-data')['harga_properti'], 0, ',', '.') }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="fs-14 fw-medium">Uang Muka</div>
                        <div class="mt-2 fw-bold">Rp {{  number_format(Session::get('cicilan-data')['dp'], 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
            <hr>
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 mt-2">
                        <label for="bukti" class="form-label fs-14 fw-medium">Bukti Bayar</label>
                        <input type="file" class="form-control" name="bukti" id="bukti" accept="image/*">
                        @error('bukti')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <hr class="mt-4">
                <div class="d-flex align-items-center justify-content-end gap-2">
                    <a href="{{ route('customer') }}" class="btn btn-sm btn-light fw-medium text-muted border-0">Cancel</a>
                    <button class="btn btn-sm btn-primary fw-medium border-0">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
