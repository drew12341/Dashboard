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





<div class="row">
    <div class="col-lg-8">
        <div id="previous_panel" class="panel panel-primary">

            <div class="panel-body with-table">
                <table class="table datatables table-striped table-bordered" id="table1">
                    <thead>
                    <tr>
                        <th>Group</th>
                        <th>Group Sorting</th>
                        <th>Row Sorting</th>
                        <th>Description</th>

                        <th>Feb-Mar</th>
                        <th>Apr-May</th>
                        <th>Jun-Jul</th>
                        <th>Aug-Sept</th>
                        <th>Oct-Nov</th>
                        <th>Dec-Jan</th>


                    </tr>
                    </thead>

                    <tbody>
                <?php foreach ($sections as $key => $value): ?>


                        <?php foreach($value as $row):
                            $percent = '';
                            if ($row['type'] == 'Percentage') {
                                $percent = '%';
                            }
                            ?>
                            <?php if($row['type'] == 'True/False'): ?>
                            <tr>

                                <td><?= $this->config->item($key) ?></td>
                                <td><?=$key;?></td>
                                <td><?=$row['sort_order'];?></td>
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
                                <td><?= $this->config->item($key) ?></td>
                                <td><?=$key;?></td>
                                <td><?=$row['sort_order'];?></td>
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



<script type="text/javascript">

    $("#year").change(function(){
        url = '<?php echo site_url('Report/index');?>';
        year = $.trim($("#year").val());
        window.location.href = url+'/'+year;

    });


    $(document).ready(function() {
        $('#table1').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'pdf', 'print'
            ],
            "order": [[1, "asc"],[2, "asc"]],
            rowGroup: {
                dataSrc: 0
            },
            columnDefs: [
                {
                    targets: [0, 1, 2],
                    visible: false,
                    searchable: false
                },

            ],
            paging: false

        } );
    } );

</script>

<style type="text/css">
    #table1_info{
        display:none;
    }
</style>