<?php

class Migration_import_indicators extends CI_Migration {

    public function up() {
        // Dumping data for table 'users'
        $data = array(

            'userid' => '1',
            'description' => 'No-lost-time injuries reported',
            'visible' => true,
            'type' => 'Absolute',
            'value' => '90',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '1_minimise_injuries_maximise_wellbeing',
            'sort_order'=>1

        );
        $this->db->insert('indicators', $data);

        $data = array(

            'userid' => '1',
            'description' => 'Lost-time Injuries reported',
            'visible' => true,
            'type' => 'Absolute',
            'value' => '0',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '1_minimise_injuries_maximise_wellbeing',
            'sort_order'=>2

        );
        $this->db->insert('indicators', $data);

        $data = array(

            'userid' => '1',
            'description' => 'Near Misses Reported',
            'visible' => true,
            'type' => 'Absolute',
            'value' => '0',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '1_minimise_injuries_maximise_wellbeing',
            'sort_order'=>3

        );
        $this->db->insert('indicators', $data);

        $data = array(

            'userid' => '1',
            'description' => 'Wellbeing Participation',
            'visible' => true,
            'type' => 'Absolute',
            'value' => '0',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '1_minimise_injuries_maximise_wellbeing',
            'sort_order'=>4

        );
        $this->db->insert('indicators', $data);


       ////////////////////////////////////////////////////////////////////////////
        $data = array(

            'userid' => '1',
            'description' => 'Inspections Completed to Schedule',
            'visible' => true,
            'type' => 'Percentage',
            'value' => '90',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '2_safe_workplace',
            'sort_order'=>1

        );
        $this->db->insert('indicators', $data);

        $data = array(

            'userid' => '1',
            'description' => 'Hazards Reported',
            'visible' => true,
            'type' => 'Absolute',
            'value' => '0',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '2_safe_workplace',
            'sort_order'=>2

        );
        $this->db->insert('indicators', $data);

        $data = array(

            'userid' => '1',
            'description' => 'Hazards Actioned',
            'visible' => true,
            'type' => 'Percentage',
            'value' => '100',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '2_safe_workplace',
            'sort_order'=>3

        );
        $this->db->insert('indicators', $data);

        /////////////////////////////////////////////////////////////////////////////

        $data = array(

            'userid' => '1',
            'description' => 'Safety and Wellbeing Essentials',
            'visible' => true,
            'type' => 'Percentage',
            'value' => '90',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '3_informed_and_engaged',
            'sort_order'=>1

        );
        $this->db->insert('indicators', $data);

        $data = array(

            'userid' => '1',
            'description' => 'Preventing Bullying in the Workplace',
            'visible' => true,
            'type' => 'Percentage',
            'value' => '90',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '3_informed_and_engaged',
            'sort_order'=>2

        );
        $this->db->insert('indicators', $data);


        $data = array(

            'userid' => '1',
            'description' => 'H&S for Supervisors',
            'visible' => true,
            'type' => 'Percentage',
            'value' => '90',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '3_informed_and_engaged',
            'sort_order'=>3

        );
        $this->db->insert('indicators', $data);


        $data = array(

            'userid' => '1',
            'description' => 'Local Inductions Completed',
            'visible' => true,
            'type' => 'Percentage',
            'value' => '90',
            'mandatory'=>0,
            'category' => 'standard',
            'heading' => '3_informed_and_engaged',
            'sort_order'=>4

        );
        $this->db->insert('indicators', $data);

        $data = array(

            'userid' => '1',
            'description' => 'H&S Working Group Meetings',
            'visible' => true,
            'type' => 'Absolute',
            'value' => '1',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '3_informed_and_engaged',
            'sort_order'=>5

        );
        $this->db->insert('indicators', $data);


        ////////////////////////////////////////////////////////////////////////////////////
        $data = array(

            'userid' => '1',
            'description' => 'Business Unit H&S Plans in Place and current',
            'visible' => true,
            'type' => 'True/False',
            'value' => 'true',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '4_proactive_approach',
            'sort_order'=>1

        );
        $this->db->insert('indicators', $data);

        $data = array(

            'userid' => '1',
            'description' => 'H&S Plan Review is current',
            'visible' => true,
            'type' => 'True/False',
            'value' => 'true',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '4_proactive_approach',
            'sort_order'=>2

        );
        $this->db->insert('indicators', $data);

        $data = array(

            'userid' => '1',
            'description' => 'H&S Plan actions completed on schedule',
            'visible' => true,
            'type' => 'Percentage',
            'value' => '90',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '4_proactive_approach',
            'sort_order'=>3

        );
        $this->db->insert('indicators', $data);

        $data = array(

            'userid' => '1',
            'description' => 'Risk Assessments are less than 2 years old',
            'visible' => true,
            'type' => 'Percentage',
            'value' => '90',
            'mandatory'=>0,
            'category' => 'standard',
            'heading' => '4_proactive_approach',
            'sort_order'=>4

        );
        $this->db->insert('indicators', $data);


    }

    public function down() {

    }

}