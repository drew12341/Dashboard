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
        if(!isset($record['mandatory'])){
            $record['mandatory'] = 0;
        }
        if(!isset($record['traffic_light'])){
            $record['traffic_light'] = 0;
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

    public function getFullMeasures($user, $thisperiod, $utswide = false){
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

        //echo $thisperiod;

        //if UTS wide, then we change the queries

        $SQL = "select heading from indicators where userid = $user or category = 'standard'
                  group by heading";
        if($utswide){
            $SQL = "select heading from indicators where category = 'standard'
                  group by heading";
        }

        $query = $this->db->query($SQL);
        $results = $query->result_array();

        //Aggregate for ease of display (group into sections)
        $aggregated = array();
        foreach($results as $res){
            $heading = $res['heading'];

            $SQL = "select curr.period as currentperiod, prev.period as previousperiod, prev.value as previous, curr.value as current, 
curr.userid , ind.description, ind.type, ind.heading, ind.sort_order, ind.value, ind.traffic_light
from indicator_measures curr
  INNER JOIN indicators ind on ind.id = curr.indicatorid
  left outer join indicator_measures prev on curr.indicatorid = prev.indicatorid and curr.userid = prev.userid and prev.period = '$previousperiod' and prev.committed = 1
where curr.period = '$thisperiod'  and curr.userid = $user and ind.heading = '$heading'  and curr.committed = 1 
ORDER BY ind.heading, ind.sort_order";

            if($utswide){
                $SQL = "select curr.period as currentperiod, prev.period as previousperiod, prev.value as previous, curr.value as current, 
 ind.description, ind.type, ind.heading, ind.sort_order, ind.value, ind.traffic_light
from indicator_measures_aggregate curr
  INNER JOIN indicators ind on ind.id = curr.indicatorid
  left outer join indicator_measures_aggregate prev on curr.indicatorid = prev.indicatorid and prev.period = '$previousperiod'
where curr.period = '$thisperiod' and ind.heading = '$heading'
ORDER BY ind.heading, ind.sort_order";
            }

            $query1 = $this->db->query($SQL);
            $results1 = $query1->result_array();
            $aggregated[$heading] = $results1;
        }
        //echo json_encode($aggregated);
        return $aggregated;
    }

    public function getMeasuresChartData($user, $period, $utswide = false){
        //first get measures that are percentage based
        $SQL = "select heading from indicators where (userid = $user or category = 'standard')
and type = 'Percentage' group by heading";

        if($utswide){
            $SQL = "select heading from indicators where category = 'standard'
and type = 'Percentage' group by heading";
        }

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
                $SQL = "select period, ifnull(indicator_measures.value, 0) as value from indicator_measures 
where indicatorid = $id and userid = $user and period <= '$period' and committed = 1 order by period desc limit 6";

                if($utswide){
                    $SQL = "select period, ifnull(indicator_measures_aggregate.value, 0) as value from indicator_measures_aggregate 
where indicatorid = $id and period <= '$period' order by period desc limit 6";
                }

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


            $aggregated[$heading] = array_reverse(array_values($agg));
        }

        return $aggregated;
    }

    public function getMeasuresStatus($user, $period){
        //echo $user.' '.$period;
        $this->db->where('userid', $user);
        $this->db->where('period', $period);
        $this->db->group_by('committed');
        $query = $this->db->get('indicator_measures');
        $results = $query->result_array();

        if(count($results) == 0){
            return 'No Data';
        }
        $res = $results[0];
        if($res['committed'] == 1){
            return 'Committed';
        }
        return 'Draft';
    }


    public function getAllMeasures($user){
        //echo $user.' '.$period;
        $this->db->where('userid', $user);
        $this->db->group_by('period');
        $this->db->order_by('period', 'desc');
        $query = $this->db->get('indicator_measures');
        $results = $query->result_array();


        return $results;
    }

    public function upsertmeasure($measure){

        if($measure['committed']){
            $measure['date_committed'] = date("Y-m-d H:i:s");
        }
        if(!isset($measure['value'])){
            $measure['value'] = 0;
        }

        $this->db->where('userid', $measure['userid']);
        $this->db->where('indicatorid', $measure['indicatorid']);
        $this->db->where('period', $measure['period']);


        $query = $this->db->get('indicator_measures');
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

    public function getYearlyMeasures($user, $year ){

        $y1 = $year.'-1';
        $y2 = $year.'-2';
        $y3 = $year.'-3';
        $y4 = $year.'-4';
        $y5 = $year.'-5';
        $y6 = $year.'-6';


        //if UTS wide, then we change the queries

        $SQL = "select heading from indicators where userid = $user or category = 'standard'
                  group by heading";


        $query = $this->db->query($SQL);
        $results = $query->result_array();

        //Aggregate for ease of display (group into sections)
        $aggregated = array();
        foreach($results as $res){
            $heading = $res['heading'];



            $SQL = "select y1.period as y1period, y2.period as y2period, y3.period as y3period, y4.period as y4period, y5.period as y5period, y6.period as y6period, 
y1.value as y1value, y2.value as y2value, y3.value as y3value, y4.value as y4value, y5.value as y5value, y6.value as y6value,  
y1.userid , ind.description, ind.type, ind.heading, ind.sort_order, ind.value
from indicators ind
  left outer join indicator_measures y1 on ind.id = y1.indicatorid and y1.userid = $user and y1.period = '$y1' and y1.committed = 1
  left outer join indicator_measures y2 on ind.id = y2.indicatorid and y2.userid = $user and y2.period = '$y2' and y2.committed = 1
  left outer join indicator_measures y3 on ind.id = y3.indicatorid and y3.userid = $user and y3.period = '$y3' and y3.committed = 1
  left outer join indicator_measures y4 on ind.id = y4.indicatorid and y4.userid = $user and y4.period = '$y4' and y4.committed = 1
  left outer join indicator_measures y5 on ind.id = y5.indicatorid and y5.userid = $user and y5.period = '$y5' and y5.committed = 1
  left outer join indicator_measures y6 on ind.id = y6.indicatorid and y6.userid = $user and y6.period = '$y6' and y6.committed = 1
where ind.heading = '$heading' 
ORDER BY ind.heading, ind.sort_order";


            $query1 = $this->db->query($SQL);
            $results1 = $query1->result_array();
            $aggregated[$heading] = $results1;
        }

        return $aggregated;
    }


    public function getCommittedDate($userid, $period){
        $this->db->where('userid', $userid);
        $this->db->where('period', $period);
        $query = $this->db->get('indicator_measures');
        $results = $query->result_array();

        if(count($results) > 0){
            $res = $results[0];
            return $res['date_committed'];
        }
    }
}