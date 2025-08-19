<?php
class BancoDeDados {
    private $host = "localhost";
    private $usuario = "root";
    private $senha = "";
    private $nome_banco = "meuprojeto";
    private $porta = "49170"; 
    private $conexao;

    public function obterConexao() {
        $this->conexao = null;
        try {
            $dsn = "mysql:host={$this->host};port={$this->porta};dbname={$this->nome_banco}"; 
            $this->conexao = new PDO($dsn, $this->usuario, $this->senha);  
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
