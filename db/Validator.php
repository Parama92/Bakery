<?php

    class Validator
    {
        protected $item;
        protected $field;

        function __construct($item,$field)
        {
            $this->item=$item;
            $this->field=$field;
        }

        function validate()
        {
            $method="validate".ucfirst($this->field);
            if(method_exists($this,$method))
            {
                return $this->$method();
            }
            else
            {
                throw new Exception("Invalid field $this->field");
            }
        }

        function validatePhone()
        {
            $nums=preg_replace("/[+\s]/","",$this->item);
            if(preg_match("/\D|[0-9]{14,}/",$nums))
            {
                return "Invalid phone number!";
            }
            return "";
        }

        function validateName()
        {
            if(strlen($this->item)<1)
            {
                return "Name cannot be empty!";
            }
            else if(preg_match("/[^a-zA-Z0-9\-\_\'\s]/",$this->item))
            {
                return "Invalid characters in name!";
            }
            return "";
        }

        function validateText()
        {
            return strlen($this->item)<4?"Not enough information provided!":"";
        }

        function validateEmail()
        {
            $email = filter_var($this->item, FILTER_SANITIZE_EMAIL);
            
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) 
            {
                return "Invalid email address";
            }
        }

        function getItem()
        {
            return $this->item;
        }
    }
?>