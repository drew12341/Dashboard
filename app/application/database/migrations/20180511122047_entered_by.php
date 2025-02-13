<?php

class Migration_entered_by extends CI_Migration {

    public function up() {
        $fields = array(
            'data_entered_by'=>array(
                'type'=>'text',

            )
        );

        $this->dbforge->add_column('indicator_measures_meta', $fields);
    }

    public function down() {

    }

}