<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
function set_value_AA($field, $current_values) {
    if (isset($_POST['data'][$field]))
    {
        return $_POST['data'][$field];

    }
    return (isset($current_values[$field])) ? $current_values[$field] : '';
}
?>

<h3>Enter Data for: <?= $this->ion_auth->user()->row()->orgunit_name; ?></h3>
<br/>
<div class="row">
    <div class="col-lg-12">

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <form class="form-horizontal col-sm-12" autocomplete="on" method="post" accept-charset="utf-8">
            <div class="form-group">

                <label class="col-lg-1 control-label" for="year">ID</label>
                <span class="col-lg-2 label-value"><?= $id.'-'.$year.'-'.$period; ?></span>

                <label class="col-lg-1 control-label" for="year">Year</label>
                <span class="col-lg-2 label-value"><?= $year; ?></span>


                <label class="col-lg-1 control-label" for="period">Period</label>
                <span class="col-lg-2 label-value"><?= $period_txt; ?></span>


                <label class="col-lg-1 control-label" for="status">Status</label>
                <span class="col-lg-2 label-value"><?= $status ?></span>


            </div>


        </form>
    </div>
</div>



<form class="form-horizontal col-sm-12" id="mainform" autocomplete="on" method="post" accept-charset="utf-8">

    <input type="hidden" name="year"    value="<?= $year; ?>"/>
    <input type="hidden" name="period"  value="<?= $period; ?>"/>
    <input type="hidden" name="committed" id="committed" value="1"/>


    <!---- render page from array ---->
    <?php foreach ($sections as $key => $value): ?>
        <div class="row">
            <div class="col-lg-12">

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th><?= $this->config->item($key) ?></th>
                        <th class="col-lg-2">Previous</th>
                        <th class="col-lg-2">Current</th>
                    </tr>

                    </thead>
                    <tbody>
                    <?php foreach($value as $row): ?>
                        <tr>
                            <td>
                                <?= $row['description']; ?>
                            </td>
                            <td>
                                <?php if(isset($previous_values[$row['id']])){
                                    echo $previous_values[$row['id']];
                                }
                                else{
                                    echo 'N/A';
                                }
                                ?>
                            </td>
                            <td>
                                <input class="form-control"
                                       <?= ($status == 'Committed') ? 'readonly' : ''; ?>
                                       name="data[<?=$row['id'];?>]"
                                       value="<?= set_value_AA($row['id'], $current_values); ?>"

                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>

    <?php endforeach; ?>

    <a href="<?= site_url('EnterData/');?>" class="btn btn-primary" >Back </a>

    <input type="button" id="draftbtn" class="btn btn-primary" value="Save as Draft"/>
    <input type="submit" class="btn btn-primary" <?= ($status == 'Committed') ? 'disabled' : ''; ?>
           value="Commit"/>

    <br/>
</form>

<style type="text/css">
    .label-value{
        padding: 7px 12px;
    }
</style>

<script type="text/javascript">
    $("#draftbtn").click(function(){
        $("#committed").val(0);
        $("#mainform").submit();
    });
</script>