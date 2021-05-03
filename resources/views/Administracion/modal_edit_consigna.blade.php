
<div class="modal fade" id="modal_editar-{{$item->id_consigna}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header bg-dark">
          <h5 class="modal-title text-white " id="exampleModalLabel"><b>EDICION DE CONSIGNA</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('consigna.update') }}" method="POST" >
            @method('POST')
            @csrf
            <input type="hidden" name="id" value="{{$item->id_consigna}}">
            <div class="form-group">
              <label for="message-text" class="col-form-label">Titulo</label>
              <input required type="text" class="form-control" value="{{$item->titulo}}" name="titulo" id="titulo">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Descripcion:</label>
             <textarea required name="descripcion" class="form-control" id="" cols="30" rows="5">{{$item->descripcion}}</textarea>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Fecha inicio</label>
              <input required type="date" class="form-control" value="{{$item->fecha_inicio}}" name="fecha_inicio" id="fecha_inicio">
            </div> 
            <div class="form-group">
              <label for="message-text" class="col-form-label">Fecha fin</label>
              <input required type="date" class="form-control"  value="{{$item->fecha_fin}}" name="fecha_fin" id="fecha_fin">
            </div>
            <select required name="residencia" id="residencia" class="form-control">
              <option value="{{$item->id_residencia}}">{{$item->cod_MnzV}}</option>
              @foreach ($residencias as $residencia)
             
              <option value="{{$residencia->id_residencia}}">{{$residencia->cod_MnzV}}</option>
             
              @endforeach
            </select>
            
         
            <div class="form-group">
              <input type="hidden" class="form-control" value="GUARDIA" name="categoria" id="categoria">
              <input type="hidden" class="form-control" value="GUARDIA" name="subcategoria" id="subcategoria">
            </div>
           
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">GUARDAR CAMBIOS</button>
        </div>
      </form>
      </div>
    </div>
  </div>
 