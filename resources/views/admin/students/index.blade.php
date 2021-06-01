@extends('adminlte::page')

@section('title', 'All Students')

@section('content')

    <x-delete />

    <x-alert />

    <div class="card">
        <div class="card-header border-bottom-0">
            <h3 class="card-title text-bold" style="font-size:1.4rem">All Students</h3>
            <div class="card-tools">
                <a href="{{ route('admin.students.create') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-fw fa-plus-circle mr-1"></i>
                    <span>Add New</span>
                </a>
            </div>
        </div>
        <div class="card-body p-0 border-top-0">
            <table class="table table-bordered border-top-0">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Room </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td class='text-center'>
                            @if($student->media_id)
                                <img src="/storage/{{ $student->media->path }}" height="40px" width="60px">
                            @endif
                        </td>
                        <td>{{ $student->user->name }}</td>
                        <td>{{ $student->room->name }}</td>
                        <td>
                            <!-- Show -->
                            <a href="{{ route('admin.students.show', $student->id) }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-fw fa-eye mr-1"></i>
                                <span>Details</span>
                            </a>

                            <!-- Edit -->
                            <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-fw fa-edit mr-1"></i>
                                <span>Edit</span>
                            </a>

                            <!-- Delete -->
                            <a href="#" onclick="confirmDelete({{ $student->id }})" class="btn btn-danger btn-sm">
                                <i class="fas fa-fw fa-edit mr-1"></i>
                                <span>Delete</span>
                            </a>

                            <!-- Delete Form -->
                            <form id="delete-form-{{ $student->id }}" action="{{ route('admin.students.destroy', $student->id) }}" method="post">
                                @csrf @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($students->total() > 30)
        <div class="card-footer">
            {{ $students->links() }}
        </div>
        @endif
    </div>
@stop
