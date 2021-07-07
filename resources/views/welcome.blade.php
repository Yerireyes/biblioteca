<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BIBLIOTECA</title>
        <link  href="{{asset('css/estilos.css')}}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Sanchez&display=swap" rel="stylesheet">
    </head>
    <body>
        <main class="contenedor">
            <div class="contenedor-textos">
                <h1 class="titulo">Dreams come true to those who truly want them</h1>

                <a href="login" class="cta">Ingresa ahora</a>
            </div>
            <div class="contenedor-imagen">
                <img src="{{asset('imagenes/ilustracion.svg')}}" alt="" class="imag">
            </div>
            <div class="wave">
                <img src="{{asset('imagenes/wave.svg')}}" alt="">
            </div>
        </main>
    </body>
</html>
