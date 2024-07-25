@extends('layout.main')
@section('title', 'Data Customer')
@section('customer', 'active')
@section('bread', 'Customer')

@section('content')
    <div class="card rounded-4 overflow-hidden">
        <div class="card-header bg-white border-0 p-3 d-flex align-items-center justify-content-between">
            <div class="search">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>

                <form action="{{route('search-customer')}}" method="get">
                    <input type="text" name="keyword" class="form-control form-control-solid" placeholder="Search Customer">
                </form>
            </div>
            <div class="tools d-flex align-items-center gap-3">
                <a href="{{ route('create-customer') }}"
                    class="fs-14 btn btn-primary text-nowrap d-flex align-items-center">
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
                            <th>Kode Customer</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. Hp</th>
                            <th>Status Cicilan</th>
                            <th>Tgl. Beli</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $item)
                            <tr>
                                <td>{{ $loop->iteration + 15 * ($customers->currentPage() - 1) }}</td>
                                <td>{{ $item->kode_customer }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->no_hp }}</td>
                                <td>
                                    @switch($item->cicilan->status)
                                        @case('Lunas')
                                            <div class="badge py-2 text-success bg-success-subtle">{{ $item->cicilan->status }}
                                            </div>
                                        @break

                                        @default
                                            <div class="badge py-2 text-danger bg-danger-subtle">{{ $item->cicilan->status }}</div>
                                    @endswitch
                                </td>
                                <td>{{ date_format($item->created_at, 'd-m-Y') }}</td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-end gap-2">
                                        <a href="{{ route('detail-customer', $item->id) }}"
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
                    {{-- Page {{$rumahs->currentPage()}} of {{$rumahs->lastPage()}} --}}
                </div>
                <div class="col-sm-6 text-center text-sm-end">
                    {{-- <a href="{{ $rumahs->previousPageUrl() }}" class="btn btn-sm btn-primary">Previous</a>
                    <a href="{{ $rumahs->nextPageUrl() }}" class="btn btn-sm btn-primary">Next</a> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
