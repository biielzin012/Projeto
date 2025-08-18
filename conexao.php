<?php
class BancoDeDados {
$servername = "localhost"; 
$username = "root";  
$password = "";    
$dbname = "meuprojeto"; 
    public function obterConexao() {
        $this->conexao = null;
        try {
            $this->conexao = new PDO("mysql:host={$this->host};port=49160;dbname={$this->nome_banco}", $this->usuario, $this->senha);
            $this->conexao->exec("set names utf8");
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $excecao) {
            echo "Erro de conexão: " . $excecao->getMessage();
            return null;
        }
        return $this->conexao;
    }
}
?>
