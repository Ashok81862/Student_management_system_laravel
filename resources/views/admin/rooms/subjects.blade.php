@extends('adminlte::page')

@section('title', 'Rooms subjects')

@section('plugins.Select2', true)

@push('js')
<script>
    $(document).ready(function() {
        $('#subject_id').select2();
    });
</script>
@endpush

@section('content')

    <x-delete />

    <x-alert />

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold" style="font-size:1.4rem">Room Subjects</h3>
            <div class="card-tools">
                <a href="{{ route('admin.rooms.show', $room->id) }}" class="btn btn-sm btn-info">
                    <i class="fas fa-fw fa-arrow-left mr-1"></i>
                    <span>Go Back</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.rooms.subjects.store', $room->id) }}" method="post">
                @csrf @method('PUT')


                <div class="form-group">
                    <label for="subject_id">Choose subject</label>
                    <select
                        name="subject_id" id="subject_id"
                        class="form-control @error('subject_id') is-invalid @enderror"
                    >
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" @if(old('subject_id') == $subject->id) selected @endif>{{ $subject->name }}</option>
                        @endforeach
                    </select>

                    @error('subject_id')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <input type="submit" class="btn btn-primary" value="Add Subject">

            </form>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Subject Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($room->subjects as $subject)
                    <tr>
                        <td>{{ $subject->user->name }}</td>
                        <td>
                            <!-- Delete -->
                            <a href="#" onclick="confirmDelete({{ $subject->id }})" class="btn btn-danger btn-sm">
                                <i class="fas fa-fw fa-edit mr-1"></i>
                                <span>Delete</span>
                            </a>

                            <!-- Delete Form -->
                            <form id="delete-form-{{ $subject->id }}" action="{{ route('admin.rooms.subjects.remove', $subject->id) }}" method="post">
                                <input type="hidden" name="subject_id" value="{{ $subject->id }}">
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
