@extends('adminlte::page')

@section('title', 'Subject Details')

@section('content')

    <x-alert />

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold" style="font-size:1.4rem">Subject Details</h3>
            <div class="card-tools">
                <a href="{{ route('admin.subjects.edit', $subject->id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-fw fa-edit mr-1"></i>
                    <span>Edit</span>
                </a>

                <a href="{{ route('admin.subjects.index') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-fw fa-arrow-left mr-1"></i>
                    <span>Go Back</span>
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered">
                <tr>
                    <td>ID</td>
                    <td>{{ $subject->id }}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{ $subject->name }}</td>
                </tr>
                <tr>
                    <td>Code</td>
                    <td>{{ $subject->code }}</td>
                </tr>
                <tr>
                    <td>Room</td>
                    <td>
                        @foreach ($subject->rooms as $subject )
                            <li>
                                <a href="{{ route('admin.rooms.show', $subject->id) }}">{{ $subject->name }}</a>
                            </li>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>Created At</td>
                    <td>{{ $subject->created_at }}</td>
                </tr>
                <tr>
                    <td>Updated At</td>
                    <td>{{ $subject->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>
@stop
