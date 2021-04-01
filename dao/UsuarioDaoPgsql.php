<?php

include 'database.php';
require_once 'models/Usuario.php';

class UsuarioDaoPgsql implements UsuarioDAO{
    private $pdo;

    public function __construct(PDO $driver){
        $this->pdo = $driver;
    }

    public function addUsuario(Usuario $u){
        $sql = $this->pdo->prepare("INSERT INTO usuarios (nome, email, senha, nivel_acesso, ativo, telefone) VALUES
            (:nome,:email,:senha,:nivel_acesso,:ativo, :telefone)");
            $sql->bindValue(":nome", $u->getNome());
            $sql->bindValue(":email", $u->getEmail());
            $sql->bindValue(":senha", $u->getSenha());
            $sql->bindValue(":telefone", $u->getTelefone());
            $sql->bindValue(":nivel_acesso", $u->getAcesso());
            $sql->bindValue(":ativo", $u->getAtivo());
            
            if($sql->execute()){
                return true;
            }else{
                return false;
            }
    }

    public function buscarPeloId($id){
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE id_usuario = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0 ){
            $linha = $sql->fetch(PDO::FETCH_ASSOC);

            $u = New Usuario();
            $u->setNome($linha['nome']);
            $u->setEmail($linha['email']);
            $u->setAtivo($linha['ativo']);
            $u->setAcesso($linha['nivel_acesso']);
            $u->setTelefone($linha['telefone']);

            return $u;
        }else{
            return false;
        }
    }

    public function buscarLogin(Usuario $u){
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND ativo = true");
        $sql->bindValue(":email", $u->getEmail());
        $sql->execute();

        if($sql->rowCount() > 0 ){
            $linha = $sql->fetch(PDO::FETCH_ASSOC);
            $u = New Usuario();
            $u->setID($linha['id_usuario']);
            $u->setSenha($linha['senha']);
            $u->setAcesso($linha['nivel_acesso']);
            return $u;
        }else{
            return false;
        }
    }

    public function buscarConsulta(){
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE ativo = true;");
        $sql->execute();

        if($sql->rowCount() > 0 ){
            $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
  
            foreach($lista as $item){
                $u = New Usuario();
                $u->setID($item['id_usuario']);
                $u->setNome($item['nome']);
                $u->setEmail($item['email']);
                $u->setAcesso($item['nivel_acesso']);
                $u->setTelefone($item['telefone']);

                $array[] = $u;
            }
            return $array;
        }else{
            return false;
        }
    }

    public function editar(Usuario $u){
        $sql = $this->pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, telefone = :telefone  WHERE id_usuario = :id");
        $sql->bindValue(":nome", $u->getNome());
        $sql->bindValue(":email", $u->getEmail());
        $sql->bindValue(":telefone", $u->getTelefone());
        $sql->bindValue(":id", $u->getID());
        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function buscarEmail($email){
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $sql->bindValue(":email", $email);
        $sql->execute();

        if($sql->rowCount() > 0){
            $linha = $sql->fetch(PDO::FETCH_ASSOC);
            return $linha['id_usuario'];
        }else{
            return false;
        }
    }

    public function deletar($id){
        $sql = $this->pdo->prepare("UPDATE usuarios SET ativo = false WHERE id_usuario = :id");
        $sql->bindValue(":id", $id);

        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function buscarPeloNome($nome){
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE nome = :nome");
        $sql->bindValue(":nome", $nome);
        $sql->execute();

        if($sql->rowCount() > 0){
            $linha = $sql->fetch(PDO::FETCH_ASSOC);
            return $linha['id_usuario'];
        }else{
            return false;
        }
    }

}