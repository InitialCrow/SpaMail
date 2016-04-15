<?php
include_once './vendor/autoload.php';
class utilisateurTableSeeder {
    private $servername = 'localhost';
    private $username = 'root';
    private $password = NULL;
    private $dbname = 'mailing_kertios';
    private $stmt = NULL;
    private $table = 'utilisateur';

    public function run() {
        

        $faker = Faker\Factory::create();
        try {

            $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            //set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $conn->prepare("TRUNCATE TABLE $this->table");
            $sql->execute();
            $this->stmt =  $conn->prepare("INSERT INTO $this->table (identifiant, mdp) VALUES (:identifiant, :mdp)");
            $id = "adam";
            $mdp="1996";
            $this->stmt->bindParam(':identifiant', $id, PDO::PARAM_STR);
            $this->stmt->bindParam(':mdp', $mdp, PDO::PARAM_STR);
            if($this->stmt->execute()) {
                    echo "1 row has been inserted\n"; 
                    
                }  

            for($i=0;$i<3; $i++){
                $this->stmt =  $conn->prepare("INSERT INTO $this->table (identifiant, mdp) VALUES (:identifiant, :mdp)");
                $id = $faker->name;
                $mdp="1234";
                $this->stmt->bindParam(':identifiant', $id, PDO::PARAM_STR);
                $this->stmt->bindParam(':mdp', $mdp, PDO::PARAM_STR);
                
                if($this->stmt->execute()) {
                    echo "1 row has been inserted \n"; 

                    
                }  
            }
            
           

            

            $conn = null;
         
           
        }   
        catch(PDOException $e){
            echo $this->stmt . $e->getMessage();
        }
    }

}
$buffer = new utilisateurTableSeeder();
$buffer->run();
