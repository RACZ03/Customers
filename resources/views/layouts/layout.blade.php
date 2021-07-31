<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" 
        content="viewport-fit=cover, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Customers</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
</head>
<body>
    <div id="divLoader" class="div_loader">
        <div class="loader"></div>
    </div>

    <div class="container pt-5 mb-5">            

        <!-- Open modal -->
        <div class="col-12 text-right">
            <button type="button" class="btn btn-primary btn-circle btn-lg top-0 end-0"
                    data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"/>
                </svg>
            </button>
        </div>

        <!-- Include modal -->
        @include('components.create')
        
    
        <!-- Container customer -->
        <div class="row mt-3 content">
            <!-- Title -->
            <h5 class="title">
                Clientes
            </h5>
            <!-- Imput search -->
            <div class="col-xl-4 offset-xl-8 col-lg-4 offset-lg-8 col-md-5 offset-md-7 col-sm-6 offset-sm-6 col-xs-8 offset-xs-4">
                <form action="{{ route('index') }}" method="get">
                    <input class="form-control me-2"
                            id="textInput" 
                            type="search" 
                            placeholder="Buscar" 
                            aria-label="Search"
                            name="searchText"
                            value="{{ $searchText }}">
                    <button id="btnChange" hidden="hidden"></button>
                </form>
            </div>

            <!-- Import Table -->
                @yield('tableCustomers')
            <!-- Fin table -->
            

        </div>

    <div>
    
    <script src="{{asset('js/app.js')}}"></script>
    <!-- ====== Jquery ====== -->
    <script src="{{asset('js/jquery-3.6.0.js')}}"></script> 

    <!-- ==== SweetAlert ==== -->
    <script src="{{asset('js/sweetalert2.js')}}"></script> 
    
    <!-- ===== MAIN JS ===== -->
    <script src="{{asset('js/main.js')}}"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>