@extends('adminlte::page')

@section('title', 'Update Teacher')

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
            <h3 class="card-title text-bold" style="font-size:1.4rem">Update Teacher Account</h3>
            <div class="card-tools">
                <a href="{{ route('admin.teachers.index') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-fw fa-arrow-left mr-1"></i>
                    <span>Go Back</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('admin.teachers.update', $teacher->id) }}" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input
                        type="text"
                        name="name" id="name"
                        value="{{ old('name') ?? $teacher->user->name }}"
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
                        value="{{ old('email') ?? $teacher->user->email }}"
                        class="form-control @error('email') is-invalid @enderror"
                    >
                    @error('email')
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
                            <option value="{{ $gender }}" @if($teacher->gender == $gender) selected @endif>{{ $gender }}</option>
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
                        value="{{ old('phone') ?? $teacher->phone }}"
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
                        value="{{ old('address') ?? $teacher->address }}"
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
                    <input type="submit" class="btn btn-primary" value="Update Teacher">
                    <a href="{{ route('admin.teachers.index') }}" class="btn btn-link float-right">Cancel</a>
                </div>


            </form>
        </div>
    </div>
@stop
