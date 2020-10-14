@section('css')
    <style>
        li{
            display: inline;
            margin-right: 10px;
            cursor: pointer;
            color: #6777EF
        }
    </style>
@endsection
<div>
    @if (session("success"))
        <script>
            swal("System Says", "{{ session("success") }}", "success");
        </script>
    @endif
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table class="table table-responsive table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Waktu</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $item => $result)
                            <tr>
                                <td>{{ $item+$articles->firstitem() }}</td>
                                <td>{{ $result->title }}
                                    <div>
                                        <li>lihat</li>
                                        <li class="text-danger" wire:click="unpublish({{ $result->id }})">unpublish</li>
                                    </div>
                                </td>
                                <td>
                                    <img 
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
                                    <span class="badge badge-primary">{{ $result->status->name }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
