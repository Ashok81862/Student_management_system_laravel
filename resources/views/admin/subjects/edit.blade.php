@extends('adminlte::page')

@section('title', 'Update Subject')

@section('content')

    <x-alert />

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold" style="font-size:1.4rem">Update Subject</h3>
            <div class="card-tools">
                <a href="{{ route('admin.subjects.index') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-fw fa-arrow-left mr-1"></i>
                    <span>Go Back</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('admin.subjects.update', $subject->id) }}">
                @csrf @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input
                        type="text"
                        name="name" id="name"
                        value="{{ old('name') ?? $subject->name }}"
                        class="form-control @error('name') is-invalid @enderror"
                        autofocus
                    >
                    @error('name')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="code">Code</label>
                    <input
                        type="number"
                        name="code" id="code"
                        value="{{ old('code') ?? $subject->code }}"
                        class="form-control @error('code') is-invalid @enderror"
                        autofocus
                    >
                    @error('code')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mt-4 mb-1">
                    <input type="submit" class="btn btn-primary" value="Update Subject">
                    <a href="{{ route('admin.subjects.index') }}" class="btn btn-link float-right">Cancel</a>
                </div>

            </form>
        </div>
    </div>
@stop
