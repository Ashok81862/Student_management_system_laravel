@extends('adminlte::page')

@section('title', 'All Parents')

@section('content')

    <x-delete />

    <x-alert />

    <div class="card">
        <div class="card-header border-bottom-0">
            <h3 class="card-title text-bold" style="font-size:1.4rem">All Parents</h3>
            <div class="card-tools">
                <a href="{{ route('admin.parents.create') }}" class="btn btn-sm btn-info">
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
                        <th>Phone Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($parents as $parent)
                    <tr>
                        <td>{{ $parent->id }}</td>
                        <td class='text-center'>
                            @if($parent->media_id)
                                <img src="/storage/{{ $parent->media->path }}" height="40px" width="60px">
                            @endif
                        </td>
                        <td>{{ $parent->user->name }}</td>
                        <td>{{ $parent->phone  }}</td>
                        <td>
                            <!-- Show -->
                            <a href="{{ route('admin.parents.show', $parent->id) }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-fw fa-eye mr-1"></i>
                                <span>Details</span>
                            </a>

                            <!-- Edit -->
                            <a href="{{ route('admin.parents.edit', $parent->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-fw fa-edit mr-1"></i>
                                <span>Edit</span>
                            </a>

                            <!-- Delete -->
                            <a href="#" onclick="confirmDelete({{ $parent->id }})" class="btn btn-danger btn-sm">
                                <i class="fas fa-fw fa-edit mr-1"></i>
                                <span>Delete</span>
                            </a>

                            <!-- Delete Form -->
                            <form id="delete-form-{{ $parent->id }}" action="{{ route('admin.parents.destroy', $parent->id) }}" method="post">
                                @csrf @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($parents->total() > 30)
        <div class="card-footer">
            {{ $parents->links() }}
        </div>
        @endif
    </div>
@stop
