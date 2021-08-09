// View control to display
let stage = 0;

// Titles of the content of the stages of the form
const title1 = 'Nueva Evaluación';
const title2 = 'Presentación Personal, Porte y Aspecto y Puesto de Trabajo';
const title3 = 'Asistencia y Puntualidad';
// buttom text
const titleStart = 'Iniciar';
const titleNext = 'Siguiente';
const titleFinish = 'Finalizar';

// Definition of content instances
const titleContent = document.querySelector('#titleContent'),
    btnNext = document.querySelector('#labelBtnNext'),
    formEvaluation = document.querySelector('#form-Evaluation');

// Inizialize data
initialize();

function initialize() {
    this.loadModal();

    this.nextOrBack(true);

}

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
    let currentDate = buildDate();
    // Define form title
    if (titleContent && btnNext) {
        titleContent.innerHTML = title1;
        btnNext.innerHTML = titleStart;

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
        // create object
        // .1 Get total Score
        const totalScore = await getScore();
        console.log(totalScore)
    }

}

// Validation methods
// 1. Stage 1
function validationStage1() {
    return new Promise((resolve) => {
        if (formEvaluation.idCandidate.value !== '0' && formEvaluation.startDate.value !== '' && formEvaluation.endDate.value !== '') {

            resolve(true);
            return;
        }

        showAlert('error', 'Error', 'Por favor completa correctamente los campos requeridos');
        resolve(false);
    });
}

//  validate input of category 2 indicator
function changeInputI2(event) {
    event.value = evento.value.replace(/[^0-9]/g, "");
}

// Get Score
function getScore() {
    return new Promise((resolve) => {
        let totalScore = 0;
        // Get the total number of items in the list of category 1 indicators
        let count = document.querySelectorAll('#listGroup .element').length;
        for (let i = 0; i < count; i++) {
            var item = document.getElementById(`check${i + 1}`);
            if (item.checked) totalScore += parseInt(item.value);
        }
        resolve(totalScore);
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


// Show alert
function showAlert(icon, title, text) {
    Swal.fire({
        icon,
        title,
        text,
        showConfirmButton: false,
        timer: 2000
    });
}