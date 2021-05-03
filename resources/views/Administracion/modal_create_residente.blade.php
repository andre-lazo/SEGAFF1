
<div class="modal fade" id="residente_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header bg-dark">
          <h5 class="modal-title text-white " id="exampleModalLabel"><b>CREACION DE RESIDENTE</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            
          </button>
        </div>
        <div class="modal-body">
          <span class="text-danger">Parametros a seguir: <br>
            - archivos de tipo imagen <br>
            - maximo 1 archivo <br>
        -tamaño maximo 2mb </span> <br>
      

              <form action="{{ route('residente.store') }}" enctype="multipart/form-data" method="POST"  >
                @method('POST')
                @csrf
                <div class="form-group">
                <label for="message-text" class="col-form-label">IMAGEN</label>
                </div>
               <input  type="file" accept="image/*" name="imagen_nombre" id="imagen_nombre">
                <div class="form-group">
                  <label for="message-text" class="col-form-label">NOMBRE</label>
                  <input type="text" class="form-control" name="nombre" id="nombre">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">RESIDENCIA</label>
                    <select required name="residencia" id="" class="form-control">
                      @foreach ($residencias as $residencia)
                     
                      <option value="{{$residencia->id_residencia}}">{{$residencia->cod_MnzV}}</option>
                     
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">CEDULA</label>
                    <input type="text" class="form-control" name="cedula" id="cedula">
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">RUBRO</label>
                    <select name="rubro" id="" class="form-control"></select>
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">STATUS</label>
                    <select name="status" id="" class="form-control"></select>
                  </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">FECHA NACIMIENTO</label>
                  <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_fin">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">PROFESION</label>
                    <select name="profesion" id="" class="form-control"></select>
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">NACIONALIDAD</label>
                    <select name="nacionalidad" id="" class="form-control"></select>
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">ESTADO CIVIL</label>
                    <select name="estado_civil" id="" class="form-control">
                      <option value="SOLTERO">SOLTERO</option>
                      <option value="CASADO">CASADO</option>
                      <option value="VIUDO">VIUDO</option>
                      <option value="DIVORCIADO">DIVORCIADO</option>
                      <option value="UNION LIBRE">UNION LIBRE</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">SEXO</label>
                    <select name="sexo" id="" class="form-control">
                      <option value="MASCULINO">MASCULINO</option>
                      <option value="FEMENINO">FEMENINO</option>
                    </select>
                  </div>
                 
                <div class="form-group">
                  <input type="hidden" class="form-control" value="GUARDIA" name="categoria" id="categoria">
                  <input type="hidden" class="form-control" value="GUARDIA" name="subcategoria" id="subcategoria">
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Agregar</button>
        </div>
      </form>
      </div>
    </div>
  </div>
  <script>
    Dropzone.options.myAwesomeDropzone = {
        autoProcessQueue : false,
        acceptedFiles : ".png,.jpg,.gif,.bmp,.jpeg",
        maxFiles:1,
        maxFilesize:2,
        success: function(file, response){
         
          $('#imagen_nombre').val(response); 
        }
    
      };
      
      
  </script>