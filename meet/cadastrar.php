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
            background-image: linear-gradient(to bottom, #006b71 30%, #006ec5);
        }

        h1 {
            color: #08baff;
        }

        label {
            color: #08baff;
        }

        #cadastrar {
            border-color: #08baff;

            position: absolute;
            left: 150px;
        }

        #mostrar {
            margin-left: 200px;
            position: relative;
            bottom: 120px;
            right: 15px;
            width: 30px;
            height: 30px;
        }

        section {
            background-color: white;
            border-radius: 10px;
            width: 400px;
            padding: 20px;
            box-shadow: 5px 5px 10px;
            margin: 0px auto;
            position: relative;
            justify-content: center;
            right: 660px;

        }
    </style>
    <?php

    // Receber os dados do formulário
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    // Acessa o IF quando o usuário clicar no botão cadastrar
    if (!empty($dados['SendCadUser'])) {
        //var_dump($dados);

        // Criar a QUERY para cadastrar no banco de dados
        $query_usuario = "INSERT INTO tb_acessos(usuario, senha, matricula, ativo) 
        VALUES ( :usuario, :senha, :matricula, 'Sim')";

        // Preparar a QUERY
        $cad_usuario = $conn->prepare($query_usuario);

        // Substituir o link pelo valor que vem do formulário
        $cad_usuario->bindParam(':usuario', $dados['usuario']);
        $cad_usuario->bindParam(':matricula', $dados['matricula']);
        
        // Criptografar a senha
        $senha_criptografada = password_hash($dados['senha'], PASSWORD_DEFAULT);
        $cad_usuario->bindParam(':senha', $senha_criptografada);

        // Executar a QUERY
        $cad_usuario->execute();

        // Acessa o IF quando cadastrar o registro no banco de dados
        if ($cad_usuario->rowCount()) {
            // Criar a mensagem e atribuir para variável global
            $_SESSION['msg'] = "<p style='color: green;'>Usuário cadastrado com sucesso!</p>";

            // Redirecionar o usuário para a página de login
            header("Location: index.php");
        } else {
            echo "<p style='color: #fff;'>Erro: Usuário não cadastrado!</p>";
        }
    }

    ?>

    <title>Link Meet - ECONET</title>
</head>

<body>
    <section class="secao">
        <h1>Cadastre-se</h1>
        <br>
        <!-- Início do formulário cadastrar usuário -->

        <form method="POST" action="">
            <label>Nome: </label>
            <input type="text" name="usuario" class="form-control  w-70" placeholder="Nome completo" required><br>

            <label>Senha: </label>
            <input type="password" name="senha" id="senha" class="form-control  w-50" placeholder="Mínimo 6 caracteres" required><br>

            <label>Matricula: </label>
            <input type="text" name="matricula" class="form-control  w-25" placeholder="Ex:0000" required>
            <img src='eye.svg' id='mostrar'>
            <br>

            <input type="submit" name="SendCadUser" id='cadastrar' class="btn btn-outline-primary" value="Cadastrar"><br><br>
        </form>
        <!-- Fim do formulário cadastrar usuário -->

        <a href="index.php">Login</a><br><br>
    </section>
</body>
<script>
    var senha = document.getElementById('senha');
    const icon = document.getElementById("mostrar");
    icon.addEventListener('click', togglePass);

    function togglePass() {
        if (senha.type == "password") {
            senha.type = "text";
            icon.src = "eye-off.svg";
        } else {
            senha.type = "password";
            icon.src = "eye.svg";
        }
    }
</script>

</html>