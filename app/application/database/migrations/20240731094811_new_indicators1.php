<?php

class Migration_new_indicators1 extends CI_Migration {

    public function up() {

        $data = array(

            'userid' => '1',
            'description' => 'Inspections completed by end of last quarter',
            'visible' => true,
            'type' => 'Percentage',
            'value' => '100',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '5_monitoring_reporting_and_verification',
            'sort_order'=>6

        );
        $this->db->insert('indicators', $data);

        $data = array(

            'userid' => '1',
            'description' => 'Inspections in this quarter as at today',
            'visible' => true,
            'type' => 'Percentage',
            'value' => '100',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '5_monitoring_reporting_and_verification',
            'sort_order'=>7

        );
        $this->db->insert('indicators', $data);

    }

    public function down() {
        $this->dbforge->drop_table('new_indicators');
    }

}