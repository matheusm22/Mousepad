"use strict";

// não adiciona o espaço no campo usuário

$(function () {
  $("#txtu").keypress(function (event) {
    if (event.which == 32) {
      return false;
    }
  });

});

// não adiciona o espaço no campo senha

$(function () {
  $("#txts").keypress(function (event) {
    if (event.which == 32) {
      return false;
    }
  });

});


// função do olho no index

var senha = document.getElementById('txts');
var icon = document.getElementById('mostrar');
icon.addEventListener('click', togglePass);

function togglePass() {
  if (senha.type == 'password') {
    senha.type = 'text';
    icon.src = '/meet/css/eye.svg';

  } else {
    senha.type = 'password';
    icon.src = '/meet/css/eye-off.svg';
  }

}

// função do olho no modal
var senha_m = document.getElementById('senha');
var icon_m = document.getElementById('mostrar2');
icon_m.addEventListener('click', togglePass2);

function togglePass2() {
  if (senha_m.type == 'password') {
    senha_m.type = 'text';
    icon_m.src = '/meet/css/eye.svg';

  } else {
    senha_m.type = 'password';
    icon_m.src = '/meet/css/eye-off.svg';
  }
}