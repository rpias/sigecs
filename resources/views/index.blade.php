@extends('layouts.layout')

@section('titulo')
   Panel de Control
@endsection

 @section('encabezados')
 <!-- Morris chart -->
 <link rel="stylesheet" href="{{ asset ('plugins/morris/morris.css')}}">

@endsection

@section('menu')
    {{!! $menu_str !!}}
@endsection

@section('contenido')

      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
        
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>0</h3>
                <p>Servicios</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">Más Información <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
           
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3> {{ $morosidad }} <sup style="font-size: 20px">%</sup></h3>

              <!--<p>Morosidad al {{ $fecha_limite }} (45 días)</p>-->
              <p>Morosidad (90 días)</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ url('index_morosidad') }}" class="small-box-footer">Más Información <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
         
              
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>0</h3>

                <p>Expedientes</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">Más Información<i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>0</h3>
                <p>Funcionarios</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">Más Información <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
      
          <!-- ./col -->
        </div>
        
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">

            <a href="{{ route('edificios.pdf') }}" class="btn btn-primary mb-2">
              Descargar Edificios en PDF
            </a>

            <!-- Custom tabs (Charts with tabs)-->
            
            <!-- /.card -->

            <!-- DIRECT CHAT -->
          
            <!--/.direct-chat -->

            <!-- TO DO List -->
         
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">

           
            <!-- Map card -->
        
            <!-- /.card -->

            <!-- solid sales graph -->
         
            <!-- /.card -->

            <!-- Calendar -->
         
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    
    




@endsection


@section('scripts')
  
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset ('dist/js/demo.js')}}"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{ asset ('plugins/morris/morris.min.js')}}"></script>
    <!-- jvectormap -->
    <script src="{{ asset ('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{ asset ('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset ('plugins/knob/jquery.knob.js')}} "></script>

@endsection