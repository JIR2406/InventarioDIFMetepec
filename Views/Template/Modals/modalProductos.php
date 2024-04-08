<!-- Modal -->
<div class="modal fade" id="modalFormProductos" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Fotos Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formProductos" name="formProductos" class="form-horizontal">
        <input type="hidden" id="idProducto" name="idProducto" value="">
          <div class="tile-footer">
            <div class="form-group">
              <div id="containerGallery">
                <span>Agregar foto (440 x 545)</span>
                <button class="btnAddImage btn btn-info btn-sm" type="button">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
              <hr>
              <div id="containerImages"></div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <button id="btnActionForm" class="btn btn-primary btn-lg btn-block" type="submit">
                <i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span>
              </button>
            </div>
            <div class="form-group col-md-6">
              <button class="btn btn-danger btn-lg btn-block" type="button" data-dismiss="modal">
                <i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>




<!-- Modal -->
<div class="modal fade" id="modalViewProducto" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos del Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>Articulo:</td>
              <td id="celArticulo"></td>
            </tr>
            <tr>
              <td>Descripción:</td>
              <td id="celDescripcion"></td>
            </tr>
            <tr>
              <td>Categoría:</td>
              <td id="celCategoria"></td>
            </tr>
            <tr>
              <td>Marca:</td>
              <td id="celMarca"></td>
            </tr>
            <tr>
              <td>Fabricante:</td>
              <td id="celFabricante"></td>
            </tr>
            <tr>
              <td>Impuesto:</td>
              <td id="celImpuesto"></td>
            </tr>
            <tr>


            </tr>
            <tr>
              <td>Fotos de referencia:</td>
              <td id="celFotos">
              </td>
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
