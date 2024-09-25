<?php
require 'config.php';

// Configurações seguras de sessão
ini_set('session.cookie_httponly', 1); // Impede o acesso ao cookie de sessão via JavaScript
ini_set('session.cookie_secure', 1);   // Garante que o cookie de sessão seja transmitido apenas via HTTPS
ini_set('session.use_only_cookies', 1); // Utiliza apenas cookies para armazenar o ID da sessão

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

    // Use prepared statements
    $stmt = $mysqli->prepare("SELECT id, senha FROM user_db WHERE nome = ?");
    $stmt->bind_param('s', $nome); // 's' significa que o parâmetro é uma string
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $senha_hash = $row['senha'];
        
        if(password_verify($password, $senha_hash)){
            $_SESSION['id'] = $row['id']; // Armazena o ID do usuário na sessão
            header("location: crudTarefas.php");
            exit();
        } else {
            echo "<p>Nome ou senha incorretos!</p>";
        }
    } else {
        echo "<p>Nome ou senha incorretos!</p>";
    }
    $stmt->close(); // Feche a declaração
}

$mysqli->close();
?>
