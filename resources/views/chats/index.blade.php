@extends('templates_backend.home')

@if (Auth::user()->role_id != 3)
    @section('title')
        Hubungi admin
    @endsection

    @section('sub-title')
        Hubungi admin
    @endsection
@else
    @section('title')
        Laporan user
    @endsection

    @section('sub-title')
        Laporan user
    @endsection
@endif

@section('content')
    <div class="row">
        <div class="col">
            <label for="" class="section-title mt-0">
                @if (Auth::user()->role_id != 3)
                    Hubungi admin
                @else
                    Laporan user
                @endif
            </label>
            <p class="section-lead">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorem, est, inventore error, animi placeat omnis iusto veritatis blanditiis harum aliquid repellat! Ratione aut temporibus minima doloribus atque possimus? Reiciendis, numquam?</p>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-4">
            <livewire:chats.contacts></livewire:chats.contacts>
        </div>
        <div class="col-md-8">
            <livewire:chats.send></livewire:chats.send>
        </div>
    </div>
@endsection