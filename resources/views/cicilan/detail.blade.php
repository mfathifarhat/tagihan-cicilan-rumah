@extends('layout.main')
@section('title', 'Detail Cicilan')
@section('cicilan', 'active')
@section('bread', 'Detail Cicilan')

@section('content')
    @php

        use Carbon\Carbon;

    @endphp

    <div class="card rounded-4 overflow-hidden">
        {{-- <div class="card-header bg-white border-0 p-3 row"> --}}
        {{-- <div class="search">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>

                <input type="text" class="form-control form-control-solid" placeholder="Search Customer">
            </div>
            <div class="tools d-flex align-items-center gap-3">
                <a href="{{ route('create-customer') }}" class="fs-14 btn btn-primary text-nowrap d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>

                    <span class="ms-2">Create</span>
                </a>
            </div> --}}

        {{-- </div> --}}
        <div class="card-body">
            <h6 class="fw-semibold">Data Cicilan</h6>
            <hr>
            <div class="row gy-3">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="fs-14 fw-medium">Nama Customer
                        </div>
                        <div class="mt-2 fw-bold">
                            {{ $cicilan->customer->nama }}</div>
                    </div>
                </div>
                <div class="col-md-4 mt-2">
                    <div class="form-group">
                        <div class="fs-14 fw-medium">Harga Properti</div>
                        <div class="mt-2">Rp {{ number_format($cicilan->harga_properti, 0, ',', '.') }}</div>
                    </div>
                </div>
                <div class="col-md-4 mt-2">
                    <div class="form-group">
                        <div class="fs-14 fw-medium">Cicilan/Bulan</div>
                        <div class="mt-2 fw-bold">Rp {{ number_format($cicilan->cicilan, 0, ',', '.') }}</div>
                    </div>
                </div>
                <div class="col-md-4 mt-2">
                    <div class="form-group">
                        <div class="fs-14 fw-medium">Cicilan Lunas</div>
                        <div class="mt-2">
                            {{ $cicilan->lunas->count() }}/{{ $cicilan->jangka_waktu * 12 }}</div>
                    </div>
                </div>
            </div>

            @if ($cicilan->status != 'Lunas')
                <hr>

                <div class="form-group">
                    <div class="fs-14 fw-medium">Kirim Pesan Pengingat</div>
                    <div class="mt-2">
                        <a href="{{ route('pengingat', $cicilan->customer) }}" class="btn btn-primary fs-14">Kirim
                            Pengingat</a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="card rounded-4 overflow-hidden mt-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="fw-semibold m-0">Tagihan yang harus dibayar</h6>


                @if ($cicilan->status != 'Lunas')
                    <button type="button" class="btn btn-sm btn-primary fs-14" data-bs-toggle="modal"
                        data-bs-target="#createTagihan">
                        Buat Tagihan
                    </button>
                @endif
            </div>
            <hr>

            @if ($cicilan->status == 'Lunas')
                <div class="row gy-2 justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="text-center py-3">
                                <span class="">Cicilan sudah lunas</span>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif ($cicilan->tagihan->where('status', '!=', 'Lunas')->count() < 1)
                <div class="row gy-2 justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="text-center py-3">
                                <span class="">Tidak ada cicilan yang harus dibayar bulan ini</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @foreach ($cicilan->tagihan->where('status', '!=', 'Lunas') as $item)
                <div class="row gy-2 mb-2">
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="fs-14 fw-medium">Tanggal Jatuh Tempo
                            </div>
                            <div class="mt-2 fw-bold">
                                {{ '10 ' . bulan_only(ltrim($item->bulan, '0')) . ' ' . $item->tahun }}</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="fs-14 fw-medium">Nominal</div>
                            <div class="mt-2">Rp {{ number_format($cicilan->cicilan, 0, ',', '.') }}
                            </div>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="mt-2">
                                @if ($item->bayar->count() > 0)
                                    @switch($item->bayar()->latest()->first()->status)
                                        @case('Sedang Diproses')
                                            <div class="badge py-2 text-primary bg-primary-subtle">
                                                {{ $item->bayar()->latest()->first()->status }}
                                            </div>
                                        @break

                                        @case('Berhasil')
                                            <div class="badge py-2 text-success bg-success-subtle">
                                                {{ $item->bayar()->latest()->first()->status }}
                                            </div>
                                        @break

                                        @default
                                            <div class="badge py-2 text-danger bg-danger-subtle">
                                                {{ $item->bayar()->latest()->first()->status }}
                                            </div>
                                    @endswitch
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="d-flex">
                            @if (intval(Carbon::parse("10-$item->bulan-$item->tahun")->floatDiffInDays(Carbon::now())) > 0)
                                <a href="{{ route('pengingat-japo', $cicilan->customer) }}" class="btn btn-sm btn-primary">Kirim
                                    pengingat</a>
                            @endif
                            <a href="{{ route('delete-cicilan', $item) }}" class="btn btn-sm btn-danger ms-2">Hapus</a>
                        </div>
                    </div>

                    @if ($item->bayar->count() > 0)
                        @if ($item->bayar()->latest()->first()->status == 'Gagal')
                            <div class="col-md-12">
                                <div class="mt-2"><span class="text-danger fw-semibold">Keterangan</span> :
                                    {{ $item->bayar()->latest()->first()->ket ? $item->bayar()->latest()->first()->ket : 'Tidak ada keterangan' }}
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
                <hr>
            @endforeach
        </div>
    </div>

    <div class="modal fade" id="createTagihan" tabindex="-1" aria-labelledby="createTagihanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-6" id="createTagihanLabel">Buat Tagihan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('storeTagihan', $cicilan->customer) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="bulan" class="form-label">Bulan & Tahun</label>
                            <input type="month" name="bulan" id="bulan" class="form-control" placeholder=""
                                aria-describedby="helpId" />
                        </div>
                        <hr>
                        <div class="text-end">
                            <button class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
