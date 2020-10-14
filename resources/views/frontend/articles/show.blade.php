<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Fontawesome -->
    <link href="{{ asset("article/fontawesome/css/all.css") }}" rel="stylesheet">
    <!-- My CSS -->
    <link rel="stylesheet" href="{{ asset("article/style.css") }}">
    <link href="{{ asset("/assets_hilfe/css/main.css") }}" rel="stylesheet" />

    <livewire:styles></livewire:styles>
    <livewire:scripts></livewire:scripts>
    

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

    <title>Pilogon - Blog</title>
</head>

<body>

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

    <!-- Jumbotron -->

    <!-- Detail Post -->
    
    <livewire:frontend.articles.show :article="$article"></livewire:frontend.articles.show>

    <!-- Footer -->
    <footer class="bg-primary p-5 text-white text-center">
        <h1>Ceritanya Footer ya sel :)</h1>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
    <script>
        /* Open the sidenav */
        function openNav() {
            document.getElementById("mySidebar").style.width = "250px";
        }

        /* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
        }

        $('.page-scroll').on('click', function (e) {
            var tujuan = $(this).attr('href');
            var elemenTujuan = $(tujuan);
            $('html , body').animate({
                scrollTop: elemenTujuan.offset().top - 100
            });
            e.preventDefault();
        });
    </script>
</body>

</html>