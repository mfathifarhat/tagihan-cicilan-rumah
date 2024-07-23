@extends('layout.main')
@section('title', 'Detail Data Customer')
@section('customer', 'active')
@section('bread', 'Detail Data Customer')

@section('content')
    <div class="card rounded-4 overflow-hidden">
        <div class="card-body">
            <form action="" method="post">
                @csrf
                <h6 class="fw-semibold">Identitas Pembeli</h6>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mt-2">
                            <label for="nama" class="form-label fs-14 fw-medium">Nama</label>
                            <input type="text" name="nama" id="nama" value="{{ $customer->nama }}"
                                class="form-control form-control-solid">
                            @error('nama')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="no_hp" class="form-label fs-14 fw-medium">No. Hp</label>
                            <input type="number" name="no_hp" maxlength="15"
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                id="no_hp" value="{{ $customer->no_hp }}" class="form-control form-control-solid">
                            @error('no_hp')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mt-2">
                            <label for="email" class="form-label fs-14 fw-medium">Email</label>
                            <input type="email" name="email" id="email" value="{{ $customer->email }}"
                                class="form-control form-control-solid">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="luas_bangunan" class="form-label fs-14 fw-medium">Password</label>
                            <input type="password" name="password" id="password" value=""
                                class="form-control form-control-solid">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="alamat" class="form-label fs-14 fw-medium">Alamat Pembeli</label>
                        <textarea name="alamat" id="alamat" class="form-control form-control-solid">{{ $customer->alamat }}</textarea>
                        @error('alamat')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>


                <h6 class="fw-semibold mt-4">Data Rumah</h6>
                <hr>
                {{-- <button class="btn btn-primary w-100 fs-14 fw-semibold py-2 mb-2" type="button" data-bs-toggle="modal"
                    data-bs-target="#rumahModal">Pilih Rumah</button> --}}
                <div class="row" id="data-rumah">

                    <input type="hidden" name="rumah_id" id="rumah_id" value="{{ $customer->rumah->id }}">
                    @error('rumah_id')
                        <div class="text-danger">Rumah field is required</div>
                    @enderror
                    <div class="col-md-12">
                        <label for="blok_rumah" class="form-label fs-14 fw-medium">Blok Rumah</label>
                        <input type="text" name="blok_rumah" readonly id="blok_rumah" class="form-control disabled form-control-solid" value="{{ $customer->rumah->blok }}">
                        @error('blok_rumah')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mt-2">
                            <label for="luas_tanah" class="form-label fs-14 fw-medium">Luas Tanah (m<sup>2</sup>)</label>
                            <input type="number" readonly name="luas_tanah" id="luas_tanah"
                                value="{{ $customer->rumah->luas_tanah }}"
                                class="form-control disabled form-control-solid">
                            @error('luas_tanah')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="luas_bangunan" class="form-label fs-14 fw-medium">Luas Bangunan
                                (m<sup>2</sup>)</label>
                            <input type="number" readonly name="luas_bangunan" id="luas_bangunan"
                                value="{{ $customer->rumah->luas_bangunan }}"
                                class="form-control disabled form-control-solid">
                            @error('luas_bangunan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mt-2">
                            <label for="jumlah_kamar" class="form-label fs-14 fw-medium">Jumlah Kamar</label>
                            <input type="number" readonly name="jumlah_kamar" id="jumlah_kamar"
                                value="{{ $customer->rumah->jumlah_kamar }}"
                                class="form-control disabled form-control-solid">
                            @error('jumlah_kamar')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="harga" class="form-label fs-14 fw-medium">Harga</label>
                            <input type="number" readonly name="harga" id="harga"
                                value="{{ $customer->rumah->harga }}" class="form-control form-control-solid disabled">
                            @error('harga')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>


                <h6 class="fw-semibold mt-4">Cicilan</h6>
                <hr>
                <div class="row" id="data-cicilan">
                    <div class="col-md-6">
                        <div class="form-group mt-2">
                            <label for="harga_properti" class="form-label fs-14 fw-medium">Harga Properti
                                <span>({{ number_format($customer->cicilan->harga_properti, 0, ',', '.') }})</span></label>
                            <input type="number" readonly name="harga_properti" id="harga_properti"
                                value="{{ $customer->cicilan->harga_properti }}"
                                class="form-control disabled form-control-solid">
                            @error('harga_properti')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="dp" class="form-label fs-14 fw-medium">Uang Muka (15%)
                                <span>({{ number_format($customer->cicilan->dp, 0, ',', '.') }})</span></label>
                            <input type="number" readonly name="dp" id="dp"
                                value="{{ $customer->cicilan->dp }}" class="form-control disabled form-control-solid">
                            @error('dp')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mt-2">
                            <label for="jangka_waktu" class="form-label fs-14 fw-medium">Jangka Waktu (1-20 Tahun)</label>
                            <input type="number" readonly name="jangka_waktu" id="jangka_waktu"
                                value="{{ $customer->cicilan->jangka_waktu }}"
                                class="form-control disabled form-control-solid">
                            @error('jangka_waktu')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="cicilan" class="form-label fs-14 fw-medium">Cicilan/Bulan
                                <span>({{ number_format($customer->cicilan->cicilan, 0, ',', '.') }})</span></label>
                            <input type="number" readonly name="cicilan" id="cicilan"
                                value="{{ $customer->cicilan->cicilan }}"
                                class="form-control disabled form-control-solid">
                            @error('cicilan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>


                <hr class="mt-4">
                <div class="d-flex align-items-center justify-content-between gap-2">
                    <button type="button" class="btn btn-sm btn-danger fw-medium" data-bs-toggle="modal"
                        data-bs-target="#deleteModal">Delete</button>
                    <div>
                        <a href="{{ route('customer') }}"
                            class="btn btn-sm btn-light fw-medium text-muted border-0">Cancel</a>
                        <button class="btn btn-sm btn-primary fw-medium border-0">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

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
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                        </span>

                        <h6 class="mt-4">Apakah anda yakin ingin menghapus data ini?</h6>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{route('delete-customer', $customer->id)}}" class="btn btn-danger fs-14 px-4">Delete</a>
                    <button type="button" class="btn btn-secondary fs-14 px-4" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection
