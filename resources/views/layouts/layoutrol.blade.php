<!DOCTYPE html>
<html lang="en">

  <head>

   
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SIGECS - Login</title>

    <!-- Bootstrap core CSS-->
    <link rel="stylesheet" href="{{ asset ('plugins/bootstrap/css/bootstrap.min.css')}}">

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="{{ asset ('plugins/font-awesme/css/font-awesome.min.css')}}">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="{{ asset ('css/app.css')}}">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

  </head>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Acceso Usuarios</div>
        <div class="card-body">

          <form>

            <div class="form-group">
              <div class="form-label-group">

              </div>
            </div>
          
            <div class="form-group">
              <div class="form-label-group">
               
                <label for="select_rol">Perfiles del usuario</label>
            
                    <select id="select_rol" name="select_rol" class="form-control">
                        @foreach ($user->roles as $rol)
                          <option value="{{ $rol->id_rol }}">{{ $rol->nombre }}</option>
                        @endforeach
                    </select> 
            </div>

            <div class="form-group">&nbsp;</div>
<!--
            <button type="button" class="btn btn-primary" 
            name="btn_ingresar" id="btn_ingresar">Ingresar</button>
-->
            <a id="btn_ingresar" class="btn btn-primary btn-block" href="{{ url('index') }}" class="nav-link">Login</a>

          </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <!-- jQuery -->
    <script src="{{ asset ('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset ('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset ('plugins/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{ asset ('js/globales.js')}}"></script>

    <script>
        $(document).ready(function() {
            // -----------------------------------------------------------
            // TOCKEN de PETICIONES
            // -----------------------------------------------------------
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // -----------------------------------------------------------
            // FIN TOCKEN de PETICIONES
            // -----------------------------------------------------------
            $('#btn_ingresar').on('click', onClickBotonIniciar);
            function onClickBotonIniciar(){
              var id_rol = $('#select_rol').val();
              var ruta = ruta_raiz + "index_rol";
              $.post(ruta, {id_rol: id_rol});
            }
        });
    </script>

  </body>
</html>
