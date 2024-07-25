@extends('layout.main')
@section('title', 'Create Admin')
@section('admin', 'active')
@section('bread', 'Create Admin')

@section('content')
    <div class="card rounded-4 overflow-hidden">
        <div class="card-body">
            <form action="" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama" class="form-label fs-14 fw-medium">Nama</label>
                            <input type="text" name="name" value="{{ old('name') }}" id="nama" class="form-control form-control-solid">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="email" class="form-label fs-14 fw-medium">Email</label>
                            <input type="text" name="email" value="{{ old('email') }}" id="email" class="form-control form-control-solid">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password" class="form-label fs-14 fw-medium">Password</label>
                            <input type="password" name="password" id="password" class="form-control form-control-solid">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <div class="form-group mt-2">
                            <label for="email" class="form-label fs-14 fw-medium">Role</label>
                            <select name="role" class="form-select form-select-solid" id="role">
                                <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="User" {{ old('role') == 'User' ? 'selected' : '' }}>User</option>
                            </select>
                            @error('role')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div> --}}
                    </div>
                </div>
                <hr class="mt-4">
                <div class="d-flex align-items-center justify-content-end gap-2">
                    <a href="{{ route('admin') }}" class="btn btn-sm btn-light fw-medium text-muted border-0">Cancel</a>
                    <button class="btn btn-sm btn-primary fw-medium border-0">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
