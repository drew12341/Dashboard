<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<h3> Reports</h3>


<div class="row">
    <div class="col-lg-8">

        <form class="form-horizontal col-sm-12" autocomplete="on" method="post" accept-charset="utf-8">
            <div class="form-group">

                <label class="col-lg-1 control-label" for="year">Year</label>

                <div class="col-lg-2">
                    <select id="year" name="year" class="form-control col-lg-2">
                        <option>--</option>
                        <option value="<?=date("Y");?>" <?= ($year == date("Y")) ? 'selected' : '';  ?> ><?= date("Y");?></option>
                        <option
                            value="<?=date("Y", strtotime("-1 year"));?>" <?= ($year ==date("Y", strtotime("-1 year"))) ? 'selected' : '';  ?>  ><?=date("Y", strtotime("-1 year"));?></option>
                    </select>
                </div>
            </div>
        </form>
    </div>
</div>


<table id="example" class="display nowrap" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th>Name</th>
        <th>Position</th>
        <th>Office</th>
        <th>Age</th>
        <th>Start date</th>
        <th>Salary</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>Name</th>
        <th>Position</th>
        <th>Office</th>
        <th>Age</th>
        <th>Start date</th>
        <th>Salary</th>
    </tr>
    </tfoot>
    <tbody>
    <tr>
        <td>Tiger Nixon</td>
        <td>System Architect</td>
        <td>Edinburgh</td>
        <td>61</td>
        <td>2011/04/25</td>
        <td>$320,800</td>
    </tr>
    </table>


<div class="row">
    <div class="col-lg-8">
        <div id="previous_panel" class="panel panel-primary">

            <div class="panel-body with-table">
                <table class="table datatables table-striped table-bordered" id="table1">


                    <tbody>
                <?php foreach ($sections as $key => $value): ?>


                        <tr class="header">


                            <td><?= $this->config->item($key) ?></td>
                            <td>Feb-Mar</td>
                            <td>Apr-May</td>
                            <td>Jun-Jul</td>
                            <td>Aug-Sept</td>
                            <td>Oct-Nov</td>
                            <td>Dec-Jan</td>
                        </tr>



                        <?php foreach($value as $row):
                            $percent = '';
                            if ($row['type'] == 'Percentage') {
                                $percent = '%';
                            }
                            ?>
                            <?php if($row['type'] == 'True/False'): ?>
                            <tr>

                                <td class="col-lg-4"><?=$row['description'];?></td>
                                <td><?=(isset($row['y1value'])) ? ($row['y1value']) ? 'Yes' : 'No' : '';?> </td>
                                <td><?=(isset($row['y2value'])) ? ($row['y2value']) ? 'Yes' : 'No' : '';?> </td>
                                <td><?=(isset($row['y3value'])) ? ($row['y3value']) ? 'Yes' : 'No' : '';?> </td>
                                <td><?=(isset($row['y4value'])) ? ($row['y4value']) ? 'Yes' : 'No' : '';?> </td>
                                <td><?=(isset($row['y5value'])) ? ($row['y5value']) ? 'Yes' : 'No' : '';?> </td>
                                <td><?=(isset($row['y6value'])) ? ($row['y6value']) ? 'Yes' : 'No' : '';?> </td>

                            </tr>
                            <?php else: ?>
                            <tr>

                                <td class="col-lg-4"><?=$row['description'];?></td>
                                <td><?=(isset($row['y1value']))? $row['y1value'].$percent : '' ;?></td>
                                <td><?=(isset($row['y2value']))? $row['y2value'].$percent : '' ;?></td>
                                <td><?=(isset($row['y3value']))? $row['y3value'].$percent : '' ;?></td>
                                <td><?=(isset($row['y4value']))? $row['y4value'].$percent : '' ;?></td>
                                <td><?=(isset($row['y5value']))? $row['y5value'].$percent : '' ;?></td>
                                <td><?=(isset($row['y6value']))? $row['y6value'].$percent : '' ;?></td>

                            </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>



                <?php endforeach; ?>
                    </tbody>

                </table>

            </div>
        </div>
    </div>
</div>

<button type="button" id="mybtn"/>PRINT</button>

<script type="text/javascript">

    $("#year").change(function(){
        url = '<?php echo site_url('Report/index');?>';
        year = $.trim($("#year").val());
        window.location.href = url+'/'+year;

    });
    </script>



<script type="text/javascript">
    $(document).ready(function() {
        $("#mybtn").click(function() {
            $('#table1').tableExport({type: 'csv'});
        });
    });
</script>