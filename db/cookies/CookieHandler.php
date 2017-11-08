<?php

    abstract class CookieHandler{
        protected $user_id;

        static function getInstance()
        {
            if(!isset($_COOKIE['id']))
                return new NewCookieHandler(new IdGen());
            else
                return new OldCookieHandler();
        }

        function updateSession()
        {
            $_SESSION["user_id"]=$this->user_id;
        }

        abstract function setUserId();

        function doEssentials()
        {
            $this->setUserId();
            $this->updateSession();
        }
    }

?>