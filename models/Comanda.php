<?php

class Comanda{
    private $id;
    private $idEndereco;
    private $idUsuario1;
    private $idUsuario2;
    private $idCliente;
    private $idPagamento;
    private $dataInicial;
    private $dataFinal;
    private $descricao;
    private $materiais;
    private $tipo;
    private $prioridade;
    private $situacao;
    private $agendamento;
    private $previsaoChegada;

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = trim($id);
    }

    public function getIdPagamento(){
        return $this->idPagamento;
    }
    public function setIdPagamento($idPagamento){
        $this->idPagamento = trim($idPagamento);
    }

    public function getIdCliente(){
        return $this->idCliente;
    }
    public function setIdCliente($idCliente){
        $this->idCliente = trim($idCliente);
    }

    public function getIdUsuario2(){
        return $this->idUsuario2;
    }
    public function setIdUsuario2($idUsuario2){
        $this->idUsuario2 = trim($idUsuario2);
    }

    public function getIdUsuario1(){
        return $this->idUsuario1;
    }
    public function setIdUsuario1($idUsuario1){
        $this->idUsuario1 = trim($idUsuario1);
    }

    public function getIdEndereco(){
        return $this->idEndereco;
    }
    public function setIdEndereco($idEndereco){
        $this->idEndereco = trim($idEndereco);
    }

    public function getDataInicial(){
        return $this->dataInicial;
    }
    public function setDataInicial($dataInicial){
        $this->dataInicial = trim($dataInicial);
    }

    public function getDataFinal(){
        return $this->dataFinal;
    }
    public function setDataFinal($dataFinal){
        $this->dataFinal = trim($dataFinal);
    }

    public function getDescricao(){
        return $this->descricao;
    }
    public function setDescricao($descricao){
        $this->descricao = ucwords(trim($descricao));
    }

    public function getMateriais(){
        return $this->materiais;
    }
    public function setMateriais($materiais){
        $this->materiais = trim($materiais);
    }

    public function getTipo(){
        return $this->tipo;
    }
    public function setTipo($tipo){
        $this->tipo = trim($tipo);
    }

    public function getPrioridade(){
        return $this->prioridade;
    }
    public function setPrioridade($prioridade){
        $this->prioridade = trim($prioridade);
    }

    public function getSituacao(){
        return $this->situacao;
    }
    public function setSituacao($situacao){
        $this->situacao = trim($situacao);
    }

    public function getAgendamento(){
        return $this->agendamento;
    }
    public function setAgendamento($agendamento){
        $this->agendamento = trim($agendamento);
    }

    public function getPrevisaoChegada(){
        return $this->previsaoChegada;
    }
    public function setPrevisaoChegada($previsaoChegada){
        $this->previsaoChegada = trim($previsaoChegada);
    }
}

interface ComandaDAO{
    public function cadastrar(Comanda $c);
    public function editar(Comanda $c);
    public function cancelar(Comanda $c);
    public function encerrar(Comanda $c);
    public function buscarConsulta($parametro);
    public function buscarPeloId($id);
    public function buscarMateriais($id);
}