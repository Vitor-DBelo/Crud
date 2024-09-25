<?php
require 'config.php';



// Verificar se o formulário de inserção foi enviado
if (isset($_POST['submit'])) {
    // Sanitização do input
    $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);

    // Verificar se o título já existe
    $stmt = $mysqli->prepare("SELECT COUNT(*) FROM tarefas WHERE titulo = ?");
    if ($stmt) {
        $stmt->bind_param('s', $titulo);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        // Se o count for 0, significa que não existe um registro igual
        if ($count === 0) {
            // Prepare a inserção
            $stmt = $mysqli->prepare("INSERT INTO tarefas (titulo, descricao) VALUES (?, ?)");
            if ($stmt) {
                $stmt->bind_param('ss', $titulo, $descricao);
                if ($stmt->execute()) {
                    header("Location: crudTarefas.php");
                    exit;
                } else {
                    echo "Erro ao inserir tarefa: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Erro ao preparar a inserção: " . $mysqli->error;
            }
        } else {
            echo "Já existe uma tarefa com esse título!";
        }
    } else {
        echo "Erro ao preparar a consulta: " . $mysqli->error;
    }
}

// Verificar se o botão de apagar foi clicado
if (isset($_POST['apagar'])) {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    if ($id) {
        $stmt = $mysqli->prepare("DELETE FROM tarefas WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param('i', $id);
            if ($stmt->execute()) {
                header("Location: crudTarefas.php");
                exit;
            } else {
                echo "Erro ao apagar a tarefa: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Erro ao preparar a exclusão: " . $mysqli->error;
        }
    }
}
