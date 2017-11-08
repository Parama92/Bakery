
<?php
    
    class IdGen 
    {
        private $id_val;
        function __construct() 
        {
            $this->id_val=$this->getLast()+1;
            $this->storeId();
        }
        function getId()
        {
            return "hb_".$this->id_val;
        }
        function getLast()
        {
            $id= App::get('database')->runQuery("SELECT id FROM users ORDER BY id DESC LIMIT 1;");
            $id=$id[0];
            return (isset($id['id']))? $id['id'] : 0;
        }
        function storeId()
        {
            App::get('database')->runQuery("INSERT INTO users (id) VALUES (?);",array($this->id_val));
        }
        function storeUserId($save)
        {
            App::get('database')->runQuery("INSERT INTO users (user_id) VALUES (?);",array($save));
        }
    }
?>