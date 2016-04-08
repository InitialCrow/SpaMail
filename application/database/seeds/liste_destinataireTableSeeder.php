<?php

class liste_destinataireTableSeeder {
    private $servername = 'localhost';
    private $username = 'root';
    private $password = NULL;
    private $dbname = 'mailing_kertios';
    private $stmt = NULL;
    private $table = 'users';

    public function run() {
        


        try {

            $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            //set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = $conn->prepare("TRUNCATE TABLE $this->table");
            $sql->execute();
            $this->stmt =  $conn->prepare("INSERT INTO $this->table (..,..) VALUES (:.., :.., :.., :..)");
           
            $this->stmt->bindParam(':..', $.., PDO::PARAM_STR);

            if($this->stmt->execute()) {
              echo "1 row has been inserted \n ";  
            }

            $conn = null;
         
           
        }   
        catch(PDOException $e){
            echo $e;
        }
    }

}
$buffer = new liste_destinataireTableSeeder();
$buffer->run();
