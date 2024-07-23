@extends('layout.main')
@section('title', 'Edit Data Rumah')
@section('rumah', 'active')
@section('bread', 'Edit Data Rumah')

@section('content')
    <div class="card rounded-4 overflow-hidden">
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label for="blok" class="form-label fs-14 fw-medium">Blok</label>
                        <input type="text" disabled name="blok" id="blok" value="{{ $rumah->blok }}"
                            class="form-control form-control-solid disabled">
                        @error('blok')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mt-2">
                            <label for="luas_tanah" class="form-label fs-14 fw-medium">Luas Tanah (m<sup>2</sup>)</label>
                            <input type="number" name="luas_tanah" id="luas_tanah" value="{{ $rumah->luas_tanah }}"
                                class="form-control form-control-solid">
                            @error('luas_tanah')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="luas_bangunan" class="form-label fs-14 fw-medium">Luas Bangunan
                                (m<sup>2</sup>)</label>
                            <input type="number" name="luas_bangunan" id="luas_bangunan"
                                value="{{ $rumah->luas_bangunan }}" class="form-control form-control-solid">
                            @error('luas_bangunan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group mt-2">
                            <label for="jumlah_kamar" class="form-label fs-14 fw-medium">Jumlah Kamar</label>
                            <input type="number" name="jumlah_kamar" id="jumlah_kamar" value="{{ $rumah->jumlah_kamar }}"
                                class="form-control form-control-solid">
                            @error('jumlah_kamar')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="harga" class="form-label fs-14 fw-medium">Harga</label>
                            <input type="number" name="harga" id="harga" value="{{ $rumah->harga }}"
                                class="form-control form-control-solid">
                            @error('harga')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="my-3">
                            <div>Image</div>
                            <label id="preview" for="gambar" class="form-label">
                                @if (Cloudinary::getUrl($rumah->gambar))
                                    <img class="w-100" src="{{ Cloudinary::getUrl($rumah->gambar) }}" alt="">
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-100" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>
                                @endif
                            </label>
                            <input type="file" accept="image/*" id="gambar" name="gambar" onchange="PreviewImage()"
                                class="d-none" />
                            <p class="text-muted">Clik the image to upload Image</p>

                            @error('gambar')
                                <p class="text-danger fs-14">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <hr class="mt-4">
                <div class="d-flex align-rumahs-center justify-content-end gap-2">
                    <a href="{{ route('rumah') }}" class="btn btn-sm btn-light fw-medium text-muted border-0">Cancel</a>
                    <button class="btn btn-sm btn-primary fw-medium border-0">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection