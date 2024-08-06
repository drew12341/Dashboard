<?php

class Migration_Lead_lag extends CI_Migration {

    public function up() {
        $fields = array(
            'lead'=>array(
                'type'=>'tinyint',
                'default'=>1
            )
        );

        $this->dbforge->add_column('indicators', $fields);

        //Update existing records
        $SQL = "Update indicators 
 set lead = 0 where heading like '5%' and sort_order <= 5";

        $this->db->query($SQL);
    }

    public function down() {

    }

}