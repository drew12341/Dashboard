<?php

class Migration_comments_field extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'period' =>array(
                'type'=>'varchar',
                'constraint'=>'50'

            ),
            'userid' => array(
                'type' => 'int',

            ),
            'comments' => array(
                'type' => 'text',

            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('indicator_measures_meta');
    }

    public function down() {
        $this->dbforge->drop_table('indicator_measures_meta');
    }

}