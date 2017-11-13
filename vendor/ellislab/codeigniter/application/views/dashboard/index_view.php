

<?php if($this->ion_auth->logged_in()) : ?>
    <h4>Dashboard report for: <?=$this->ion_auth->user()->row()->orgunit_name;?></h4>
<?php endif; ?>


<div class="row">
    <div class="col-lg-12">

        <form class="form-horizontal col-sm-12" autocomplete="on" method="post" accept-charset="utf-8">
            <div class="form-group">

                <label class="col-lg-1 control-label" for="year">Year</label>

                <div class="col-lg-2">
                    <select id="year" name="year" class="form-control col-lg-2">
                        <option>--</option>
                        <option value="<?= date("Y"); ?>"><?= date("Y"); ?></option>
                        <option value="<?= date("Y", strtotime("-1 year")); ?>"><?= date("Y", strtotime("-1 year")); ?></option>
                    </select>
                </div>

                <label class="col-lg-1 control-label" for="period">Period</label>

                <div class="col-lg-2">
                    <select id="period" name="period" class="form-control col-lg-2">
                        <option>--</option>
                        <?php

                        foreach ($periods as $key=>$value): ?>
                            <option value="<?= $key; ?>"><?= $value ?></option>

                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </form>
    </div>
</div>



<div class="row">
<?php
$counter = 0;
foreach($sections as $key => $value) : ?>

            <div class="col-sm-6">
                <div id="<?=$key;?>_panel" class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="panel-title"><?= $this->config->item($key) ?></div>

                        <div class="panel-options">
                            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                            <a href="#"  data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                        </div>
                    </div>
                    <table class="table table-bordered table-responsive">
                        <thead>
                        <tr>

                            <th></th>
                            <th>Previous</th>
                            <th>Current</th>
                            <th>Score</th>
                            <th>Trend</th>
                        </tr>
                        </thead>

                        <tbody>

                        <?php foreach($value as $row):
                            $arrow = '';
                            $button = '';
                            $badge = '';
                            $indicator_threshold = $this->config->item('indicator_threshold');
                            $percent = '';

                            if ($row['current'] > $row['previous']){
                                $arrow = 'entypo-up';
                                $button = 'btn-green';
                            }
                            if ($row['current'] < $row['previous']){
                                $arrow = 'entypo-down';
                                $button = 'btn-red';
                            }
                            if ($row['current'] == $row['previous']){
                                $arrow = 'entypo-switch';
                                $button = 'btn-gold';
                            }

                            if($row['type'] == 'True/False'){
                                $badge = ($row['current']) ? 'badge-success' : 'badge-danger';
                                $row['previous'] = ($row['previous']? 'Yes': 'No');
                                $row['current'] = ($row['current']? 'Yes': 'No');
                            }
                            if($row['type'] == 'Absolute'){
                                $badge = ($row['current'] > $row['value']) ? 'badge-success' : 'badge-danger';
                            }
                            if($row['type'] == 'Percentage'){
                                $percent = '%';
                                if($row['current'] > $row['value'] ){
                                    $badge = 'badge-success';
                                }
                                else if($row['current'] > $row['value'] - $indicator_threshold){
                                    $badge = 'badge-warning';
                                }
                                else{
                                    $badge = 'badge-danger';
                                }
                            }


                            ?>
                            <tr>

                                <td><?= $row['description'];?></td>
                                <td><?= $row['previous'].$percent;?></td>
                                <td><?= $row['current'].$percent;?></td>
                                <td class="text-center"><i class="badge <?=$badge;?>">&nbsp;</i></td>
                                <td class="text-center"><i class="<?=$arrow;?> dashboard-icon <?=$button;?>"></i></td>
                            </tr>

                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
                <!-- Chart -->
                <div id="<?=$key;?>"></div>
            </div>

    <?php if ($counter % 2 != 0): ?>
        </div>
        <div class="row">
    <?php endif;
    $counter++; ?>

<?php endforeach; ?>

</div>



<script type="text/javascript">

    // Line Charts
    var line_chart_demo = $("#4_proactive_approach");

    var line_chart = Morris.Line({
        element: '4_proactive_approach',
        data: [
            { y: '2017-1', a: 100, b: 90 },
            { y: '2017-2', a: 75,  b: 65 },
            { y: '2017-3', a: 50,  b: 40 },

        ],
        xkey: 'y',
        ykeys: ['a', 'b'],
        redraw: true
    });

    //line_chart_demo.parent().attr('style', '');



    $('body').on('click', '.panel > .panel-heading > .panel-options > a[data-rel="reload"]', function(ev)
    {
        ev.preventDefault();

        var $this = jQuery(this).closest('.panel');

        blockUI($this);
        $this.addClass('reloading');

        console.log($this.attr('id'));
        setTimeout(function()
        {
            unblockUI($this)
            $this.removeClass('reloading');

        }, 900)
    });


</script>
