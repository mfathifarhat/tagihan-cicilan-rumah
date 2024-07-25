@extends('layout.main')
@section('title', 'Data Rumah')
@section('rumah', 'active')
@section('bread', 'Rumah')

@section('content')
    <div class="card rounded-4 overflow-hidden">
        <div class="card-header bg-white border-0 p-3 d-flex align-items-center justify-content-between">
            <div class="search">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>

                <form action="{{ route('search-rumah') }}" method="get">
                    <input type="text" name="keyword" class="form-control form-control-solid"
                        placeholder="Search Blok Rumah">
                </form>
            </div>
            <div class="tools d-flex align-items-center gap-3">
                <a href="{{ route('create-rumah') }}" class="fs-14 btn btn-primary text-nowrap d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>

                    <span class="ms-2">Create</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive fs-14">
                <table class="table table-sm gy-5 align-middle">
                    <thead class="text-muted">
                        <tr>
                            <th>No.</th>
                            <th>Blok</th>
                            <th>Kode Rumah</th>
                            <th>Gambar</th>
                            <th>Luas Tanah</th>
                            <th>Luas Bangunan</th>
                            <th>Jumlah Kamar</th>
                            <th>Harga</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rumahs as $item)
                            <tr>
                                <td>{{ $loop->iteration + 15 * ($rumahs->currentPage() - 1) }}</td>
                                <td>{{ $item->blok }}</td>
                                <td>{{ $item->kode_rumah }}</td>
                                <td>
                                    <img src="{{  Cloudinary::getUrl($item->gambar) }}" width="250"
                                        alt="">
                                </td>
                                <td>{{ $item->luas_tanah }}m<sup>2</sup></td>
                                <td>{{ $item->luas_bangunan }}m<sup>2</sup></td>
                                <td>{{ $item->jumlah_kamar }}</td>
                                <td>{{ format_uang($item->harga) }}</td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-end gap-2">
                                        <a href="{{ route('edit-rumah', $item->kode_rumah) }}"
                                            class="px-0 mx-2 btn btn-sm no-border ">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="20"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('delete-rumah', $item->kode_rumah) }}"
                                            class="px-0 mx-2 btn btn-sm text-danger no-border ">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="20"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
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
                    Page {{ $rumahs->currentPage() }} of {{ $rumahs->lastPage() }}
                </div>
                <div class="col-sm-6 text-center text-sm-end">
                    <a href="{{ $rumahs->previousPageUrl() }}" class="btn btn-sm btn-primary">Previous</a>
                    <a href="{{ $rumahs->nextPageUrl() }}" class="btn btn-sm btn-primary">Next</a>
                </div>
            </div>
        </div>
    </div>
@endsection
