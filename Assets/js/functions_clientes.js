let rowTable = "";

function openModal() {
    rowTable = "";
    document.querySelector('#idUsuario').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Usuario";
    document.querySelector("#formCliente").reset();
    $('#modalFormCliente').modal('show');
}


document.addEventListener('DOMContentLoaded', function () {
    tableClientes = $('#tableClientes').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "Clientes/getClientes",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idpersona" },
            { "data": "indentificacion" },
            { "data": "nombres" },
            { "data": "apellidos" },
            { "data": "email_user" },
            { "data": "telefono" },
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
        "responsive": true, // Fix the typo here
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "desc"]]
    });



    //NUEVO ROL
    let formCliente = document.querySelector("#formCliente");
    formCliente.onsubmit = function (e) {
        e.preventDefault();

        let intIdUsuario = document.querySelector('#idUsuario').value;
        let strIdentificacion = document.querySelector('#txtIdentificacion').value;
        let strNombre = document.querySelector('#txtNombre').value;
        let strApellido = document.querySelector('#txtApellido').value;
        let strTelefono = document.querySelector('#txtTelefono').value;
        let strEmail = document.querySelector('#txtEmail').value;
        let strPassword = document.querySelector('#txtPassword').value;
        let strNit = document.querySelector('#txtNit').value;
        let strNombreFiscal = document.querySelector('#txtNombreFiscal').value;
        let strDireccionFiscal = document.querySelector('#txtDirFiscal').value;
        let strCfdi = document.querySelector('#txtCfdi').value;
        if (strNombre == '' || strIdentificacion == '' || strApellido == '' || strTelefono == '' || strEmail == '' || strNit == '' || strNombreFiscal == '' || strDireccionFiscal == '' || strCfdi == '') {
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

        if (situacion = "guardar") {

            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + 'Clientes/setCliente';
            let formData = new FormData(formCliente);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            console.log(request);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {

                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        if (rowTable == "") {
                            tableClientes.api().ajax.reload();
                        }else{
                            rowTable.cells[1].textContent = strIdentificacion;
                            rowTable.cells[2].textContent = strNombre;
                            rowTable.cells[3].textContent = strApellido;
                            rowTable.cells[4].textContent = strEmail;
                            rowTable.cells[5].textContent = strTelefono;
                            rowTable = "";
                        }
                        $('#modalFormCliente').modal("hide");
                        formCliente.reset();
                        swal("Cliente", objData.msg, "success");
                        tableClientes.api().ajax.reload();
                    } else {
                        swal("Error", objData.msg, "error");
                    }
                }
            }
        }


    }

});

function fntViewInfo(idpersona) {
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'Clientes/getCliente/' + idpersona;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                let data = objData.data[0];
                document.querySelector("#celIdentificacion").innerHTML = data.indentificacion;
                document.querySelector("#celNombre").innerHTML = data.nombres;
                document.querySelector("#celApellido").innerHTML = data.apellidos;
                document.querySelector("#celTelefono").innerHTML = data.telefono;
                document.querySelector("#celEmail").innerHTML = data.email_user;
                document.querySelector("#celIde").innerHTML = data.rfc;
                document.querySelector("#celNomFiscal").innerHTML = data.nombrefical;
                document.querySelector("#celDirFiscal").innerHTML = data.direccionfiscal;
                document.querySelector("#celCfdi").innerHTML = data.cfdi;
                document.querySelector("#celFechaRegistro").innerHTML = data.fechaRegistro;
                $('#modalViewCliente').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntEditInfo(element, idpersona) {
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML = "Actualizar Cliente";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + 'Clientes/getCliente/' + idpersona;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
                let data = objData.data[0];
                document.querySelector("#idUsuario").value = data.idpersona;
                document.querySelector("#txtIdentificacion").value = data.indentificacion;
                document.querySelector("#txtNombre").value = data.nombres;
                document.querySelector("#txtApellido").value = data.apellidos;
                document.querySelector("#txtTelefono").value = data.telefono;
                document.querySelector("#txtEmail").value = data.email_user;
                document.querySelector("#txtNit").value = data.rfc;
                document.querySelector("#txtNombreFiscal").value = data.nombrefical;
                document.querySelector("#txtDirFiscal").value = data.direccionfiscal;
                document.querySelector("#txtCfdi").value = data.cfdi;
            }
        }
        $('#modalFormCliente').modal('show');
    }
}

function fntDelInfo(idpersona) {
    swal({
        title: "Eliminar Cliente",
        text: "¿Realmente quiere eliminar al cliente?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {

        if (isConfirm) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + 'Clientes/delCliente';
            let strData = "idUsuario=" + idpersona;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Eliminar!", objData.msg, "success");
                        tableClientes.api().ajax.reload();
                    } else {
                        swal("Atención!", objData.msg, "error");
                    }
                }
            }
        }

    });

}
function controlTag() {
} 