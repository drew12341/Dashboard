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



    $items = array();

    if($this->ion_auth->is_admin()) {
        $items[] = array(
            'id' => 'heading',
            'type' => 'dropdown',
            'options' => $standard_types,
            'label' => 'Heading'
        );
    }

    $items[] = array(
        'id' => 'description'
    );

    $items[] = array(
        'id' => 'type',
        'type' => 'dropdown',
        'options' => $types,
    );

     $items[] =    array(
            'id' => 'value',
            'label'=>'Target'
        );
    $items[] = array(
            'id' => 'mandatory',
            'type'=>'checkbox',
            'label'=>'Mandatory',
            'options' => array(
                array(
                    'id' => 'mandatory',
                    'value' => 1,
                    'label' => '&nbsp;',

                )
            )
        );
        $items[] = array(
            'id' => 'visible',
            'type' => 'checkbox',
            'label'=>'Visible',

            'options' => array(

                array(
                    'id' => 'visible',
                    'value' => 1,
                    'label' => '&nbsp;',
                    'checked'=>true
                )
            )
        );
        $items[] = array(
            'id' => 'traffic_light',
            'type' => 'checkbox',
            'label'=>'Traffic Light',

            'options' => array(

                array(
                    'id' => 'traffic_light',
                    'value' => 1,
                    'label' => '&nbsp;',
                    'checked'=>true
                )
            )
        );


        $submit = array(
            'id' => 'submit',
            'type' => 'submit',
            'label'=>'Save'
        );

        if(isset($_SESSION['message']) && $_SESSION['message'] != ''){
            $submit['disabled'] = true;
        }
        $items[] = $submit;




    echo $this->form_builder->build_form_horizontal($items);

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
