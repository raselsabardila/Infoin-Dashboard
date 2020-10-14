<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="hero bg-primary text-white">
                    <div class="hero-inner">
                        <h2>Selamat datang, {{ Auth::user()->name }}</h2>
                        <p class="lead">Ini dashboard untuk mengelola data user dan event organizer.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-4">
                <livewire:online-list></livewire:online-list>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="far fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                <h4>Total Admin</h4>
                                </div>
                                <div class="card-body">
                                {{ $admin->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                                <i class="far fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                <h4>Total EO</h4>
                                </div>
                                <div class="card-body">
                                {{ $eo->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                                <i class="far fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                <h4>Total User</h4>
                                </div>
                                <div class="card-body">
                                {{ $user->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <livewire:admin.list-articles></livewire:admin.list-articles>
            </div>
        </div>
    </div>
</div>