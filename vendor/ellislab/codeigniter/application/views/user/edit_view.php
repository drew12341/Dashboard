<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<div class="row">
    <div class="col-lg-12">
        <h1>Edit User</h1>
        <?php if (isset($_SESSION['edit_message'])) : ?>
        <div class="alert alert-success"><?=$_SESSION['edit_message'];?>
        </div>
        <?php endif; ?>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>


        <?php if(!isset($dataSet['profilepic']) || $dataSet['profilepic'] == null){
            $dataSet['profilepic'] = 'upload-cloud.png';
        }
        ?>
        <?= $this->form_builder->open_form(array('action' => site_url("User/edit/").$dataSet["user_id"]));
        echo $this->form_builder->build_form_horizontal(
            array(
                array(
                    'id' => 'id',
                    'value' => $dataSet['user_id'],
                    'type' => 'hidden'
                ),

                array(
                    'id' => 'email',
                    'value' => $dataSet['email'],
                ),
                array(
                    'id' => 'orgunit_name',
                    'value' => $dataSet['orgunit_name'],
                    'label'=>'OrgUnit Name'
                ),
                array(
                    'id' => 'userfile',
                    'type' => 'file',
                    'label' => 'Picture',
                    'class' => 'pictureinput file2 inline btn btn-primary',
                    'input_addons' => array(
                        'pre' => '<img height="60px" src="'.base_url().'../tmp/'.$dataSet['profilepic'].'"/>',
                    )

                ),


                array(
                    'id' => 'submit',
                    'type' => 'submit',
                    'label'=>'Save'

                )
            )
        );
        echo $this->form_builder->close_form();
        ?>
    </div>
    </div>

<div class="row">
    <div class="col-lg-12">

    <h3>Change Password</h3>
<?= $this->form_builder->open_form(array('action' => site_url("User/changepassword/").$dataSet["user_id"]));
    echo $this->form_builder->build_form_horizontal(
        array(
            array(
                'id' => 'id',
                'value' => $dataSet['user_id'],
                'type' => 'hidden'
            ),
            array(
                'id' => 'password',
                'type' => 'password',
            ),
            array(
                'id' => 'confirm_password',
                'type' => 'password',

            ),
            array(
                'id' => 'submit',
                'type' => 'submit',
                'label'=>'Change Password'

            )
        ));
echo $this->form_builder->close_form();
?>
</div>
</div>

<style type="text/css">
    .pictureinput{
        height:74px;
    }
</style>
<script type="text/javascript">
    //$( "<div>Test</div>" ).insertBefore( "#userfile" );
</script>
