"use strict";
// função para a matricula aceitar apenas números
$(function() {
    $("#matricula").keypress(function(event) {
        if (event.which != 8 && event.which != 0 && (event.which < 48 || event.which > 57)) {
            return false;
        }
    });
  });

  // Não adiciona o espaço no campo de Senha
  $(function() {
    $("#senha").keypress(function(event) {
        if (event.which == 32) {
            return false;
        }
    });
  });

  // Não adiciona o espaço no campo de Confirmar Senha
  $(function() {
    $("#confirma").keypress(function(event) {
        if (event.which == 32) {
            return false;
        }
    });
  });

 // Mostra campo de senha: 
 const senha = document.getElementById("senha");
 const confirmSenha = document.getElementById("confirma");
 const btn = document.getElementById("mostrar");
 btn.addEventListener('click', togglePass);

 function togglePass() {
     if (senha.type == "password" && confirmSenha.type == "password") {
         senha.type = "text";
         confirmSenha.type = "text";
         btn.src = "/meet/css/eye.svg";
     } else {
         senha.type = "password";
         confirmSenha.type = "password";
         btn.src = "/meet/css/eye-off.svg";
     }
 }

