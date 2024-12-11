function openModal() {
    //rowTable = "";
    /*document.querySelector('#idProducto').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Producto";
    document.querySelector("#formProductos").reset();
    document.querySelector("#containerGallery").classList.add("notblock");
    document.querySelector("#containerImages").innerHTML = "";
    */$('#modalFormProductos').modal('show');

}


var tableProductos;
document.addEventListener('DOMContentLoaded', function () {

    tableProductos = $('#tableProductos').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": base_url + "Productos/getProductos",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idproducto" },
            { "data": "nombre" },
            { "data": "descripcion" },
            { "data": "categoriaid" },
            { "data": "unidades" },
            { "data": "idalmacen" },
            { "data": "status" },
            { "data": "options" }
        ],
        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr": "Copiar",
                "className": "btn btn-secondary"
            }, {
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr": "Esportar a Excel",
                "className": "btn btn-success"
            }, {
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr": "Esportar a PDF",
                "className": "btn btn-danger"
            }, {
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr": "Esportar a CSV",
                "className": "btn btn-info"
            }
        ],
        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 5,
        "order": [[0, "asc"]]
    });

    var formModulo = document.querySelector("#formProductos");
    formModulo.onsubmit = function (e) {
        e.preventDefault();
        var strTitulo = document.querySelector('#txtTitulo').value;
        var strDescripcion = document.querySelector('#txtDescripcion').value;
        var strCategoria = document.querySelector('#txtCategoria').value;
        var strUnidades = document.querySelector('#txtUnidades').value;
        var strAlmacen = document.querySelector('#txtAlmacen').value;
        var intStatus = document.querySelector('#listStatus').value;

        if (strTitulo == '' || strDescripcion == '' || intStatus == '' || strCategoria == '' || strUnidades == '' || strAlmacen == '') {
            swal("Atención", "Todos los campos son obligatorios.", "error");
            return false;
        }

        let elementsValid = document.getElementsByClassName("valid");
        for (let i = 0; i < elementsValid.length; i++) {
            if (elementsValid[i].classList.contains('is-invalid')) {
                swal("Atención", "Por favor verifique los campos en rojo.", "error");
                return false;
            }
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url + 'Productos/setProducto';
        var formData = new FormData(formModulo);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        console.log(request);
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                console.log(objData.status);
                if (objData.status) {
                    $('#modalFormEProductos').modal('hide');
                    formModulo.reset();
                    swal("Productos", objData.msg, "success");
                    tableModulos.api().ajax.reload();
                } else {
                    swal("Error", objData.msg, "error");
                }
            }
        }

    }


}, false);

function fntDelProducto(idmodulo) {

    $('#modalFormBorrar').modal('show');

    var formModuloE = document.querySelector("#formEProductos");

    formModuloE.onsubmit = function (e) {
        e.preventDefault();
        var strTitulo = document.querySelector('#txtObservacion').value;
        if (strTitulo == '') {
            swal("Atención", "Todos los campos son obligatorios.", "error");
            return false;
        }
        let elementsValid = document.getElementsByClassName("valid");
        for (let i = 0; i < elementsValid.length; i++) {
            if (elementsValid[i].classList.contains('is-invalid')) {
                swal("Atención", "Por favor verifique los campos en rojo.", "error");
                return false;
            }
        }
        console.log(formModuloE);
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url + 'Productos/delProducto/'+idmodulo;
        var formData = new FormData(formModuloE);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        console.log(request);
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                    $('#formEProductos').modal('hide');
                    formModuloE.reset();
                    swal("Productos", objData.msg, "success");
                    tableProductos.api().ajax.reload();
                    $('#modalFormBorrar').modal('hide');

                } else {
                    swal("Error", objData.msg, "error");
                }
            }
        }

    }



}

function fntUpdProducto(idmodulo) {

    $('#modalFormActualizar').modal('show');

    var formModuloA = document.querySelector("#formAProductos");

    formModuloA.onsubmit = function (e) {
        e.preventDefault();
        var strTitulo = document.querySelector('#txtSalida').value;
        if (strTitulo == '') {
            swal("Atención", "Todos los campos son obligatorios.", "error");
            return false;
        }
        let elementsValid = document.getElementsByClassName("valid");
        for (let i = 0; i < elementsValid.length; i++) {
            if (elementsValid[i].classList.contains('is-invalid')) {
                swal("Atención", "Por favor verifique los campos en rojo.", "error");
                return false;
            }
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url + 'Productos/updateProducto/'+idmodulo;
        var formData = new FormData(formModuloE);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        console.log(request);

        /*
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                    $('#formEProductos').modal('hide');
                    formModuloE.reset();
                    swal("Productos", objData.msg, "success");
                    tableProductos.api().ajax.reload();
                    $('#modalFormBorrar').modal('hide');

                } else {
                    swal("Error", objData.msg, "error");
                }
            }
        }*/

    }



}


