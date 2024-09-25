<?php
include_once('config.php');
require 'verifica_sessao.php'; 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $id = $_SESSION['id']; // Pega o ID da sessão
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    // Verifica se os campos estão preenchidos
    if (!empty($nome) && !empty($email)) {
        // Prepara a consulta de atualização
        $sqlUpdate = "UPDATE user_db SET nome = ?, email = ? WHERE id = ?";
        $stmt = $mysqli->prepare($sqlUpdate);

        if ($stmt) {
            // Bind dos parâmetros
            $stmt->bind_param('ssi', $nome, $email, $id);

            // Executa a atualização
            if ($stmt->execute()) {
                header("Location: ../frontend/index.html");  // Redireciona após a atualização
                exit();
            } else {
                echo "Erro ao atualizar: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Erro ao preparar a consulta: " . $mysqli->error;
        }
    } else {
        echo "Preencha todos os campos!";
    }
}

$mysqli->close(); // Fecha a conexão
?>
