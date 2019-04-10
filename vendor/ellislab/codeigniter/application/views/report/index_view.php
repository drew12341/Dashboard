<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if($this->ion_auth->is_admin() && (!isset($_SESSION['emulate']) || $this->ion_auth->user()->row()->id == $_SESSION['emulate']))  : ?>
    <?php if( $this->ion_auth->is_admin())  : ?>
        <span><a href="<?= site_url('Dashboard/meetingPackPDF');?>" class="btn btn-primary" >Generate Dashboard Meeting Pack Report&nbsp; (takes ~30 seconds)</a></span>
    <?php else: ?>
        <span> </span>
    <?php endif; ?>
<?php else : ?>


    <?php if($this->ion_auth->is_admin() && isset($_SESSION['emulated_name'])):
            $orgunit = urldecode($_SESSION['emulated_name']); ?>
        <h4>Report for: <?= urldecode($_SESSION['emulated_name']); ?></h4>

    <?php else:
            $orgunit = $this->ion_auth->user()->row()->orgunit_name; ?>
        <h4>Report for: <?= $this->ion_auth->user()->row()->orgunit_name; ?></h4>
    <?php endif; ?>




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
						<option
                            value="<?=date("Y", strtotime("-2 year"));?>" <?= ($year ==date("Y", strtotime("-2 year"))) ? 'selected' : '';  ?>  ><?=date("Y", strtotime("-2 year"));?></option>
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
                        <th>Jan</th>
                        <th>Feb</th>
                        <th>Mar</th>
                        <th>Apr</th>
                        <th>May</th>
                        <th>Jun</th>
                        <th>Jul</th>
                        <th>Aug</th>
                        <th>Sept</th>
                        <th>Oct</th>
                        <th>Nov</th>
                        <th>Dec</th>



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

                                <td><?=(isset($row['y7value'])) ? ($row['y7value']) ? 'Yes' : 'No' : '';?> </td>
                                <td><?=(isset($row['y8value'])) ? ($row['y8value']) ? 'Yes' : 'No' : '';?> </td>
                                <td><?=(isset($row['y9value'])) ? ($row['y9value']) ? 'Yes' : 'No' : '';?> </td>
                                <td><?=(isset($row['y10value'])) ? ($row['y10value']) ? 'Yes' : 'No' : '';?> </td>
                                <td><?=(isset($row['y11value'])) ? ($row['y11value']) ? 'Yes' : 'No' : '';?> </td>
                                <td><?=(isset($row['y12value'])) ? ($row['y12value']) ? 'Yes' : 'No' : '';?> </td>

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

                                <td><?=(isset($row['y7value']))? $row['y7value'].$percent : '' ;?></td>
                                <td><?=(isset($row['y8value']))? $row['y8value'].$percent : '' ;?></td>
                                <td><?=(isset($row['y9value']))? $row['y9value'].$percent : '' ;?></td>
                                <td><?=(isset($row['y10value']))? $row['y10value'].$percent : '' ;?></td>
                                <td><?=(isset($row['y11value']))? $row['y11value'].$percent : '' ;?></td>
                                <td><?=(isset($row['y12value']))? $row['y12value'].$percent : '' ;?></td>

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
    var orgunit = "<?=$orgunit;?>";


    $(document).ready(function() {
        $('#table1').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15],
                    },
                    filename:'UTS | WHS Dashboard for '+orgunit,
                    title:'UTS | WHS Dashboard for '+orgunit
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [0, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15],
                    },
                    filename:'UTS | WHS Dashboard for '+orgunit,
                    title:'UTS | WHS Dashboard for '+orgunit
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15],
                    },
                    filename:'UTS | WHS Dashboard for '+orgunit,
                    title:'UTS | WHS Dashboard for '+orgunit
                },
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

<?php endif; ?>