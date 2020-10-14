<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="{{ asset("/assets_hilfe/vendor/owlcarousel/assets/owl.carousel.min.css") }}" rel="stylesheet">
    <link href="{{ asset("/assets_hilfe/vendor/owlcarousel/assets/owl.theme.default.min.css") }}" rel="stylesheet">
    <!-- My CSS -->
    <link href="{{ asset("/assets_hilfe/css/main.css") }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <livewire:styles></livewire:styles>
    
    <style>
        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background-color: white;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #F8E7B3;
        }
    </style>

    <title>Hil•fe</title>
</head>

<body class="page-home">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-none">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="#">Hil•fe</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route("tm.index") }}">Tulisan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tentang kita</a>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        @if (Auth::user() == true)
                            <a class="nav-link my-auto btn-main btn-block rounded-pill text-center text-white px-3"
                        href="{{ route("home") }}"><i class="fa fa-home" aria-hidden="true"></i></a>
                        @else
                            <a class="nav-link my-auto btn-main btn-block rounded-pill text-center text-white px-3"
                            href="{{ route("login") }}">Login</a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <livewire:frontend.articles.index></livewire:frontend.articles.index>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset("/assets_hilfe/vendor/jquery/jquery.min.js") }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="{{ asset("/assets_hilfe/vendor/bootstrap/js/bootstrap.min.js") }}"></script>
    <script src="{{ asset("/assets_hilfe/vendor/owlcarousel/owl.carousel.min.js") }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <livewire:scripts></livewire:scripts>

    <script>
        AOS.init();

        $(document).ready(function () {
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                dots: false,
                navText: [
                    `<div class='nav-btn prev-slide rounded-circle shadow-sm'>
                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-chevron-left" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </div>`,
                    `<div class='nav-btn next-slide rounded-circle shadow-sm'>
                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-chevron-right" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </div>`
                ],
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            })
        });
    </script>
</body>

</html>