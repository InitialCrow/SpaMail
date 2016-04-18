<?php

class Migration_ficher extends CI_Migration {
    private $servername = 'localhost';
    private $username = 'root';
    private $password = NULL;
    private $dbname = 'mailing_kertios';
    private $sql = NULL;

    public function up() {
        try {

            $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            //set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            //sql to create the activity registered table

            /*$sql = 'CREATE TABLE ficher (

                exemple for syntax
                Activity_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                participant_id INT(6) FOREIGN KEY (participant_id) REFERENCES participants,
                entry_number INT(2),
                recorded_result INT(6),
                entry_date TIMESTAMP


                 request here

            )';*/

            $this->sql = 'CREATE TABLE fichier (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                mail_id INT(11) UNSIGNED,
                fichier_uri VARCHAR(150) NOT NULL,
                CONSTRAINT fichier_mail_id_mail_foreign FOREIGN KEY (mail_id) REFERENCES mail (id) ON delete CASCADE

               

            )';

            //use exec() because no results are returned
            $conn->exec($this->sql);
            echo "Table Activity Recorder created successfully \n";
        }
        catch(PDOException $e){
            echo $this->sql . $e->getMessage();
        }

        $conn = null;
    }

    public function down() {
        $this->sql= $conn->prepare("DROP TABLE ficher");
        $conn->exec($this->sql);
    }

}