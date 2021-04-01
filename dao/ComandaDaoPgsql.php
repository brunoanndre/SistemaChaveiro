<?php

    include 'database.php';
    require_once 'models/Comanda.php';

    class ComandaDaoPgSql implements ComandaDAO{
        private $pdo;
        
        public function __construct(PDO $driver){
            $this->pdo = $driver;
        }

        public function cadastrar(Comanda $c){

        }

        public function editar(Comanda $c){
            
        }

        public function cancelar(Comanda $c){
            
        }

        public function encerrar(Comanda $c){
            
        }

    }