<?php

session_start();

$host = 'localhost'; 
$db   = 'nome_do_banco'; 
$user = 'seu_usuario'; 
$pass = 'sua_senha'; 

$conn = new mysqli($host, $user, $pass, $db);


if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirma_senha = $_POST['senha']; 
    $datanascimento = $_POST['datanascimento'];
    $estadocivil = $_POST['estadocivil'];
    $sexo = $_POST['sexo'];

    
    $stmt = $conn->prepare("SELECT id, nome, senha FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        
        $usuario = $resultado->fetch_assoc();

        
        if (password_verify($senha, $usuario['senha'])) {
         
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            header("Location: painel.php");
            exit();
        } else {
          
            $erro = "Senha incorreta!";
        }
    } else {
        
        $erro = "Usuário não encontrado!";
    }

    $stmt->close();
}

$conn->close();
?>