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
                <div class="mt-1 p-0">
                    <a type="submit" href="/home2" class="btn btn-sm btn-primary"> Ir a la Biblioteca</a>
                </div>
                <li class="nav-item dropdown text-white">
                    <a id="navbarDropdown" class="nav-link text-white" color="white" href="/profile/{{Auth::id()}}" role="button"
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
        @if('user.profile'!=Route::currentRouteName() && 'user.configurations'!=Route::currentRouteName() && 'user.password'!=Route::currentRouteName())
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3><i class="fas fa-user"></i>Administrador</h3>
            </div>

            <ul class="list-unstyled components">
                @if(str_contains($rol->accion,'Usuarios'))
                <li>
                    <a href="/users"><i class="fas fa-usua"></i>Usuarios</a>
                </li>
                @endif
                @if(str_contains($rol->accion,'Roles'))
                <li>
                    <a href="/roles"><i class="fas fa-rol"></i>Rol</a>
                </li>
                @endif
                @if(str_contains($rol->accion,'Libros'))
                <li>
                    <a href="/books"><i class="fas fa-docu"></i>Libros</a>
                </li>
                @endif
                @if(str_contains($rol->accion,'Apuntes'))
                <li>
                    <a href="/notes"><i class="fas fa-docu"></i>Apuntes</a>
                </li>
                @endif
                @if(str_contains($rol->accion,'Tesis'))
                <li>
                    <a href="/theses"><i class="fas fa-docu"></i>Tesis</a>
                </li>
                @endif
                @if(str_contains($rol->accion,'Editoriales'))
                <li>
                    <a href="/editorials"><i class="fas fa-edito"></i>Editoriales</a>
                </li>
                @endif
                @if(str_contains($rol->accion,'Autores'))
                <li>
                    <a href="/authors"><i class="fas fa-auto"></i>Autores</a>
                </li>
                @endif
                @if(str_contains($rol->accion,'Idiomas'))
                <li>
                    <a href="/languages"><i class="fas fa-lol"></i>Idiomas</a>
                </li>
                @endif
                @if(str_contains($rol->accion,'Gestiones'))
                <li>
                    <a href="/managements"><i class="fas fa-lol"></i>Gestion</a>
                </li>
                @endif
                @if(str_contains($rol->accion,'Materias'))
                <li>
                    <a href="/subjects"><i class="fas fa-lol"></i>Materia</a>
                </li>
                @endif
                @if(str_contains($rol->accion,'Bitacora'))
                <li>
                    <a href="/logs"><i class="fas fa-ikjds"></i>Bitacora</a>
                </li>
                @endif
                @if(str_contains($rol->accion,'Categorias'))
                <li>
                    <a href="/categories"><i class="fas fa-ikjds"></i>Categoria</a>
                </li>
                @endif
            </ul>
        </nav>
        @endif
        @endguest
        <div id="content">
            <main class="py-4">
                @yield('content')
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
        function eliminar(id){
            var inputValue = $("#selectedOptionIds").val();
            var selectedIds = inputValue.split("-");
            $("#selected-options span#"+id).remove();
            var newSelectedIds = "";
            selectedIds.forEach(element => {
                if (element!="" && element!=id){
                    newSelectedIds += "-" + element;
                }
                
            });
            $("#selectedOptionIds").val(newSelectedIds);
        }

        
    </script>
</body>

</html>

