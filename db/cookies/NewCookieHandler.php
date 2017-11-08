<?php

    class NewCookieHandler extends CookieHandler implements UpdateUser{

        protected $id;

        function __construct(IdGen $id)
        {
            $this->id=$id;
        }
        function setUserId()
        {   
            $this->user_id="c".$this->id->getId();
            setcookie("id", $this->user_id, time()+3600*24*60);
        }
        function updateUserId()
        {
            $this->id->storeUserId($this->user_id);
        }
        function doEssentials()
        {
            parent::doEssentials();
            $this->updateUserId();
        }
    }

?>