<?php

// Função para validar o token
function validarToken(){
    // Recuperar o token do cookie
    $token = $_COOKIE['token'];
    //var_dump($token);

    // Converter o token em array
    $token_array = explode('.', $token);
    //var_dump($token_array);
    $header = $token_array[0];
    $payload = $token_array[1];
    $signature = $token_array[2];

    // Chave secreta e única
    $chave = "DGBU85S46H9M5W4X6OD7";

    // Usar o header e o payload e codificar com o algoritmo sha256
    $validar_assinatura = hash_hmac('sha256', "$header.$payload", $chave, true);

    // Codificar dados em base64
    $validar_assinatura = base64_encode($validar_assinatura);

    // Comparar a assinatura do token recebido com a assinatura gerada.
    // Acessa o IF quando o token é válido
    if($signature == $validar_assinatura){

        // decodificar dados de base64
        $dados_token = base64_decode($payload);

        // Converter objeto em array
        $dados_token = json_decode($dados_token);
        //var_dump($dados_token);

        // Comparar a data de vencimento do token com a data atual
        // Acessa o IF quando a data do token é maior do que a data atual
        if($dados_token->exp > time()){
            // Retorna TRUE indicando que o token é válido
            return true;
        }else{
            // Acessa o ELSE quando a data do token é menor ou igual a data atual
            // Retorna FALSE indicando que o token é inválido
            return false;
        }        
    }else{ 
        // Acessa o ELSE quando o token é inválido
        // Retorna FALSE indicando que o token é inválido
        return false;
    }    
}

// Recuperar o nome salvo no token
function recuperarNomeToken(){
    // Recuperar o token do cookie
    $token = $_COOKIE['token'];

    // Converter o token em array
    $token_array = explode('.', $token);
    //var_dump($token_array);
    $payload = $token_array[1];

    // decodificar dados de base64
    $dados_token = base64_decode($payload);

    // Converter objeto em array
    $dados_token = json_decode($dados_token);
    // var_dump($dados_token);

    // Retorna o nome do usuário salvo no token
    return $dados_token->nome;
}

