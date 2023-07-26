<?php

session_start(); // Iniciar a sessão

// Limpara o buffer de redirecionamento
ob_start();

// Acessa o IF quando o usuário clicou no botão "Acessar" do formulário
if (!empty($_POST['submit'])) {
  include_once '../meet/php/config.php';
  $usuario = $_POST['usuario'];
  $senha = $_POST['senha'];

  // QUERY para recuperar o usuário do banco de dados
  $sql = mysqli_query($conexao, "SELECT * FROM tb_acessos
   WHERE usuario ='$usuario' and ativo ='Sim' LIMIT 1");

  // Acessa o IF quando encontrou usuário no banco de dados
  if ($sql->num_rows > 0) {
    // Ler o resultado retornado do banco de dados
    $user_data = mysqli_fetch_assoc($sql);
    //var_dump($row_usuario);

    $_SESSION['id_usuario'] = $user_data['id_usuario'];
    $_SESSION['usuario'] = $user_data['usuario'];
    $_SESSION['nivel'] = $user_data['nivel'];
  

    // Verificar se a senha digitada pelo usuário no formulário é igual a senha salva no banco de dados
    if (password_verify($senha, $user_data['senha'])) {

      // Header indica o tipo do token "JWT", e o algoritmo utilizado "HS256"
      $header = [
        'alg' => 'HS256',
        'typ' => 'JWT'
      ];

      // Converter o array em objeto
      $header = json_encode($header);

      // Codificar dados em base64
      $header = base64_encode($header);

      // 7 days; 24 hours; 60 mins; 60secs
      // $duracao = time() + (7 * 24 * 60 * 60);
      // 5 segundos
      $duracao = time() + (120);

      $payload = [

        'exp' => $duracao,
      ];

      // Converter o array em objeto
      $payload = json_encode($payload);
      //var_dump($payload);

      // Codificar dados em base64
      $payload = base64_encode($payload);

      // Chave secreta e única
      $chave = "DGBU85S46H9M5W4X6OD7";

      // Gera um valor de hash com chave usando o método HMAC
      $signature = hash_hmac('sha256', "$header.$payload", $chave, true);

      // Codificar dados em base64
      $signature = base64_encode($signature);

      // Cria o cookie com duração 7 dias
      setcookie('token', "$header.$payload.$signature", (time() + (7 * 24 * 60 * 60))); //para aqui

      // Permissão de usuários  e redirecionamento
      if($_SESSION['nivel'] == 2){  // NUNCA COLOQUE UM ISSET AQUI (PS: NUNCA FUNCIONA).
      // Redirecionar o usuário para página do meet
      header("Location: /meet/php/meet.php");
     
      }
      else{
        $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário ou senha inválida!</p>";
      }
    } else {
      // Criar a mensagem de erro e atribuir para variável global "msg"  -- ERRO INPUT EM BRANCO
      $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário ou senha inválida!</p>";
      echo "<script>setTimeout(function() {
      window.location.href = '/meet/index.php';
  }, 1200); </script>";
    }
  } else {
    // Criar a mensagem de erro e atribuir para variável global "msg" -- ERRO USUARIO INVÁLIDO
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário ou senha inválida!</p>";
    echo "<script>setTimeout(function() {
      window.location.href = '/meet/index.php';
  }, 1200); </script>";
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
  <link rel="shortcut icon" href="/meet/css/download.ico" type="image/x-icon">
  <link rel="stylesheet" href="/meet/css/login.css">
  <title>Link Meet - ECONET</title>
</head>

<body>
  <section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-md-8 col-lg-7 col-xl-6">
          <img src="/meet/css/econet.webp" class="img-fluid" alt="logo econet">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
          <!-- Início do formulário de login -->
          <form method="POST" action="">
            <h3>Login</h3>
            <br>
            <?php
            $user = "";
            if (isset($usuario)) {
              $user = $usuario;
            }
            ?>
            <div class="form-outline mb-4">
              <label>Usuário: </label><br>
              <input type="text" name="usuario" id="txtu" class="form-control  w-75" placeholder="Digite o usuário" value="<?php echo $user; ?>">
            </div>
            <?php
            $password = "";
            if (isset($senha)) {
              $password = $senha;
            }
            ?>
            <div class="form-outline mb-4">
              <label>Senha: </label>
              <input type="password" name="senha" id="txts" class="form-control  w-75" placeholder="Digite a senha" value="<?php echo $password; ?>">
              <img src="/meet/css/eye-off.svg" id="mostrar">
              <br>

              <input type="submit" name="submit"  id='acessar' class="btn btn-outline-success w-25" value="Acessar"> 
          </form>
          <a href="/meet/php/update.php" class="btn btn-outline-primary" id='esq_senha'>Esqueceu a senha?</a>
          <br>
          <!-- Fim do formulário de login -->

        </div>
        <button id="open-modal" class=" btn btn-outline-primary w-25" name="Cadastrar">Cadastro</button>

        <div id="fade" class="hide"></div>
        <div id="modal" class="hide">
          <div class="modal-header" value="gerar()">
            <h2>Cadastre-se</h2>
            <button id="close-modal">X</button>
          </div>

          <div class=" modal-body">
            <strong>
              <div id="saida">
                <label>Usuário: </label><br>
                <input type="text" class="form-control w-100" id="usuario" placeholder="Insira seu usuário" required autofocus> 
                <button type="button" class="btn btn-sm btn-primary" id="balao_user" data-toggle="popover" title="Ex: econet_editora" >?</button>
                <br>
                <label>Senha: </label>
                <input type="password" class="form-control w-100" id="senha"
                 placeholder="Crie sua senha" required>
                <img src="/meet/css/eye-off.svg" id="mostrar2">
                <button type="button" class="btn btn-sm btn-primary" id="balao_senha" data-toggle="popover" title="Minimo 6 caracteres!" >?</button>
                <br>

                Matricula: <input type="text" class="form-control w-50" id="matricula" placeholder="Ex:0000" required>
                <button type="button" class="btn btn-sm btn-primary" id="balao_matricula" data-toggle="popover" title="Insira somente 4 caracteres!" >?</button>
                <br>

                <button id="btnEnviar" class=" btn btn-info" type="button">Cadastrar</button> &nbsp; &nbsp;

              </div>
              <br>
</body>
</div>
</div>
</div>
</section>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="/meet/js/login.js"></script>
<script src="/meet/js/cadastro.js"></script>

</html>
