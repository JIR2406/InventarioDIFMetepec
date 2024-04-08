function openModalPerfil() {
    $('#modalFormPerfil').modal('show');
}

var divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector("#formPerfil")) {
        var formPerfil = document.querySelector("#formPerfil");
        formPerfil.onsubmit = function (e) {
            e.preventDefault();
            var strIdentificacion = document.querySelector('#txtIdentificacion').value;
            var strNombre = document.querySelector('#txtNombre').value;
            var strApellido = document.querySelector('#txtApellido').value;
            var intTelefono = document.querySelector('#txtTelefono').value;
            var strPassword = document.querySelector('#txtPassword').value;
            var strPasswordConfirm = document.querySelector('#txtPasswordConfirm').value;

            // Check if any of the required fields are empty
            if (strIdentificacion == '' || strApellido == '' || strNombre == '' || intTelefono == '') {
                swal("Atención", "Todos los campos son obligatorios.", "error");
                return false;
            }

            // Check if the name contains numbers
            if (/\d/.test(strNombre) || /\d/.test(strApellido)) {
                swal("Atención", "El nombre y el apellido no deben contener números.", "error");
                return false;
            }
            if (strPassword != '' || strPasswordConfirm != '') {
                if (strPassword != strPasswordConfirm) {
                    swal("Atención", "Las contraseñas no son iguales.", "error");
                    return false;
                }
                if (strPassword.length < 5) {
                    swal("Atención", "La contraseña debe tener minimo 5 caracteres.", "error");
                    return false;
                }
            }


            // Additional validation with "valid" class
            let elementsValid = document.getElementsByClassName("valid");
            for (let i = 0; i < elementsValid.length; i++) {
                if (elementsValid[i].classList.contains('is-invalid')) {
                    swal("Atención", "Por favor verifique los campos en rojo.", "error");
                    return false;
                }
            }
            divLoading.style.display = "flex";
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url + 'Usuarios/putPerfil';
            var formData = new FormData(formPerfil);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            console.log(request);

            request.onreadystatechange = function () {
                if (request.readyState != 4) return;
                if (request.status == 200) {
                    var objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        $('#modalFormPerfil').modal("hide");
                        formPerfil.reset();
                        swal({
                            title: "",
                            text: objData.msg,
                            type: "success",  // Corrected the typo here
                            confirmButtonText: "Aceptar",
                            closeOnConfirm: false,
                        }, function (isConfirm) {
                            if (isConfirm) {
                                location.reload();
                            }
                        });
                    } else {
                        swal("Error", objData.msg, "error");
                    }
                }
            }
            divLoading.style.display = "none";
        }
    }



    if (document.querySelector("#formDataFiscal")) {
        var formDataFiscal = document.querySelector("#formDataFiscal");
        formDataFiscal.onsubmit = function (e) {
            e.preventDefault();
            var strNit = document.querySelector('#txtNit').value;
            var strNombreFiscal = document.querySelector('#txtNombreFiscal').value;
            var strDirFiscal = document.querySelector('#txtDirFiscal').value;
            // Check if any of the required fields are empty
            if (strNit == '' || strNombreFiscal == '' || strDirFiscal == '') {
                swal("Atención", "Todos los campos son obligatorios.", "error");
                return false;
            }

            divLoading.style.display = "flex";
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url + 'Usuarios/putDFiscal';
            var formData = new FormData(formDataFiscal);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            console.log(request);

            request.onreadystatechange = function () {
                if (request.readyState != 4) return;
                if (request.status == 200) {
                    var objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        $('#modalFormPerfil').modal("hide");
                        formPerfil.reset();
                        swal({
                            title: "",
                            text: objData.msg,
                            type: "success",  // Corrected the typo here
                            confirmButtonText: "Aceptar",
                            closeOnConfirm: false,
                        }, function (isConfirm) {
                            if (isConfirm) {
                                location.reload();
                            }
                        });
                    } else {
                        swal("Error", objData.msg, "error");
                    }
                }
            }
            divLoading.style.display = "none";
        }
    }




}, false);