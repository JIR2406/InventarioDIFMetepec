var tableUsuarios;
document.addEventListener('DOMContentLoaded', function () {

    tableUsuarios = $('#tableUsuarios').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": base_url + "Usuarios/getUsuarios",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idpersona" },
            { "data": "nombres" },
            { "data": "apellidos" },
            { "data": "email_user" },
            { "data": "telefono" },
            { "data": "nombrerol" },
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

    var formUsuario = document.querySelector("#formUsuario");
    formUsuario.onsubmit = function (e) {
        e.preventDefault();
        var strIdentificacion = document.querySelector('#txtIdentificacion').value;
        var strNombre = document.querySelector('#txtNombre').value;
        var strApellido = document.querySelector('#txtApellido').value;
        var strEmail = document.querySelector('#txtEmail').value;
        var intTelefono = document.querySelector('#txtTelefono').value;
        var intTipousuario = document.querySelector('#listRolid').value;
        var strPassword = document.querySelector('#txtPassword').value;

        if (strIdentificacion == '' || strApellido == '' || strNombre == '' || strEmail == '' || intTelefono == '' || intTipousuario == '') {
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
        // Verificar el formato del correo electrónico
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(strEmail)) {
            swal("Atención", "El formato del correo electrónico no es válido. Asegúrate de incluir '@' y '.com' correctamente.", "error");
            return false;
        }


        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url + 'Usuarios/setUsuario';
        var formData = new FormData(formUsuario);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                    $('#modalFormUsuario').modal("hide");
                    formUsuario.reset();
                    swal("Usuarios", objData.msg, "success");
                    tableUsuarios.api().ajax.reload();
                } else {
                    swal("Error", objData.msg, "error");
                }
            }
        }

    }
}, false);

function fntRolesUsuario() {
    var ajaxUrl = base_url + 'Roles/getSelectRoles';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            document.querySelector('#listRolid').innerHTML = request.responseText;
            $('#listRolid').selectpicker('render');
        }
    }

}
window.addEventListener('load', function () {
    fntRolesUsuario();
    /*fntViewUsuario();
    fntEditUsuario();
    fntDelUsuario();*/
}, false);

function openModalU() {
    document.querySelector('#idUsuario').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Usuario";
    document.querySelector("#formUsuario").reset();
    $('#modalFormUsuario').modal('show');
}

function fntViewUsuario(idpersona) {
    var idpersona = idpersona;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + 'Usuarios/getUsuario/' + idpersona;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            var data = objData.data[0];
            
            if (objData.status) {
                var estadoUsuario = data.status == 1 ?
                    '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-danger">Inactivo</span>';

                document.querySelector("#celIdentificacion").innerHTML = data.indentificacion;
                document.querySelector("#celNombre").innerHTML = data.nombres;
                document.querySelector("#celApellido").innerHTML = data.apellidos;
                document.querySelector("#celTelefono").innerHTML = data.telefono;
                document.querySelector("#celEmail").innerHTML = data.email_user;
                document.querySelector("#celTipoUsuario").innerHTML = data.nombrerol;
                document.querySelector("#celEstado").innerHTML = estadoUsuario;
                document.querySelector("#celFechaRegistro").innerHTML = data.fechaRegistro;
                $('#modalViewUser').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntEditUsuario(idpersona) {
    document.querySelector('#titleModal').innerHTML = "Actualizar Usuario";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";

    var idpersona = idpersona;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + 'Usuarios/getUsuario/' + idpersona;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);

            if (objData.status) {
                var data = objData.data[0];
                document.querySelector("#idUsuario").value = data.idpersona;
                document.querySelector("#txtIdentificacion").value = data.indentificacion;
                document.querySelector("#txtNombre").value = data.nombres;
                document.querySelector("#txtApellido").value = data.apellidos;
                document.querySelector("#txtTelefono").value = data.telefono;
                document.querySelector("#txtEmail").value = data.email_user;
                document.querySelector("#listRolid").value = data.idrol;


                if (data.status == 1) {
                    document.querySelector("#listStatus").value = 1;
                } else {
                    document.querySelector("#listStatus").value = 2;
                }
                $('#listRolid').selectpicker('render');
                $('#listStatus').selectpicker('render');
            }

            $('#modalFormUsuario').modal('show');
        }

    }
}

function fntDelUsuario(idpersona) {

    var idUsuario = idpersona;
    swal({
        title: "Eliminar Usuario",
        text: "¿Realmente quiere eliminar el Usuario?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {

        if (isConfirm) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url + 'Usuarios/delUsuario';
            var strData = "idUsuario=" + idUsuario;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    var objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Eliminar!", objData.msg, "success");
                    } else {
                        swal("Atención!", objData.msg, "error");
                    }
                    tableUsuarios.api().ajax.reload();
                }
            }
        }

    });

}