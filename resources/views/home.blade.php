@extends('templates_backend.home')

@section('title')
    @if (Auth::user()->role_id == 1)
        Dashboard User
    @endif
    @if (Auth::user()->role_id == 2)
        Dashboard Event Organizer
    @endif
    @if (Auth::user()->role_id == 3)
        Dashboard Admin
    @endif
@endsection

@section('sub-title')
    @if (Auth::user()->role_id == 1)
        Dashboard User
    @endif
    @if (Auth::user()->role_id == 2)
        Dashboard Event Organizer
    @endif
    @if (Auth::user()->role_id == 3)
        Dashboard Admin
    @endif
@endsection

@section('content')
<div class="container">
    @if (Auth::user()->role_id == 1)
        @include('user.dashboard')
    @endif
    @if (Auth::user()->role_id == 2)
        @include('eo.dashboard')
    @endif
    @if (Auth::user()->role_id == 3)
        @include('admin.dashboard')
    @endif
</div>
@endsection
