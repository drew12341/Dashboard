<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row">
    <div class="col-lg-12">
        <h1>Edit Indicator</h1>

        <?php if (isset($_SESSION['message'])) : ?>
            <div class="alert alert-success"><?=$_SESSION['message'];?>
            </div>
        <?php endif; ?>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>


        <?= $this->form_builder->open_form(array('action' => ''));

           $items =  array(
                array(
                    'id'=>'id',
                    'value'=>$dataSet['id'],
                    'type'=>'hidden'
                ),

                array(
                    'id' => 'description',
                    'value'=>$dataSet['description']
                ),
//                array(
//                    'id' => 'type',
//                    'value'=>$dataSet['type'],
//                    'type' => 'dropdown',
//                    'options' => $types,
//                    'readonly'=>true
//                ),
           array(
               'id'=>'type',
               'readonly'=>true,
               'value'=>$dataSet['type'],
           )

            );
        if($dataSet['type'] == 'True/False'){
            $items[] = array(
                'id' => 'value',
                'value'=>$dataSet['value'],
                'type'=>'dropdown',
                'options'=>array('True','False')
            );
        }
        if($dataSet['type'] == 'Absolute'){
            $items[] = array(
                'id' => 'value',
                'value'=>$dataSet['value'],

            );
        }
        if($dataSet['type'] == 'Percentage'){
            $items[] = array(
                'id' => 'value',
                'value'=>$dataSet['value'],

            );
        }

        $items[] = array(
            'id' => 'visible',
            'type' => 'checkbox',
            'label'=>'Visible',

            'options' => array(

                array(
                    'id' => 'visible',
                    'value' => 1,
                    'label' => '&nbsp;',
                    'checked' => $dataSet['visible'],

                )
            )
        );

        $items[] =   array(
                'id' => 'submit',
                'type' => 'submit',
                'label'=>'Save'
        );
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

