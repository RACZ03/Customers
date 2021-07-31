
// Define path url
const path = window.location.href;
const indexPath = path.indexOf('public/') + 7;
const url = path.slice(0, indexPath);
const API_URL = url;


const inputText = document.querySelector('#textInput'),
      formCustomer = document.querySelector('#form-customer'),
      btn = document.querySelector('#btnChange'),
      btnSave = document.querySelector('#btnSave'),
      titleForm = document.querySelector('#nameForm');

// Inizialize data
initialize();


function initialize()
{
    this.loadModal();
}

function loadModal( customers = {} ) {
    formCustomer.id.value = customers.id !== undefined ? customers.id : '';
    formCustomer.dni.value = customers.dni !== undefined ? customers.dni : '';
    formCustomer.phoneNumber.value = customers.phoneNumber !== undefined ? customers.phoneNumber : '505';
    titleForm.innerHTML =  customers.id !== undefined ? 'Actualizar datos' : 'Nuevo Cliente';

    
    let name = (customers.name !== undefined || customers.name !== '') ? customers.name : '';
    let lastName = (customers.lastName !== undefined || customers.lastName !== '') ? customers.lastName : '';

    let array_name = [];
    let array_lastName = [];

    if ( name !== undefined) array_name = name.split(' ');
    if ( lastName !== undefined) array_lastName = lastName.split(' ');
    
    if ( array_name.length > 0 ) {
        formCustomer.firstName.value = ( array_name[0] !== undefined || array_name[0] !== '') ? array_name[0] : '';
        formCustomer.lastName.value = ( array_name[1] !== undefined || array_name[1] !== '') ? array_name[1] : '';
    } else {
        formCustomer.firstName.value = '';
        formCustomer.secondSurname.value =  '';
    }

    if ( array_lastName[1] ) {
        formCustomer.surname.value = ( array_lastName[0] !== undefined || array_lastName[0] !== '') ? array_lastName[0] : '';
        formCustomer.secondSurname.value = ( array_lastName[1] !== undefined || array_lastName[1] !== '') ? array_lastName[1] : '';
    } else {
        formCustomer.surname.value = '';
        formCustomer.secondSurname.value = '';
    }

    setTimeout(() => {
        $('#divLoader').hide();
    }, 500);
}



// Search
inputText.addEventListener('keyup', (e) => {
    setTimeout(() => {
        btn.click();
        inputText.focus();
    }, 1000);
});

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


// Save customer
$('#form-customer').submit(function(e) {
    // El preventDefault evita que la pagina se refresque al hacer submit
    e.preventDefault();
    const postData = {
        id: formCustomer.id.value,
        name: formCustomer.firstName.value.trim() + ' ' + formCustomer.lastName.value.trim(),
        lastName: formCustomer.surname.value.trim() + ' ' + formCustomer.secondSurname.value.trim(),
        dni: formCustomer.dni.value,
        phoneNumber: formCustomer.phoneNumber.value
    };

    if (postData.name !== ''  && postData.lastName !== '' && postData.dni !== '') {

        // Validate dni

        let v_dni = formCustomer.dni.value;
        let valid_dni = v_dni.split('-');
        let div_dateu = valid_dni[1].match(/.{1,2}/g);
        
        // La fecha de nac no debe ser incorrecta
        if ( v_dni.length > 16 || div_dateu[0] > 31 || div_dateu[1] > 12 ) {
            return showAlert('error', 'Error', 'Los datos de Cédula son incorrectos')
        } 

        if ( postData.phoneNumber.length > 13 ) {
            return showAlert('error', 'Error', 'La cantidad de digitos de número teléfonico es muy larga')
        }

        let type = ( postData.id === undefined || postData.id === '') ? 'POST' : 'PUT';

        sendData( postData , type);
    }
    else
    {
        redBord();
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Por favor completa correctamente los campos requeridos',
        });
    }

    function redBord()
    {
        if ($('#firstName').val() === '')
        {
            $('#firstName').css('border-bottom', '1px solid red');
        }
        if ($('#surname').val() === '')
        {
            $('#surname').css('border-bottom', '1px solid red');
        }
        if ($('#secondSurname').val() === '')
        {
            $('#secondSurname').css('border-bottom', '1px solid red');
        }
        if ($('#identityCard').val() === '')
        {
            $('#identityCard').css('border-bottom', '1px solid red');
        }
    }

    $('#firstName').keydown(function () {
        $('#firstName').css('border-bottom', '1px solid #12192C');
    });

    $('#surname').keydown(function () {
        $('#surname').css('border-bottom', '1px solid #12192C');
    });

    $('#secondSurname').keyup(function () {
        $('#secondSurname').css('border-bottom', '1px solid #12192C');
    });

    $('#identityCard').keyup(function () {
        $('#identityCard').css('border-bottom', '1px solid #12192C');
    });
});


function deleteCustomer( custorme ) {

    Swal.fire({
        title: 'Estas seguro?',
        text: "Desea eliminar al cliente: " + custorme.name + ' ' + custorme.lastName,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar!'
      }).then((result) => {
          if ( !result.isConfirmed ) {
            return;
          }
        let data = { id: custorme.id };
        sendData( data, 'DELETE')
    });
}


function sendData(data, type) {
    let url;
    if ( type === 'PUT' || type === 'DELETE') { 
        url = API_URL + data.id;
    }
    else { url = API_URL; }
    
    $.ajax({
        url,
        type,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { 'json': JSON.stringify(data) },
        success: function(Response){
            if ( Response.code === 400 ) {
                showAlert('error', 'Error', Response.message);
            } else if ( Response.code === 404) {
                showAlert( 'error', 'Error', Response.message)
            } else if ( Response.code === 201 || Response.code === 200 ) {
                $(function () {
                     $("#exampleModal").modal('hide');
                 });
                // Update table
                btn.click();
                resetModal();
                showAlert( 'success', 'Success', Response.message);
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
    formCustomer.lastName.value = '';
    formCustomer.surname.value = '';
    formCustomer.secondSurname.value = '';
    formCustomer.dni.value = '';
    formCustomer.phoneNumber.value = '';
    titleForm.innerHTML = 'Nuevo Cliente'

}