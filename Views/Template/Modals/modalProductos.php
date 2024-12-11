<!-- Modal -->
<div class="modal fade" id="modalFormProductos" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formProductos" name="formProductos" class="form-horizontal">
          <input type="hidden" id="idModulo" name="idModulo" value="">
          <p class="text-primary">Todos los campos son obligatorios.</p>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtT">Nombre</label>
              <input type="text" class="form-control valid validText" id="txtTitulo" name="txtTitulo" required="">
            </div>
            <div class="form-group col-md-6">
              <label for="txtDescripcion">Descripción</label>
              <input type="text" class="form-control valid validText" id="txtDescripcion" name="txtDescripcion" required="">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtCategoria">Categoría</label>
              <input type="text" class="form-control valid validText" id="txtCategoria" name="txtCategoria" required="">
            </div>
            <div class="form-group col-md-6">
              <label for="txtDescripcion">Unidades</label>
              <input type="text" class="form-control valid validText" id="txtUnidades" name="txtUnidades" required="">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtAlmacen">Almacén</label>
              <input type="text" class="form-control valid validText" id="txtAlmacen" name="txtAlmacen" required="">
            </div>
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
<div class="modal fade" id="modalFormBorrar" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Eliminar producto</h5>
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

<!-- Modal -->
<div class="modal fade" id="modalFormActualizar" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Salida Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formAProductos" name="formAProductos" class="form-horizontal">
          <input type="hidden" id="idModulo" name="idModulo" value="">
          <div class="form-group">
            <label for="txtSalida">Cantidad Salida</label>
            <input type="text" class="form-control" id="txtSalida" name="txtSalida" required>
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