<?php
    session_start();

    $_SESSION['timeout'] = time();
    
    if(($_SESSION['timeout']+60*10)<time())
    {
        session_destroy(); 
        header("Location: index.php");
    }
    /*$session_life = time() - $_SESSION['timeout'];

    if($session_life > $inactive)
    {  
        session_destroy(); 
        header("Location: index.php");     
    }

    $_SESSION['timeout']=time();*/
    
    require_once 'info.php';
    
    $connection=new Connect($host, $database);
    $conn=$connection->con();
    $qh= new QueryHandler($conn);

    function getConn()
    {
        global $connection;
        return $connection->con();
    }
    class Connect {

        private $host,$user,$password,$database;
        function __construct($host,$database,$user="root",$password="") {
            $this->host=$host;
            $this->user=$user;
            $this->password=$password;
            $this->database=$database;
        }
        function con(){
            return mysqli_connect($this->host, $this->user, $this->password, $this->database);//returns the connection object 
        }
    }
    class QueryHandler {

        private $result,$conn;
        function __construct($conn) {
            $this->conn=$conn;
        }
        function runQuery($query){
            $this->result=mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
            return $this->result;
        }
}
    class IdGen {
        
        static $id=0;
        private $id_val;
        function __construct() {
            $this->id_val="hb_".self::$id;
            self::$id++;
        }
        function getId()
        {
            return $this->id_val;
        }
    }
?>

