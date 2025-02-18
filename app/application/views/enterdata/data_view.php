<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
//echo json_encode($current_values);
//echo $this->config->item('incidents_hazards_title') ;

function set_value_AA($field, $current_values) {
    if (isset($_POST['data'][$field]))
    {
        return $_POST['data'][$field];
    }
    return (isset($current_values[$field])) ? $current_values[$field] : '';
}
function set_value_staff($field, $current_staff_values) {
    if (isset($_POST['staff'][$field]))
    {
        return $_POST['staff'][$field];
    }
    return (isset($current_staff_values[$field])) ? $current_staff_values[$field] : '';
}
function set_value_completions($field, $current_completion_values) {
    if (isset($_POST['completions'][$field]))
    {
        return $_POST['completions'][$field];
    }
    return (isset($current_completion_values[$field])) ? $current_completion_values[$field] : '';
}
?>

<h3>Enter Data for: <?= $this->ion_auth->user()->row()->orgunit_name; ?></h3>
<br/>
<div class="row">
    <div class="col-lg-10">

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <form class="form-horizontal col-sm-12" autocomplete="on" method="post" accept-charset="utf-8" >
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
    <form role="form" class="form-horizontal col-lg-10 validate" id="mainform" autocomplete="on" method="post" accept-charset="utf-8">

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
                            <th class="col-lg-5">Current</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($value as $row): ?>
                            <?php if($row['visible']):?>
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
                                    <?php if($row['type'] != 'True/False' && $row['type'] != 'Calculated'): ?>
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
                                    <?php elseif ($row['type'] == 'True/False'): ?>
                                        <select class="form-control" data-first-option="false" name="data[<?=$row['id'];?>]" >
                                            <option value="1">True</option>
                                            <option value="0">False</option>
                                        </select>
                                    <?php elseif ($row['type'] == 'Calculated'):
                                        $placeholder_denominator = '# of Staff in Group';
                                        $placeholder_numerator  = '# of Completions';
                                        $label_denominator = '# Staff';
                                        $label_numerator = '# Completions';

                                        if ($row['description'] == $this->config->item('incidents_hazards_title')){
                                            $placeholder_denominator = '# of Incident and Hazards reported';
                                            $placeholder_numerator  = '# reported within 24 hours';
                                            $label_denominator = '# Hazards';
                                            $label_numerator = '# in last 24 hours';
                                        }

                                        ?>
                                        <?php if ($status == 'Committed'): ?>

                                            <input class="form-control" readonly
                                                   value="<?= round(set_value_AA($row['id'], $current_values),0); ?>" />
                                            <span class="input-group-addon">%</span>

                                            <span class="input-group-addon"><i class="entypo-chart-pie"><?= strval(set_value_completions($row['id'], $current_completion_values).'/'.strval(set_value_staff($row['id'], $current_staff_values))) ?></i></span>

                                        <?php else:?>
                                        <input class="form-control" name="staff[<?=$row['id'];?>]" id="staff_<?=$row['id'];?>"
                                               <?php if($row['mandatory']):?>
                                                data-validate="required,number,min[0]"
                                                data-message-required="Please provide a number"
                                               <?php endif ?>

                                               value="<?= set_value_staff($row['id'], $current_staff_values); ?>"

                                               type="text"
                                               placeholder="<?=$placeholder_denominator;?>"
                                        />
                                            <span class="input-group-addon"><?=$label_denominator;?></span>

                                        <input class="form-control lessThan" name="completions[<?=$row['id'];?>]"
                                               data-reference="staff_<?=$row['id'];?>"
                                            <?php if($row['mandatory']):?>
                                                data-validate="required,number,min[0],lessThan"
                                                data-message-required="Please provide a number"

                                            <?php endif ?>
                                            <?= ($status == 'Committed') ? 'readonly' : ''; ?>
                                               value="<?= set_value_completions($row['id'], $current_completion_values); ?>"

                                               type="text" placeholder="<?=$placeholder_numerator;?>"/>
                                            <span class="input-group-addon"><?=$label_numerator;?></span>
                                        <?php endif; ?>
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
                        endif;
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
                    <tr>
                        <td>
                            <textarea rows="3" class="form-control" type="text" name="comments"><?=$comments;?></textarea>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Data Entered By</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <textarea rows="3" class="form-control" type="text" name="data_entered_by"><?=$data_entered_by;?></textarea>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <a href="<?= site_url('EnterData/');?>" class="btn btn-primary" >Back </a>

                <input type="button" formnovalidate="formnovalidate"  id="draftbtn" class="btn btn-primary" <?= ($status == 'Committed') ? 'disabled' : ''; ?> value="Save as Draft"/>
                <input type="submit" id="submitbtn"
                       data-btn-ok-label="Continue" data-btn-ok-class="btn-success"
                       data-btn-ok-icon-class="material-icons" data-btn-ok-icon-content="check"
                       data-btn-cancel-label="Cancel" data-btn-cancel-class="btn-danger"
                       data-btn-cancel-icon-class="material-icons" data-btn-cancel-icon-content="close"
                       data-title="Commit" data-content="Are you sure? Data cannot be edited once committed."
                       data-toggle="confirmation" class="btn btn-primary" <?= ($status == 'Committed') ? 'disabled' : ''; ?>
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
        $("#mainform").unbind('submit').submit();
    });

    $(document).ready(function() {
        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            // other options
        });
        
        jQuery.validator.addMethod("lessThan", function(value, e1) {
            var id = $(e1).data('reference');
            return parseInt($(e1).val(), 10) <= parseInt($('#'+id).val(), 10);
        }, "Percentage cannot be greater than 100");

        //Add class based validation rule for 'required' inputs
        jQuery.validator.addClassRules("lessThan", {
            lessThan: true,
        });

    });



</script>