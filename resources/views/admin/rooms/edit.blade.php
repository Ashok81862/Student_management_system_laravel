@extends('adminlte::page')

@section('title', 'Update Room')

@section('content')

    <x-alert />

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold" style="font-size:1.4rem">Update Room Account</h3>
            <div class="card-tools">
                <a href="{{ route('admin.rooms.index') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-fw fa-arrow-left mr-1"></i>
                    <span>Go Back</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('admin.rooms.update', $room->id) }}">
                @csrf @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input
                        type="text"
                        name="name" id="name"
                        value="{{ old('name') ?? $room->name }}"
                        class="form-control @error('name') is-invalid @enderror"
                        autofocus
                    >
                    @error('name')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mt-4 mb-1">
                    <input type="submit" class="btn btn-primary" value="Update Room">
                    <a href="{{ route('admin.rooms.index') }}" class="btn btn-link float-right">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@stop
