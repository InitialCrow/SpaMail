<?php

class Migration_adresse_log_envoi extends CI_Migration {
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

            /*$sql = 'CREATE TABLE adresse_log_envoi (

                exemple for syntax
                Activity_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                participant_id INT(6) FOREIGN KEY (participant_id) REFERENCES participants,
                entry_number INT(2),
                recorded_result INT(6),
                entry_date TIMESTAMP


                 request here

            )';*/

            $this->sql = 'CREATE TABLE adresse_log_envoi (

                adresse_id INT(11) UNSIGNED,
                log_envoi_id INT(11) UNSIGNED,
                CONSTRAINT adresse_log_envoi_adresse_id_adresse_foreign FOREIGN KEY (adresse_id) REFERENCES adresse (id) ON DELETE SET NULL,
                CONSTRAINT adresse_log_envoi_log_envoi_id_log_envoi_foreign FOREIGN KEY (log_envoi_id) REFERENCES log_envoi (id) ON DELETE SET NULL

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
        $this->sql= $conn->prepare("DROP TABLE adresse_log_envoi");
        $conn->exec($this->sql);
    }

}