// Define path url
const path = window.location.href;
const indexPath = path.indexOf('public/candidatos') + 17;
const url = path.slice(0, indexPath);
const API_URL = url;

const inputText = document.querySelector('#textInput'),
    formCustomer = document.querySelector('#form-customer'),
    btn = document.querySelector('#btnChange'),
    btnSave = document.querySelector('#btnSave'),
    titleForm = document.querySelector('#nameForm');

// Inizialize data
initialize();


function initialize() {
    this.loadModal();
}

// Load modal forms
function loadModal(customers = {}) {
    // Define form title
    titleForm.innerHTML = customers.id !== undefined ? 'Actualizar datos' : 'Nuevo Candidato';

    formCustomer.id.value = customers.id !== undefined ? customers.id : '';
    formCustomer.firstName.value = customers.firstName !== undefined ? customers.firstName : '';
    formCustomer.secondName.value = customers.secondName !== undefined ? customers.secondName : '';
    formCustomer.surname.value = customers.surname !== undefined ? customers.surname : '';
    formCustomer.secondSurname.value = customers.secondSurname !== undefined ? customers.secondSurname : '';
    formCustomer.dni.value = customers.dni !== undefined ? customers.dni : '';
    formCustomer.phoneNumber.value = customers.phoneNumber !== undefined ? customers.phoneNumber : '505';

    setTimeout(() => {
        $('#divLoader').hide();
    }, 500);
}



// Search form
if (inputText) {
    inputText.addEventListener('keyup', (e) => {
        setTimeout(() => {
            btn.click();
            inputText.focus();
        }, 1000);
    });
}

//  Input dni 
formCustomer.dni.addEventListener('keyup', (e) => {
    let valueInput = e.target.value;
    formCustomer.dni.value = valueInput.replace(/\s/g, '') // Elimina espacios en blanco
        .replace(/^(\d{3})(\d{6})([0-3])[0-9A-Z].*/, '$1-$2-') // Agrupa elementos
        .trim() // Elimina el utlimo espacio de una cadena
});

//  Input phoneNumber 
formCustomer.phoneNumber.addEventListener('keyup', (e) => {
    let valueInput = e.target.value;
    formCustomer.phoneNumber.value = valueInput.replace(/\s/g, '') // Elimina espacios en blanco
        .replace(/^(\d{3})(\d{4})/, '$1 $2 ') // Agrupa elementos
        .trim() // Elimina el utlimo espacio de una cadena
});

// Validate numeric field to allow values ​​0 and 9
function validateInputPhoneNumber( e ) {
    let key = e.keyCode || e.which;
    let keyboard = String.fromCharCode(key);
    let numbers = '0123456789';
    if ( numbers.indexOf(keyboard) === -1) return false;

    return true;
}


// Save customer
$('#form-customer').submit(function(e) {
    // El preventDefault evita que la pagina se refresque al hacer submit
    e.preventDefault();
    const postData = {
        id: formCustomer.id.value,
        firstName: formCustomer.firstName.value.trim(),
        secondName: formCustomer.secondName.value.trim(),
        surname: formCustomer.surname.value.trim(),
        secondSurname: formCustomer.secondSurname.value.trim(),
        dni: formCustomer.dni.value,
        phoneNumber: formCustomer.phoneNumber.value
    };

    if (postData.firstName !== '' && postData.secondName !== '' && postData.surname !== '' &&
        postData.secondSurname !== '' && postData.dni !== '') {

        // Validate dni

        let v_dni = formCustomer.dni.value;
        let valid_dni = v_dni.split('-');
        let div_dateu = valid_dni[1].match(/.{1,2}/g);

        // La fecha de nac no debe ser incorrecta
        if (v_dni.length > 16 || div_dateu[0] > 31 || div_dateu[1] > 12) {
            return showAlert('error', 'Error', 'Los datos de Cédula son incorrectos')
        }

        if (postData.phoneNumber.length > 13) {
            return showAlert('error', 'Error', 'La cantidad de digitos de número teléfonico es muy larga')
        }

        let type = (postData.id === undefined || postData.id === '') ? 'POST' : 'PUT';

        sendData(postData, type);
    } else {
        redBord();
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Por favor completa correctamente los campos requeridos',
        });
    }

    function redBord() {
        if ($('#firstName').val() === '') {
            $('#firstName').css('border-bottom', '1px solid red');
        }
        if ($('#secondName').val() === '') {
            $('#secondName').css('border-bottom', '1px solid red');
        }
        if ($('#surname').val() === '') {
            $('#surname').css('border-bottom', '1px solid red');
        }
        if ($('#secondSurname').val() === '') {
            $('#secondSurname').css('border-bottom', '1px solid red');
        }
        if ($('#identityCard').val() === '') {
            $('#identityCard').css('border-bottom', '1px solid red');
        }
    }

    $('#firstName').keydown(function() {
        $('#firstName').css('border-bottom', '1px solid #12192C');
    });

    $('#secondName').keydown(function() {
        $('#secondName').css('border-bottom', '1px solid #12192C');
    });

    $('#surname').keydown(function() {
        $('#surname').css('border-bottom', '1px solid #12192C');
    });

    $('#secondSurname').keyup(function() {
        $('#secondSurname').css('border-bottom', '1px solid #12192C');
    });

    $('#identityCard').keyup(function() {
        $('#identityCard').css('border-bottom', '1px solid #12192C');
    });
});


function deleteCustomer(custorme) {

    Swal.fire({
        title: 'Estas seguro?',
        text: "Desea eliminar al cliente: " + custorme.firstName + ' ' + custorme.secondName + ' ' + custorme.surname + ' ' + custorme.secondSurname,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar!'
    }).then((result) => {
        if (!result.isConfirmed) {
            return;
        }
        let data = { id: custorme.id };
        sendData(data, 'DELETE')
    });
}


function sendData(data, type) {
    let url;
    if (type === 'PUT' || type === 'DELETE') {
        url = API_URL + '/' + data.id;
    } else { url = API_URL; }

    $.ajax({
        url,
        type,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { 'json': JSON.stringify(data) },
        success: function(Response) {
            if (Response.code === 400) {
                showAlert('error', 'Error', Response.message);
            } else if (Response.code === 404) {
                showAlert('error', 'Error', Response.message)
            } else if (Response.code === 201 || Response.code === 200) {
                $(function() {
                    $("#exampleModal").modal('hide');
                });
                // Update table
                btn.click();
                resetModal();
                showAlert('success', 'Success', Response.message);
            }
            return;
        }
    });
}

function showAlert(icon, title, text) {
    Swal.fire({
        icon,
        title,
        text,
        showConfirmButton: false,
        timer: 2000
    });
}

function resetModal() {
    formCustomer.id.value = '';
    formCustomer.firstName.value = '';
    formCustomer.secondName.value = '';
    formCustomer.surname.value = '';
    formCustomer.secondSurname.value = '';
    formCustomer.dni.value = '';
    formCustomer.phoneNumber.value = '';
    titleForm.innerHTML = 'Nuevo Cliente'

}