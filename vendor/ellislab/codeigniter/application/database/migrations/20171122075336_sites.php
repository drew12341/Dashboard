<?php

class Migration_sites extends CI_Migration {

    public function up() {
        $data = array(
            'ip_address' => '127.0.0.1',
            'username' => 'fass',
            'password' => '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36',
            'salt' => '',
            'email' => 'admin@admin.com',
            'activation_code' => '',
            'forgotten_password_code' => NULL,
            'created_on' => '1268889823',
            'last_login' => '1268889823',
            'active' => '1',
            'first_name' => '',
            'last_name' => '',
            'orgunit_name'=>'Faculty of Arts and Social Sciences '
        );
        $this->db->insert('users', $data);

        $data['username'] = 'fdab';
        $data['orgunit_name'] = 'Faculty of Design, Architecture and Building';
        $this->db->insert('users', $data);

        $data['username'] = 'feit';
        $data['orgunit_name'] = 'Faculty of Engineering and Information Technology';
        $this->db->insert('users', $data);

        $data['username'] = 'foh';
        $data['orgunit_name'] = 'Faculty of Health ';
        $this->db->insert('users', $data);

        $data['username'] = 'fol';
        $data['orgunit_name'] = 'Faculty of Law';
        $this->db->insert('users', $data);

        $data['username'] = 'fos';
        $data['orgunit_name'] = 'Faculty of Science ';
        $this->db->insert('users', $data);

        $data['username'] = 'fsu';
        $data['orgunit_name'] = 'Financial Services Unit';
        $this->db->insert('users', $data);

        $data['username'] = 'gsu';
        $data['orgunit_name'] = 'Governance Support Unit';
        $this->db->insert('users', $data);

        $data['username'] = 'gsh';
        $data['orgunit_name'] = 'Graduate School of Health (incl. Pharmacy) ';
        $this->db->insert('users', $data);

        $data['username'] = 'hru';
        $data['orgunit_name'] = 'Human Resources Unit ';
        $this->db->insert('users', $data);

        $data['username'] = 'itd';
        $data['orgunit_name'] = 'Information Technology Division ';
        $this->db->insert('users', $data);

        $data['username'] = 'iiml';
        $data['orgunit_name'] = 'Institute for Interactive Media and Learning ';
        $this->db->insert('users', $data);


        $data['username'] = 'isf';
        $data['orgunit_name'] = 'Institute for Sustainable Futures';
        $this->db->insert('users', $data);

        $data['username'] = 'mcu';
        $data['orgunit_name'] = 'Marketing and Communication Unit';
        $this->db->insert('users', $data);

        $data['username'] = 'pmo';
        $data['orgunit_name'] = 'Program Management Office';
        $this->db->insert('users', $data);

        $data['username'] = 'rio';
        $data['orgunit_name'] = 'Research and Innovation Office';
        $this->db->insert('users', $data);

        $data['username'] = 'sau';
        $data['orgunit_name'] = 'Student Administration Unit';
        $this->db->insert('users', $data);

        $data['username'] = 'ssu';
        $data['orgunit_name'] = 'Student Services Unit ';
        $this->db->insert('users', $data);

        $data['username'] = 'ul';
        $data['orgunit_name'] = 'University Library';
        $this->db->insert('users', $data);

        $data['username'] = 'ubs';
        $data['orgunit_name'] = 'UTS Business School ';
        $this->db->insert('users', $data);

        $data['username'] = 'ui';
        $data['orgunit_name'] = 'UTS International';
        $this->db->insert('users', $data);

        $data['username'] = 'uls';
        $data['orgunit_name'] = 'UTS Legal Services';
        $this->db->insert('users', $data);



        //Finally, insert missing groups to make app work
        $SQL = "INSERT INTO users_groups (user_id, group_id)
  SELECT [id], 2
  FROM users e
  where not exists (
      select *
      from users_groups
      where user_id = e.id )";

        $this->db->query($SQL);
    }

    public function down() {

    }

}