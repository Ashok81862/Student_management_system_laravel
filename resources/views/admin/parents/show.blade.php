@extends('adminlte::page')

@section('title', 'Parent Details')

@section('content')

    <x-alert />

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold" style="font-size:1.4rem">Parent Details</h3>
            <div class="card-tools">
                <a href="{{ route('admin.parents.edit', $parent->id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-fw fa-edit mr-1"></i>
                    <span>Edit</span>
                </a>

                <a href="{{ route('admin.parents.index') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-fw fa-arrow-left mr-1"></i>
                    <span>Go Back</span>
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered">
                <tr>
                    <td>ID</td>
                    <td>{{ $parent->id }}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{ $parent->user->name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $parent->user->email }}</td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>{{ $parent->gender }}</td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td>{{ $parent->role }}</td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>{{ $parent->phone }}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{ $parent->address }}</td>
                </tr>
                <tr>
                    <td>Photo</td>
                    <td>
                        @if($parent->media_id)
                            <img src="/storage/{{ $parent->media->path }}" height="150px" width="150px">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Created At</td>
                    <td>{{ $parent->created_at }}</td>
                </tr>
                <tr>
                    <td>Updated At</td>
                    <td>{{ $parent->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>
@stop
