@extends('adminlte::page')

@section('title', 'Teacher Details')

@section('content')

    <x-alert />

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold" style="font-size:1.4rem">Teacher Details</h3>
            <div class="card-tools">
                <a href="{{ route('admin.teachers.edit', $teacher->id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-fw fa-edit mr-1"></i>
                    <span>Edit</span>
                </a>

                <a href="{{ route('admin.teachers.index') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-fw fa-arrow-left mr-1"></i>
                    <span>Go Back</span>
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered">
                <tr>
                    <td>ID</td>
                    <td>{{ $teacher->id }}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{ $teacher->name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $teacher->email }}</td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>{{ $teacher->gender }}</td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td>{{ $teacher->role }}</td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>{{ $teacher->phone }}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{ $teacher->address }}</td>
                </tr>
                <tr>
                    <td>Photo</td>
                    <td>
                        @if($teacher->media_id)
                            <img src="/storage/{{ $teacher->media->path }}" height="30px">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Created At</td>
                    <td>{{ $teacher->created_at }}</td>
                </tr>
                <tr>
                    <td>Updated At</td>
                    <td>{{ $teacher->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>
@stop
