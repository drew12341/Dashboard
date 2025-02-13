<?php

class Migration_indicator_measures extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'userid' => array(
                'type' => 'int',

            ),
            'indicatorid' => array(
                'type' => 'int'
            ),
            'period' =>array(
                'type'=>'varchar',
                'constraint'=>'50'

            ),
            'value' => array(
                'type'=>'float',
                'default'=>0
            ),
            'date_committed' => array(
                'type'=>'datetime',
                'null'=>true
            ),
            'committed' => array(
                'type' => 'int',
                'default'=>0
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('indicator_measures');
    }

    public function down() {
        $this->dbforge->drop_table('indicator_measures');
    }

}