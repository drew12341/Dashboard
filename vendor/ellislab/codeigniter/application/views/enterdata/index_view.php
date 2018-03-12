<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h4>Enter/View Data for: <?= $this->ion_auth->user()->row()->orgunit_name; ?></h4>
<br/>
<div class="row">
    <div class="col-lg-8">

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <form class="form-horizontal col-sm-12" autocomplete="on" method="post" accept-charset="utf-8">
            <div class="form-group">

                <label class="col-lg-1 control-label" for="year">Year</label>

                <div class="col-lg-2">
                    <select id="year" name="year" class="form-control col-lg-2">
                        <option>--</option>
                        <option value="<?=date("Y");?>" <?= ($year == date("Y")) ? 'selected' : '';  ?> ><?= date("Y");?></option>
                        <option
                            value="<?=date("Y", strtotime("-1 year"));?>" <?= ($year ==date("Y", strtotime("-1 year"))) ? 'selected' : '';  ?>  ><?=date("Y", strtotime("-1 year"));?></option>
						<option
                            value="<?=date("Y", strtotime("-2 year"));?>" <?= ($year ==date("Y", strtotime("-2 year"))) ? 'selected' : '';  ?>  ><?=date("Y", strtotime("-2 year"));?></option>
                    </select>
                </div>

                <label class="col-lg-1 control-label" for="period">Period</label>

                <div class="col-lg-2">
                    <select id="period" name="period" class="form-control col-lg-2">
                        <option>--</option>
                        <?php

                        foreach ($periods as $key => $value): ?>
                            <option value="<?= $key; ?>" <?= ($key == $period) ? 'selected' : '';  ?>  ><?=$key;?> (<?= $value ?>) </option>


                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-lg-2">
                    <input type="submit" class="btn btn-primary" value="Next"/>
                </div>

            </div>


        </form>
    </div>
</div>
<br/>

<script type="text/javascript">
    $( document ).ready( function() {
        var table1 = $( '#table-1' );

        // Initialize DataTable
        table1.DataTable( {
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "bStateSave": true,
            columnDefs: [ {
                targets: [4],
                render:  $.fn.dataTable.render.moment('h:mm:ss a, DD/MM/YYYY'),
            } ],
        });

        // Initalize Select Dropdown after DataTables is created
//        table1.closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
//            minimumResultsForSearch: -1
//        });

        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            // other options
        });
    } );
</script>


<div class="row">
    <div class="col-lg-8">
        <div id="previous_panel" class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">Completed Reports</div>

                <div class="panel-options">
                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                </div>
            </div>
            <div class="panel-body with-table">
                <table class="table table-bordered datatable" id="table-1">
                    <thead>
                    <tr>

                        <th></th>
                        <th>ID</th>
                        <th>Year</th>
                        <th>Period</th>
                        <th>Date Committed</th>
                        <th>Status</th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php foreach($measures as $measure):
                            $d = explode('-', $measure['period']);
                            $year = $d[0];
                            $period = $d[1];

                            $dashperiods =    explode(',', $this->config->item('dash_periods'));
                            $periodtext = $dashperiods[$period-1];


                            $status = ($measure['committed'])? 'Committed' : 'Draft';
                            ?>
                            <tr>
                                <td><a href="<?=site_url('EnterData/data/').$year.'/'.$period;?>" class="btn btn-primary">Open</a>

                                    <a
                                        class="btn btn-primary" data-toggle="confirmation"
                                        data-btn-ok-label="Delete" data-btn-ok-icon="glyphicon glyphicon-share-alt"
                                        data-btn-ok-class="btn-success"
                                        data-btn-cancel-label="Cancel" data-btn-cancel-icon="glyphicon glyphicon-ban-circle"
                                        data-btn-cancel-class="btn-danger"
                                        data-title="Warning" data-content="This will remove these records"
                                        href="<?=site_url('EnterData/remove/').$measure['period'].'/'.$measure['userid']?>">Delete</a>
                                </td>
                                <td><?=$measure['id'];?></td>
                                <td><?=$year;?> </td>
                                <td><?=$period;?> (<?= $periodtext; ?>)</td>
                                <td><?=(isset($measure['date_committed'])? $measure['date_committed']: null) ?></td>
                                <td><?=$status;?></td>

                            </tr>
                    <?php endforeach; ?>

                    </tbody>

                </table></div>
        </div>
    </div>
</div>

