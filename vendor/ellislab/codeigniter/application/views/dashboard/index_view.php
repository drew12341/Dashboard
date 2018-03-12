<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<?php if ($this->ion_auth->is_admin() && (!isset($_SESSION['emulate']) || $this->ion_auth->user()->row()->id == $_SESSION['emulate']))  : ?>
    <span>&nbsp;</span>
<?php else : ?>

    <div class="col-md-6 col-sm-6 clearfix">
        <?php
        //if($this->ion_auth->is_admin()):
        $em = $this->ion_auth->get_all_id();
        if(isset($_SESSION['emulate'])) {
            $sel = $_SESSION['emulate'];
        }
        else{
            $sel = 0;
        }
        ?>

        <span style="padding-left:20px;">&nbsp;Viewing as: &nbsp;</span>
        <select style="float:right;width:auto;display:inline-block" id="emulate" class="form-control">
            <?php foreach($em as $key=>$value): ?>
                <option <?=($sel == $key)? 'selected' : '' ?> value="<?=$key;?>"><?=$value;?></option>
            <?php endforeach;?>
        </select>

        <script type="text/javascript">
            $("#emulate").change(function(){
                v = $("#emulate").val();
                d = $("#emulate option:selected").text();


                //console.log(v);

                jQuery.ajax({
                    url: "<?php echo site_url('ajax'); ?>/setSession/"+v+"/"+d,
                    type: 'GET',
                    dataType: 'json',
                    async: true,
                    success: handleData,
                });
            });

            function handleData(data) {
                //console.log("handled");
                //location.reload();
                window.location = '<?php echo site_url();?>';
                return false;

            }

        </script>

    </div>


<div class="col-md-12 col-sm-12 clearfix">
        <?php if (isset($_SESSION['emulated_name'])): ?>
            <h4>Dashboard report for: <?= urldecode($_SESSION['emulated_name']); ?></h4>

        <?php elseif($this->ion_auth->logged_in()): ?>
            <h4>Dashboard report for: <?= $this->ion_auth->user()->row()->orgunit_name; ?></h4>
            <?php else: ?>
            <h4>Dashboard report for: UTS Wide</h4>
        <?php endif; ?>

