@extends('templates_backend.home')

@section('title')
    Artikel Ku
@endsection

@section('sub-title')
    Artikel Ku
@endsection

@section('content')
    @php
        $null = null;
    @endphp
    @if (isset($articleEdit))
        <livewire:articles.index :articleEdit="$articleEdit"></livewire:articles.index>
    @else
        <livewire:articles.index :articleEdit="$null"></livewire:articles.index>
    @endif
@endsection