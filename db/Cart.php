<?php

    class Cart{

        protected $user_data, $db;

        function __construct($db)
        {
            if(isset($_COOKIE['id']))
            {
                $this->user_data=$_COOKIE['id'];
            }
            elseif(isset($_SESSION["user_id"]))
            {
                $this->user_data=$_SESSION["user_id"];
            }
            else{
                throw new Error('Error in session and cookies');
            }

            $this->db = $db;
        }

        public function addToCart($pid, $fid)
        {
            $cart_check=$this->db->runQuery("SELECT id,quantity FROM cart WHERE product_id=? AND feature_id=? AND user_data=?;",array($pid,$fid,$this->user_data));
            if(count($cart_check)==0)
            {
                $this->db->runQuery("INSERT INTO cart (product_id,feature_id,user_data) VALUES (?,?,?);",array($pid,$fid,$this->user_data));
            }
            else
            {
                $row= $cart_check[0];
                $this->db->runQuery("UPDATE cart SET quantity=".($row['quantity']+1)." WHERE id={$row['id']};");
            }
        }

        public function changeCart($cid,$quant) 
        {
            $cart_search=$this->db->runQuery("SELECT id FROM cart WHERE id=?;",array($cid));
            
            if(count($cart_search)==0)
            {
                header("location: ../error.php?error='unknown'");
            }
            else
            {
                if($quant==0)
                    $this->db->runQuery("DELETE FROM cart WHERE id=?;",array($cid));
                else
                {
                    $this->db->runQuery("UPDATE cart SET quantity=? WHERE id=?;",array($quant,$cid));
                }
            }
        }
    }

?>