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

    public function getFullMeasures($user, $thisperiod){
        $d = explode('-', $thisperiod);
        $period = $d[1];
        $year = $d[0];
        //calculate previous value (year then base 6)
        if($period > 1){
            $previousyear = $year;
            $previousperiod = $period - 1;
        }
        else{
            $previousyear = $year - 1;
            $previousperiod = 6;
        }
        $previousperiod = $previousyear.'-'.$previousperiod;


        $SQL = "select heading from indicators where userid = $user or category = 'standard'
                  group by heading";

        $query = $this->db->query($SQL);
        $results = $query->result_array();

        //Aggregate for ease of display (group into sections)
        $aggregated = array();
        foreach($results as $res){
            $heading = $res['heading'];

            $SQL = "select curr.period as currentperiod, prev.period as previousperiod, prev.value as previous, curr.value as current, 
curr.userid , ind.description, ind.type, ind.heading, ind.sort_order, ind.value
from indicator_measures curr
  left outer join indicator_measures prev on curr.indicatorid = prev.indicatorid
  INNER JOIN indicators ind on ind.id = curr.indicatorid
where curr.period = '$thisperiod' and prev.period = '$previousperiod' and curr.userid = $user and ind.heading = '$heading'
ORDER BY ind.heading, ind.sort_order";

            $query1 = $this->db->query($SQL);
            $results1 = $query1->result_array();
            $aggregated[$heading] = $results1;
        }

        return $aggregated;
    }

    public function getMeasuresChartData($user, $period){
        //first get measures that are percentage based
        $SQL = "select heading from indicators where (userid = $user or category = 'standard')
and type = 'Percentage' group by heading";

        $query = $this->db->query($SQL);
        $results = $query->result_array();

        //Aggregate for ease of display (group into sections)
        $aggregated = array();
        foreach($results as $res){
            $heading = $res['heading'];

            //get items that are percentage
            $SQL = "select id, description from indicators where heading = '$heading' and type = 'Percentage'";

            $query1 = $this->db->query($SQL);
            $results1 = $query1->result_array();

            $agg = array();
            foreach($results1 as $res1){
                $id = $res1['id'];
                $description = $res1['description'];
                $SQL = "select period, value from indicator_measures 
where indicatorid = $id and userid = $user and period <= '$period' order by period asc limit 6";
                $query2 = $this->db->query($SQL);
                $results2 = $query2->result_array();

                foreach($results2 as $res2){
                    $row = array();
                    if(isset($agg[$res2['period']])){
                        $row = $agg[$res2['period']];
                    }
                    else{
                        $row['period'] = $res2['period'];
                    }
                    $row[$description] = $res2['value'];
                    $agg[$res2['period']] = $row;
                }

            }


            $aggregated[$heading] = array_values($agg);
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