</div>


    <div class="row">
        <div class="col-lg-12">

            <form class="form-horizontal col-sm-12" autocomplete="on" method="post" accept-charset="utf-8">
                <div class="form-group">

                    <label class="col-lg-1 control-label" for="year">Year</label>

                    <div class="col-lg-2">
                        <select id="year" name="year" class="form-control col-lg-2">
                            <option>--</option>
                            <option
                                value="<?= date("Y"); ?>" <?= ($year == date("Y")) ? 'selected' : ''; ?> ><?= date("Y"); ?></option>
                            <option
                                value="<?= date("Y", strtotime("-1 year")); ?>" <?= ($year == date("Y", strtotime("-1 year"))) ? 'selected' : ''; ?> ><?= date("Y", strtotime("-1 year")); ?></option>
                        </select>
                    </div>

                    <label class="col-lg-1 control-label" for="period">Period</label>

                    <div class="col-lg-2">
                        <select id="period" name="period" class="form-control col-lg-2">
                            <option>--</option>
                            <?php

                            foreach ($periods as $key => $value): ?>
                                <option
                                    value="<?= $key; ?>" <?= ($key == $period) ? 'selected' : ''; ?> ><?= $value ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>




    <div class="row">
        <div class="col-sm-6">
             <div class="panel panel-primary">
                    <div class="panel-body with-table">
                        <table class="table table-bordered table-responsive">
                            <tr>
                                <td><i class="badge badge-success">&nbsp;</i> &nbsp;On Track</td>
                                <td><i class="entypo-up dashboard-icon btn-green">&nbsp;</i>&nbsp;Performance Improving</td>
                            </tr>
                            <tr>
                                <td><i class="badge badge-warning">&nbsp;</i> &nbsp;Needs Improvement</td>
                                <td><i class="entypo-down dashboard-icon btn-red">&nbsp;</i>&nbsp;Performance Declining</td>
                            </tr>
                            <tr>
                                <td><i class="badge badge-danger">&nbsp;</i> &nbsp;Further Work Required</td>
                                <td><i class="entypo-switch dashboard-icon btn-gold">&nbsp;</i>&nbsp;Performance Improving</td>
                            </tr>
                        </table>
                    </div>
                </div>

            <?php
            $counter = 1;
            foreach ($sections as $key => $value) : ?>


            <div id="<?= $key; ?>_panel" class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title"><?= $this->config->item($key) ?></div>

                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    </div>
                </div>
                <table class="table table-bordered table-responsive">
                    <thead>
                    <tr>

                        <th></th>
                        <th>Previous</th>
                        <th>Current</th>
                        <th>Target</th>
                        <th>Trend</th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php if (count($value) == 0) : ?>
                        <tr>
                            <td>No Data for this period</td>
                        </tr>
                    <?php endif; ?>

                    <?php foreach ($value as $row):
                        $arrow = '';
                        $button = '';
                        $badge = '';
                        $indicator_threshold = $this->config->item('indicator_threshold');
                        $percent = '';


                        if ($row['current'] > $row['previous']) {
                            $arrow = 'entypo-up';
                            $button = 'btn-green';
                        }
                        if ($row['current'] < $row['previous']) {
                            $arrow = 'entypo-down';
                            $button = 'btn-red';
                        }
                        if ($row['current'] == $row['previous']) {
                            $arrow = 'entypo-switch';
                            $button = 'btn-gold';
                        }


                        if ($row['type'] == 'True/False') {
                            $badge = ($row['current']) ? 'badge-success' : 'badge-danger';
                            if (isset($row['previous'])) {
                                $row['previous'] = ($row['previous'] ? 'Yes' : 'No');
                            }
                            if (isset($row['current'])) {
                                $row['current'] = ($row['current'] ? 'Yes' : 'No');
                            }
                        }
                        if ($row['type'] == 'Absolute') {
                            $badge = ($row['current'] > $row['value']) ? 'badge-success' : 'badge-danger';
                        }
                        if ($row['type'] == 'Percentage') {
                            $percent = '%';
                            if ($row['current'] > $row['value']) {
                                $badge = 'badge-success';
                            } else if ($row['current'] > $row['value'] - $indicator_threshold) {
                                $badge = 'badge-warning';
                            } else {
                                $badge = 'badge-danger';
                            }
                        }

                        if (!$row['traffic_light']) {
                            $button = 'btn-grey';
                            $badge = '';
                        }

                        ?>
                        <tr>

                            <td><?= $row['description']; ?></td>
                            <td><?= $row['previous'] ?> <?= isset($row['previous']) ? $percent : ''; ?></td>
                            <td><?= $row['current'] ?> <?= isset($row['current']) ? $percent : ''; ?></td>
                            <td class="text-center"><i class="badge <?= $badge; ?>">&nbsp;</i></td>
                            <td class="text-center"><i class="<?= $arrow; ?> dashboard-icon <?= $button; ?>"></i></td>
                        </tr>

                    <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
            <!-- Chart -->
            <?php if (isset($chartData[$key]) && count($chartData[$key]) > 0): ?>

                <div id="<?= $key; ?>_chart" class="panel panel-primary">

                    <div class="panel-heading">
                        <div class="panel-title"><?= $this->config->item($key) ?> Chart</div>
                        <div class="panel-options">
                            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        </div>
                    </div>
                    <div class="panel-body with-chart">

                        <div style="height:150px" id="<?= preg_replace('/[0-9]+/', '', $key); ?>"></div>
                    </div>
                </div>

                <script type="text/javascript">

                    var counter = <?=$counter;?>;

                    var d = <?=json_encode($chartData[$key]);?>;
                    //console.log(d);
                    var keys = Object.keys(d[0]);
                    keys.splice(0, 1);


                    var line_chart = MTA.Line({
                            element: '<?=preg_replace('/[0-9]+/', '', $key);?>',
                            data: d,
                            xkey: 'period',
                            ykeys: keys,
                            labels: keys,
                            redraw: true,
                            ymax: 100,
                            postUnits: '%',
                            parseTime: false,
                            hideHover: true,


                        },
                        true);


                </script>
            <?php endif; ?>



            <?php if ($counter == floor(count($sections) / 2.0)): ?>
        </div>
        <div class="col-sm-6">
            <?php endif;

            $counter++; ?>

            <?php endforeach; ?>
        </div>
    </div>

    <script type="text/javascript">

        $("#year").change(function () {
            url = '<?php echo site_url('Dashboard/index');?>';
            year = $.trim($("#year").val());
            period = $.trim($("#period").val());
            window.location.href = url + '/' + year + '/' + period;

        });

        $("#period").change(function () {
            url = '<?php echo site_url('Dashboard/index');?>';
            year = $.trim($("#year").val());
            period = $.trim($("#period").val());
            window.location.href = url + '/' + year + '/' + period;
        });
    </script>

<?php endif; ?>

<?php if(!$utswide && isset($date_committed)): ?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-body ">
        Dashboard report for <?=$period_txt;?> <?=$year;?> committed on <?=date("g:i a d/m/Y", strtotime($date_committed)); ?>
            </div>
            </div>
        </div>
    </div>
    <?php endif;?>
<?php if(!$utswide && isset($comments)): ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-body ">
                   Comments:  <?=$comments;?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>