<div class="sidebar-menu">

    <div class="sidebar-menu-inner">

        <header class="logo-env">

            <!-- logo -->
            <div class="logo">
                <a href="<?php echo base_url(); ?>">
                    <img src="<?php echo base_url(); ?>assets/images/UTS-logo.png" width="80" alt="" />

                </a>
                <br/>
                <h4 style="color:rgb(170, 171, 174)">HSW Dashboard</h4>
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




        <ul id="main-menu" class="main-menu">
            <!-- add class "multiple-expanded" to allow multiple submenus to open -->
            <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
            <li id="defaulttab" class="">
                <a href="<?php echo site_url('Dashboard');?>">
                    <i class="entypo-gauge"></i>
                    <span class="title">Dashboard</span>
                </a>

            </li>

            <?php if($this->ion_auth->logged_in()): ?>
                <?php if(!$this->ion_auth->is_admin()) :?>
                    <li class="">
                        <a href="<?php echo site_url('EnterData');?>">
                            <i class="entypo-doc-text"></i>
                            <span class="title">Enter/View Data</span>
                        </a>

                    </li>
                    <?php endif; ?>
            <!--<li class="">
                <a href="<?php echo site_url('ViewData');?>">
                    <i class="entypo-window"></i>
                    <span class="title">View Data</span>
                </a>

            </li>-->
            <li class="">
                <a href="<?php echo site_url('Report');?>">
                    <i class="entypo-monitor"></i>
                    <span class="title">Reports</span>
                </a>

            </li>
            <?php endif; ?>

            <li id="defaulttab" class="">
                <a href="https://studentutsedu.sharepoint.com/sites/safety-portal/SitePages/Monitoring,%20Reporting%20&%20Verification.aspx#h-s-performance-reporting" target="_blank">
                 <span class="title">Performance Reporting Instructions</span>
                </a>
            </li>
			
        </ul>

    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        var active_link = $('.main-menu li a[href~="<?=base_url($this->uri->segment(1))?>"]');

        if(active_link.size() > 0){
            //console.log('active');
            active_link.parent().addClass('active');

        }
        else{
            $("#defaulttab").addClass('active');
        }

        //can check correct-loading of bootstrap with this
        //console.log((typeof $().emulateTransitionEnd == 'function'));

        $('.dropdown-toggle').dropdown()
    });


</script>