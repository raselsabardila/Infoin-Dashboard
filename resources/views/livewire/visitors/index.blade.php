<div>
    <div class="row">
        <div class="col">
            <label for="" class="section-title mt-0">Pengunjung</label>
            <p class="section-lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos, deleniti, fuga mollitia deserunt distinctio iusto doloribus sequi culpa labore necessitatibus assumenda corrupti voluptates rem nulla? Suscipit itaque nam maiores cumque!</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card" id="box-visitor-list">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>IP Address</th>
                                <th>Waktu Login</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($visitors as $item => $result)
                                <tr>
                                    <td>{{ $item+$visitors->firstitem() }}</td>
                                    <td>{{ $result->user->email }}</td>
                                    <td>{{ $result->ip }}</td>
                                    <td>{{ $result->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            {{ $visitors->links('custom-pagination-links-view') }}
        </div>
    </div>
</div>

@section('script')
    <script>
        var width = screen.width;
        console.log(width)
    </script>
@endsection
