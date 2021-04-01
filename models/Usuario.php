<?php


class Usuario{
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $nivel_acesso;
    private $ativo;
    private $telefone;

    public function getID(){
        return $this->id;
    }
    public function setID($id){
        $this->id = trim($id);
    }

    public function getNome(){
        return $this->nome;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = strtolower(trim($email));
    }

    public function getSenha(){
        return $this->senha;
    }
    public function setSenha($senha){
        $this->senha = trim($senha);
    }

    public function getAcesso(){
        return $this->nivel_acesso;
    }
    public function setAcesso($acesso){
        $this->nivel_acesso = trim($acesso);
    }

    public function getAtivo(){
        return $this->ativo;
    }
    public function setAtivo($ativo){
        $this->ativo = trim($ativo);
    }

    public function getTelefone(){
        return $this->telefone;
    }
    public function setTelefone($telefone){
        $this->telefone = trim($telefone);
    }
}

interface UsuarioDAO{
    public function addUsuario(Usuario $u);
    public function buscarPeloId($id);
    public function buscarLogin(Usuario $u);
    public function buscarPeloNome($nome);
    public function buscarEmail($email);
    public function buscarConsulta();
    public function editar(Usuario $u);
    public function deletar($id);
}