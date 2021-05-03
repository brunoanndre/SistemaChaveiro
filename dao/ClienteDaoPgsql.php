<?php

    include 'database.php';
    require_once 'models/Cliente.php';


    class ClienteDaoPgSql implements ClienteDAO{
        private $pdo;

        public function __construct(PDO $driver){
            $this->pdo = $driver;
        }

        public function adicionar(Cliente $c){
            $sql = $this->pdo->prepare("INSERT INTO clientes (idtipo, idendereco, nome, telefone, email, cpf, cnpj, status) VALUES
            (:tipo, :endereco, :nome, :telefone, :email, :cpf, :cnpj, :status)");
            $sql->bindValue(":tipo", $c->getIdTipo());
            $sql->bindValue(":nome", $c->getNome());
            $sql->bindValue(":telefone", $c->getTelefone());
            $sql->bindValue(":email", $c->getEmail());
            $sql->bindValue(":cpf", $c->getCPF());
            $sql->bindValue(":cnpj", $c->getCNPJ());
            $sql->bindValue(":endereco", $c->getIdEndereco());
            $sql->bindValue(":status", $c->getStatus());
            
            if($sql->execute()){
                return true;
            }else{
                return false;
            }
        }


        public function editar(Cliente $c){
            $sql = $this->pdo->prepare("UPDATE clientes SET nome = :nome, idtipo = :tipo, idendereco = :endereco, telefone = :telefone, email = :email, cpf = :cpf, cnpj = :cnpj WHERE id = :id");
            $sql->bindValue(":nome", $c->getNome());
            $sql->bindValue(":tipo", $c->getIdTipo());
            $sql->bindValue(":endereco", $c->getIdEndereco());
            $sql->bindValue(":telefone", $c->getTelefone());
            $sql->bindValue(":email", $c->getEmail());
            $sql->bindValue(":cpf", $c->getCPF());
            $sql->bindValue(":cnpj", $c->getCNPJ());
            $sql->bindValue(":id", $c->getId());

            if($sql->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function remover($id){
            
        }

        public function buscarPeloId($id){
            $sql = $this->pdo->prepare("SELECT * FROM clientes WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();

            if($sql->rowCount() > 0 ){
                $linha = $sql->fetch(PDO::FETCH_ASSOC);

                $c = New Cliente();
                $c->setIdTipo($linha['idtipo']);
                $c->setIdEndereco($linha['idendereco']);
                $c->setNome($linha['nome']);
                $c->setTelefone($linha['telefone']);
                $c->setEmail($linha['email']);
                $c->setCPF($linha['cpf']);
                $c->setCNPJ($linha['cnpj']);
                $c->setHistorico($linha['historico']);

                return $c;
            }else{
                return false;
            }

        }

        public function buscarPeloNome($nome){
            $sql = $this->pdo->prepare("SELECT * FROM clientes WHERE nome = :nome");
            $sql->bindValue(":nome", $nome);
            $sql->execute();

            if($sql->rowCount() > 0){
                $linha = $sql->fetch(PDO::FETCH_ASSOC);
                return $linha['id'];
            }else{
                return false;
            }
        }

        public function buscarHistorico($id){
            $sql = $this->pdo->prepare("SELECT historico FROM clientes WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();

            $linha = $sql->fetch(PDO::FETCH_ASSOC);

            return $linha['historico'];
        }

        public function atualizarHistorico($id_comanda,$id){
            $sql = $this->pdo->prepare("UPDATE clientes SET historico = :historico WHERE id = :id");
            $sql->bindValue(":historico", $id_comanda);
            $sql->bindValue(":id", $id);

            if($sql->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function buscarConsulta($parametro){

            if($parametro == 'todos'){

                $sql = $this->pdo->prepare("SELECT * FROM clientes ORDER BY id");
                $sql->execute();

                if($sql->rowCount() > 0){
                    $listaClientes = $sql->fetchAll(PDO::FETCH_ASSOC);

                    foreach($listaClientes as $item){
                        $c = New Cliente();
                        $c->setId($item['id']);
                        $c->setNome($item['nome']);
                        $c->setIdTipo($item['idtipo']);

                        $array[] = $c;
                    }
                    return $array;
                }else{
                    return false;
                    die;
                }
            }
        }

        public function mostrarResultado($value){
            $sql = $this->pdo->prepare("SELECT nome, status FROM clientes WHERE nome ILIKE '$value%' AND status = 'true' ");
            $sql->execute();

            if($sql->rowCount() > 0 ){
                $listaClientes = $sql->fetchAll(PDO::FETCH_ASSOC);

                foreach($listaClientes as $item){
                    $c = New Cliente();
                    $c->setNome($item['nome']);

                    $array[] = $c;
                }
                return $array;
            }else{
                return false;
            }
        }

        public function adicionarPeloModal(Cliente $c){
            $sql = $this->pdo->prepare("INSERT INTO clientes (idtipo, idendereco, nome, telefone, email, cpf, cnpj, status) VALUES
            (:tipo, :endereco, :nome, :telefone, :email, :cpf, :cnpj, :status)");
            $sql->bindValue(":tipo", $c->getIdTipo());
            $sql->bindValue(":nome", $c->getNome());
            $sql->bindValue(":telefone", $c->getTelefone());
            $sql->bindValue(":email", $c->getEmail());
            $sql->bindValue(":cpf", $c->getCPF());
            $sql->bindValue(":cnpj", $c->getCNPJ());
            $sql->bindValue(":endereco", $c->getIdEndereco());
            $sql->bindValue(":status", $c->getStatus());
            
            if($sql->execute()){
                $id = $this->pdo->lastInsertId();
                return $id;
            }else{
                return false;
            }
        }
    }