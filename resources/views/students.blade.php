@extends('front.layouts')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
          <h1 class="fw-bold fs-3">Student Information</h1>
        </div>
        <div class="card-body d-flex justify-content-around">
            <div class="w-25">
                @if($user->media->path)
                    <img src="/storage/{{ $user->media->path}}" width="100%" height="200px"  alt="">
                @endif
            </div>
            <table class="table table-bordered w-50">
                    <tr>
                        <td>Name </td>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>{{ $user->student->address }}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>{{ $user->student->phone }}</td>
                    </tr>
                    <tr>
                        <td>Class</td>
                        <td>{{ $user->student->room->name }}</td>
                    </tr>
                    <tr>
                       <td>Parents</td>
                       <td>{{ $user->student->parentDetail->name }}</td>
                    </tr>
            </table>
        </div>
      </div>
</div>

@endsection
