<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row">
    <div class="col-lg-12">
        <h1>Log In</h1>

        <?php if (isset($_SESSION['auth_message'])) : ?>
            <div class="alert alert-warning"><?=$_SESSION['auth_message'];?>
            </div>
        <?php endif; ?>


        <div id="infoMessage"><?php if (isset($message)){ echo $message; }?></div>
        <?= $this->form_builder->open_form(array('action' => ''));
        echo $this->form_builder->build_form_horizontal(
            array(
//                array(
//                    'id' => 'username'
//                ),
                array(
                    'id'=>'username',
                    'type'=>'dropdown',
                    'options'=>$users,
                ),
                array(
                    'id' => 'password',
                    'type' => 'password',
                ),

                array(
                    'id' => 'remember',
                    'type' => 'checkbox',
                    'options' => array(
                        array(

                            'label' => 'Remember Me',
                            'value'=>TRUE,

                        ),
                    ),
                ),
                array(
                    'id' => 'submit',
                    'label' => 'Log In',
                    'type' => 'submit',
                )

            ));
?>
        <div class="form-group">

            <div class="col-sm-12">
                <label class="col-sm-2 control-label">&nbsp;</label>

                <span class="col-sm-9">Contact Safety and Wellbeing on ext 1063 if password forgotten</span>
                <!-- the below forgot password link (and create account!) works - just uncomment if needed in future -->
                <!--<a style="text-decoration: underline !important" href="<?php echo site_url('auth/forgot_password'); ?>">Forgot your password?</a><br/>
                <!--<a style="text-decoration: underline !important" href="<?php echo site_url('User/register'); ?>">Create an account</a>-->
            </div>
        </div>


</div>
    </div>
<script type="text/javascript">
    function enableinputs() {
        if ($('#username').val() == 0) {
            $('#password').prop("disabled", true);
            $('#remember').prop("disabled", true);
            $("[name='submit']").prop("disabled", true);
        }
        else{
            $('#password').prop("disabled", false);
            $('#remember').prop("disabled", false);
            $("[name='submit']").prop("disabled", false);
        }
    }
    $( "#username" ).change(enableinputs);
    $( document ).ready(enableinputs);
</script>
