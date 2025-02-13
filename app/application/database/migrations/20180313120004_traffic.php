<?php

class Migration_traffic extends CI_Migration {

    public function up() {
        $fields = array(
            'traffic_light_reverse'=>array(
                'type'=>'tinyint',
                'default'=>0

            )
        );

        $this->dbforge->add_column('indicators', $fields);
    }

    public function down() {

    }

}