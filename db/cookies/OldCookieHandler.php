<?php

    class OldCookieHandler extends CookieHandler{

        function setUserId()
        {
            $this->user_id=$_COOKIE["id"];
        }
    }

?>