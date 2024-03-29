<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang web của tôi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>';
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('assets/clients/css/style.css')}}">
    @yield('css')
</head>
<body>
    @include('clients.blocks.header')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <aside>
                        @section('sidebar')
                            @include('clients.blocks.sidebar')
                        @show
                    </aside>
    
                </div>
                <div class="col-8">
                    <div class="content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>        
    </main>
    @include('clients.blocks.footer')
    @yield('js')
    @stack('scripts')
</body>
</html>