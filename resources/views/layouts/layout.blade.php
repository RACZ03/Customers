<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" 
        content="viewport-fit=cover, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Staff evaluation</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
</head>
<body>
    <!-- Loading import -->
    <div id="divLoader" class="div_loader">
        <div class="loader"></div>
    </div>
    <!-- Navbar import -->
    @include('shared.navbar')

    
    <!-- Include modal create customers-->
    @include('components.create')

    <div class="container pt-3 mb-5"> 


        <!-- Import content -->
        @yield('content')
            
    <div>
    
    <script src="{{asset('js/app.js')}}"></script>
    <!-- ====== Jquery ====== -->
    <script src="{{asset('js/jquery-3.6.0.js')}}"></script> 

    <!-- ==== SweetAlert ==== -->
    <script src="{{asset('js/sweetalert2.js')}}"></script> 
    
    <!-- ===== archivos JS ===== -->
    <script src="{{asset('js/evaluation.js')}}"></script>
    <script src="{{asset('js/customers.js')}}"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>