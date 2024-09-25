<?php
require 'config.php'; // Inclui a conexão com o banco de dados

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário e sanitiza
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($mysqli, filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $password = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING); // Corrigido para 'senha'

    // Prepara a consulta para evitar SQL injection
    $stm = $mysqli->prepare("INSERT INTO user_db (nome, email, senha) VALUES (?, ?, ?)");

    // Verifica se a preparação da consulta foi bem-sucedida
    if ($stm) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stm->bind_param("sss", $nome, $email, $hashed_password); 

        // Executa a consulta
        if ($stm->execute()) {
            header("Location: ../frontend/index.html"); // Ajuste o caminho para index.html
            exit(); // Finaliza o script após o redirecionamento
        } else {
            echo "Erro ao cadastrar usuário: " . $stm->error;
        }

        $stm->close(); 
    } else {
        die('Erro ao preparar a consulta: ' . $mysqli->error);
    }
}

$mysqli->close(); // Fecha a conexão
?>
