<?php

class Comanda{
    private $id;
    private $dataInicial;
    private $dataFinal;
    private $descricao;
    private $material1;
    private $material2;
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

    public function getMaterial1(){
        return $this->material1;
    }
    public function setMaterial1($material1){
        $this->material1 = trim($material1);
    }

    public function getMaterial2(){
        return $this->material2;
    }
    public function setMaterial2($material2){
        $this->material2 = trim($material2);
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
}