<?php

// SESSÃO RESPONSÁVEL PELO LOGIN
session_start();

// Limpara o buffer de redirecionamento
ob_start();

// Incluir o arquivo para validar e recuperar dados do token
include_once 'validar_token.php';


// Chamar a função validar o token, se a função retornar FALSE significa que o token é inválido e acessa o IF
if(!validarToken()){
    // Criar a mensagem de erro e atribuir para variável global
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Necessário realizar o login para acessar a página!</p>";

    // Redireciona o o usuário para o arquivo index.php
    header("Location: index.php");

    // Pausar o processamento da página
    exit();
}

include_once('config.php');

// CÓDIGO ṔHP PARA A FUNCIONALIDADE DO SISTEMA

if (isset($_POST['submit'])) {

    $nome = $_POST['nome'];

    $nome_filtrado = str_replace(' ', '', $nome);


    include_once('config.php');

    $sql = "SELECT link_1, link_2 FROM tb_usuarios where chave='$nome_filtrado'";

    $result = $conexao->query($sql);
    
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="download.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css
    ">
    <title>ECONET - Meet</title>
</head>

<body>
    <div>
        <div class="d-flex">
            <a href="logout.php" class="btn btn-outline-danger  me-2">Sair</a>
        </div>
        <form action="" method="post">
            <div class="menu">
                <header>
                    <h1>Link Meet</h1>
                </header>
                
                <label for="Nome">Chave:</label>
                <select class="form-select w-25" name="nome" aria-label="Default select example">
                    <option selected>Selecione uma chave</option>
                    <option value="W2bK5">W2bK5</option>
                    <option value="Jql@#">Jql@#</option>
                    <option value="Klu%*">Klu%*</option>
                    <option value="Ygh#%">Ygh#%</option>
                    <option value="Sxw#@">Sxw#@</option>
                    <option value="Cfj#$">Cfj#$</option>
                    <option value="Nho*%">Nho*%</option>
                    <option value="CFm48">CFm48</option>
                    <option value="yUf3d">yUf3d</option>
                    <option value="9Uk$K">9Uk$K</option>

                </select>
                <br>
            
                <button type="submit" class="btn btn-gerar  btn-outline-primary" name="submit">Gerar</button>
            </div>
        </form>


        <div id="fade" class="hide"></div>
        <div id="modal" class="hide">
            <div class="modal-header" value="gerar()">
                <h2>Link do meet</h2>
                <button id="close-modal">X</button>
            </div>
            <div class="modal-body">
                <p><strong>Não esqueça de enviar o link para seu contato / T.I!</strong></p>

                <strong>
                    <div id="res">
                        <?php
                        if ($result->num_rows == 0) {
                            echo 'Por favor, selecione chave!';
                        }

                        while ($user_data = mysqli_fetch_assoc($result)) {
                            $links = array($user_data['link_1'], $user_data['link_2']);
                            $rand_keys = array_rand($links, 2);
                            echo $links[$rand_keys[rand(0, 1)]];
                        }

                        ?>
                    </div>
                </strong>
                &nbsp;
                <button class="btn btn-outline-primary" onclick="copiarTexto()">Copiar &nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-files" viewBox="0 0 16 16">
                        <path d="M13 0H6a2 2 0 0 0-2 2 2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 13V4a2 2 0 0 0-2-2H5a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1zM3 4a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4z" />
                    </svg></button>
                <br>
            </div>
        </div>
    </div>

</body>

</html>
<script src="script.js">
</script>


<?php
if (isset($_POST['submit'])) {
    // Isso quer dizer que você mandou o post e deve abrir a modal por que o link ta lá em cima
    echo "
        <script>
            window.onload = function() {
                toggleModal();
            };
        </script>
    ";
}
?>
</body>

</html>