@extends('adminlte::page')

@section('title', 'Add New Parent')

@section('plugins.Select2', true)

@push('js')
<script>
    $(document).ready(function() {
        $('#gender').select2();
    });
</script>
@endpush

@section('content')

    <x-alert />

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold" style="font-size:1.4rem">Add New Parent Account</h3>
            <div class="card-tools">
                <a href="{{ route('admin.parents.index') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-fw fa-arrow-left mr-1"></i>
                    <span>Go Back</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('admin.parents.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input
                        type="text"
                        name="name" id="name"
                        value="{{ old('name') ?? '' }}"
                        class="form-control @error('name') is-invalid @enderror"
                        autofocus
                    >
                    @error('name')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        name="email" id="email"
                        value="{{ old('email') ?? '' }}"
                        class="form-control @error('email') is-invalid @enderror"
                    >
                    @error('email')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror"
                    >
                    @error('password')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input
                        type="password"
                        name="password_confirmation" id="password_confirmation"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                    >
                    @error('password_confirmation')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select
                        name="gender" id="gender"
                        class="form-control @error('gender') is-invalid @enderror"
                    >
                        @foreach($genders as $gender)
                            <option value="{{ $gender }}" @if(old('gender') == $gender) selected @endif>{{ $gender }}</option>
                        @endforeach
                    </select>

                    @error('gender')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input
                        type="number"
                        name="phone" id="phone"
                        value="{{ old('phone') ?? '' }}"
                        class="form-control @error('phone') is-invalid @enderror"
                    >
                    @error('phone')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input
                        type="text"
                        name="address" id="address"
                        value="{{ old('address') ?? '' }}"
                        class="form-control @error('address') is-invalid @enderror"
                    >
                    @error('address')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Profile Picture</label>
                    <input
                        type="file"
                        name="image" id="image"
                        class="form-control-file @error('image') is-invalid @enderror"
                    >
                    @error('image')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mt-4 mb-1">
                    <input type="submit" class="btn btn-primary" value="Add New parent">
                    <a href="{{ route('admin.parents.index') }}" class="btn btn-link float-right">Cancel</a>
                </div>


            </form>
        </div>
    </div>
@stop
