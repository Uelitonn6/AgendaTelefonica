<?php

    class User extends Connection {
        public object $conn;
        public array $formData;
        public int $id;

        public function list() : array {
            $this->conn = $this->connectDB(); //Conexao com DB
            
            $query_users = "SELECT id, name, telefhone FROM users ORDER BY id DESC LIMIT 40";
            $result_users = $this->conn->prepare($query_users); //Preparando a Query 
            $result_users->execute(); //executando a Query

            $date = $result_users->fetchAll(); //Retorna um array com todos os dados da Query

            return $date;
        }

        public function create() : bool {
            $this->conn = $this->connectDB(); //Conexao com DB

            $query_user = "INSERT INTO users (name, telefhone, created) VALUES (:name, :telefhone, NOW())";
            $add_user = $this->conn->prepare($query_user);

            $add_user->bindParam(':name', $this->formData['name']); //Definir o valor do parametro.
            $add_user->bindParam(':telefhone', $this->formData['telefhone']);
            $add_user->execute();

            // Verificar se foi cadastrado
            if($add_user->rowCount()) {
                return true;
            } else {
                return false;
            }
        }

        public function view() : array {
            $this->conn = $this->connectDB(); //Conexao com DB

            $query_user = "SELECT id, name, telefhone, created, modified FROM users
             WHERE id =:id LIMIT 1";

            $result_user = $this->conn->prepare($query_user);
            $result_user->bindParam(':id', $this->id);
            $result_user->execute();

            $value = $result_user->fetch(); //Retorna um unico registro

            return $value;
        }

        public function edit() : bool {
            $this->conn = $this->connectDB();

            $query_user = "UPDATE users SET name=:name, telefhone=:telefhone, modified=NOW() 
            WHERE id=:id";
            $edit_user = $this->conn->prepare($query_user); //Preparar Query
            $edit_user->bindParam(':name', $this->formData['name']); //Substituir valores
            $edit_user->bindParam(':telefhone', $this->formData['telefhone']);
            $edit_user->bindParam(':id', $this->formData['id']);

            $edit_user->execute();

            //Foi editado?
            if($edit_user->rowCount()) { //Contar quantidade de linhas
                return true;
            } else {
                return false;
            }
        }

        public function delete() : bool {
            $this->conn = $this->connectDB();

            $query_user = "DELETE FROM users WHERE id=:id LIMIT 1";
            $delete_user = $this->conn->prepare($query_user);
            $delete_user->bindParam(':id', $this->id);
            $value = $delete_user->execute();

            return $value;
        }
    }