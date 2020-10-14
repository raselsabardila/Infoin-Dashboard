@extends('templates_backend.home')

@section('content')
    @if ($role == 1)
        <livewire:admin.user-list></livewire:admin.user-list>
    @endif
    @if ($role == 2)
    <livewire:admin.eo-list></livewire:admin.eo-list>
    @endif
    @if ($role == 3)
    <livewire:admin.admin-list></livewire:admin.admin-list>
    @endif
@endsection