<?php

class Migration_lights extends CI_Migration {

    public function up() {
        $fields = array(
            'traffic_light'=>array(
                'type'=>'tinyint',
                'default'=>1

            )
        );

        $this->dbforge->add_column('indicators', $fields);
    }

    public function down() {

    }

}