@extends('layout.main')
@section('title', 'Cicilan Anda')
@section('cicilan', 'active')
@section('bread', 'Cicilan Anda')

@section('content')
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
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="fs-14 fw-medium">Harga Properti</div>
                        <div class="mt-2">Rp {{ number_format($customer->cicilan->harga_properti, 0, ',', '.') }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="fs-14 fw-medium">Cicilan/Bulan</div>
                        <div class="mt-2 fw-bold">Rp {{ number_format($customer->cicilan->cicilan, 0, ',', '.') }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="fs-14 fw-medium">Cicilan Lunas</div>
                        <div class="mt-2">
                            {{ $customer->cicilan->lunas->count() }}/{{ $customer->cicilan->jangka_waktu * 12 }}</div>
                    </div>
                </div>
            </div>

            <h6 class="fw-semibold mt-5">Tagihan Bulan Ini</h6>
            <hr>

            @if ($customer->cicilan->tagihan->where('status', '!=', 'Lunas')->count() < 1)
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

            @foreach ($customer->cicilan->tagihan->where('status', '!=', 'Lunas') as $item)
                    <div class="row gy-2 justify-content-center mb-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="fs-14 fw-medium">Tanggal Jatuh Tempo
                                </div>
                                <div class="mt-2 fw-bold">
                                    {{ '10 ' . bulan_only(ltrim($item->bulan, '0')) . ' ' . $item->tahun }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="fs-14 fw-medium">Nominal</div>
                                <div class="mt-2">Rp {{ number_format($customer->cicilan->cicilan, 0, ',', '.') }}
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="mt-2">
                                    <a href="{{ route('client.bayar', $item) }}"
                                        class="btn btn-primary fs-14 {{ $item->bayar->count() > 0 ? ($item->bayar()->latest()->first()->status == 'Sedang Diproses' ? 'disabled' : '') : '' }}">Bayar</a>
                                    @if ($item->bayar->count() > 0)
                                        @switch($item->bayar()->latest()->first()->status)
                                            @case('Sedang Diproses')
                                                <div class="badge py-2 text-primary bg-primary-subtle">{{ $item->bayar()->latest()->first()->status }}
                                                </div>
                                            @break

                                            @case('Berhasil')
                                                <div class="badge py-2 text-success bg-success-subtle">{{ $item->bayar()->latest()->first()->status }}
                                                </div>
                                            @break

                                            @default
                                                <div class="badge py-2 text-danger bg-danger-subtle">{{ $item->bayar()->latest()->first()->status }}
                                                </div>
                                        @endswitch
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if ($item->bayar->count() > 0)
                            @if ($item->bayar()->latest()->first()->status == 'Gagal')
                                <div class="col-md-12">
                                    <div class="mt-2"><span class="text-danger fw-semibold">Keterangan</span> : {{ $item->bayar()->latest()->first()->ket }}</div>
                                </div>
                            @endif
                        @endif
                    </div>
                    <hr>
            @endforeach

            {{-- @if ($tanggal_terlewat)
                @for ($i = 0; $i < $jumlah_bulan_terlewat; $i++)
                    <div class="row gy-2 justify-content-center mb-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="fs-14 fw-medium">Tanggal (Cicilan ke {{ $i + 1 }})
                                </div>
                                <div class="mt-2 fw-bold">{{ $tanggal_maju->addMonth($i)->format('d-m-Y') }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="fs-14 fw-medium">Nominal</div>
                                <div class="mt-2">Rp {{ number_format($customer->cicilan->cicilan, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="mt-2">
                                    <a href="client.bayar" class="btn btn-primary fs-14 {{ $tanggal_terlewat ? '' : 'disabled' }}">Bayar</a>
                                    @if (date_format($tanggal_maju, 'd-m-Y') == now()->format('d-m-Y'))
                                        <span class="badge py-2 text-success bg-success-subtle">Bayar Sekarang</span>
                                    @elseif($tanggal_terlewat)
                                        <span class="badge py-2 text-danger bg-danger-subtle">Terlambat</span>
                                    @else
                                        <span class="badge py-2 text-danger bg-danger-subtle">Belum waktunya</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endfor
            @else
                <div class="row gy-2 justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="text-center py-3">
                                <span class="">Tidak ada cicilan yang harus dibayar bulan ini</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif --}}
        </div>
    </div>

@endsection
