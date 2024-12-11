<!-- Modal -->
<div class="modal fade" id="modalFormAlmacen" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Almacen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formAlmacen" name="formAlmacen" class="form-horizontal">
          <input type="hidden" id="idModulo" name="idModulo" value="">
          <p class="text-primary">Todos los campos son obligatorios.</p>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtT">Nombre</label>
              <input type="text" class="form-control valid validText" id="txtTitulo" name="txtTitulo" required="">
            </div>
            <div class="form-group col-md-6">
              <label for="txtDescripciona">Descripción</label>
              <input type="text" class="form-control valid validText" id="txtDescripciona" name="txtDescripciona" required="">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtTipo">Tipo</label>
              <input type="text" class="form-control valid validText" id="txtTipo" name="txtTipo" required="">
            </div>
            <div class="form-group col-md-6">
              <label for="txtDirecciones">Dirección</label>
              <input type="text" class="form-control valid validText" id="txtDirecciones" name="txtDirecciones" required="">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="listStatus">Status</label>
              <select class="form-control selectpicker" id="listStatus" name="listStatus" required>
                <option value="1">Activo</option>
                <option value="2">Inactivo</option>
              </select>
            </div>
          </div>
          <div class="tile-footer">
            <button id="btnActionForm" class="btn btn-primary" type="submit">
              <i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span>
            </button>&nbsp;&nbsp;&nbsp;
            <button class="btn btn-danger" type="button" data-dismiss="modal">
              <i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalViewModulo" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos del Modulo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>ID:</td>
              <td id="celID"></td>
            </tr>
            <tr>
              <td>Titulo:</td>
              <td id="celTitulo"></td>
            </tr>
            <tr>
              <td>Descripcions:</td>
              <td id="celDescripcion"></td>
            </tr>
            <tr>
              <td>Status:</td>
              <td id="celStatus"></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalFormBorrar" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Eliminar almacen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formEProductos" name="formEProductos" class="form-horizontal">
          <input type="hidden" id="idModulo" name="idModulo" value="">
          <div class="form-group">
            <label for="txtObservacion">Observación</label>
            <input type="text" class="form-control" id="txtObservacion" name="txtObservacion" required>
            <small class="form-text text-muted">Todos los campos son obligatorios.</small>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">
          <i class="fa fa-times-circle"></i> Cancelar
        </button>
        <button type="submit" form="formEProductos" class="btn btn-primary">
          <i class="fa fa-check-circle"></i> Aceptar
        </button>
      </div>
    </div>
  </div>
</div>

