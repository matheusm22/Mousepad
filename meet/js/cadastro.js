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
  
  // Não adiciona o espaço no campo de usuário
  $(function() {
    $("#usuario").keypress(function(event) {
        if (event.which == 32) {
            return false;
        }
    });
  });

  // Não adiciona o espaço no campo de senha
  $(function() {
    $("#senha").keypress(function(event) {
        if (event.which == 32) {
            return false;
        }
    });
  });

//  JS do modal de cadastro
const openModalButton = document.querySelector('#open-modal');
const closeModalButton = document.querySelector('#close-modal');
const modal = document.querySelector('#modal');
const fade = document.querySelector('#fade');

const toggleModal = () => {
   [modal, fade].forEach((el) => el.classList.toggle("hide"));

};

[openModalButton,closeModalButton, fade].forEach((el) => {
   el.addEventListener('click', () => toggleModal());
});

// Envia os dados para cadastrar.php via ajax

$(document).ready(function() {

    $("#btnEnviar").click(()=> {
       $.ajax({
            url: "/meet/php/cadastrar.php",
            type: "POST",
            data: {
                usuario:   $("#usuario").val(),
                senha:     $("#senha").val(),
                matricula: $("#matricula").val()
            },
            success: (resultado)=> {
                $("#saida").html(resultado);
                setTimeout(function() {
                    window.location.reload(1);
                  }, 1500); 
            }
        });
     } );

});


