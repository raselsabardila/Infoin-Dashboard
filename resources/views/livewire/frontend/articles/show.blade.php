<div>
    @if (session("success"))
        <script>
            swal("System Says", "{{ session("success") }}", "success");
        </script>
    @endif
    <section id="detail-post" class="detail-post my-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8" id="box-title-article">
                    <h2>{{ $article->title }}</h2>
                    <div style="margin-top: 15px">
                        <img 
                            @if ($article->user->google_id != null)
                                @php
                                    $path = explode("/",$article->user->avatar)
                                @endphp
                                @if ($path[0] == "storage")
                                    src="{{ asset($article->user->avatar) }}"
                                @else
                                    src="{{ $article->user->avatar }}"
                                @endif
                            @else
                                @if ($article->user->avatar != null)
                                    src="{{ asset($article->user->avatar) }}"
                                @else
                                src="{{ asset("resources/images/default.svg") }}"
                                @endif
                            @endif
                        alt="" width="48px" height="48px" class="rounded-circle float-left">

                        <div class="float-left ml-3">
                            <p style="font-size:16px;color:rgb(56, 56, 56);margin-top:3px;text-transform:capitalize">{{ $article->user->name }}</p>
                            <p style="margin-top: -19px;font-size:14px">{{ $article->created_at->format("d M, Y") }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-md-1 text-center">
                    <div class="share-comment sticky-top py-md-5">
                        <div class="share-post">
                            <p>Share</p>
                            <a href="https://twitter.com/intent/tweet?{{ $link }}" class="d-md-block mx-4 mx-md-0 my-4">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?{{ $link }}" class="d-md-block mx-4 mx-md-0 my-4">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ $link }}" class="d-md-block mx-4 mx-md-0 my-4">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                        <hr>
                        <div class="reply-post d-none d-md-block">
                            <p>Reply</p>
                            <a href="#komentar" class="page-scroll">{{ $article->comments->count() }}</a>
                            <a href="#komentar" class="d-block my-3 page-scroll">
                                <i class="far fa-comment"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="detail-post-thumbnail">
                        <img src="{{ asset("storage/thumbnail/$article->thumbnail") }}" alt="html" class="img-fluid">
                        <div class="breadcrumb-detail-post mt-3">
                            <p><a href="{{ route("tm.index") }}" class="font-normal">Tulisan Masyarakat</a> &raquo; {{ $article->title }}</p>
                        </div>
                    </div>
                    <div class="detail-post-content mt-4">
                        {!! $article->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Komentar & Related Post -->
    <section class="related-post mt-5" id="related-post">
        <div class="container post pt-4">
            <div class="post-item my-5">
                <div class="row mt-4">
                    @foreach ($articlesLatest as $item)
                        <div class="col-md-6 col-lg-4 my-3">
                            <div class="card">
                                <a href="{{ route("tm.show",$item) }}" class="text-decoration-none">
                                    <img src="{{ asset("storage/thumbnail/$item->thumbnail") }}" class="card-img-top" height="180px" alt="html">
                                </a>
                                <div class="card-body">
                                    <a href="{{ route("tm.show",$item) }}" class="text-decoration-none">
                                        <h5 class="card-title">
                                            {{ substr($item->title,0,20) }}..
                                        </h5>
                                    </a>
                                    <div class="author d-flex mt-4 align-items-center">
                                        <div class="author-img">
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
                                            alt="author" class="rounded-circle" width="48px" height="48px">
                                        </div>
                                        <div class="author-name ml-3">
                                            <p class="m-0"><a href="">{{ $item->user->name }}</a> in <a href="">{{ $item->categori->name }}</a></p>
                                            <p class="m-0">Sep 9, 2020 • 2 min read</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="komentar" id="komentar">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <h2>Komentar</h2>
                    </div>
                </div>
                <div class="row justify-content-center my-3">
                    <div class="col-md-8">
                        @foreach ($comments as $item)
                            <div class="card komentar-item my-4">
                                <div class="card-body">
                                    <div class="author d-flex justify-content-between">
                                        <div class="komentar-left  d-flex align-items-center">
                                            <div class="author-img">
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
                                                alt="komentar" class="rounded-circle" width="48px" height="48px">
                                            </div>
                                            <div class="author-name ml-3">
                                                <p class="m-0">{{ $item->user->email }}</p>
                                                <small class="m-0">{{ $item->user->role->name }}</small>
                                            </div>
                                        </div>
                                        <div class="komentar-right">
                                            <p>{{ $item->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <div class="komentar-desc mt-3">
                                        <p>{{ $item->comment }}</p>
                                    </div>
                                    <br>
                                    @if ($item->childs->count() != null)
                                        @foreach ($item->childs as $item2)
                                            <div class="ml-5">
                                                <div class="author d-flex justify-content-between">
                                                    <div class="komentar-left  d-flex align-items-center">
                                                        <div class="author-img">
                                                            <img 
                                                            @if ($item2->user->google_id != null)
                                                                @php
                                                                    $path = explode("/",$item2->user->avatar)
                                                                @endphp
                                                                @if ($path[0] == "storage")
                                                                    src="{{ asset($item2->user->avatar) }}"
                                                                @else
                                                                    src="{{ $item2->user->avatar }}"
                                                                @endif
                                                            @else
                                                                @if ($item2->user->avatar != null)
                                                                    src="{{ asset($item2->user->avatar) }}"
                                                                @else
                                                                src="{{ asset("resources/images/default.svg") }}"
                                                                @endif
                                                            @endif
                                                            alt="komentar" class="rounded-circle" width="48px" height="48px">
                                                        </div>
                                                        <div class="author-name ml-3">
                                                            <p class="m-0">{{ $item2->user->email }}</p>
                                                            <small class="m-0">{{ $item2->user->role->name }}</small>
                                                        </div>
                                                    </div>
                                                    <div class="komentar-right">
                                                        <p>{{ $item2->created_at->diffForHumans() }}</p>
                                                    </div>
                                                </div>
                                                <div class="komentar-desc mt-3">
                                                    <p>{{ $item2->comment }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    <hr>
                                    @if (Auth::user() == true)
                                        <a class="float-right" wire:click="reply({{ $item->id }})" data-toggle="collapse" href="#collapse2" role="button"
                                            aria-expanded="false" aria-controls="collapse2">
                                            Reply
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        @if (Auth::user() == true)
                            <livewire:frontend.articles.comments :article="$article"></livewire:frontend.articles.comments>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
