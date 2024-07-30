<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row">
    <div class="col-lg-12">
    <h1>Register</h1>

<p><em>Username</em> is an abbreviated unique name that is not displayed again within this application. Usually a <strong>lowercase</strong> three letter acronym.</p>
<p><em>OrgUnit Nam</em>e is the long, proper name of the faculty or unit.</p>


        <?php if (isset($_SESSION['register_message'])) : ?>
            <div class="alert alert-success"><?=$_SESSION['register_message'];?>
            </div>
        <?php endif; ?>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>


    <?= $this->form_builder->open_form(array('action' => ''));
    echo $this->form_builder->build_form_horizontal(
    array(

        array(
            'id' => 'username',
            'label'=>'Username'
        ),
        array(
            'id' => 'email',
            'value' => 'admin@admin.com',
            'type' => 'hidden'
        ),
        array(
            'id' => 'orgunit_name',
            'label'=>'OrgUnit Name'
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
            'type' => 'submit'
        )
    )
    );

    ?>
    </div>
</div>

