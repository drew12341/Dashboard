<?php

class Migration_Sort_order extends CI_Migration {

    public function up() {

        //Update existing records
        $SQL = "Update indicators 
 set heading = '3_risk_management' where heading ='4_risk_management'";

        $this->db->query($SQL);

        //Update existing records
        $SQL = "Update indicators 
 set heading = '4_information_and_training' where heading ='3_information_and_training'";

        $this->db->query($SQL);
    }

    public function down() {

    }

}