<?php

// SESSÃO RESPONSÁVEL PELO LOGIN
session_start();

// Limpara o buffer de redirecionamento
ob_start();

// Incluir o arquivo para validar e recuperar dados do token
include_once 'validar_token.php';

// Chamar a função validar o token, se a função retornar FALSE significa que o token é inválido e acessa o IF
if (!validarToken()) {
    // Criar a mensagem de erro e atribuir para variável global
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Necessário realizar o login para acessar a página!</p>";

    // Redireciona o o usuário para o arquivo index.php
    header("Location: /meet/index.php");

    // Pausar o processamento da página
    exit();
}


include_once 'config.php';


// CÓDIGO ṔHP PARA A FUNCIONALIDADE DO SISTEMA MEET

if (isset($_POST['submit'])) {

    $chave = $_POST['chave'];

    $chave_filtrada = str_replace(' ', '', $chave);

    //USAR EM CASO DE NOVA CHAVE 
    // $sql = mysqli_query($conexao, "SELECT * FROM tb_links where chave='$chave_filtrada'");

    $sql = mysqli_query($conexao, "SELECT * FROM tb_links where chave='$chave_filtrada'
     and ultimo_uso <= DATE_SUB(NOW(), INTERVAL 1 DAY)");

    $dia_seguinte = time() + (1 * 24 * 60 * 60);
    $today = date("Y-m-d H:i:s", $dia_seguinte);

    //   echo $today;


}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/meet/css/meet.css">
    <link rel="shortcut icon" href="/meet/css/download.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css
    ">
    <title>ECONET - Meet</title>
</head>

<body>
    <div>
        <div class="d-flex">
            <a href="logout.php" id="sair" class="btn btn-outline-danger me-2" class='borda'>Sair</a>
        </div>
        <form action="" method="post">
            <div class="menu">
                <header>
                    <h1>Link Meet</h1>
                </header>

                <label for="chave">Chave:</label>
                <select class="form-select w-25" name="chave" autofocus>
                    <option Selected>Selecione uma chave</option>
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
                    <option value="vQ%39">vQ%39</option>
                    <option value="25s8@">25s8@</option>
                    <option value="5w^F3">5w^F3</option>
                    <option value="41Q7m">41Q7m</option>
                    <option value="r7!04">r7!04</option>
                    <option value="Rg08!">Rg08!</option>
                    <option value="53#Y3">53#Y3</option>
                    <option value="4%Lt6">4%Lt6</option>
                    <option value="#73Jy">#73Jy</option>

                </select>
                <br>

                <button type="submit" id="gerar" class="btn btn-gerar  btn-outline-primary borda" name="submit">Gerar</button>
            </div>


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
                            if ($sql->num_rows == 0) {

                                // Separa as duas partes em um array, explode separada em um array toda vez que encontrar a ocorrencia, no caso ali espaço
                                $data = explode(' ', $today);

                                $hora = $data[1];
                                //Espaço na hora de imprimir
                                $space = ' ';

                                        //'2023-05-26'  Transforma a data em um array também 
                                $dataCorreta = explode('-',  $data[0]);
                                //Inverte o array que está [2023,05,26] para [26,05,2023] 
                                $dataCorreta = array_reverse($dataCorreta); 
                                // Junta o array com o delimitador / para uma string 
                                $dataCorreta = implode('/', $dataCorreta);

                                echo "<span color='red'>Chave sendo utilizada! Liberação: " .substr($dataCorreta, 0, 5) . $space. substr($hora, 0, 5). "</span>";
                            }

                            while ($user_data = mysqli_fetch_assoc($sql)) {


                                echo $user_data['link'];

                                $update = mysqli_query($conexao, "UPDATE tb_links SET ultimo_uso = NOW()
                                 where chave='$chave_filtrada'");
                            }

                            ?>
                        </div>
                    </strong>
                    &nbsp;
                    <button class="btn btn-outline-primary" name="copy" id="copy" onclick="copiarTexto()"><svg xmlns="http://www.w3.org/2000/svg" width="46" height="30" fill="currentColor" class="bi bi-files" viewBox="0 0 16 16">
                            <path d="M13 0H6a2 2 0 0 0-2 2 2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 13V4a2 2 0 0 0-2-2H5a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1zM3 4a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4z" />
                        </svg></button>
        </form>
    </div>
    </div>
    </div>

</body>

</html>
<script src="/meet/js/meet.js">
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