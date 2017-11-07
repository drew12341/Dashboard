<?php

class Indicator_model extends CI_Model
{

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function getIndicators($id){
        $this->db->where('userid', $id);
        $query = $this->db->get('indicators');

        $results = $query->result_array();
        return $results;
    }

    public function getIndicator($id){
        $this->db->where('id', $id);
        $query = $this->db->get('indicators');

        $results = $query->result_array();
        return $results[0];
    }

    public function addIndicator($record){
        if($this->ion_auth->is_admin()){
            $record['category'] = 'standard';
        }
        else{
            $record['category'] = 'local';
            $record['heading'] = '9_local_indicator';
            $record['sort_order'] = 9;
        }

        $this->db->insert('indicators', $record);

        return $this->db->insert_id();
    }

    public function updateIndicator($record){
        $id = $record['id'];
        unset($record['id']);


        if(!isset($record['visible'])){
            $record['visible'] = 0;
        }
        $this->db->update('indicators', $record, array('id'=>$id));
        return $this->db->insert_id();
    }

    public function getForUser($userid){

        $this->db->where('userid', $userid);
        $this->db->or_where('category', 'standard');
        $this->db->order_by('heading ASC');
        $this->db->group_by('heading');
        $query = $this->db->get('indicators');
        $results = $query->result_array();
        $aggregated = array();

        foreach($results as $res){
            $this->db->where('heading', $res['heading']);
            $this->db->order_by('sort_order ASC');
            $query1 = $this->db->get('indicators');
            $results1 = $query1->result_array();
            $aggregated[$res['heading']] = $results1;
        }


        return $aggregated;

    }

    public function getMeasures($user, $period){
        $this->db->where('userid', $user);
        $this->db->where('period', $period);
        $query = $this->db->get('indicator_measures');
        $results = $query->result_array();

        $aggregated = array();
        foreach($results as $res){
            $aggregated[$res['indicatorid']] = $res['value'];
        }
        return $aggregated;
    }

    public function getMeasuresStatus($user, $period){
        $this->db->where('userid', $user);
        $this->db->where('period', $period);
        $this->db->group_by('committed');
        $query = $this->db->get('indicator_measures');
        $results = $query->result_array();

        if(count($results) == 0){
            return '-';
        }
        $res = $results[0];
        if($res['committed'] == 1){
            return 'Committed';
        }
        return 'Draft';
    }

    public function upsertmeasure($measure){
        $this->db->where('userid', $measure['userid']);
        $this->db->where('indicatorid', $measure['indicatorid']);
        $this->db->where('period', $measure['period']);
        $query = $this->db->get('indicators');
        $results = $query->result_array();
        if(count($results) > 0){
            //Update
            $existing = $results[0];
            $this->db->update('indicator_measures', $measure, array('id'=>$existing['id']));
        }
        else{
            //Insert
            $this->db->insert('indicator_measures', $measure);
        }
    }
}