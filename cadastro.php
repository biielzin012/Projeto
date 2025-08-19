<?php

include 'conexao.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'enviar') {

    $bancoDeDados = new BancoDeDados(); 
    $conn = $bancoDeDados->obterConexao(); 
    
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirma_senha = $_POST['senha']; 
    $datanascimento = $_POST['datanascimento'];
    $estadocivil = $_POST['estadocivil'];
    $sexo = $_POST['sexo'];

  
    if ($senha !== $confirma_senha) {
        die("As senhas não coincidem!");
    }

 
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

  
    try {
        $sql = "INSERT INTO usuarios (nome, email, senha, datanascimento, estadocivil, sexo) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nome, $email, $senha_hash, $datanascimento, $estadocivil, $sexo]);
        
        echo "Cadastro realizado com sucesso!";
    } catch(PDOException $e) {
        echo "Erro ao cadastrar: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cadastro</title>
</head>
<body>
    <div class="container_form">
        <h1>Cadastra-se</h1>
    
        <form class="form" action="cadastro.php" method="post">
            
            <div class="form_grupo">
                <label for="nome" class="form_label">Nome</label>
                <input type="text" name="nome" class="form_input" id="nome" placeholder="Nome" required>
            </div>
            
            
            <div class="form_grupo">
                <label for="email" class="form_label">Email</label>
                <input type="email" name="email" class="form_input" id="email" placeholder="seuemail@email.com" required>
            </div>
    
            
            <div class="form_grupo">
                <label for="senha" class="form_label">Senha</label>
                <input type="password" name="senha" class="form_input" id="senha" placeholder="digite a senha" required>
            </div>
    
            
            <div class="form_grupo">
                <label for="confirmar_senha" class="form_label">Confirme sua Senha</label>
                <input type="password" name="confirmar_senha" class="form_input" id="confirmar_senha" placeholder="repita a senha" required>
            </div>
            
            
            <div class="form_grupo">
                <label for="datanascimento" class="form_label">Data de Nascimento</label>
                <input type="date" name="datanascimento" class="form_input" id="datanascimento" required>
            </div>        
    
           
            <div class="form_grupo">
                <label for="estadocivil" class="text">Estado civil</label>
                <select name="estadocivil" class="dropdown" required>
                    <option selected disabled class="form_select_option" value="">Selecione</option>
                    <option value="Solteiro" class="form_select_option">Solteiro(a)</option>
                    <option value="Casado" class="form_select_option">Casado(a)</option>
                    <option value="Divorciado" class="form_select_option">Divorciado(a)</option>
                    <option value="Viúvo" class="form_select_option">Viúvo(a)</option>
                </select>
            </div>
    
          
            <div class="form_grupo">
                <span class="legenda">Sexo:</span>
                <div class="radio-btn">
                    <input type="radio" class="form_new_input" id="masculino" name="sexo" value="Masculino" required>
                    <label for="masculino" class="radio_label form_label"> <span class="radio_new_btn"></span> Masculino</label>
                </div>
                <div class="radio-btn">
                    <input type="radio" class="form_new_input" id="feminino" name="sexo" value="Feminino" required>
                    <label for="feminino" class="radio_label form_label"> <span class="radio_new_btn"></span> Feminino</label>
                </div>
            </div>
          
            
            <div class="submit">
                <input type="hidden" name="acao" value="enviar">
                <button type="submit" name="Submit" class="submit_btn">Cadastrar</button>
                <button type="button" onclick="window.location.href='index.html'" class="submit_btn">Cancelar</button>
            </div>
        </form>
    </div>
</body>
</html>

