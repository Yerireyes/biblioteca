<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">
    <!-- FONTAWESOME : https://kit.fontawesome.com/a23e6feb03.js -->
    <link rel="stylesheet"   href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.  5/jquery.mCustomScrollbar.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="{{asset('js/icons.js')}}" ></script>

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
    <button class="navbar-toggler" type="button" data-toggle="collapse"   data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"  aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" id="link" href="#">
          <i class="fas fa-sign-out-alt"></i>
          LogOut<span class="sr-only">(current) </span></a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link" id="link" href="/">
          <i class="fas fa-id-card"></i>LogOut</a> --}}
        </li>
      </ul>
    </div>
  </nav>

  <div class="wrapper fixed-left">
    <nav id="sidebar">
      <div class="sidebar-header">
        <h3><i class="fas fa-user"></i>Administrador</h3>
      </div>

      <ul class="list-unstyled components">
        <li>
          <a href=""><i class="fas fa-usua"></i>Usuarios</a>
        </li>
        <li>
          <a href=""><i class="fas fa-rol"></i>Rol</a>
        </li>
        <li>
          <a href=""><i class="fas fa-docu"></i>Documentos</a>
        </li>
        <li>
          <a href=""><i class="fas fa-edito"></i>Editoriales</a>
        </li>
        <li>
          <a href=""><i class="fas fa-auto"></i>Autores</a>
        </li>
        <li>
          <a href=""><i class="fas fa-lol"></i>Idiomas</a>
        </li>
        <li>
          <a href=""><i class="fas fa-ikjds"></i>Bitacora</a>
        </li>
        <li>
          <a href=""><i class="fas fa-hdj"></i>Estadisticas</a>
        </li>
      </ul>
    </nav>

    <div id="content">

    </div>

  </div>
    
    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="{{asset('js/script.js')}}"></script>
  </body>
</html>