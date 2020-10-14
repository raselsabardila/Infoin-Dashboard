@section('title')
    Admin
@endsection

@section('sub-title')
    Admin
@endsection

<div>
    <div class="row">
        <div class="col">
            <label for="" class="section-title mt-0">Admin</label>
            <p class="section-lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi iure, deserunt exercitationem ad quidem, est quam nemo molestiae eveniet repellat id. Architecto optio saepe magnam quia, voluptates iusto natus et!</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="float-left">
                                <div class="card-header-form">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" style="border-radius:25px 0px 0px 25px" wire:model="search">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary" style="height:42px;border-radius:0px 25px 25px 0px;width:50px"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="float-right">
                                <div class="form-group">
                                    <select wire:model="paginate" id="my-select" class="form-control paginate-index" name="">
                                        <option>1</option>
                                        <option>5</option>
                                        <option>10</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-12">
                            <table class="table table-hover table-responsive">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Avatar</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Joined</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $item => $result)
                                        <tr>
                                            <td>{{ $item+$users->firstitem() }}</td>
                                            <td>
                                                <img 
                                                    @if ($result->google_id != null)
                                                        @php
                                                            $path = explode("/",$result->avatar)
                                                        @endphp
                                                        @if ($path[0] == "storage")
                                                            src="{{ asset($result->avatar) }}"
                                                        @else
                                                            src="{{ $result->avatar }}"
                                                        @endif
                                                    @else
                                                        @if ($result->avatar != null)
                                                            src="{{ asset($result->avatar) }}"
                                                        @else
                                                            src="{{ asset("resources/images/default.svg") }}"
                                                        @endif
                                                    @endif
                                                alt="" class="img-thumbnail mt-3" width="100px">
                                            </td>
                                            <td>{{ $result->name }}</td>
                                            <td>{{ $result->email }}</td>
                                            <td>
                                                @if ($result->role_id == 1)
                                                    <span class="badge badge-pill badge-primary">{{ $result->role->name }}</span>
                                                @endif
                                                @if ($result->role_id == 2)
                                                    <span class="badge badge-pill badge-success">{{ $result->role->name }}</span>
                                                @endif
                                                @if ($result->role_id == 3)
                                                    <span class="badge badge-pill badge-warning">{{ $result->role->name }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $result->created_at->diffForHumans() }}</td>
                                            <td>
                                                @if ($result->status == 1)
                                                    <span class="badge badge-pill badge-success">Online</span>
                                                @else
                                                    <span class="badge badge-pill badge-danger">Offline</span>
                                                @endif
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
                <div class="col-md-4">
                    {{ $users->links("custom-pagination-links-view") }}
                </div>
            </div>
        </div>
    </div>
</div>
