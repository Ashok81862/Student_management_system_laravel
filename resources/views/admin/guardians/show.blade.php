@extends('adminlte::page')

@section('title', 'Guardian Details')

@section('content')

    <x-alert />

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold" style="font-size:1.4rem">Guardian Details</h3>
            <div class="card-tools">
                <a href="{{ route('admin.guardians.edit', $guardian->id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-fw fa-edit mr-1"></i>
                    <span>Edit</span>
                </a>

                <a href="{{ route('admin.guardians.index') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-fw fa-arrow-left mr-1"></i>
                    <span>Go Back</span>
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered">
                <tr>
                    <td>ID</td>
                    <td>{{ $guardian->id }}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{ $guardian->user->name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $guardian->user->email }}</td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>{{ $guardian->gender }}</td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td>{{ $guardian->role }}</td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>{{ $guardian->phone }}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{ $guardian->address }}</td>
                </tr>
                <tr>
                    <td>Children</td>
                    <td>
                        @foreach ($guardian->students as $student)
                            <li>{{ $student->user->name }}</li>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>Photo</td>
                    <td>
                        @if($guardian->media_id)
                            <img src="/storage/{{ $guardian->media->path }}" height="150px" width="150px">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Created At</td>
                    <td>{{ $guardian->created_at }}</td>
                </tr>
                <tr>
                    <td>Updated At</td>
                    <td>{{ $guardian->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>
@stop
