const title1 = 'Nueva Evaluación';
const title2 = 'Presentación Personal, Porte y Aspecto y Puesto de Trabajo';
const title3 = 'Asistencia y Puntualidad';
const titleStart = 'Iniciar';
const titleNext = 'Siguiente';
const titleFinish = 'Finalizar';

const titleContent = document.querySelector('#titleContent')
btnNext = document.querySelector('#labelBtnNext');

// Inizialize data
initialize();

function initialize() {
    this.loadModal();

    // Content display
    $('#stage1').show();
    $('#stage2').hide();
    $('#stage3').hide();
    // Butom display
    $('#btnBack').hide();
}

// Load modal forms
function loadModal() {
    // Define form title
    if (titleContent && btnNext) {
        titleContent.innerHTML = title1;
        btnNext.innerHTML = titleStart;
    }

    setTimeout(() => {
        $('#divLoader').hide();
    }, 500);
}

function nextOrBack() {
    // If the first one is visible
    if ($('#stage1').is(':hidden') && $('#stage2').is(':hidden')) {
        $('#stage1').show();
        $('#stage2').hide();
        $('#stage3').hide();
        $('#btnCancelE').show();
        $('#btnBack').hide();

        btnNext.innerHTML = titleStart;
    } // switch to stage 2
    else if ($('#stage2').is(':hidden')) {
        $('#stage1').hide();
        $('#stage2').show();
        $('#stage3').hide();
        $('#btnCancelE').hide();
        $('#btnBack').show();

        btnNext.innerHTML = titleNext;
        titleContent.innerHTML = title2;
    } else {
        $('#stage1').hide();
        $('#stage2').hide();
        $('#stage3').show();
        $('#btnCancelE').hide();
        $('#btnBack').show();

        btnNext.innerHTML = titleFinish;
        titleContent.innerHTML = title3;
    }

}