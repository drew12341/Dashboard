<?php

class Migration_indicators extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'userid'=>array(
                'type'=> 'INT',
                'constraint'=>11

            ),
            'description'=>array(
                'type'=>'varchar',
                'constraint'=>200
            ),
            'visible'=>array(
                'type'=>'tinyint',
                'default'=>1

            ),
            'type'=>array(
                'type'=>'varchar',
                'constraint'=>10
            ),
            'value'=>array(
                'type'=>'float',
            ),
            'category'=>array(
                'type'=>'varchar',
                'constraint'=>'50'
            ),
            'heading'=>array(
                'type'=>'varchar',
                'constraint'=>'50',
                'null'=>true
            ),
            'sort_order'=>array(
                'type'=>'int',
                'constraint'=>'3',
                'null'=>true
            )



        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('indicator');
    }

    public function down() {
        $this->dbforge->drop_table('indicator');
    }

}