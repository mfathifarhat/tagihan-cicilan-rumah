@extends('layout.main')
@section('title', 'Detail Pembayaran')
@section('bayar', 'active')
@section('bread', 'Detail Pembayaran')

@section('content')
    <div class="card rounded-4 overflow-hidden">
        <div class="card-body">
            <h6 class="fw-semibold">Detail Pembayaran</h6>
            <hr>
            <div class="row">
                <div class="col-7">
                    <div class="form-group">
                        <h6 class="fw-semibold">Nama</h6>
                        <div>{{ $pembayaran->customer->nama }}</div>
                    </div>


                </div>

                <div class="col-5">
                    <div class="form-group text-end">
                        <h6 class="fw-semibold">Tanggal Bayar</h6>
                        <div>{{ date_format($pembayaran->created_at, 'd ') . bulan($pembayaran->created_at) }}</div>
                    </div>
                </div>



            </div>

            <table class="table mt-5">
                <tr>
                    <td class="fw-semibold ps-0">Cicilan/Bulan</td>
                    <td class="text-end pe-0">Rp {{ number_format($pembayaran->customer->cicilan->cicilan, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td class="fw-semibold ps-0">Denda ({{ $pembayaran->denda }} Hari)</td>
                    <td class="text-end pe-0">Rp
                        {{ number_format(($pembayaran->denda / 100) * $pembayaran->customer->cicilan->cicilan, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                </tr>
            </table>

            <div class="row">
                <div class="col-4">
                    <div class="fw-semibold ps-0">Total</div>
                </div>

                <div class="col-8 text-end">
                    <div class="text-end fw-semibold">Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}</div>
                </div>
            </div>


            {{-- <hr class="mt-4">
            <div class="d-flex align-items-center justify-content-between gap-2">
                <button type="button" class="btn btn-sm btn-danger fw-medium" data-bs-toggle="modal"
                    data-bs-target="#deleteModal">Delete</button>
                <div>
                    <a href="{{ route('customer') }}" class="btn btn-sm btn-light fw-medium text-muted border-0">Back</a>
                    <button class="btn btn-sm btn-primary fw-medium border-0">Submit</button>
                </div>
            </div> --}}
        </div>
    </div>

    <div class="card rounded-4 mt-3 overflow-hidden">
        <div class="card-body">
            <h6 class="fw-semibold">Bukti Pembayaran</h6>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="form-group">
                                <h6 class="fw-semibold text-center">Bukti Pembayaran</h6>
                                @if (Storage::disk('public')->has($pembayaran->bukti))
                                    <img class="w-100" src="{{ Storage::url($pembayaran->bukti) }}" alt="">
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-100" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    @if (Auth::user()->role == 'Admin')
        <div class="card rounded-4 mt-3 overflow-hidden">
            <div class="card-body">
                <form action="" method="post">
                    @csrf
                    <h6 class="fw-semibold">Konfirmasi Pembayaran</h6>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label fw-semibold" for="status">Status</label>
                                <select class="form-select" name="status" id="status">
                                    <option {{ $pembayaran->status == 'Berhasil' ? 'selected' : '' }} value="Berhasil">
                                        Berhasil
                                    </option>
                                    <option {{ $pembayaran->status == 'Gagal' ? 'selected' : '' }} value="Gagal">Gagal
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="form-label fw-semibold" for="ket">Keterangan</label>
                                <input class="form-control" type="text" name="ket" id="ket">
                            </div>
                        </div>

                    </div>

                    <hr class="mt-4">
                    <div class="d-flex align-items-center justify-content-between gap-2">
                        {{-- <button type="button" class="btn btn-sm btn-danger fw-medium" data-bs-toggle="modal"
                        data-bs-target="#deleteModal">Delete</button> --}}
                        <div>
                            <a href="{{ route('pembayaran') }}"
                                class="btn btn-sm btn-light fw-medium text-muted border-0">Back</a>
                            <button class="btn btn-sm btn-primary fw-medium border-0">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="card rounded-4 mt-3 overflow-hidden">
            <div class="card-body">
                <form action="" method="post">
                    @csrf
                    <h6 class="fw-semibold">Konfirmasi Pembayaran</h6>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label fw-semibold" for="status">Status</label>
                                <select class="form-select"
                                    {{ $pembayaran->status != 'Sedang Diproses' ? 'disabled' : '' }} name="status"
                                    id="status">
                                    <option {{ $pembayaran->status == 'Berhasil' ? 'selected' : '' }} value="Berhasil">
                                        Berhasil
                                    </option>
                                    <option {{ $pembayaran->status == 'Gagal' ? 'selected' : '' }} value="Gagal">Gagal
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="form-label fw-semibold" for="ket">Keterangan</label>
                                <input class="form-control"
                                    {{ $pembayaran->status != 'Sedang Diproses' ? 'disabled' : '' }} type="text"
                                    name="ket" id="ket">
                            </div>
                        </div>

                    </div>

                    <hr class="mt-4">
                    <div class="d-flex align-items-center justify-content-between gap-2">
                        {{-- <button type="button" class="btn btn-sm btn-danger fw-medium" data-bs-toggle="modal"
                        data-bs-target="#deleteModal">Delete</button> --}}
                        <div>
                            <a href="{{ route('pembayaran') }}"
                                class="btn btn-sm btn-light fw-medium text-muted border-0">Back</a>
                            <button class="btn btn-sm btn-primary fw-medium border-0"
                                {{ $pembayaran->status != 'Sedang Diproses' ? 'disabled' : '' }}>Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-6 fw-bold text-danger" id="deleteModalLabel">Warning</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <span class="text-danger p-4 ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                        </span>

                        <h6 class="mt-4">Apakah anda yakin ingin menghapus data ini?</h6>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <a href="{{route('delete-customer', $customer->id)}}" class="btn btn-danger fs-14 px-4">Delete</a> --}}
                    <button type="button" class="btn btn-secondary fs-14 px-4" data-bs-dismiss="modal">Back</button>
                </div>
            </div>
        </div>
    </div>

@endsection
