<div>
    <!-- Jumbotron -->
    <div class="jumbotron jumbotron-fluid bg-white mt-4">
        <div class="container text-center" style="background-image: url({{ asset("/assets_hilfe/icons/virus2.svg") }}),
        url({{ asset("/assets_hilfe/icons/virus1.svg") }});">
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-6">
                    <h1 class="display-4">Kumpulan <span>Tulisan</span> <br> <img src="{{ asset("/assets_hilfe/icons/virus3.svg") }}"
                            class="d-none d-lg-inline" alt="virus"> Masyarakat</h1>
                    <p class="lead mt-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci odio autem
                        pariatur vel omnis deserunt iusto dolore nam vero enim.
                    </p>
                    <form class="mt-5 d-flex justify-content-center">
                        <div class="form-group d-flex input-search justify-content-center shadow rounded-pill">
                            <button class="btn" type="submit">
                                <img src="{{ asset("/assets_hilfe/icons/search.svg") }}" alt="search">
                            </button>
                            <input type="text" wire:model="search" class="form-control border-0 w-100 ml-2 bg-transparent" id="search"
                                placeholder="cari...">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Posts -->
    <section class="recent-posts">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-8 hero-title">
                    <span class="rounded-pill"></span>
                    <h3>Tulisan terbaru</h2>
                </div>
            </div>
            <div class="owl-carousel owl-theme" wire:ignore>
                @foreach ($articlesLatest as $item)
                    <div class="row justify-content-center mt-4 item">
                        <div class="col-md-12 col-lg-8">
                            <div class="card mb-3 shadow p-3">
                                <div class="row no-gutters">
                                    <div class="col-md-6 thumbnail-post">
                                        <a href="{{ route("tm.show", $item) }}">
                                            <img src="{{ asset("/assets_hilfe/img/washing-hand.jpg") }}" class="card-img" alt="washing hand"
                                            height="100%">
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <a href=""
                                                class="badge-pill badge-main text-white text-decoration-none">{{ $item->categori->name }}</a>
                                            <a href="{{ route("tm.show", $item) }}">
                                                <h2 class="card-title mt-3" style="color: rgb(46, 46, 46)">{{ $item->title }}</h2>
                                            </a>
                                            <p class="card-text">{!! substr($item->content,0,120) !!}..</p>
                                            <div class="media d-flex align-items-center mt-4">
                                                <a href="" class="media-header mr-3">
                                                    <img 
                                                        @if ($item->user->google_id != null)
                                                            @php
                                                                $path = explode("/",$item->user->avatar)
                                                            @endphp
                                                            @if ($path[0] == "storage")
                                                                src="{{ asset($item->user->avatar) }}"
                                                            @else
                                                                src="{{ $item->user->avatar }}"
                                                            @endif
                                                        @else
                                                            @if ($item->user->avatar != null)
                                                                src="{{ asset($item->user->avatar) }}"
                                                            @else
                                                            src="{{ asset("resources/images/default.svg") }}"
                                                            @endif
                                                        @endif
                                                    alt="author" class="rounded-circle">
                                                </a>
                                                <div class="media-body">
                                                    <a href="">
                                                        <h5 class="m-0">{{ $item->name }}</h5>
                                                    </a>
                                                    <span>{{ $item->created_at->format("d M Y") }} • 
                                                            @if ($item->view->count() == null)
                                                                0
                                                            @else
                                                                {{ $item->view->count() }}
                                                            @endif
                                                        read</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Old Posts -->
    <section class="old-posts">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-8 hero-title">
                    <span class="rounded-pill"></span>
                    <h3>Tulisan lama</h2>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-md-12 col-lg-8">
                    <div class="row">
                        @foreach ($articlesOldest as $item)
                            <div class="col-md-6 mb-5" data-aos="fade-up" data-aos-delay="150">
                                <div class="card shadow">
                                    <div style="background: url({{ asset("storage/thumbnail/$item->thumbnail") }})" class="card-thumbnail d-flex align-items-end p-3">
                                        <h5 class="card-title">{{ $item->title }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-subtitle mt-2 mb-3 d-flex align-items-center">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clock mr-2"
                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm8-7A8 8 0 1 1 0 8a8 8 0 0 1 16 0z" />
                                                <path fill-rule="evenodd"
                                                    d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" />
                                            </svg>
                                            {{ $item->created_at->diffForHumans() }}
                                        </h6>
                                        <p class="card-text">{!! substr($item->content,0,120) !!}..</p>
                                        <a href="{{ route("tm.show",$item) }}" class="btn btn-block btn-secondary text-white rounded">Read More</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-3">
                    {{ $articlesOldest->links("custom-pagination-links-view") }}
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="shadow-lg d-flex justify-content-center align-items-center">
        <h1>Footer</h1>
    </footer>
</div>
