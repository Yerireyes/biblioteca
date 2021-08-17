<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">
    <!-- FONTAWESOME : https://kit.fontawesome.com/a23e6feb03.js -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.  5/jquery.mCustomScrollbar.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="{{asset('js/icons.js')}}"></script>

    <title>Home</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light blue fixed-top">
        <button id="sidebarCollapse" class="btn navbar-btn">
            <i class="fas fa-lg fa-bars"></i>
        </button>
        <a class="navbar-brand" href="">
            <h3 id="logo">Biblioteca</h3>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">

                {{-- <li class="nav-item">
                    <a class="nav-link" id="link" href="/">
                        <i class="fas fa-id-card"></i>LogOut</a> --}}

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    @guest
                    @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @endif

                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                @if('user.profile2'!=Route::currentRouteName() && 'user.configurations2'!=Route::currentRouteName() && 'user.password2'!=Route::currentRouteName())
                @if(str_contains($rol->accion,'Usuarios') || str_contains($rol->accion,'Roles') || str_contains($rol->accion,'Libros') || str_contains($rol->accion,'Apuntes') ||
                str_contains($rol->accion,'Tesis') || str_contains($rol->accion,'Editoriales') || str_contains($rol->accion,'Autores') || str_contains($rol->accion,'Idiomas') ||
                str_contains($rol->accion,'Gestiones') || str_contains($rol->accion,'Materias') || str_contains($rol->accion,'Bitacora') || str_contains($rol->accion,'Categorias'))
                <div class="mt-1 p-0">
                    <a type="submit" href="/home" class="btn btn-sm btn-primary"> Administrador</a>
                </div>
                @endif
                @endif
                <li class="nav-item dropdown text-white">
                    <a id="navbarDropdown" class="nav-link text-white" color=white href="/profile2/{{Auth::id()}}" role="button"
                        data-toggle="" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->username }}
                    </a>
                <li class="nav-item active">
                    <a class="nav-link" id="link" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        LogOut<span class="sr-only">(current) </span></a>
                </li>

                </li>
                @endguest
                </li>
            </ul>
        </div>
    </nav>

    <div class="wrapper fixed-left">
        @guest
        @else
        @if('user.profile2'!=Route::currentRouteName() && 'user.configurations2'!=Route::currentRouteName() && 'user.password2'!=Route::currentRouteName())
        <nav id="sidebar" class="bg-white border border-dark">


            <ul class="list-unstyled components">
            
                @foreach($categories as $category)
                <li>
                    <a data-bs-toggle="collapse" href="#category-{{$category['id']}}">{{$category['name']}}</a>
                </li>
                <div class="collapse" id="category-{{$category['id']}}">
                    <div class="card card-body">
                        <ul class="list-unstyled components">
                            @foreach($category['subCategories'] as $subCategory)
                            <br>
                            <div class="row ">
                                
                                @if(count($subCategory['subCategories'])>0)
                                <a class="text-dark font-weight-bold" data-bs-toggle="collapse"
                                    href="#category-{{$subCategory['id']}}">{{$subCategory['name']}}</a>
                                    @else
                                    <a class="text-dark font-weight-bold" 
                                    href="{{route('books.user',[$subCategory['id'],$category['id']])}}">{{$subCategory['name']}}</a>
                                    @endif
                                <div class="collapse" id="category-{{$subCategory['id']}}">
                                    <ul class="justify-content-end list-unstyled components">
                                        @foreach($subCategory['subCategories'] as $subCategory2)
                                        <div class="row">
                                            <a class="text-dark font-weight-bold"
                                                href="{{route('books.user',[$subCategory2->id,$category['id']])}}">{{$subCategory2['name']}}</a>
                                        </div>
 
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach
            
            </ul>
        </nav>
        @endif
        @endguest
        <div id="content">
            <main class="py-4">
                @yield('content')
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
            </main>

        </div>


    </div>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
    <script src="{{asset('js/script.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $("#options").on("change", function () {
            console.clear();
            var id = $(this).val();
            var name = $(this).find("option:selected").text();
            console.log(`Option selected: ${name}`);

            console.log(`Verifying if was already selected...`);
            if (alreadyExists(id)) {
                console.log(`Option already selected. Not added`);
            } else {
                console.log(`Option not selected. Yes added`);
                addOption(id, name);
            }
        });
        function alreadyExists(id) {
            var inputValue = $("#selectedOptionIds").val();
            var selectedIds = inputValue.split("-");
            return selectedIds.indexOf(id) > -1;
        }
        function addOption(id, name) {
            $("#selected-options").append(`
                <span id="${id}" class="badge rounded-pill bg-dark text-white">${name} 
                <button onclick="eliminar(${id})" type="button" class="badge rounded-pill bg-dark text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x author" viewBox="0 0 16 16">
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
                </svg>
              </button>
              </span>
                
                
                `);
            var selectedIds = $("#selectedOptionIds").val() + "-" + id;
            $("#selectedOptionIds").val(selectedIds);
        }
        function eliminar(id) {
            var inputValue = $("#selectedOptionIds").val();
            var selectedIds = inputValue.split("-");
            $("#selected-options span#" + id).remove();
            var newSelectedIds = "";
            selectedIds.forEach(element => {
                if (element != "" && element != id) {
                    newSelectedIds += "-" + element;
                }

            });
            $("#selectedOptionIds").val(newSelectedIds);
        }


    </script>
</body>

</html>