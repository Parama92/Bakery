<?php

    class QueryHandler 
    {

        private $result,$conn;
        function __construct($conn) 
        {
            $this->conn=$conn;
        }
        function runQuery($query,$data=[])
        {
        
            $statement=$this->conn->prepare($query);
            $statement->execute($data);

            $this->result=$statement->fetchAll();
            return $this->result;
        }
    }

?>