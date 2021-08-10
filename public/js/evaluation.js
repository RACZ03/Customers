// Define path url
const pathE = window.location.href;
const indexPathE = pathE.indexOf('public/') + 7;
const urlE = pathE.slice(0, indexPathE);
const API_URLE = urlE;
// View control to display
let stage = 0;

// Titles of the content of the stages of the form
const title1 = (pathE.indexOf('edit') && pathE.indexOf('edit') !== -1) ? 'Editar Evaluación' : 'Nueva Evaluación';
const title2 = 'Presentación Personal, Porte y Aspecto y Puesto de Trabajo';
const title3 = 'Asistencia y Puntualidad';
// buttom text
const titleStart = 'Iniciar';
const titleNext = 'Siguiente';
const titleFinish = 'Finalizar';

let currentDate = '';
// Definition of content instances
const titleContent = document.querySelector('#titleContent'),
    btnNext = document.querySelector('#labelBtnNext'),
    formEvaluation = document.querySelector('#form-Evaluation');

// Inizialize data
initialize();

function initialize() {
    currentDate = buildDate();
    this.loadModal();

    this.nextOrBack(true);

}

// construct the date for the input dates of the form
function buildDate() {
    let date = new Date();
    let year = date.getFullYear();
    let m = (date.getMonth() + 1);
    let month = m < 10 ? `0${ m }` : m;
    let d = date.getDate();
    let day = d < 10 ? `0${ d }` : d;
    return `${ year }-${ month }-${ day }`
}

// Load modal forms
function loadModal() {
    // Define form title
    if (titleContent && btnNext) {
        btnNext.innerHTML = titleStart;
        titleContent.innerHTML = title1;

        // block expired date of date inputs
        formEvaluation.startDate.min = currentDate;
        formEvaluation.endDate.min = currentDate;
    }

    setTimeout(() => {
        $('#divLoader').hide();
    }, 500);
}

// Method show the next content or return
async function nextOrBack(band) {

    stage = band ? (stage + 1) : (stage - 1);
    // If the first one is visible
    if (stage === 1) {
        $('#stage1').show();
        $('#stage2').hide();
        $('#stage3').hide();
        $('#btnCancelE').show();
        $('#btnBack').hide();

        if (btnNext) btnNext.innerHTML = titleStart;
        if (titleContent) titleContent.innerHTML = title1;
    } // switch to stage 2
    else if (stage === 2) {
        // validation stage 1
        const validation = await validationStage1();
        showRedBox();
        if (!validation) {
            stage -= stage;
            return;
        };
        $('#stage1').hide();
        $('#stage2').show();
        $('#stage3').hide();
        $('#btnCancelE').hide();
        $('#btnBack').show();

        if (btnNext) btnNext.innerHTML = titleNext;
        titleContent.innerHTML = title2;
    } else if (stage === 3) {
        $('#stage1').hide();
        $('#stage2').hide();
        $('#stage3').show();
        $('#btnCancelE').hide();
        $('#btnBack').show();

        btnNext.innerHTML = titleFinish;
        titleContent.innerHTML = title3;
    } else {
        // .1 Get the id of the selected indicators (stage 2)
        const arrayId = await getSelectedIndicators();

        // 2.create object
        let data = {
            idUser: formEvaluation.idCandidate.value,
            startDate: formEvaluation.startDate.value,
            endDate: formEvaluation.endDate.value,
            arrayId
        };
        let type = 'POST';
        if (formEvaluation.idEvaluation.value !== '') {
            type = 'PUT';
            data.id = formEvaluation.idEvaluation.value;
        }

        // send to save data
        this.sendDataEvaluation(data, type);
    }

}

// Validation methods
// Stage 1
function validationStage1() {
    return new Promise((resolve) => {
        if (formEvaluation.idCandidate.value !== '0' && formEvaluation.startDate.value !== '' && formEvaluation.endDate.value !== '') {

            resolve(true);
            return;
        }

        showAlertEvaluation('error', 'Error', 'Por favor completa correctamente los campos requeridos');
        resolve(false);
    });
}

//  validate the minimum date of the input endDate after the selection of the initial date
function changeInputDate(e) {
    formEvaluation.endDate.min = e.target.value;
}

