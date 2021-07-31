require('./bootstrap');

const inputText = document.querySelector('#textInput');

inputText.addEventListener('keyup', (e) => {
    console.log( e.target.value );
});