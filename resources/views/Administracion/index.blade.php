@extends('dashboard')
@section('content')


<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div>
        <x-jet-application-logo class="block h-12 w-auto" />
    </div>

    <div class="mt-8 text-2xl">
       Bienvenidos Al sistema de Administracion de SEGAFF
    </div>

    <div class="mt-6 text-gray-500">
        Funciones que podra realizar: <br>
        -Administracion de residentes (creacion,modificacion,eliminacion) <br>
        -Administracion de visitas autorizadas (creacion,modificacion,eliminacion) <br>
        -Creacion de Consignas (creacion) <br>

        <span style="color: red">Recuerde que todas las administracion se haran efectivas una vez que el sistema <br>
         en garita actualice las designacion via internet
        </span>
    </div>
</div>
<section class="container">

    <div class="row">
       <div class="col-lg-12 col-xs-12">
         
           <h1 class="text-center text-danger mt-5">ADMINISTRACION DE CONSIGNAS</h1>
           <button type="button" class="btn btn-outline-success mb-3" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">+Añadir</button>
        @include('Administracion.modal_create_consigna')
        <table class="table table-dark w-100 mx-auto">
            <thead>
              <tr>
                <th class="text-center"  scope="col">#</th>
                <th class="text-center"  scope="col">Titulo</th>
                <th class="text-center"  scope="col">Residencia</th>
                <th class="text-center" scope="col">Fecha de Creacion</th>
                <th class="text-center" scope="col">EDITAR</th>
               
               
              </tr>
            </thead>
            <tbody>
             
                @foreach ($consignas as $item)
                @include('Administracion.modal_edit_consigna')

                <tr>
                <th class="text-center" scope="row">{{$item->id_consigna}}</th>
                <th class="text-center" scope="row">{{$item->titulo}}</th>
                <th class="text-center" scope="row">{{$item->cod_MnzV}}</th>
                <td class="text-center">{{$item->fecha_creacion}}</td>
                <td class="text-center"><button class="btn btn-outline-success" data-toggle="modal" data-target="#modal_editar-{{$item->id_consigna}}">Editar</button></td>
                
              </tr>
                @endforeach
             
             
            </tbody>
          </table>
       </div>
    </div>
    {{$consignas->links()}}
</section>
<section class="container">

  <div class="row">
     <div class="col-lg-12 col-xs-12">
       
         <h1 class="text-center text-danger mt-5">ADMINISTRACION DE RESIDENTES</h1>
         <button type="button" class="btn btn-outline-success mb-3" data-toggle="modal" data-target="#residente_modal" data-whatever="@getbootstrap">+Añadir</button>
      @include('Administracion.modal_create_residente')
      <table class="table table-dark w-100 mx-auto">
          <thead>
            <tr>
              <th class="text-center"  scope="col">#</th>
              <th class="text-center"  scope="col">CEDULA</th>
              <th class="text-center" scope="col">APELLIDO</th>
              <th class="text-center" scope="col">Imagen</th>
              <th class="text-center" scope="col">EDITAR</th>
             
             
            </tr>
          </thead>
          <tbody>
             
            @foreach ($residentes as $item)
            @include('Administracion.modal_edit_residente')
            <tr>
            <th class="text-center" scope="row">{{$item->id_persona}}</th>
            <th class="text-center" scope="row">{{$item->cedula}}</th>
            <th class="text-center" scope="row">{{$item->nombre}}</th>
<center><th  ><img  width = " 100 " src = " data:image/jpg; base64,{{base64_encode($item->imagen)}}"></th></center>
            <td class="text-center"><button class="btn btn-outline-success" data-toggle="modal" data-target="#modal_editar-{{$item->id_residente}}">Editar</button></td>
            
          </tr>
            @endforeach
         
         
        </tbody>
      </table>
   </div>
</div>
{{$residentes->links()}}

</section>


@endsection