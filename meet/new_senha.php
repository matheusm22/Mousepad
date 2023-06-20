<?php

session_start(); // Iniciar a sessão

// Limpara o buffer de redirecionamento
ob_start();

// Incluir o arquivo com a conexão com banco de dados
include_once 'conexao.php';

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css
    ">
    <link rel="shortcut icon" href="download.ico" type="image/x-icon">
    <style>
        body {
            overflow: hidden;
            position: relative;
            left: 700px;
            top: 100px;
            margin: 0 auto;
            background-repeat: no-repeat;
            background-size: 100vw 100vh;
            background-image: linear-gradient(to bottom, #006b71, green 90%);
        }

        label {
            color: #1aad86;

        }

        
        #mostrar {
            margin-left: 5px;
            position: relative;
            bottom: 120px;
            right: 415px;
            width: 30px;
            height: 30px;
            
        }

        h1 {
            color: #1aad86;
        }


        #alterar {
            position: absolute;
            left: 175px;

        }

        #login {
            color: #1aad86;
        }

        #mostrar {
            position: relative;
            left: 230px;
            top: 15px;
            color: #1aad86;
        }

        section {
            background-color: white;
            border-radius: 10px;
            width: 500px;
            padding: 20px;
            box-shadow: 5px 5px 10px;
            margin: 0px auto;
            position: relative;
            justify-content: center;
            right: 660px;
            height: 515px;

        }
    </style>

    <?php

    // Receber os dados do formulário
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    // Acessa o IF quando o usuário clicar no botão cadastrar
    if (!empty($dados['SendCadUser'])) {
        //var_dump($dados);

        // Criar a QUERY para cadastrar no banco de dados
        $query_usuario = "UPDATE tb_acessos SET senha = :senha WHERE matricula = :matricula ";

        // Preparar a QUERY
        $cad_usuario = $conn->prepare($query_usuario);

        // Substituir o link pelo valor que vem do formulário
        $cad_usuario->bindParam(':matricula', $dados['matricula']);


        if ($dados['senha'] == $dados['confirm_senha']) {
            // Criptografar a senha
            $senha_criptografada = password_hash($dados['senha'], PASSWORD_DEFAULT);
            $cad_usuario->bindParam(':senha', $senha_criptografada);

            // Executar a QUERY
            $cad_usuario->execute();
        }

        // Acessa o IF quando cadastrar o registro no banco de dados
        if ($cad_usuario->rowCount()) {
            // Criar a mensagem e atribuir para variável global
            $_SESSION['msg'] = "<p style='color: green;'>Senha alterada com sucesso!</p>";

            // Redirecionar o usuário para a página de login
            header("Location: index.php");
        } else {
            echo "<p style='color: #ffff; font-size: 20px'>Erro: Senha não alterada!</p>";
            if ($dados['senha'] != $dados['confirm_senha']) {
                echo "<p style='color: #ffff; font-size: 20px'> As senhas não coincidem!</p>";
            }
        }
    }
    ?>

    <title>Link Meet - ECONET</title>
</head>

<body>
    <section>
        <h1>Crie uma nova senha</h1>
        <br>

        <!-- Início do formulário cadastrar usuário -->
        <form method="POST" action="">
            <label>Matricula: </label> <br>
            <input type="text" name="matricula" class="form-control  w-25" placeholder="Ex:0000" required><br>

            <label>Nova Senha: </label>
            <input type="password" name="senha" id="senha" class="form-control  w-50" placeholder="Mínimo 6 caracteres">
            <!-- mostrar senha -->
            <img src='eye.svg' id='mostrar'>
            <br>
            <label>Confirmar senha: </label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="password" name="confirm_senha" id="confirm_senha" class="form-control  w-50" placeholder="Mínimo 6 caracteres"><br><br>
            <input type="submit" name="SendCadUser" id='alterar' class="btn btn-outline-success w-25" value="Alterar">

        </form>
        <!-- Fim do formulário cadastrar usuário -->
        <a href="index.php" id="login">Login</a>
    </section>

</body>
<script>
    // Mostra campo de senha: 
    const senha = document.getElementById("senha");
    const confirmSenha = document.getElementById("confirm_senha");
    const btn = document.getElementById("mostrar");
    btn.addEventListener('click', togglePass);

    function togglePass() {
        if (senha.type == "password" && confirmSenha.type == "password") {
            senha.type = "text";
            confirmSenha.type = "text";
            btn.src = "eye-off.svg";
        } else {
            senha.type = "password";
            confirmSenha.type = "password";
            btn.src = "eye.svg";
        }
    }
</script>

</html>