@section('css')
    <style>
        h6{
            cursor: pointer;
            font-weight: normal;
            font-size: 15px
        }

        ul{
            margin-top: 5px
        }

        li{
            display: inline;
            list-style: none;
            cursor: pointer;
            color: #6777EF
        }

    </style>
@endsection
<div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col">
                    <label for="" class="section-title mt-0">Artikel</label>
                    <p class="section-lead">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magni ut expedita hic ullam dolorem voluptas aliquid qui molestiae doloremque nemo tenetur, vel in quasi ratione repellat aut tempora enim impedit.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <h6 
                                        @if ($active == null)
                                        class="nav-link active"
                                        @else
                                            class="nav-link"
                                        @endif
                                    wire:click="nonActive()">Semua <span class="badge badge-primary">{{ $all->count() }}</span></h6>
                                </li>
                                <li class="nav-item">
                                    <h6 
                                        @if ($active == 2)
                                            class="nav-link active"
                                        @else
                                            class="nav-link"
                                        @endif
                                    wire:click="active({{ 2 }})">Draft <span class="badge badge-primary">{{ $draft }}</span></h6>
                                </li>
                                <li class="nav-item">
                                    <h6 
                                        @if ($active == 3)
                                            class="nav-link active"
                                        @else
                                            class="nav-link"
                                        @endif
                                    wire:click="active({{ 3 }})">Sampah <span class="badge badge-primary">{{ $trash }}</span></h6>
                                </li>
                                <li class="nav-item">
                                    <h6 
                                        @if ($active == 1)
                                            class="nav-link active"
                                        @else
                                            class="nav-link"
                                        @endif
                                    wire:click="active({{ 1 }})">Publish <span class="badge badge-primary">{{ $publish }}</span></h6>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @if (session("successArticle"))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session("successArticle") }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session("errorArticle"))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session("errorArticle") }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="float-left mb-3">
                                        <div class="card-header-form">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Search" style="border-radius:25px 0px 0px 25px" wire:model="search" wire:model="search">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-primary" style="height:42px;border-radius:0px 25px 25px 0px;width:50px"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tr>
                                                <th class="text-center pt-2">
                                                #
                                                </th>
                                                <th>Judul</th>
                                                <th>Kategori</th>
                                                <th>Penulis</th>
                                                <th>Waktu</th>
                                                <th>Status</th>
                                            </tr>
                                            @foreach ($articles as $item => $result)
                                                <tr>
                                                    <td>
                                                        {{ $item+$articles->firstitem() }}
                                                    </td>
                                                    <td>{{ $result->title }}
                                                        <div class="mt-1">
                                                            @if ($result->status_id == 1)
                                                                <li style="margin-right: 10px">
                                                                    lihat
                                                                </li>
                                                            @endif
                                                            @if ($result->status_id != 3)
                                                                <li style="margin-right: 10px">
                                                                    <a href="{{ route("articles.edit",$result) }}">
                                                                        ubah
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            @if ($articleEdit == null)
                                                                @if ($result->deleted_at != null)
                                                                    <li wire:click="destroy({{ $result->id }})" class="text-danger" style="margin-right: 10px">
                                                                        hapus
                                                                    </li>
                                                                @else
                                                                    <li wire:click="toTrash({{ $result->id }})" class="text-danger" style="margin-right: 10px">
                                                                        sampah
                                                                    </li>
                                                                @endif
                                                            @endif
                                                            @if ($result->deleted_at != null)
                                                                <li wire:click="restore({{ $result->id }})" class="text-success" style="margin-right: 10px">
                                                                    pulihkan
                                                                </li>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{ $result->categori->name }}
                                                    </td>
                                                    <td>
                                                        <img alt="image" 
                                                            @if ($result->user->google_id != null)
                                                                @php
                                                                    $path = explode("/",$result->user->avatar)
                                                                @endphp
                                                                @if ($path[0] == "storage")
                                                                    src="{{ asset($result->user->avatar) }}"
                                                                @else
                                                                    src="{{ $result->user->avatar }}"
                                                                @endif
                                                            @else
                                                                @if ($result->user->avatar != null)
                                                                    src="{{ asset($result->user->avatar) }}"
                                                                @else
                                                                src="{{ asset("resources/images/default.svg") }}"
                                                                @endif
                                                            @endif
                                                        class="rounded-circle" width="35" data-toggle="title" height="35" title="">
                                                    </td>
                                                    <td>{{ $result->created_at->format("d M Y") }}</td>
                                                    <td>
                                                        @if ($result->status_id == 1)
                                                            <div class="badge badge-primary">{{ $result->status->name }}</div>
                                                        @endif
                                                        @if ($result->status_id == 2)
                                                            <div class="badge badge-warning">{{ $result->status->name }}</div>
                                                        @endif
                                                        @if ($result->status_id == 3)
                                                            <div class="badge badge-danger">{{ $result->status->name }}</div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-3">
                    {{ $articles->links("custom-pagination-links-view") }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" wire:ignore>
            @if ($articleEdit !=null)
                @include('articles.edit')
            @else
                @include('articles.create')
            @endif
        </div>
    </div>
</div>
