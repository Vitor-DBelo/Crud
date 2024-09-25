<?php
require 'config.php';


// Função para apagar todas as tarefas de um usuário
function deleteTarefas($user_id) {
    global $mysqli;
    $stmt = $mysqli->prepare("DELETE FROM tarefas WHERE user_id = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->close();
}

// Função para apagar o usuário
function deleteUser($id) {
    global $mysqli;

    // Primeiro, apaga as tarefas do usuário
    deleteTarefas($id);

    // Agora, apaga o usuário
    $stmt = $mysqli->prepare("DELETE FROM user_db WHERE id = ?");
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        header("Location: crudUsuarios.php"); // Redireciona após a exclusão
    } else {
        echo "Erro ao apagar o usuário: " . $stmt->error;
    }
    $stmt->close();
}

// Verifica se um ID foi enviado para excluir
if (isset($_POST['id'])) {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    if ($id) {
        deleteUser($id);
        header("Location: ../frontend/index.html"); 
    } else {
        echo "ID inválido.";
    }
}

$mysqli->close();
?>
