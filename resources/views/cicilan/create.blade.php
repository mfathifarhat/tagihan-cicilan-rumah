@extends('layout.main')
@section('title', 'Create Data Customer')
@section('customer', 'active')
@section('bread', 'Create Data Customer')

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
                            <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                                class="form-control form-control-solid">
                            @error('nama')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="no_hp" class="form-label fs-14 fw-medium">No. Hp</label>
                            <input type="number" name="no_hp" maxlength="15"
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                id="no_hp" value="{{ old('no_hp') }}" class="form-control form-control-solid">
                            @error('no_hp')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mt-2">
                            <label for="email" class="form-label fs-14 fw-medium">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="form-control form-control-solid">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="luas_bangunan" class="form-label fs-14 fw-medium">Password</label>
                            <input type="text" name="password" id="password" value="{{ old('password') }}"
                                class="form-control form-control-solid">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="alamat" class="form-label fs-14 fw-medium">Alamat Pembeli</label>
                        <textarea name="alamat" id="alamat" class="form-control form-control-solid">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>


                <h6 class="fw-semibold mt-4">Data Rumah</h6>
                <hr>
                <button class="btn btn-primary w-100 fs-14 fw-semibold py-2 mb-2" type="button" data-bs-toggle="modal"
                    data-bs-target="#rumahModal">Pilih Rumah</button>
                <div class="row" id="data-rumah">

                    <input type="hidden" name="rumah_id" id="rumah_id" value="{{old('rumah_id')}}">
                    @error('rumah_id')
                        <div class="text-danger">Rumah field is required</div>
                    @enderror
                    <div class="col-md-12">
                        <label for="alamat_rumah" class="form-label fs-14 fw-medium">Alamat/Lokasi Rumah</label>
                        <textarea name="alamat_rumah" readonly id="alamat_rumah" class="form-control disabled form-control-solid">{{ old('alamat_rumah') }}</textarea>
                        @error('alamat_rumah')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mt-2">
                            <label for="luas_tanah" class="form-label fs-14 fw-medium">Luas Tanah (m<sup>2</sup>)</label>
                            <input type="number" readonly name="luas_tanah" id="luas_tanah"
                                value="{{ old('luas_tanah') }}" class="form-control disabled form-control-solid">
                            @error('luas_tanah')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="luas_bangunan" class="form-label fs-14 fw-medium">Luas Bangunan
                                (m<sup>2</sup>)</label>
                            <input type="number" readonly name="luas_bangunan" id="luas_bangunan"
                                value="{{ old('luas_bangunan') }}" class="form-control disabled form-control-solid">
                            @error('luas_bangunan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mt-2">
                            <label for="jumlah_kamar" class="form-label fs-14 fw-medium">Jumlah Kamar</label>
                            <input type="number" readonly name="jumlah_kamar" id="jumlah_kamar"
                                value="{{ old('jumlah_kamar') }}" class="form-control disabled form-control-solid">
                            @error('jumlah_kamar')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="harga" class="form-label fs-14 fw-medium">Harga</label>
                            <input type="number" readonly name="harga" id="harga" value="{{ old('harga') }}"
                                class="form-control form-control-solid disabled">
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
                                <span></span></label>
                            <input type="number" readonly name="harga_properti" id="harga_properti"
                                value="{{ old('harga_properti') }}" class="form-control disabled form-control-solid">
                            @error('harga_properti')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="dp" class="form-label fs-14 fw-medium">Uang Muka (15%) <span></span></label>
                            <input type="number" readonly name="dp" id="dp" value="{{ old('dp') }}"
                                class="form-control disabled form-control-solid">
                            @error('dp')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mt-2">
                            <label for="jangka_waktu" class="form-label fs-14 fw-medium">Jangka Waktu (1-20 Tahun)</label>
                            <input type="number" name="jangka_waktu" id="jangka_waktu"
                                value="{{ old('jangka_waktu') }}" class="form-control form-control-solid">
                            @error('jangka_waktu')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="cicilan" class="form-label fs-14 fw-medium">Cicilan/Bulan <span></span></label>
                            <input type="number" readonly name="cicilan" id="cicilan" value="{{ old('cicilan') }}"
                                class="form-control disabled form-control-solid">
                            @error('cicilan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
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

    <div class="modal fade" id="rumahModal" tabindex="-1" aria-labelledby="rumahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-6 fw-medium" id="rumahModalLabel">Pilih Rumah</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>

                        <form action="" method="get" class="w-100">
                            <input type="text" name="keyword" class="form-control form-control-solid w-100"
                                placeholder="Search Rumah">
                        </form>

                    </div>
                    <div class="result">
                        {{-- <div class="table-responsive fs-14">
                            <table class="table table-sm gy-5 align-middle">
                                <thead class="text-muted">
                                    <tr>
                                        <th></th>
                                        <th>Alamat</th>
                                        <th>Luas Tanah</th>
                                        <th>Luas Bangunan</th>
                                        <th>Jumlah Kamar</th>
                                        <th>Status</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rumahs as $item)
                                        <tr>
                                            <td>
                                                <input class="form-check-input form-select-lg m-0" type="radio"
                                                    name="rumah" id="rumah" value="{{ $item->id }}">
                                            </td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>{{ $item->luas_tanah }}</td>
                                            <td>{{ $item->luas_bangunan }}</td>
                                            <td>{{ $item->jumlah_kamar }}</td>
                                            <td>
                                                <div class="badge py-2 text-success bg-success-subtle">{{ $item->status }}
                                                </div>
                                            </td>
                                            <td>{{ format_uang($item->harga) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="pagination row gy-2 justify-content-between align-items-center">
                            <div class="col-sm-6 text-center text-sm-start">
                                Page {{ $rumahs->currentPage() }} of {{ $rumahs->lastPage() }}
                            </div>
                            <div class="col-sm-6 text-center text-sm-end">
                                <a href="{{ $rumahs->previousPageUrl() }}" class="btn btn-sm btn-primary">Previous</a>
                                <a href="{{ $rumahs->nextPageUrl() }}" class="btn btn-sm btn-primary">Next</a>
                            </div>
                        </div> --}}

                        {{-- @include('rumah.search') --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="w-100 row gy-2">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6 text-end">
                            <button type="button" class="btn btn-primary fs-14 px-4 save">Select</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
