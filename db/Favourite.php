<?php

    class Favourite{

        protected $queryHandler;

        public function __construct(QueryHandler $queryHandler)
        {
            $this->queryHandler = $queryHandler;
        }

        private function getUserData()
        {
            if(isset($_COOKIE['id']))
            {
                $user_data=$_COOKIE['id'];
            }
            elseif(isset($_SESSION["user_id"]))
            {
                $user_data=$_SESSION["user_id"];
            }

            return $user_data;
        }

        private function getFav($product)
        {
            $fav = $this->queryHandler->runQuery("SELECT u.id FROM users u INNER JOIN user_favourites uf USING(user_id) WHERE uf.favourite=? AND user_id=?", array($product,$this->getUserData()));
            return $fav;
        }

        public function addFav($product)
        {
            if(count($this->getFav($product))==0)
            {
                $this->queryHandler->runQuery("INSERT INTO user_favourites(favourite,user_id) VALUES(?,?)", array($product,$this->getUserData()));
            }
        }

        public function removeFav($product)
        {
            if(count($this->getFav($product))!=0)
            {
                $this->queryHandler->runQuery("DELETE FROM user_favourites WHERE favourite=? AND user_id=?", array($product,$this->getUserData()));
            }
        }
    }
    
?>