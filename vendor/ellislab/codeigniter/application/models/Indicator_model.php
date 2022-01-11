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
        if(!isset($record['traffic_light_reverse'])){
            $record['traffic_light_reverse'] = 0;
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
            if($res['category'] == 'standard') {
                $this->db->where('heading', $res['heading']);
                $this->db->order_by('sort_order ASC');
                $query1 = $this->db->get('indicators');
                $results1 = $query1->result_array();
                $aggregated[$res['heading']] = $results1;
            }
            else{
                $this->db->where('heading', $res['heading']);
                $this->db->where('userid', $userid);
                $this->db->order_by('sort_order ASC');
                $query1 = $this->db->get('indicators');
                $results1 = $query1->result_array();
                $aggregated[$res['heading']] = $results1;
            }
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
    public function getMeasuresStaff($user, $period){
        $this->db->where('userid', $user);
        $this->db->where('period', $period);
        $query = $this->db->get('indicator_measures');
        $results = $query->result_array();

        $aggregated = array();
        foreach($results as $res){
            $aggregated[$res['indicatorid']] = $res['staff_in_group'];
        }
        return $aggregated;
    }
    public function getMeasuresCompletion($user, $period){
        $this->db->where('userid', $user);
        $this->db->where('period', $period);
        $query = $this->db->get('indicator_measures');
        $results = $query->result_array();

        $aggregated = array();
        foreach($results as $res){
            $aggregated[$res['indicatorid']] = $res['completions'];
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
            $previousperiod = 12;
        }
        $previousperiod = $previousyear.'-'.$previousperiod;

        //echo $thisperiod;

        //if UTS wide, then we change the queries

        $SQL = "select heading, category from indicators where (userid = $user or category = 'standard') and visible = 1
                  group by heading";
        if($utswide){
            $SQL = "select heading, category from indicators where category = 'standard' and visible = 1
                  group by heading";
        }

        $query = $this->db->query($SQL);
        $results = $query->result_array();

        //Aggregate for ease of display (group into sections)
        $aggregated = array();
        foreach($results as $res){
            $heading = $res['heading'];
            $category = $res['category'];

            if(!$utswide && $category == 'standard') {
                $SQL = "
                    select curr.period as currentperiod, prev.period as previousperiod, prev.value as previous, curr.value as current, 
                                 prev.staff_in_group as prevstaff, curr.staff_in_group as currstaff,
                      curr.userid , ind.description, ind.type, ind.heading, ind.sort_order, ind.value, ind.traffic_light, ind.traffic_light_reverse
                    from indicators ind
                      left outer join indicator_measures curr on ind.id = curr.indicatorid and curr.userid = $user and curr.period = '$thisperiod' and curr.committed = 1
                      left outer join indicator_measures prev on ind.id = prev.indicatorid and prev.userid = $user and prev.period = '$previousperiod' and prev.committed = 1
                    where ind.heading = '$heading' and ind.visible = 1
                    ORDER BY ind.heading, ind.sort_order;";
            }
            else{
                $SQL = "
                    select curr.period as currentperiod, prev.period as previousperiod, round(prev.value, 2) as previous, round(curr.value,2 ) as current,
                                 prev.staff_in_group as prevstaff, curr.staff_in_group as currstaff,
                      curr.userid , ind.description, ind.type, ind.heading, ind.sort_order, ind.value, ind.traffic_light, ind.traffic_light_reverse
                    from indicators ind
                      left outer join indicator_measures curr on ind.id = curr.indicatorid and curr.userid = $user and curr.period = '$thisperiod' and curr.committed = 1
                      left outer join indicator_measures prev on ind.id = prev.indicatorid and prev.userid = $user and prev.period = '$previousperiod' and prev.committed = 1
                    where ind.heading = '$heading' and ind.userid = $user and ind.visible = 1
                    ORDER BY ind.heading, ind.sort_order;";
            }


            if($utswide){

                $SQL = "select curr.period as currentperiod, prev.period as previousperiod, round(prev.value, 2) as previous, 
       round(curr.value,2) as current,
       prev.staff_in_group as prevstaff, curr.staff_in_group as currstaff,
   ind.description, ind.type, ind.heading, ind.sort_order, ind.value, ind.traffic_light, ind.traffic_light_reverse
from indicators ind
  left outer join indicator_measures_aggregate curr on ind.id = curr.indicatorid and curr.period = '$thisperiod' 
  left outer join indicator_measures_aggregate prev on ind.id = prev.indicatorid and prev.period = '$previousperiod' 
where ind.heading = '$heading' and ind.visible = 1
ORDER BY ind.heading, ind.sort_order;";
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
and type = 'Percentage' and visible = 1 group by heading";

        if($utswide){
            $SQL = "select heading from indicators where category = 'standard'
and type = 'Percentage' and visible = 1 group by heading";
        }

        $query = $this->db->query($SQL);
        $results = $query->result_array();

        //Aggregate for ease of display (group into sections)
        $aggregated = array();
        foreach($results as $res){
            $heading = $res['heading'];

            //get items that are percentage
            $SQL = "select id, description from indicators where heading = '$heading' and type = 'Percentage' and visible = 1";

            $query1 = $this->db->query($SQL);
            $results1 = $query1->result_array();

            $agg = array();
            foreach($results1 as $res1){
                $id = $res1['id'];
                $description = $res1['description'];
                $SQL = "select period, ifnull(round(indicator_measures.value, 2), 0) as value from indicator_measures 
where indicatorid = $id and userid = $user and period <= '$period' and committed = 1 order by period desc limit 6";

                if($utswide){
                    $SQL = "select period, ifnull(round(indicator_measures_aggregate.value, 2), 0) as value from indicator_measures_aggregate 
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

    public function getEveryMeasure(){
        $this->db->select('indicator_measures.*, users.orgunit_name, users.first_name, users.last_name');
        $this->db->join('users', 'users.id = indicator_measures.userid');
        $this->db->group_by('period, users.id');
        $this->db->order_by('period', 'desc');

        $query = $this->db->get('indicator_measures');

        $results = $query->result_array();
        return $results;
    }

    public function uncommit($user, $period){
        $this->db->set('committed', false);
        $this->db->where('userid', $user);
        $this->db->where('period', $period);
        $this->db->update('indicator_measures');
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
    public function upsert_measure_meta($measuremeta){
        $this->db->where('userid', $measuremeta['userid']);
        $this->db->where('period', $measuremeta['period']);
        $query = $this->db->get('indicator_measures_meta');
        $results = $query->result_array();
        if(count($results) > 0){
            //Update
            $existing = $results[0];
            $this->db->update('indicator_measures_meta', $measuremeta, array('id'=>$existing['id']));
        }
        else{
            //Insert
            $this->db->insert('indicator_measures_meta', $measuremeta);
        }
    }
    public function get_measure_meta($userid, $period){
        $this->db->where('userid', $userid);
        $this->db->where('period', $period);
        $query = $this->db->get('indicator_measures_meta');
        $results = $query->result_array();
        if(count($results) > 0) {
            return $results[0];
        }
        else{
            //meta is a new feature - handle any records that may not have an entry in the 'meta'table.
            return array('comments'=>null, 'data_entered_by'=>null);
        }
    }

    public function getYearlyMeasures($user, $year ){

        $y1 = $year.'-1';
        $y2 = $year.'-2';
        $y3 = $year.'-3';
        $y4 = $year.'-4';
        $y5 = $year.'-5';
        $y6 = $year.'-6';
        $y7 = $year.'-7';
        $y8 = $year.'-8';
        $y9 = $year.'-9';
        $y10 = $year.'-10';
        $y11 = $year.'-11';
        $y12 = $year.'-12';

        //if UTS wide, then we change the queries

        $SQL = "select heading, category from indicators where (userid = $user or category = 'standard') and visible = 1
                  group by heading";


        $query = $this->db->query($SQL);
        $results = $query->result_array();

        //Aggregate for ease of display (group into sections)
        $aggregated = array();
        foreach($results as $res){
            $heading = $res['heading'];
            $category = $res['category'];

            if($category == 'standard') {
                $SQL = "select y1.period as y1period, y2.period as y2period, y3.period as y3period, y4.period as y4period, y5.period as y5period, y6.period as y6period, 
y7.period as y7period, y8.period as y8period, y9.period as y9period, y10.period as y10period, y11.period as y11period, y12.period as y12period, 
y1.value as y1value, y2.value as y2value, y3.value as y3value, y4.value as y4value, y5.value as y5value, y6.value as y6value,  
y7.value as y7value, y8.value as y8value, y9.value as y9value, y10.value as y10value, y11.value as y11value, y12.value as y12value, 
y1.userid , ind.description, ind.type, ind.heading, ind.sort_order, ind.value
from indicators ind
  left outer join indicator_measures y1 on ind.id = y1.indicatorid and y1.userid = $user and y1.period = '$y1' and y1.committed = 1
  left outer join indicator_measures y2 on ind.id = y2.indicatorid and y2.userid = $user and y2.period = '$y2' and y2.committed = 1
  left outer join indicator_measures y3 on ind.id = y3.indicatorid and y3.userid = $user and y3.period = '$y3' and y3.committed = 1
  left outer join indicator_measures y4 on ind.id = y4.indicatorid and y4.userid = $user and y4.period = '$y4' and y4.committed = 1
  left outer join indicator_measures y5 on ind.id = y5.indicatorid and y5.userid = $user and y5.period = '$y5' and y5.committed = 1
  left outer join indicator_measures y6 on ind.id = y6.indicatorid and y6.userid = $user and y6.period = '$y6' and y6.committed = 1
  left outer join indicator_measures y7 on ind.id = y7.indicatorid and y7.userid = $user and y7.period = '$y7' and y7.committed = 1
  left outer join indicator_measures y8 on ind.id = y8.indicatorid and y8.userid = $user and y8.period = '$y8' and y8.committed = 1
  left outer join indicator_measures y9 on ind.id = y9.indicatorid and y9.userid = $user and y9.period = '$y9' and y9.committed = 1
  left outer join indicator_measures y10 on ind.id = y10.indicatorid and y10.userid = $user and y10.period = '$y10' and y10.committed = 1
  left outer join indicator_measures y11 on ind.id = y11.indicatorid and y11.userid = $user and y11.period = '$y11' and y11.committed = 1
  left outer join indicator_measures y12 on ind.id = y12.indicatorid and y12.userid = $user and y12.period = '$y12' and y12.committed = 1
where ind.heading = '$heading' and ind.visible = 1
ORDER BY ind.heading, ind.sort_order";
            }
            else{
                $SQL = "select y1.period as y1period, y2.period as y2period, y3.period as y3period, y4.period as y4period, y5.period as y5period, y6.period as y6period, 
y7.period as y7period, y8.period as y8period, y9.period as y9period, y10.period as y10period, y11.period as y11period, y12.period as y12period, 
y1.value as y1value, y2.value as y2value, y3.value as y3value, y4.value as y4value, y5.value as y5value, y6.value as y6value,  
y7.value as y7value, y8.value as y8value, y9.value as y9value, y10.value as y10value, y11.value as y11value, y12.value as y12value, 
y1.userid , ind.description, ind.type, ind.heading, ind.sort_order, ind.value
from indicators ind
  left outer join indicator_measures y1 on ind.id = y1.indicatorid and y1.userid = $user and y1.period = '$y1' and y1.committed = 1
  left outer join indicator_measures y2 on ind.id = y2.indicatorid and y2.userid = $user and y2.period = '$y2' and y2.committed = 1
  left outer join indicator_measures y3 on ind.id = y3.indicatorid and y3.userid = $user and y3.period = '$y3' and y3.committed = 1
  left outer join indicator_measures y4 on ind.id = y4.indicatorid and y4.userid = $user and y4.period = '$y4' and y4.committed = 1
  left outer join indicator_measures y5 on ind.id = y5.indicatorid and y5.userid = $user and y5.period = '$y5' and y5.committed = 1
  left outer join indicator_measures y6 on ind.id = y6.indicatorid and y6.userid = $user and y6.period = '$y6' and y6.committed = 1
    left outer join indicator_measures y7 on ind.id = y7.indicatorid and y7.userid = $user and y7.period = '$y7' and y7.committed = 1
  left outer join indicator_measures y8 on ind.id = y8.indicatorid and y8.userid = $user and y8.period = '$y8' and y8.committed = 1
  left outer join indicator_measures y9 on ind.id = y9.indicatorid and y9.userid = $user and y9.period = '$y9' and y9.committed = 1
  left outer join indicator_measures y10 on ind.id = y10.indicatorid and y10.userid = $user and y10.period = '$y10' and y10.committed = 1
  left outer join indicator_measures y11 on ind.id = y11.indicatorid and y11.userid = $user and y11.period = '$y11' and y11.committed = 1
  left outer join indicator_measures y12 on ind.id = y12.indicatorid and y12.userid = $user and y12.period = '$y12' and y12.committed = 1
where ind.heading = '$heading' and ind.userid = $user and ind.visible = 1
ORDER BY ind.heading, ind.sort_order";
            }

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

    public function mostRecentMeasures($userid){
        $this->db->select_max('period');
        $this->db->where('userid', $userid);
        $query = $this->db->get('indicator_measures');
        $results = $query->result_array();
        if(count($results) > 0) {
            $result = $results[0];
            return $result['period'];
        }
        return null;
    }

    public function completedforPeriod($period){
        $SQL = "select count(distinct(userid)) as cnt from indicator_measures where period = '$period' group by period";
        $query = $this->db->query($SQL);
        $results = $query->result_array();
        if(count($results) > 0) {
            $result = $results[0];
            return $result['cnt'];
        }
        return 0;
    }

    public function totalUsers(){
        $SQL = "select count(*) as cnt from users";
        $query = $this->db->query($SQL);
        $results = $query->result_array();
        if(count($results) > 0) {
            $result = $results[0];
            //subtract 1 for admin
            return $result['cnt'] -1;
        }
        return 0;
    }
}