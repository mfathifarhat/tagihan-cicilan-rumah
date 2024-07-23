@extends('layout.main')
@section('title', 'Dashboard')
@section('db', 'active')
@section('bread', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-md-6 align-self-stretch">
            <div class="card text-white rounded-4 overflow-hidden bg-primary border-primary h-100">
                <div class="card-header bg-primary overflow-hidden border-0 p-4">
                    <h2 class="fw-bolder">{{ $cicilan->count() }}</h2>
                    <div>Total Cicilan</div>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex mb-2 justify-content-between">
                        <div class="fs-14">{{ $cicilan->where('status', 'Lunas')->count() }} Lunas</div>
                        <div class="fs-14">
                            @if ($cicilan->count() > 0)
                                {{ number_format(($cicilan->where('status', 'Lunas')->count() / $cicilan->count()) * 100, 2) }}%

                            @else
                                0%
                            @endif
                        </div>
                    </div>
                    <div class="progress rounded-5" role="progressbar" aria-label="Success example" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100">
                        @if ($cicilan->count() > 0)
                            
                            <div class="progress-bar bg-info"
                                style="width: {{ number_format(($cicilan->where('status', 'Lunas')->count() / $cicilan->count()) * 100, 2) }}%">
                            </div>
                        @else

                            <div class="progress-bar bg-info" style="width: 0%"></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mt-2 mt-md-0 align-self-stretch">
            <div class="card rounded-4 overflow-hidden h-100">
                <div class="card-header bg-white border-0 p-4">
                    <h5 class="fw-medium">Jumlah Data</h5>
                    <hr>
                </div>
                <div class="card-body p-4 pt-0 pt-md-3">
                    <div class="row">
                        <div class="col-md-4 col-6">
                            <div class="form-group">
                                <div class=" fw-medium">Admin
                                </div>
                                <div class="mt-2 fs-4 fw-bold">{{ $totalAdmin }}</div>
                            </div>
                        </div>
                        <div class="col-md-4 col-6">
                            <div class="form-group">
                                <div class=" fw-medium">Rumah
                                </div>
                                <div class="mt-2 fs-4 fw-bold">{{ $totalRumah }}</div>
                            </div>
                        </div>
                        <div class="col-md-4 col-6 mt-2 mt-md-0">
                            <div class="form-group">
                                <div class=" fw-medium">Customer
                                </div>
                                <div class="mt-2 fs-4 fw-bold">{{ $totalCustomer }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card rounded-4 mt-3 overflow-hidden">
        <div class="card-header bg-white">
            <h6 class="fw-semibold mt-2">Pembayaran Terakhir</h6>
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
                        @foreach ($pembayaran as $item)
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
                                <td>{{ $item->created_at->timezone('Asia/Jakarta') }}</td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-end gap-2">
                                        <a href="{{ route('detail-pembayaran', $item->id) }}"
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
