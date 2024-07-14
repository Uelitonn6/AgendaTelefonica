<?php

    abstract class Connection {
        public string $database = "mysql";
        public string $host = "localhost";
        public string $user = "root";
        public string $pass = "";
        public string $databaseName = "agendatelefonica";
        public int $port = 3306;

        public object $connect;

        public function connectDB() {
            
            try {

                $this->connect = new PDO($this->database . ':host=' . $this->host . ';port=' . $this->port . ';dbname=' .
                $this->databaseName, $this->user, $this->pass);

                return $this->connect;
            }catch (Exception $err) {

                die('Erro: Por favor tente novamente. Caso o problema persista,
                    entre em contato com o administrador adm@agendaTelefonica.com');
            }
        }
    }