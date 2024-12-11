var tableModulos;
document.addEventListener('DOMContentLoaded', function () {

    tableModulos = $('#tableAlmacenes').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": base_url + "Almacenes/getAlmacenes",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idalmacen" },
            { "data": "nombre" },
            { "data": "descripcion" },
            { "data": "tipo" },
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

    var formUsuario = document.querySelector("#formAlmacen");
    formUsuario.onsubmit = function (e) {
        e.preventDefault();
        var strNombre = document.querySelector('#txtDescripciona').value;
        var strApellido = document.querySelector('#txtTipo').value;
        var strEmail = document.querySelector('#txtDirecciones').value;
        var intTipousuario = document.querySelector('#listStatus').value;

        if ( strNombre == '' || strEmail == '' || strApellido == '' || intTipousuario == '') {
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
        var ajaxUrl = base_url + 'Almacenes/setAlmacen';
        var formData = new FormData(formUsuario);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        console.log(request);
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                    formUsuario.reset();
                    swal("Almacenes", objData.msg, "success");
                    tableModulos.api().ajax.reload();
                    $('#modalFormAlmacen').modal('hide');
                } else {
                    swal("Error", objData.msg, "error");
                }
            }
        }

    }

}, false);





function openModalM() {
    document.querySelector('#idModulo').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Almacen";
    //document.querySelector("#formAlmacen").reset();
    $('#modalFormAlmacen').modal('show');
}

function fntViewModulo(idmodulo) {
    var idmodulo = idmodulo;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + 'Modulos/getModulo/' + idmodulo;
    request.open("GET", ajaxUrl, true);
    request.send();
    console.log(request)
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            var data = objData.data[0];
            if (objData.status) {
                var estadoUsuario = data.status == 1 ?
                    '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-danger">Inactivo</span>';

                document.querySelector("#celID").innerHTML = data.idmodulo;
                document.querySelector("#celTitulo").innerHTML = data.titulo;
                document.querySelector("#celDescripcion").innerHTML = data.descripcion;
                if(data.status == 1){
                document.querySelector("#celStatus").innerHTML = "Activo";
                }else{
                document.querySelector("#celStatus").innerHTML = "Inactivo";
                }
                $('#modalViewModulo').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntEditModulo(idpersona) {
    document.querySelector('#titleModal').innerHTML = "Actualizar Modulo";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";

    var idpersona = idpersona;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + 'Modulos/getModulo/' + idpersona;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);

            if (objData.status) {
                var data = objData.data[0];
                document.querySelector("#idModulo").value = data.idmodulo;
                document.querySelector('#txtTitulo').value = data.titulo;
                document.querySelector('#txtDescripcion').value = data.descripcion;
                document.querySelector('#listStatus').value = data.status;



                if (data.status == 1) {
                    document.querySelector("#listStatus").value = 1;
                } else {
                    document.querySelector("#listStatus").value = 2;
                }
                $('#listStatus').selectpicker('render');
            }

            $('#modalFormModulo').modal('show');
        }

    }
}

function fntDelModulo(idmodulo) {

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
        var ajaxUrl = base_url + 'Almacenes/delProducto/'+idmodulo;
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
                    tableModulos.api().ajax.reload();
                    $('#modalFormBorrar').modal('hide');

                } else {
                    swal("Error", objData.msg, "error");
                }
            }
        }

    }



}




