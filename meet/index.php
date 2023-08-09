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
      // 5 minutos
      $duracao = time() + (300);

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
        $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário sem pemissão!</p>";
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/meet/css/login.css">
    <link rel="shortcut icon" href="/meet/css/download.ico" type="image/x-icon">

    <title>Link Meet ECONET</title>
</head>

<body>
  <div id="saida"></div>
    <h2>Link Meet</h2>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form>
                <h1>Crie seu Usuário</h1>
                <div class="social-container">
                </div>
                <span>Preencha os campos abaixo:</span>
                <input type="text" id="matricula" name="matricula" placeholder="Matricula" />
                <input type="text" id="cad_usuario" name="usuario" placeholder="Usuário" />
                <input type="password" id="cad_senha" name="senha" placeholder="Senha" />
                <br>
                <button id="adicionar" type="button">Adicionar</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="" method="post">
                <h1>Login</h1>
                <div class="social-container">
                </div>
                <?php
                $user = "";
                if (isset($usuario)) {
                    $user = $usuario;
                }

                $password = "";
                if (isset($senha)) {
                  $password = $senha;
                }
                ?>
                <input type="text" name="usuario" id="usuario" autofocus placeholder="Usuário" value="<?php echo $user; ?>">
                <input type="password" name="senha"  id="senha" placeholder="Senha" value="<?php echo $password; ?>">
                <a href="../meet/php/update.php">Esqueceu a senha?</a>
                <input type="submit" name="submit"  id='entrar' value="Entrar"> 
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Bem vindo de volta!</h1>
                    <p>Para se manter conectado conosco, faça o login com suas informações pessoais</p>
                    <button class="ghost" id="signIn">Entrar</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Olá amigo!</h1>
                    <p>Introduza os seus dados pessoais e comece a viajar conosco</p>
                    <button class="ghost" id="signUp">Adicionar</button>
                </div>
            </div>
        </div>
    </div>
 
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="/meet/js/cadastro.js"></script>
<script src="/meet/js/login.js"></script>



</html>
