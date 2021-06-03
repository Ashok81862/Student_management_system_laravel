@extends('adminlte::page')

@section('title', 'Subject Teachers')

@section('plugins.Select2', true)

@push('js')
<script>
    $(document).ready(function() {
        $('#teacher_id').select2();
    });
</script>
@endpush

@section('content')

    <x-delete />

    <x-alert />

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold" style="font-size:1.4rem">Subject Teachers</h3>
            <div class="card-tools">
                <a href="{{ route('admin.subjects.show', $subject->id) }}" class="btn btn-sm btn-info">
                    <i class="fas fa-fw fa-arrow-left mr-1"></i>
                    <span>Go Back</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.subjects.teachers.store', $subject->id) }}" method="post">
                @csrf @method('PUT')


                <div class="form-group">
                    <label for="subject_id">Choose Teacher</label>
                    <select
                        name="teacher_id" id="teacher_id"
                        class="form-control @error('teacher_id') is-invalid @enderror"
                    >
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}" @if(old('teacher_id') == $teacher->id) selected @endif>{{ $teacher->user->name }}</option>
                        @endforeach
                    </select>

                    @error('teacher_id')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <input type="submit" class="btn btn-primary" value="Add Teacher">

            </form>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Teacher Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subject->teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->user->name }}</td>
                        <td>
                            <!-- Delete -->
                            <a href="#" onclick="confirmDelete({{ $teacher->id }})" class="btn btn-danger btn-sm">
                                <i class="fas fa-fw fa-edit mr-1"></i>
                                <span>Delete</span>
                            </a>

                            <!-- Delete Form -->
                            <form id="delete-form-{{ $teacher->id }}" action="{{ route('admin.subjects.teachers.remove', $teacher->id) }}" method="post">
                                <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                                @csrf @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
