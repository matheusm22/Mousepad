<?php

session_start(); // Iniciar a sessão

// Limpara o buffer de redirecionamento
ob_start();

// Incluir o arquivo com a conexão com banco de dados
include_once 'conexao.php';

// Receber os dados do formulário
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// Acessa o IF quando o usuário clicou no botão "Acessar" do formulário
if (!empty($dados['SendLogin'])) {
  //var_dump($dados);

  // QUERY para recuperar o usuário do banco de dados
  $query_usuario = "SELECT * FROM tb_acessos WHERE usuario =:usuario LIMIT 1";

  // Preparar a QUERY
  $result_usuario = $conn->prepare($query_usuario);

  // Substitui o link ":usuario" pelo valor que vem do formulário
  $result_usuario->bindParam(':usuario', $dados['usuario']);


  // Executar a QUERY
  $result_usuario->execute();

  // Acessa o IF quando encontrou usuário no banco de dados
  if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
    // Ler o resultado retornado do banco de dados
    $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
    //var_dump($row_usuario);

    // Verificar se a senha digitada pelo usuário no formulário é igual a senha salva no banco de dados
    if (password_verify($dados['senha'], $row_usuario['senha'])) {
      // O JWT é divido em três partes separadas por ponto ".": um header, um payload e uma signature

      // Header indica o tipo do token "JWT", e o algoritmo utilizado "HS256"
      $header = [
        'alg' => 'HS256',
        'typ' => 'JWT'
      ];
      //var_dump($header);

      // Converter o array em objeto
      $header = json_encode($header);
      //var_dump($header);

      // Codificar dados em base64
      $header = base64_encode($header);

      // Imprimir o header
      //var_dump($header);

      // O payload é o corpo do JWT, recebe as informações que precisa armazenar
      // iss - O domínio da aplicação que gera o token
      // aud - Define o domínio que pode usar o token
      // exp - Data de vencimento do token
      // 7 days; 24 hours; 60 mins; 60secs
      // $duracao = time() + (7 * 24 * 60 * 60);
      // 5 segundos
      $duracao = time() + (10);

      $payload = [
        /*'iss' => 'localhost',
                'aud' => 'localhost',*/
        'exp' => $duracao,
      ];

      // Converter o array em objeto
      $payload = json_encode($payload);
      //var_dump($payload);

      // Codificar dados em base64
      $payload = base64_encode($payload);

      // Imprimir o payload
      //var_dump($payload);

      // O signature é a assinatura. 
      // Chave secreta e única
      $chave = "DGBU85S46H9M5W4X6OD7";

      // Pegar o header e o payload e codificar com o algoritmo sha256, junto com a chave
      // Gera um valor de hash com chave usando o método HMAC
      $signature = hash_hmac('sha256', "$header.$payload", $chave, true);

      // Codificar dados em base64
      $signature = base64_encode($signature);

      // Imprimir o signature
      //var_dump($signature);

      // Imprimir o token
      //echo "Token: $header.$payload.$signature <br>";

      // Salvar o token em cookies
      // Cria o cookie com duração 7 dias
      setcookie('token', "$header.$payload.$signature", (time() + (7 * 24 * 60 * 60)));


      // Redirecionar o usuário para página do meet
      header("Location: meet.php");
    } else {
      // Criar a mensagem de erro e atribuir para variável global "msg"
      $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário ou senha inválida!</p>";
    }
  } else {
    // Criar a mensagem de erro e atribuir para variável global "msg"
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário ou senha inválida!</p>";
  }
}

// Verificar se existe a variável global "msg" e acessa o IF
if (isset($_SESSION['msg'])) {
  // Imprimir o valor da variável global "msg"
  echo $_SESSION['msg'];

  // Destruir a variável globar "msg"
  unset($_SESSION['msg']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <link rel="shortcut icon" href="download.ico" type="image/x-icon">
  <style>
    body{
      overflow: hidden;
    }
    #entrar {
      width: 29%;
      padding-left: 20px;
    }

    p {
      position: absolute;
      left: 58%;
      top: 165px;
    }
    #res {
      position: relative;
      justify-content: center;
      font-size: 20px;
      padding-left: 50px;
      margin-top: 18px;
    }

    #mostrar {
      margin-left: 200px;
      position: relative;
      bottom: 35px;
      left: 30px;
      width: 30px;
      height: 30px;

    }

    #esq_senha {
      color: #1aad86;
    }
  </style>
  <title>Link Meet - ECONET</title>
</head>

<body>

  <section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-md-8 col-lg-7 col-xl-6">
          <img src="econet.webp" class="img-fluid" alt="Phone image">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
          <!-- Início do formulário de login -->
          <form method="POST" action="">

            <h3>Login</h3>
            <br>
            <?php
            $usuario = "";
            if (isset($dados['usuario'])) {
              $usuario = $dados['usuario'];
            }
            ?>
            <div class="form-outline mb-4">
              <label>Usuário: </label><br>
              <input type="text" name="usuario" class="form-control  w-50" placeholder="Digite o usuário" value="<?php echo $usuario; ?>">
            </div>
            <?php
            $senha = "";
            if (isset($dados['senha'])) {
              $senha = $dados['senha'];
            }
            ?>
            <div class="form-outline mb-4">
              <label>Senha: </label>
              <input type="password" name="senha" id="senha" class="form-control  w-50" placeholder="Digite a senha" value="<?php echo $senha; ?>">
              <img src='eye.svg' id='mostrar'>
              <br>

              <input type="submit" name="SendLogin" class="btn btn-outline-success w-25" value="Acessar"> &nbsp;&nbsp;
              <a href="new_senha.php" id='esq_senha'>Esqueceu a senha?</a>
              <br>
              <!-- Fim do formulário de login -->

            </div>
            <a href="cadastrar.php" class="btn btn-outline-primary w-25">Cadastrar</a> <br>

          </form>

        </div>
      </div>
    </div>
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