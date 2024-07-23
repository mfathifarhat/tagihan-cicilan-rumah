@extends('layout.main')
@section('title', 'Create Blok')
@section('rumah', 'active')
@section('bread', 'Create Blok')

@section('content')
    <div class="card rounded-4 overflow-hidden">
        <div class="card-body">
            <form action="" method="post">
                @csrf
                <div class="form-group">
                    <label for="blok" class="form-label fs-14 fw-medium">Blok</label>
                    <input type="text" name="blok" value="{{ old('name') }}" id="blok"
                        class="form-control form-control-solid">
                    @error('blok')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="alamat" class="form-label fs-14 fw-medium">Alamat</label>
                    <textarea type="text" name="alamat" id="alamat"
                        class="form-control form-control-solid" rows="5">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <hr class="mt-4">
                <div class="d-flex align-items-center justify-content-end gap-2">
                    <a href="{{ route('blok') }}" class="btn btn-sm btn-light fw-medium text-muted border-0">Cancel</a>
                    <button class="btn btn-sm btn-primary fw-medium border-0">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
