@extends('layout.main')
@section('title', 'Bayar Cicilan')
@section('cicilan', 'active')
@section('bread', 'Bayar Cicilan')

@section('content')
    @php
        use Carbon\Carbon;

        $createdAt = Carbon::parse("10-$tagihan->bulan-$tagihan->tahun");

        $daysPassed = intval($createdAt->floatDiffInDays(Carbon::now()));

        if($daysPassed < 0){
            $daysPassed = 0;
        }
    @endphp
    <div class="card rounded-4 overflow-hidden">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="fs-14 fw-medium">Tanggal Jatuh Tempo
                        </div>
                        <div class="mt-2 fw-bold">{{ '10 ' . bulan_only(ltrim($tagihan->bulan, '0')) .' '. $tagihan->tahun  }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="fs-14 fw-medium">Cicilan/Bulan</div>
                        <div class="mt-2 fw-bold">Rp
                            {{ number_format(Auth::guard('customer')->user()->cicilan->cicilan, 0, ',', '.') }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="fs-14 fw-medium">Cicilan Lunas</div>
                        <div class="mt-2">
                            {{ Auth::guard('customer')->user()->cicilan->lunas->count() }}/{{ Auth::guard('customer')->user()->cicilan->jangka_waktu * 12 }}
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            @if ($daysPassed > 0)
                <div class="my-1">Terlambat : {{ $daysPassed }} Hari</div>
                <div class="my-1">Denda :
                    Rp {{ number_format($daysPassed * ((Auth::guard('customer')->user()->cicilan->cicilan / 100) * 1), 0, ',', '.') }}
                </div>
            @endif
            <div class="my-1">Total nominal yang harus dibayar :
                <span class="fw-bold">
                    Rp {{ number_format(Auth::guard('customer')->user()->cicilan->cicilan + $daysPassed * ((Auth::guard('customer')->user()->cicilan->cicilan / 100) * 1), 0, ',', '.') }}
                </span>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="denda" value="{{ $daysPassed }}">
                <div class="row">

                    {{-- <div class="col-md-12 mt-2">
                        <label for="metode" class="form-label fs-14 fw-medium">Metode Pembayaran</label>
                        <input type="text" class="form-control" name="metode" id="metode">
                        @error('metode')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <input type="hidden" name="nominal" value="{{ Auth::guard('customer')->user()->cicilan->cicilan + $daysPassed * ((Auth::guard('customer')->user()->cicilan->cicilan / 100) * 1) }}" id="">

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
