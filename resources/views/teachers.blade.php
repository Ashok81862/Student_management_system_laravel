@extends('front.layouts')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
          <h1 class="fw-bold fs-3">Teacher Information</h1>
        </div>
        <div class="card-body d-flex justify-content-around">
            <div class="w-25">
                @if($user->media->path)
                    <img src="/storage/{{$user->media->path }}" width="100%" height="200px"  alt="">
                @endif
            </div>
            <table class="table table-bordered w-50">
                    <tr>
                        <td>Name </td>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>{{ $user->teacher->address }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td>Gender </td>
                        <td>{{ $user->teacher->gender }}</td>
                    </tr>
                    <tr>
                        <td>Room</td>
                        <td>
                            <ul>
                                @foreach ($user->teacher->rooms as $room  )
                                <li>{{ $room->name }}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>Subject</td>
                        <td>
                            <ul>
                                <li>Science</li>
                                <li>English</li>
                            </ul>
                        </td>
                    </tr>
            </table>
        </div>
      </div>
</div>

@endsection
