@extends('front.layouts')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold" style="font-size:1.4rem">Class {{$room->name }}</h3>
            <div class="card-tools">
                <a href="{{ route('teachers', $user->teacher->id) }}" class="btn btn-sm btn-info">
                    <i class="fas fa-fw fa-arrow-left mr-1"></i>
                    <span>Go Back</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <ul>
                @foreach ($room->students as $student )
                <li>
                    {{ $student->user->name }}
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@endsection
