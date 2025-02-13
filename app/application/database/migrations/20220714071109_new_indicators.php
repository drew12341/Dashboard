<?php

class Migration_new_indicators extends CI_Migration {

    public function up() {

        //hide old records
        $sql = "update indicators set visible = 0 where visible = 1";
        $this->db->query($sql);

        // Dumping data for table 'users'
        $data = array(

            'userid' => '1',
            'description' => 'Self-assessment of H&S Plans completed within previous year',
            'visible' => true,
            'type' => 'Percentage',
            'value' => '100',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '1_management_commitment_and_leadership',
            'sort_order'=>1

        );
        $this->db->insert('indicators', $data);

        $data = array(

            'userid' => '1',
            'description' => 'Management attendance at Working Group Meeting',
            'visible' => true,
            'type' => 'True/False',
            'value' => '1',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '1_management_commitment_and_leadership',
            'sort_order'=>2

        );
        $this->db->insert('indicators', $data);

        $data = array(

            'userid' => '1',
            'description' => 'Emergency Wardens',
            'visible' => true,
            'type' => 'Percentage',
            'value' => '100',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '1_management_commitment_and_leadership',
            'sort_order'=>3

        );
        $this->db->insert('indicators', $data);

        $data = array(

            'userid' => '1',
            'description' => 'First Aid Officers',
            'visible' => true,
            'type' => 'Percentage',
            'value' => '100',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '1_management_commitment_and_leadership',
            'sort_order'=>4

        );
        $this->db->insert('indicators', $data);


        ////////////////////////////////////////////////////////////////////////////
        $data = array(

            'userid' => '1',
            'description' => 'Number of H&S Working Group Meetings held YTD',
            'visible' => true,
            'type' => 'Absolute',
            'value' => '4',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '2_consultation_and_communication',
            'sort_order'=>1

        );
        $this->db->insert('indicators', $data);

        $data = array(

            'userid' => '1',
            'description' => 'Attendance of delegate at H&S Advisory Committee',
            'visible' => true,
            'type' => 'Absolute',
            'value' => '6',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '2_consultation_and_communication',
            'sort_order'=>2

        );
        $this->db->insert('indicators', $data);

        $data = array(

            'userid' => '1',
            'description' => 'Distribution of H&S newsletter to all staff',
            'visible' => true,
            'type' => 'True/False',
            'value' => '1',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '2_consultation_and_communication',
            'sort_order'=>3

        );
        $this->db->insert('indicators', $data);

        $data = array(

            'userid' => '1',
            'description' => 'Safety shares at all local management meetings',
            'visible' => true,
            'type' => 'True/False',
            'value' => '1',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '2_consultation_and_communication',
            'sort_order'=>4

        );
        $this->db->insert('indicators', $data);
        /////////////////////////////////////////////////////////////////////////////

        $data = array(

            'userid' => '1',
            'description' => 'Consent Matters',
            'visible' => true,
            'type' => 'Calculated',
            'value' => '95',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '3_information_and_training',
            'sort_order'=>1

        );
        $this->db->insert('indicators', $data);

        $data = array(

            'userid' => '1',
            'description' => 'Consent Matters (casual staff)',
            'visible' => true,
            'type' => 'Calculated',
            'value' => '75',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '3_information_and_training',
            'sort_order'=>2

        );
        $this->db->insert('indicators', $data);


        $data = array(

            'userid' => '1',
            'description' => 'Safe and Well at UTS (casual staff)',
            'visible' => true,
            'type' => 'Calculated',
            'value' => '80',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '3_information_and_training',
            'sort_order'=>3

        );
        $this->db->insert('indicators', $data);


        $data = array(

            'userid' => '1',
            'description' => 'Safety and Wellbeing Essentials  ',
            'visible' => true,
            'type' => 'Calculated',
            'value' => '95',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '3_information_and_training',
            'sort_order'=>4

        );
        $this->db->insert('indicators', $data);

        $data = array(

            'userid' => '1',
            'description' => 'Preventing Bullying in the Workplace',
            'visible' => true,
            'type' => 'Calculated',
            'value' => '95',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '3_information_and_training',
            'sort_order'=>5

        );
        $this->db->insert('indicators', $data);

        $data = array(

            'userid' => '1',
            'description' => 'H&S for Supervisors and Academics',
            'visible' => true,
            'type' => 'Calculated',
            'value' => '95',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '3_information_and_training',
            'sort_order'=>6

        );
        $this->db->insert('indicators', $data);

        $data = array(

            'userid' => '1',
            'description' => 'New staff inducted within 2 weeks YTD',
            'visible' => true,
            'type' => 'Percentage',
            'value' => '90',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '3_information_and_training',
            'sort_order'=>7

        );
        $this->db->insert('indicators', $data);

        ////////////////////////////////////////////////////////////////////////////////////
        $data = array(

            'userid' => '1',
            'description' => 'Risk Assessments in Online Risk Register current',
            'visible' => true,
            'type' => 'Percentage',
            'value' => '90',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '4_risk_management',
            'sort_order'=>1

        );
        $this->db->insert('indicators', $data);

        ////////////////////////////////////////////////////////////////////////////////////

        $data = array(

            'userid' => '1',
            'description' => 'Scheduled inspections (paper or online) or Inspections Completed to Schedule',
            'visible' => true,
            'type' => 'Percentage',
            'value' => 90,
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '5_monitoring_reporting_and_verification',
            'sort_order'=>1

        );
        $this->db->insert('indicators', $data);

        $data = array(

            'userid' => '1',
            'description' => 'HIRO reports open > 3 months',
            'visible' => true,
            'type' => 'Absolute',
            'value' => '3',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '5_monitoring_reporting_and_verification',
            'sort_order'=>2

        );
        $this->db->insert('indicators', $data);

        $data = array(

            'userid' => '1',
            'description' => 'Incidents reported within 24 hours',
            'visible' => true,
            'type' => 'Absolute',
            'value' => '100',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '5_monitoring_reporting_and_verification',
            'sort_order'=>3

        );
        $this->db->insert('indicators', $data);

        $data = array(

            'userid' => '1',
            'description' => 'Incidents reported in HIRO (both injuries and near-misses)',
            'visible' => true,
            'type' => 'Absolute',
            'value' => '0',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '5_monitoring_reporting_and_verification',
            'sort_order'=>4

        );
        $this->db->insert('indicators', $data);

        $data = array(

            'userid' => '1',
            'description' => 'Hazards reported in HIRO (not part of scheduled inspections)',
            'visible' => true,
            'type' => 'Absolute',
            'value' => '0',
            'mandatory'=>1,
            'category' => 'standard',
            'heading' => '5_monitoring_reporting_and_verification',
            'sort_order'=>5

        );
        $this->db->insert('indicators', $data);
    }

    public function down() {
        $this->dbforge->drop_table('new_indicators');
    }

}