// Validate numeric field to allow values ​​0 and 1 (stage 3)
function validateInputNumber(e) {
    let key = e.keyCode || e.which;
    let keyboard = String.fromCharCode(key);
    let numbers = '01';
    if (numbers.indexOf(keyboard) === -1) return false;

    return true;
}

// Get the id of the selected indicators
function getSelectedIndicators() {
    return new Promise((resolve) => {
        let arrayId = [];

        // Obtain the list of elements that belong to a class related to the indicators to obtain their id
        const elements = document.getElementsByClassName('item_selected');

        for (let i = 0; i < elements.length; i++) {
            //Divide checkbox inputs from text types
            if (elements[i].type === 'checkbox') { // Stage 2
                let item = document.getElementById(`${elements[i].id}`);
                if (item.checked) arrayId = [...arrayId, item.id];
            } else { // Stage 3
                let item = document.getElementById(`${elements[i].id}`);
                if (item.value === '1') arrayId = [...arrayId, item.id];
            }
        }
        resolve(arrayId);
    });
}

// Enable or disable alert styles on supplies
function showRedBox() {
    if ($('#idCandidate').val() === '0') {
        $('#idCandidate').css('border-bottom', '1px solid red');
    } else {
        $('#idCandidate').css('border-bottom', '');
    }
    if ($('#startDate').val() === '') {
        $('#startDate').css('border-bottom', '1px solid red');
    } else {
        $('#startDate').css('border-bottom', '');
    }
    if ($('#endDate').val() === '') {
        $('#endDate').css('border-bottom', '1px solid red');
    } else {
        $('#endDate').css('border-bottom', '');
    }
}


// Send DATA
function deleteCustomer(custorme) {

    Swal.fire({
        title: 'Estas seguro?',
        text: "Desea eliminar al cliente: " + custorme.firstName + ' ' + custorme.secondName + ' ' + custorme.surname + ' ' + custorme.secondSurname,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar'
    }).then((result) => {
        if (!result.isConfirmed) {
            return;
        }
        let data = { id: custorme.id };
        sendData(data, 'DELETE')
    });
}

// Delete evaluation
function deleteEvaluation(item) {
    let candidator = `${ item.customer.firstName } ${ item.customer.secondName } ${ item.customer.surname } ${ item.customer.secondSurname }`;
    Swal.fire({
        title: 'Estas seguro?',
        text: "Desea eliminar la evaluacion del cantidado: " + candidator,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar!'
    }).then((result) => {
        if (!result.isConfirmed) {
            return;
        }
        let data = { id: item.id };
        sendDataEvaluation(data, 'DELETE')
    });
}

// Sent data
function sendDataEvaluation(data, type) {
    let url;
    if (type === 'PUT' || type === 'DELETE') {
        url = API_URLE + data.id;
    } else { url = API_URLE; }

    $.ajax({
        url,
        type,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { 'json': JSON.stringify(data) },
        success: function(Response) {
            if (Response.code === 400) {
                showAlertEvaluation('error', 'Error', Response.message);
            } else if (Response.code === 404) {
                showAlertEvaluation('error', 'Error', Response.message)
            } else if (Response.code === 201 || Response.code === 200) {
                resetModalE();
                showAlertEvaluation('success', 'Success', Response.message);
                redirect();
            }
            return;
        }
    });
}

// Show alert
function showAlertEvaluation(icon, title, text) {
    Swal.fire({
        icon,
        title,
        text,
        showConfirmButton: false,
        timer: 2000
    });
}

// Salir de la page
function redirect() {
    window.location = API_URLE;
}

// Clear the form
function resetModalE() {
    if (formEvaluation) {
        formEvaluation.idCandidate.value = '';
        formEvaluation.startDate.value = currentDate;
        formEvaluation.endDate.value = currentDate;
        const elements = document.getElementsByClassName('item_selected');
        for (let i = 0; i < elements.length; i++) {
            //Divide checkbox inputs from text types
            if (elements[i].type === 'checkbox') { // Stage 2
                let item = document.getElementById(`${elements[i].id}`);
                item.checked = false;
            } else { // Stage 3
                let item = document.getElementById(`${elements[i].id}`);
                item.value === '';
            }
        }
    }
}