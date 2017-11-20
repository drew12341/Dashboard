<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="UTS WHS Dashboard" />
    <meta name="author" content="" />

    <link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.ico">

    <title>UTS | WHS Dashboard</title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-icons/entypo/css/entypo.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/neon-core.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/neon-theme.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/neon-forms.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">

    <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/raphael-min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/mta.min.js"></script>

    <!--[if lt IE 9]><script src="<?php echo base_url(); ?>assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body class="page-body" data-url="http://neon.dev">

    <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
        <?php $this->load->view('themes/menu'); ?>

        <div class="main-content">


            <?php if($this->ion_auth->logged_in()): ?>
            <!-- Profile Info and Notifications -->
            <div class="col-md-6 col-sm-8 clearfix">

                <ul class="user-info pull-left pull-none-xsm">

                    <!-- Profile Info -->
                    <li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="entypo-menu"></i>
                            <?php if(isset($this->ion_auth->user()->row()->profilepic) && $this->ion_auth->user()->row()->profilepic != ''): ?>
                            <img src="<?= base_url().'../tmp/'.$this->ion_auth->user()->row()->profilepic; ?>" alt="" class="img-circle" width="44">
                            <?php endif ?>
                            <?= $this->ion_auth->user()->row()->orgunit_name;?>
                        </a>

                        <ul class="dropdown-menu">

                            <!-- Reverse Caret -->
                            <li class="caret"></li>

                            <!-- Profile sub-links -->
                            <li>
                                <a href="<?php echo site_url('User/edit/').$this->ion_auth->user()->row()->id; ?>">
                                    <i class="entypo-user"></i>
                                    Edit Profile
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('Indicator') ?>">
                                    <i class="entypo-adjust"></i>
                                    Indicators
                                </a>
                            </li>
                            <?php if($this->ion_auth->is_admin()): ?>
                                <li>
                                    <a href="<?php echo site_url('User') ?>">
                                        <i class="entypo-users"></i>
                                        Edit Users
                                    </a>
                                </li>
                            <?php endif; ?>

                        </ul>
                    </li>

                </ul>

            </div>


            <!-- Raw Links -->
            <div class="col-md-6 col-sm-4 clearfix hidden-xs">

                <ul class="list-inline links-list pull-right">

                    <li class="sep"></li>

                    <li>
                        <a href="<?php echo site_url('User/logout'); ?>">
                            Log Out <i class="entypo-logout right"></i>
                        </a>
                    </li>
                </ul>

            </div>
            <?php endif; ?>


            <?php if(!$this->ion_auth->logged_in()): ?>
            <div class="col-md-6 col-sm-8 clearfix">

                <ul class="user-info pull-left pull-none-xsm">
                </ul>
            </div>
                <div class="col-md-6 col-sm-4 clearfix hidden-xs">

                    <ul class="list-inline links-list pull-right">

                        <li class="sep"></li>

                        <li>
                            <a href="<?php echo site_url('User/login'); ?>">
                                Log In <i class="entypo-login right"></i>
                            </a>
                        </li>
                    </ul>

                </div>


            <?php endif; ?>

            <?php echo $output;?>

            <!-- Footer -->
            <footer class="main">

                Copyright &copy; 2017 <a target="_blank" href="http://www.uts.edu.au">uts.edu.au</a>
            </footer>
        </div>



    </div>
    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/datatables/datatables.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/select2/select2.css">

    <!-- Bottom scripts (common) -->

    <script src="<?php echo base_url(); ?>assets/js/gsap/TweenMax.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/joinable.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/resizeable.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/neon-api.js"></script>



    <!-- Imported scripts on this page -->
    <script src="<?php echo base_url(); ?>assets/js/datatables_noconf.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/bootstrap-confirmation.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/select2/select2.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>



    <script src="<?php echo base_url(); ?>assets/js/dataTable.moment.js"></script>
    <!-- JavaScripts initializations and stuff -->
    <script src="<?php echo base_url(); ?>assets/js/neon-custom.js"></script>


    <!-- Demo Settings -->
    <script src="<?php echo base_url(); ?>assets/js/neon-demo.js"></script>



    <script src="<?php echo base_url(); ?>assets/js/datatables/DataTables-1.10.9/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/datatables/Buttons-1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/datatables/Buttons-1.0.3/js/buttons.flash.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/datatables/Buttons-1.0.3/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/datatables/Buttons-1.0.3/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/datatables/rowGroup.js"></script>

    </body>