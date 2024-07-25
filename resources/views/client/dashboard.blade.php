@extends('layout.main')
@section('title', 'Dashboard')
@section('db', 'active')
@section('bread', 'Dashboard')

@section('content')
    @php
        $nextMonthFormatted = date('m', strtotime($customer->cicilan->created_at)) + 0;
    @endphp


    @if ($customer->cicilan->status == "Lunas")
    <div class="card rounded-4 overflow-hidden mb-3 bg-success-subtle border-success-subtle h-100">
        <div class="card-body fw-bold py-3 text-success">
            Semua cicilan Anda telah selesai. Terima kasih atas kerja sama dan kepercayaan Anda.
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-6 align-self-stretch">
            <div class="card text-white rounded-4 overflow-hidden bg-primary border-primary h-100">
                <div class="card-header bg-primary overflow-hidden border-0 p-4">
                    <div class="fw-bolder fs-2">
                        {{ $customer->cicilan->lunas->count() }}/{{ $customer->cicilan->jangka_waktu * 12 }}
                        <span class="fs-6 fw-medium">Cicilan Lunas</span>
                    </div>
                    <hr>
                    <div>
                        {{ bulan($customer->cicilan->created_at) . ' s/d ' . bulan_only($nextMonthFormatted) . ' ' . (date('Y', strtotime($customer->cicilan->created_at)) + $customer->cicilan->jangka_waktu) }}
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex mb-2 justify-content-between">
                        <div class="fs-14">
                            {{ number_format(($customer->cicilan->lunas->count() / ($customer->cicilan->jangka_waktu * 12)) * 100, 2) }}%
                        </div>
                        <div class="fs-14">100%</div>
                    </div>
                    <div class="progress rounded-5" role="progressbar" aria-label="Success example" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-info"
                            style="width: {{ number_format(($customer->cicilan->lunas->count() / ($customer->cicilan->jangka_waktu * 12)) * 100, 2) }}%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-2 mt-md-0 align-self-stretch">
            <div class="card rounded-4 overflow-hidden h-100">
                <div class="card-body p-4">
                    <div class="fw-bolder fs-2">
                        <span class="fs-5 fw-medium">Data Rumah</span>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-2">
                                Blok {{ Auth::guard('customer')->user()->rumah->blok }}
                            </div>
                            <div class="mb-2">
                                Luas Tanah : {{ Auth::guard('customer')->user()->rumah->luas_tanah }}m<sup>2</sup>
                            </div>
                            <div class="mb-2">
                                Luas bangunan : {{ Auth::guard('customer')->user()->rumah->luas_bangunan }}m<sup>2</sup>
                            </div>
                            <div>
                                Harga :
                                {{ number_format(Auth::guard('customer')->user()->cicilan->harga_properti, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="col-6">
                            <img src="{{ Cloudinary::getUrl(Auth::guard('customer')->user()->rumah->gambar) }}"
                                class="w-100 rounded-2" alt="">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="card rounded-4 mt-3 overflow-hidden">
        <div class="card-header bg-white">
            <h6 class="fw-semibold mt-2">Riwayat Pembayaran Terakhir</h6>
        </div>
        <div class="card-body pt-0">
            <div class="table-responsive fs-14">
                <table class="table table-sm gy-5 align-middle">
                    <thead class="text-muted">
                        <tr>
                            <th>No.</th>
                            <th>Nama Customer</th>
                            <th>Nominal</th>
                            <th>Status</th>
                            <th>Tanggal Bayar</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Auth::guard('customer')->user()->pembayaran()->latest()->take(5)->get() as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->customer->nama }}</td>
                                <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                <td>
                                    @switch($item->status)
                                        @case('Sedang Diproses')
                                            <div class="badge py-2 text-primary bg-primary-subtle">{{ $item->status }}</div>
                                        @break

                                        @case('Berhasil')
                                            <div class="badge py-2 text-success bg-success-subtle">{{ $item->status }}</div>
                                        @break

                                        @default
                                            <div class="badge py-2 text-danger bg-danger-subtle">{{ $item->status }}</div>
                                    @endswitch
                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-end gap-2">
                                        <a href="{{ route('client.detail', $item->id) }}"
                                            class="px-0 mx-2 btn btn-sm no-border ">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>

                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
