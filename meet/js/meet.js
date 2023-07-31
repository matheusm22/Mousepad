'use strict';
const closeModalButton = document.querySelector('#close-modal');
const modal = document.querySelector('#modal');
const fade = document.querySelector('#fade');

const toggleModal = () => {
   [modal, fade].forEach((el) => el.classList.toggle("hide"));

};

[closeModalButton, fade].forEach((el) => {
   el.addEventListener('click', () => toggleModal());
});

function copiarTexto() {
// função copiar
   var range = document.createRange();
   range.selectNode(document.getElementById('res')); //changed here
   window.getSelection().removeAllRanges();
   window.getSelection().addRange(range);
   document.execCommand("copy");
   window.getSelection().removeAllRanges();
// mensagem para usuário
   res.innerHTML = `Link copiado! carregando...`;
// redirecionamento para o zimbra   
   setTimeout(function() {
    window.location.href = "https://email.econeteditora.com.br/#1";
}, 1500);

}


