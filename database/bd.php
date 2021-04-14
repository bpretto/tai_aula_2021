<?php

class bd {

    private $bd_tipo = "mysql";
    private $bd_host = "localhost";
    private $bd_nome = "db_tai_aula_2021";
    private $bd_porta = "3306";
    private $bd_usuario = "root";
    private $bd_senha = "";
    private $bd_charset = "utf8mb4";

    public function connection()
    {
        $str_conn = $this->bd_tipo . ":host=" . $this->bd_host .
            ";dbname=" . $this->bd_nome . ";port=" . $this->bd_porta;

        return new PDO(
            $str_conn,
            $this->bd_usuario,
            $this->bd_senha,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . $this->bd_charset)
        );
    }

    public function select()
    {
        $conn = $this->connection();

        $stmt = $conn->prepare("select * from tb_usuario");

        $stmt->execute();

        return $stmt;
    }

    public function find($id)
    {
        $conn = $this->connection();

        $stmt = $conn->prepare("SELECT * FROM tb_usuario WHERE id = ?;");

        $stmt->execute([$id]);

        return $stmt->fetchObject();
    }

    public function update($dados)
    {
        $id = $dados['id'];
        $sql = "UPDATE tb_usuario SET ";

        $flag = 0;
        $arrayValor = [];
        foreach ($dados as $campo => $valor) {

            if ($flag == 0) {
                $sql .= " $campo = ?";
            } else {
                $sql .= ", $campo = ?";
            }
            $flag = 1;
            $arrayValor[] = $valor;
        }

        $sql .= " WHERE id = $id;";

        $conn = $this->connection();
     $stmt = $conn->prepare($sql);

        $stmt->execute($arrayValor);

        return $stmt;
    }
    public function insert($dados)
    {
        unset($dados['id']);
        $sql = "INSERT INTO tb_usuario (nome, telefone, cpf) VALUES (";

        $flag = 0;
        $arrayValor = [];
        foreach ($dados as $valor) {

            if ($flag == 0) {
                $sql .= " ?";
            } else {
                $sql .= ", ?";
            }
            $flag = 1;
            $arrayValor[] = $valor;
        }
        $sql .= ");";
        $conn = $this->connection();
        $stmt = $conn->prepare($sql);

        $stmt->execute($arrayValor);

        return $stmt;
    }
        public function remove ($id)
    {
        $conn = $this->connection();

        $stmt = $conn->prepare("DELETE FROM tb_usuario WHERE id = ?;");

        $stmt->execute([$id]);

        return $stmt;
    }

    public function search($dados)
    {
        $conn = $this->connection();
        $campo = $dados['tipo'];

        $stmt = $conn->prepare("SELECT * FROM tb_usuario WHERE $campo like ?;");

        $stmt->execute(["%" . $dados['valor'] . "%"]);

        return $stmt;
    }
    
    
}