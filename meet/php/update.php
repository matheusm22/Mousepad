<?php 

session_start(); // Iniciar a sessão

// Limpara o buffer de redirecionamento
ob_start();


include_once('config.php');

// VERIFICA O SUBMIT  e os inputs de senha
if (isset($_POST['submit'])) {

     if ($_POST['senha'] != $_POST['confirma']) {

        echo "<label style='color: #fff; font-size:20px;'>Erro: As senhas não coincidem</label>";
        print_r('<br>');
        print_r('<br>');
        } else {

        $matricula = $_POST['matricula']; 
        $confirma = $_POST['confirma'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

        $res_matricula =  mysqli_query($conexao, "SELECT matricula FROM tb_acessos 
        WHERE matricula = '$matricula' ORDER by id_usuario DESC LIMIT 1");
        

        if ($res_matricula-> num_rows == 0) {
                echo "<label style='color: #ff0f; font-size:20px;'> O número de matricula não existe!</label>";
                print_r('<br>');
                print_r('<br>');
        } else {
            
            if (strlen($_POST['senha']) < 6 || strlen($confirma) < 6) {
                 
               echo "<label style='color: #ff0f;'>Erro: Senha com menos de 6 caracteres!</label>";
               print_r('<br>');
               print_r('<br>');
            } else {
            
        // Executa a query de mysql 
        $update = mysqli_query($conexao,"UPDATE tb_acessos SET senha = '$senha'
        WHERE matricula = '$matricula' ORDER BY id_usuario ASC");

    //  verifica o número de linhas no mysql 
    $sql = mysqli_query($conexao,"SELECT * FROM tb_acessos WHERE matricula = '$matricula' ORDER BY id_usuario ASC");
    
    if ($sql->num_rows == 0 || $confirma == '' || $senha == '' || $matricula == '') {
        
        echo "<label style='color: #fff; font-size:20px;'>Erro: Senha não alterada!</label>";
        print_r('<br>');
        print_r('<br>');

    } else {
        $_SESSION['msg'] = "<p style='color: green;'>Sua senha foi alterada!&nbsp</p>";
         header('Location: /meet/index.php');
        
       }
     }
    }
   }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css
    ">
    <link rel="stylesheet" href="/meet/css/senha.css">
    <link rel="shortcut icon" href="/meet/css/download.ico" type="image/x-icon">
    
    <title>Link Meet - ECONET</title>
</head>

<body>
    <section>
        <h1>Crie uma nova senha</h1>
        <br>
            <form action="" method="post">
            <label>Matricula: </label> <br>
            <input type="text" name="matricula"  autofocus id="matricula" class="form-control  w-25" placeholder="Ex:0000"><br>

            <label>Nova Senha: </label>
            <input type="password" name="senha" id="senha" class="form-control  w-50" placeholder="Mínimo 6 caracteres">
            <!-- mostrar senha -->
            <img src='/meet/css/eye-off.svg' id='mostrar'>
            <br>
            <label>Confirmar senha: </label>
            <input type="password" name="confirma" id="confirma" class="form-control  w-50" placeholder="Mínimo 6 caracteres" ><br><br>
            <input type="submit" name="submit" id='alterar'value="Alterar">
            </form>

        <!-- Fim do formulário cadastrar usuário -->
        <a href="/meet/index.php" id="login">Login</a>
    </section>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="/meet/js/senha.js"></script>

</html>