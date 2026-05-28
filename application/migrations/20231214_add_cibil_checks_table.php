<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_cibil_checks_table extends CI_Migration {

    public function up() {
        // Create cibil_checks table
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ],
            'url' => [
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => FALSE
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ],
            'copy_url' => [
                'type' => 'VARCHAR',
                'constraint' => '500',
                'null' => TRUE
            ],
            'status' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
                'comment' => '1=Active, 0=Inactive'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ]
        ]);
        
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('cibil_checks');
    }

    public function down() {
        $this->dbforge->drop_table('cibil_checks', TRUE);
    }
}
