"use strict";

// função para a matricula aceitar apenas números

$(function() {
  $("#matricula").keypress(function(event) {
      if (event.which != 8 && event.which != 0 && (event.which < 48 || event.which > 57)) {
          alert('apenas números!') 
          return false
      }
  });
});

// não adiciona o espaço no campo usuário

$(function () {
  $("#usuario").keypress(function (event) {
    if (event.which == 32) {
      return false;
    }
  });

});

// não adiciona o espaço no campo senha

$(function () {
  $("#senha").keypress(function (event) {
    if (event.which == 32) {
      return false;
    }
  });

});

const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});


// // função do olho no index

// var senha = document.getElementById('txts');
// var icon = document.getElementById('mostrar');
// icon.addEventListener('click', togglePass);

// function togglePass() {
//   if (senha.type == 'password') {
//     senha.type = 'text';
//     icon.src = '/meet/css/eye.svg';

//   } else {
//     senha.type = 'password';
//     icon.src = '/meet/css/eye-off.svg';
//   }

// }

// // função do olho no modal
// var senha_m = document.getElementById('senha');
// var icon_m = document.getElementById('mostrar2');
// icon_m.addEventListener('click', togglePass2);

// function togglePass2() {
//   if (senha_m.type == 'password') {
//     senha_m.type = 'text';
//     icon_m.src = '/meet/css/eye.svg';

//   } else {
//     senha_m.type = 'password';
//     icon_m.src = '/meet/css/eye-off.svg';
//   }
// }