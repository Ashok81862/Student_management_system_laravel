@extends('adminlte::page')

@section('title', 'Room Details')

@section('content')

    <x-alert />

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold" style="font-size:1.4rem">Room Details</h3>
            <div class="card-tools">
                <a href="{{ route('admin.rooms.teachers', $room->id) }}" class="btn btn-primary btn-sm">
                    <i class="mr-1 fas fa-fw fa-chalkboard"></i>
                    <span>Add Teacher</span>
                </a>

                <a href="{{ route('admin.rooms.subjects', $room->id) }}" class="btn btn-primary btn-sm">
                    <i class="mr-1 fas fa-fw fa-book"></i>
                    <span>Add Subject</span>
                </a>

                <a href="{{ route('admin.rooms.edit', $room->id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-fw fa-edit mr-1"></i>
                    <span>Edit</span>
                </a>

                <a href="{{ route('admin.rooms.index') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-fw fa-arrow-left mr-1"></i>
                    <span>Go Back</span>
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered">
                <tr>
                    <td>ID</td>
                    <td>{{ $room->id }}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{ $room->name }}</td>
                </tr>
                <tr>
                    <td>Teachers</td>
                    <td>
                        <ul>
                            @foreach ( $room->teachers as $teacher )
                               <li>{{ $teacher->user->name }}</li>
                           @endforeach()
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>Subjects</td>
                    <td>
                        <ul>
                            @foreach ( $room->subjects as $subject )
                               <li>{{ $subject->name }}</li>
                           @endforeach()
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>Created At</td>
                    <td>{{ $room->created_at }}</td>
                </tr>
                <tr>
                    <td>Updated At</td>
                    <td>{{ $room->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>
@stop
