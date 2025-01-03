<?php
include_once 'objetos.php'; // Carrega a classe de conexão e objetos

session_start(); // Inicia a sessão para armazenar dados do usuário


class registerProspec extends SITE_ADMIN
{
    public function updateProspec($nome,
    $endereco, 
    $maps, 
    $contato, 
    $telefone, 
    $email,
    $data,
    $status,
    $obs,
    $id)
    {
        try {
            // Cria conexão com o banco de dados
            if (!$this->pdo) {
                $this->conexao();
            }

            $result = $this->updateProspecInfo($nome,
            $endereco, 
            $maps, 
            $contato, 
            $telefone, 
            $email,
            $data,
            $status,
            $obs,
            $id);

            echo "Cliente atualizado com sucesso.";
                                      
        } catch (PDOException $e) {  
            echo "ERRO: Não foi possível atualizar o Cliente.";
        } 
    }
}

// Processa a requisição POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    
    $nome = $_POST['nome']; 
    $endereco = $_POST['endereco']; 
    $maps = $_POST['maps']; 
    $contato = $_POST['contato']; 
    $telefone = $_POST['telefone']; 
    $email = $_POST['email']; 
    $data = $_POST['data']; 
    $status = $_POST['status'];  
    $obs = $_POST['obs'];
    $id = $_POST['id'];
    $registerProspec = new registerProspec();
    
    $result = $registerProspec->updateProspec($nome,
        $endereco, 
        $maps, 
        $contato, 
        $telefone, 
        $email,
        $data,
        $status,
        $obs,
        $id
    );
}
?>
