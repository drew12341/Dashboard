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
    <div class="col-lg-8">

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


<div class="row">
    <form role="form" class="form-horizontal col-lg-8 validate" id="mainform" autocomplete="on" method="post" accept-charset="utf-8">

        <input type="hidden" name="year"    value="<?= $year; ?>"/>
        <input type="hidden" name="period"  value="<?= $period; ?>"/>
        <input type="hidden" name="committed" id="committed" value="1"/>


        <!---- render page from array ---->
        <?php
        $lastrow = array();
        foreach ($sections as $key => $value): ?>
            <div class="row">
                <div class="col-lg-12">

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th><?= $this->config->item($key) ?></th>
                            <th class="col-lg-2">Previous</th>
                            <th class="col-lg-4">Current</th>
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

                                <td class="input-group" style="width:100%">


                                    <?php if($row['type'] != 'True/False'): ?>
                                        <input class="form-control"
                                            <?= ($status == 'Committed') ? 'readonly' : ''; ?>
                                               name="data[<?=$row['id'];?>]"
                                               type="text"
                                               value="<?= set_value_AA($row['id'], $current_values); ?>"

                                            <?php if($row['mandatory'] && $row['type'] == 'Percentage'){ ?>
                                                data-validate="required,number,max[100],min[0]"
                                                data-message-required="Please provide a number < 100"
                                                placeholder="Required Field"

                                            <?php }else if($row['type'] == 'Percentage'){ ?>
                                                data-validate="number,max[100],min[0]"
                                                data-message-required="Please provide a number < 100"


                                            <?php } else if($row['mandatory']){ ?>
                                                data-validate="required,number"
                                                data-message-required="Please provide a number"
                                                placeholder="Required Field"
                                            <?php } else{ ?>
                                                data-validate="number"
                                                data-message-required="Must be numeric"
                                            <?php }; ?>
                                        >
                                    <?php else: ?>
                                        <select class="form-control" data-first-option="false" name="data[<?=$row['id'];?>]" >
                                            <option value="1">True</option>
                                            <option value="0">False</option>
                                        </select>
                                    <?php endif; ?>

                                    <?php if($row['type'] == 'Percentage'): ?>
                                        <span class="input-group-addon">%</span>
                                    <?php endif; ?>

                                    <!-- can display previous values, targets etc in this annotation box.  commented out for now (remove this 'false' condition to enable) -->

                                    <?php if(false && $row['type'] == 'Absolute'): ?>
                                        <?php if($row['description'] == 'No-lost-time injuries reported'): ?>
                                            <span class="input-group-addon"><i class="entypo-target">:
                                                    <?=(isset($previous_values[$row['id']]))?
                                                        $previous_values[$row['id']] : 'N/A';
                                                    ?></i></span>
                                        <?php else: ?>
                                            <span class="input-group-addon"><i class="entypo-target">:<?=$row['value'];?></i></span>
                                        <?php endif; ?>
                                    <?php endif; ?>


                                </td>
                            </tr>
                        <?php
                        $lastrow = $row;
                        endforeach; ?>

                        </tbody>
                    </table>

                </div>
            </div>

        <?php endforeach; ?>

        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Comments</th>
                    </tr>

                    </thead>
                    <tbody>
                    <!-- comments section -->

                    <tr><td><textarea rows="3" class="form-control" type="text" name="comments"><?=$comments;?></textarea></td></tr>
                    </tbody>
                </table>


                <a href="<?= site_url('EnterData/');?>" class="btn btn-primary" >Back </a>

                <input type="button" id="draftbtn" class="btn btn-primary" <?= ($status == 'Committed') ? 'disabled' : ''; ?> value="Save as Draft"/>
                <input type="submit" class="btn btn-primary" <?= ($status == 'Committed') ? 'disabled' : ''; ?>
                       value="Commit"/>

                <br/>
    </form>
</div>
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