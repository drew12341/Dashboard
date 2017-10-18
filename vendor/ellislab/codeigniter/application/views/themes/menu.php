<div class="sidebar-menu">

    <div class="sidebar-menu-inner">

        <header class="logo-env">

            <!-- logo -->
            <div class="logo">
                <a href="index.html">
                    <img src="<?php echo base_url(); ?>assets/images/UTS-logo.png" width="80" alt="" />

                </a>
                <br/>
                <h4 style="color:white">WHS Dashboard</h4>
            </div>


            <!-- logo collapse icon -->
            <div class="sidebar-collapse">
                <a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                    <i class="entypo-menu"></i>
                </a>
            </div>


            <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
            <div class="sidebar-mobile-menu visible-xs">
                <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                    <i class="entypo-menu"></i>
                </a>
            </div>



        </header>


        <?php if($this->ion_auth->logged_in()): ?>

        <ul id="main-menu" class="main-menu">
            <!-- add class "multiple-expanded" to allow multiple submenus to open -->
            <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
            <li class="has-sub">
                <a href="<?php echo site_url('Dashboard');?>">
                    <i class="entypo-gauge"></i>
                    <span class="title">Dashboard</span>
                </a>

            </li>

        </ul>
        <?php endif; ?>
    </div>
</div>