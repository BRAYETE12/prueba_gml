<!DOCTYPE html>
<html lang="es" class="h-100" >
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> {{$titulo}} </title>
    <link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.min.css" /> 

    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link href="/DataTable/bootstrap-table.min.css" rel="stylesheet">

    <script src="/js/vue.min.js"></script>
    <script src="/js/axios.min.js"></script>

    <style>
        .container{
            min-width: 95% !important;
        }
        .form-group label{
            display: inline-block;
            margin-bottom: 0.3rem;
            font-size: .9rem;
            font-weight: 500;
        }
    </style>
    <style>
        .cargando{
            position: absolute;
            z-index: 100;
            width: 100%;
            background: white;
            height: 100%;
            text-align: center;
            padding-top: 5rem;
        }
        .bootstrap-table .table td, .table th{
            padding: 0.2rem !important;
        }
        .bootstrap-table .table-bordered td, 
        .bootstrap-table .table-bordered th,
        .bootstrap-table .table-bordered{
            border: none !important;
        }
        .bootstrap-table table thead{
            border-top: 2px solid #dee2e6;
        }
        body{
            height: 100% !important;
        }
        .table .input-group-prepend>.input-group-text{
            padding: 0 0.2rem;
            font-size: .6rem;
            font-weight: 700;
            line-height: .9;
        }
        .line-15{
            line-height: 15px;
        }
        .vs__dropdown-toggle{
            height: calc(1.5em + 0.75rem + 2px) !important;
        }
        .SoloVer .modal-body{
            pointer-events: none !important;
        }
        .SoloVer .btn-primary{
            display: none !important;
        }
    </style>

</head>
<body class="d-flex flex-column h-100 bg-light" >

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary border-bottom shadow-lg mb-3"> 
            <div class="container">
                <a class="navbar-brand p-0" href="/dashboard" >
                    <h2 class="text-white">SEAM</h2>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <div class="dropdown">
                        <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                            usuario@gml.com
                        </button>
                    </div> 
                </div>
            </div>
        </nav>
    </header>

    <div class="container flex-shrink-0 p-0 position-relative">
        
        <div class="cargando">
            <div class="w-100 position-fixed">
                <div class="spinner-border text-success" style="width: 3rem; height: 3rem;" role="status"></div>
                <h2>Cargando...</h2>
            </div>
        </div>

        <main role="main" class="pb-3">
            @yield('content')
        </main>

    </div>

    <footer class="footer mt-auto bg-white shadow-lg py-3">
        <div class="container text-center">
            PRUEBA - GML
        </div>
    </footer>
    <script src="/jquery/dist/jquery.min.js"></script>
    <script src="/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/sweetalert2@11.js"></script> 

    <link rel="stylesheet" href="/css/vue-select.css" />
    <script src="/js/vue-select.js"></script>

    <link href="/DataTable/bootstrap-table.min.css" rel="stylesheet" />
    <script src="/DataTable/bootstrap-table.min.js"></script>
    <script src="/DataTable/bootstrap-table-es-ES.js"></script>
    <script src="/DataTable/bootstrap-table-vue.min.js"></script>

    <script>
     
        var http = {

            post: function (url, data, is_crear) {
                return new Promise((resolve, reject) => {
                    Swal.fire({
                        title: 'GUARDAR DATOS',
                        text: "¿Está seguro de guardar?",
                        type: "warning",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                        preConfirm: (login) => {
                            
                            if(is_crear)
                            {
                                return axios.post(url, data)
                                .then(response=> { return response; })
                                .catch(error=> { reject(error?.response?.data); });
                            }

                            return axios.put(url, data)
                            .then(response=> { return response; })
                            .catch(error=> { reject(error?.response?.data); });
                        },
                        allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => { resolve(result?.value?.data); });

                });
            }, 

            get: function (url) {
                return axios.get(url);
            }, 
            
            eliminar: function (url) {
                return new Promise((resolve, reject) => {
                    Swal.fire({
                        title: 'ELIMINAR',
                        text: '¿Está seguro de eliminar este registro?',
                        type: "warning",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                        preConfirm: (login) => {
                            return axios.delete(url)
                                .then(function (response) { return response; })
                                .catch(error => { reject(error); });
                        },
                        allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => { resolve(result.value.data); });

                });
            }, 

        };
 
    </script>
    @yield('scripts')
</body>
</html>