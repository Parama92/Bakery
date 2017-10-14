<?php

    class QueryHandler 
    {

        private $result,$conn;
        function __construct($conn) 
        {
            $this->conn=$conn;
        }
        function runQuery($query)
        {
        
            $statement=$this->conn->prepare($query);
            $statement->execute();

            $this->result=$statement->fetchAll();
            return $this->result;
        }
    }

?>