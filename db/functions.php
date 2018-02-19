<?php
    
    require_once 'setup.php';

    function enquire($name, $email, $message, $config, $mail)
    {
        $name=sanitize($name);
        $email=sanitize($email);
        $message=sanitize($message);

        $error=isValid($name,$message,compact('email'));

        if(trim($error)=='')
        {
            $subject="Received an enquiry";
            $error = notify($name,$email,$config,$subject,$mail);
        }
        return $error;
    }

    function sanitize($item)
    {
        return trim(htmlspecialchars(stripslashes($item)));
    }

    function isValid($name,$text,$contact)
    {
        extract($contact);
        $error='';

        $nameValidate=new Validator($name,'name');
        $error.="\n".$nameValidate->validate();
        
        $textValidate=new Validator($text,'text');
        $error.="\n".$textValidate->validate();

        if(isset($email))
        {
            $emailValidate=new Validator($email,'email');
            $error.="\n".$emailValidate->validate();
        }
        if(isset($phone))
        {
            $phoneValidate=new Validator($phone,'phone');
            $error.="\n".$phoneValidate->validate();
        }
        return $error;
    }

    
    function saveDetails($name,$phone,$amt,$notes,$config,$mail)
    {
        $cart_data=App::get('database')->runQuery("SELECT * FROM cart WHERE user_data=?",array($_SESSION["user_id"]));
        if(count($cart_data)==0)
        {
            throw new Exception("Something went wrong");
        }
        $name=sanitize($name);
        $phone=sanitize($phone);
        $notes=sanitize($notes);

        $notes=($notes=="")?"No notes":$notes;

        $error=isValid($name,$notes,compact('phone'));
        
        if(trim($error)=='')
        {
            $body='';
            App::get('database')->runQuery("INSERT INTO orders(cust_name,phone,amount,notes) VALUES(?,?,?,?);",array($name,$phone,$amt,$notes));
            $id=App::get('database')->runQuery("SELECT id FROM orders ORDER BY id DESC LIMIT 1");
            //check if session is active
            
            foreach($cart_data as $item)
            {
                App::get('database')->runQuery("INSERT INTO orderproducts(order_id,product_id,feature_id,quantity) VALUES(?,?,?,?)",array($id[0]['id'],$item['product_id'],$item['feature_id'],$item['quantity']));
                App::get('database')->runQuery("DELETE FROM cart WHERE id=?",array($item['id']));
                $body.="<br>Product id : ".$item['product_id']." Feature id : ".$item['feature_id']." * ".$item['quantity'];
            }
            $body.='<br><br>Total amount: Rs. '.$amt;
            $subject="Received an order";
            return notify($name,$phone,$config,$subject,$mail,$body);;
        }
        return $error;
    }
    
    function notify($name, $contact,$config,$subject,$mail,$body="")
    {
        //$mail->SMTPDebug = 2;
        $mail->IsSMTP();
        $mail->Host=$config['host'];
        $mail->SMTPAuth=$config['SMTPAuth'];
        $mail->Username=$config['username'];
        $mail->Password=$config['password'];

        $mail->SMTPSecure=$config["smtpSecure"];
        $mail->Port=$config["port"];
        $mail->SMTPAutoTLS = false;

        $mail->SMTPOptions = $config["SMTPOptions"];

        $mail->From = $config['from'];
        $mail->FromName=$config['fromName'];
        
        $mail->setFrom($config['from'], $config['fromName']);
        $mail->addAddress($config['addAddress']["email"],$config['addAddress']['name']);
        $mail->WordWrap=$config['wordWrap'];
        
        $mail->IsHTML(true);
        $mail->Subject=$subject;
        $mail->Body="Hi!<br><br>Customer name :$name.<br>Contact :$contact.<br>".$body;
        
        try
        {
            // $mail->Send();
            // return "";
            if(!$mail->Send()) {
                return "Mailer Error: " . $mail->ErrorInfo;
              } else {
                return "";
              }
        }
        catch (phpmailerException $e) 
        {
            return $e->errorMessage(); 
        }
        catch (Exception $e)
        {
            return $e->getMessage();
        }
    }

?>
