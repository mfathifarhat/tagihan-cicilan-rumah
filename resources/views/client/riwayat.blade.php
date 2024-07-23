@extends('layout.main')
@section('title', 'Riwayat Pembayaran')
@section('bayar', 'active')
@section('bread', 'Riwayat')

@section('content')
    <div class="card rounded-4 overflow-hidden">
        <div class="card-header bg-white border-0 p-3 d-flex align-items-center justify-content-between">
            <div class="search">
                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>

                <input type="text" class="form-control form-control-solid" placeholder="Search Pembayaran"> --}}
            </div>
            <div class="tools d-flex align-items-center gap-3">
                <a href="{{ route('kwitansi.export') }}" class="fs-14 px-4 btn btn-primary text-nowrap d-flex align-items-center {{Auth::guard('customer')->user()->cicilan->lunas->count() <= 0 ? 'disabled' : ''}}">
                    <span >Excel</span>
                </a>
                <a href="{{ route('client.kwitansi') }}" class="fs-14 px-4 btn btn-primary text-nowrap d-flex align-items-center {{Auth::guard('customer')->user()->cicilan->lunas->count() <= 0 ? 'disabled' : ''}}">
                    <span>PDF</span>
                </a>
            </div>
        </div>
        <div class="card-body">
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
                        @foreach ($pembayarans as $item)
                            <tr>
                                <td>{{ $loop->iteration + 15 * ($pembayarans->currentPage() - 1) }}</td>
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
            <div class="pagination row gy-2 justify-content-between align-items-center">
                <div class="col-sm-6 text-center text-sm-start">
                    Page {{ $pembayarans->currentPage() }} of {{ $pembayarans->lastPage() }}
                </div>
                <div class="col-sm-6 text-center text-sm-end">
                    <a href="{{ $pembayarans->previousPageUrl() }}" class="btn btn-sm btn-primary">Previous</a>
                    <a href="{{ $pembayarans->nextPageUrl() }}" class="btn btn-sm btn-primary">Next</a>
                </div>
            </div>
        </div>
    </div>
@endsection
