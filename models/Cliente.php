<?php

class Cliente{
    private $id;
    private $idTipo;
    private $idEndereco;
    private $cpf;
    private $cnpj;
    private $nome;
    private $telefone;
    private $email;
    private $historico;
    private $status;

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = trim($id);
    }

    public function getIdTipo(){
        return $this->idTipo;
    }
    public function setIdTipo($idTipo){
        $this->idTipo = trim($idTipo);
    }

    public function getIdEndereco(){
        return $this->idEndereco;
    }
    public function setIdEndereco($idEndereco){
        $this->idEndereco = trim($idEndereco);
    }

    public function getCPF(){
        return $this->cpf;
    }

    public function setCPF($cpf){
        $this->cpf = trim($cpf);
    }

    public function getCNPJ(){
        return $this->cnpj;
    }
    public function setCNPJ($cnpj){
        $this->cnpj = trim($cnpj);
    }

    public function getNome(){
        return $this->nome;
    }
    public function setNome($nome){
        $this->nome = ucwords(trim($nome));
    }

    public function getTelefone(){
        return $this->telefone;
    }
    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }

    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = trim($email);
    }

    public function getHistorico(){
        return $this->historico;
    }
    public function setHistorico($historico){
        $this->historico = $historico;
    }

    public function getStatus(){
        return $this->status;
    }
    public function setStatus($status){
        $this->status = trim($status);
    }
}

interface ClienteDAO{
    public function adicionar(Cliente $c);
    public function adicionarPeloModal(Cliente $c);
    public function editar(Cliente $c);
    public function buscarConsulta($parametro);
    public function remover($id);
    public function buscarPeloNome($nome);
    public function buscarPeloId($id);
    public function atualizarHistorico($id_comanda,$id);
    public function mostrarResultado($value);
    public function buscarHistorico($id);
}