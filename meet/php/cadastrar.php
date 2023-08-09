<?php

if (isset($_POST['usuario']) || isset($_POST['senha']) || isset($_POST['matricula'])) {
    include_once('config.php');    
    $usuario = $_POST['usuario'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $matricula = $_POST['matricula'];

    if (strlen($_POST['senha']) < 6 or strlen($usuario) < 6) {
        echo "<label style='color: #f00;'>Erro: Senha ou usuário com menos de 6 caracteres!</label>";

    } else {
    
    if(strlen($matricula) != 4){ 
        
        echo "<label style='color: #f00;'>Número de matricula inválido!, EX:0000</label>";

    } else {

        $verifica_matricula = mysqli_query($conexao, "SELECT matricula FROM tb_acessos
         WHERE matricula = '$matricula' ORDER BY id_usuario ASC");

       if ($verifica_matricula->num_rows > 0) {
             
              echo "<label style='color: #f00;'>Erro: Número de matricula em uso, Tente outro!</label>";
       } else {
    
        $verifica_usuario = mysqli_query($conexao, "SELECT usuario FROM tb_acessos
         WHERE usuario = '$usuario' ORDER BY id_usuario ASC");

       if ($verifica_usuario->num_rows > 0) {
        
           echo "<label style='color: #f00;'>Erro: Nome de usuário em uso, Tente outro!</label>";
              
       } else {
    
    // INSERINDO NO BANCO DE DADOS:

            $usuario = $_POST['usuario'];
            $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            $matricula = $_POST['matricula'];

              $insert = mysqli_query($conexao, "INSERT INTO tb_acessos(usuario,senha,matricula, ativo, nivel) 
              VALUES ('$usuario', '$senha','$matricula', 'Sim', 2)");


        $sql = mysqli_query($conexao, "SELECT * FROM tb_acessos WHERE usuario = '$usuario' ORDER BY id_usuario ASC");
       
            if ($sql->num_rows == 0 || $usuario == '' || $senha == '' || $matricula == '') {
                     echo "<label style='color: #f00;'>Erro: Usuário não cadastrado, tente novamente!</label>";
        } else {
            print_r("<label style='color: green;'>Bem-vindo !&nbsp</label> " . $usuario);  
        } 
      }    
    }
 }
} 
}
?>
