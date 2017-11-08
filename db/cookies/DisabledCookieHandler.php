<?php

    class DisabledCookieHandler extends NewCookieHandler{

        function setUserId()
        {   
            $this->user_id="u".$this->id->getId();
        }
        
    }
?>