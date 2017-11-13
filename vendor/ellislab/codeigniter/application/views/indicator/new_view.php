<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row">
    <div class="col-lg-12">
    <h1>New Indicator</h1>

        <?php if (isset($_SESSION['message'])) : ?>
            <div class="alert alert-success"><?=$_SESSION['message'];?>
            </div>
        <?php endif; ?>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>


    <?= $this->form_builder->open_form(array('action' => ''));
    echo $this->form_builder->build_form_horizontal(
    array(

        array(
            'id' => 'description'
        ),
        array(
            'id' => 'type',
            'type' => 'dropdown',
            'options' => $types,

        ),

        array(
            'id' => 'value',
            'label'=>'target'
        ),
        array(
            'id' => 'submit',
            'type' => 'submit',
            'label'=>'Save'

        )
    )
    );

    ?>
    </div>
</div>
<script type="text/javascript">
    $("#type").change(function(){
        if($( this ).val() == 'True/False'){
            var combo = $("<select></select>").attr("id", 'value').attr("name", 'value').attr('class', 'valid form-control');

            combo.append("<option>True</option>");
            combo.append("<option>False</option>");
            $('#value').replaceWith(combo);
        }
        else if($( this ).val() == 'Percentage'){
            var input = $("<input/>").attr("id", 'value').attr("name", 'value').attr('class', 'valid form-control').attr('placeholder', 'Target:90');
            $('#value').replaceWith(input);
        }
        else if($( this ).val() == 'Absolute') {
            var input = $("<input/>").attr("id", 'value').attr("name", 'value').attr('class', 'valid form-control').attr('placeholder', 'Target:50');
            $('#value').replaceWith(input);
        }
    })

</script>
