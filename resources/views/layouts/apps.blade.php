<!DOCTYPE html>
<html lang="zxx" class="js">
<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Devindicator Platform template">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('public/main/img/favicon_io/favicon.ico') }}">
    <title>Devindicator - Managing for Development Results</title>
    @include('includes.master')
</head>

<body class="nk-body bg-lighter npc-default has-sidebar ">
    <div class="nk-app-root">
        <div class="nk-main ">
            @include('includes.sidebar')
            <div class="nk-wrap ">
               @include('includes.nav') 
               <div class="nk-content ">
                @yield('content')
               </div>
               <div class="nk-footer">
               @include('includes.footer')
           </div>
            </div>
        </div>
    </div>
    </body>
    </html>