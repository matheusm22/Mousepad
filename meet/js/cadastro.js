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

// Envia os dados para cadastrar.php via ajax

$(document).ready(function() {

    $("#adicionar").click(()=> {
       $.ajax({
            url: "/meet/php/cadastrar.php",
            type: "POST",
            data: {
                usuario:   $("#cad_usuario").val(),
                senha:     $("#cad_senha").val(),
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


