<?php

class Migration_split_measures extends CI_Migration {

    public function up() {
        $fields = array(
            'staff_in_group' => array(
                'type' => 'FLOAT',
            ),
            'completions' => array(
                'type' => 'FLOAT',
            ),
        );
        $this->dbforge->add_column('indicator_measures', $fields);
    }

    public function down() {

    }

}