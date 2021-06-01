@extends('adminlte::page')

@section('title', 'Student Details')

@section('content')

    <x-alert />

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold" style="font-size:1.4rem">Student Details</h3>
            <div class="card-tools">
                <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-fw fa-edit mr-1"></i>
                    <span>Edit</span>
                </a>

                <a href="{{ route('admin.students.index') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-fw fa-arrow-left mr-1"></i>
                    <span>Go Back</span>
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered">
                <tr>
                    <td>ID</td>
                    <td>{{ $student->id }}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{ $student->user->name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $student->user->email }}</td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>{{ $student->gender }}</td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td>{{ $student->role }}</td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>{{ $student->phone }}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{ $student->address }}</td>
                </tr>
                <tr>
                    <td>Photo</td>
                    <td>
                        @if($student->media_id)
                            <img src="/storage/{{ $student->media->path }}" height="150px" width="150px">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Created At</td>
                    <td>{{ $student->created_at }}</td>
                </tr>
                <tr>
                    <td>Updated At</td>
                    <td>{{ $student->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>
@stop
