<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>

        /*! CSS Used from: Embedded */
        [class^="entypo-"]:before{font-family:"entypo";font-style:normal;font-weight:normal;speak:none;display:inline-block;
            text-decoration:inherit;width:1em;margin-right:.2em;text-align:center;
            font-variant:normal;text-transform:none;line-height:1em;
            margin-left:.2em;}
        .entypo-down-open:before{content:'\e873';}
        body{margin:0;}
        footer{display:block;}
        a{background-color:transparent;}
        a:active,a:hover{outline:0;}
        b{font-weight:bold;}
        table{border-collapse:collapse;border-spacing:0;}
        td,th{padding:0;}
        @media print{
            *,*:before,*:after{background:transparent!important;
                color:#000!important;
                box-shadow:none!important;
                text-shadow:none!important;}
            a,a:visited{text-decoration:underline;}
            a[href]:after{content:" (" attr(href) ")";}
            a[href^="#"]:after{content:"";}
            thead{display:table-header-group;}
            tr{page-break-inside:avoid;}
            .table{border-collapse:collapse!important;}
            .table td,.table th{background-color:#fff!important;}
            .table-bordered th,.table-bordered td{border:1px solid #ddd!important;}
            footer{page-break-after:always;}
        }


        *{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}
        *:before,*:after{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}
        body{font-family:"Helvetica Neue", Helvetica, Arial, sans-serif;font-size:11px;
            line-height:1.0;color:#323232;background-color:#fff;}
        a{color:#373e4a;text-decoration:none;}
        a:hover,a:focus{color:#818da2;text-decoration:none;}
        a:focus{outline:thin dotted;outline:5px auto -webkit-focus-ring-color;outline-offset:-2px;}
        h4,h6{font-family:inherit;font-weight:700;line-height:1.1;color:#373e4a;}
        h4,h6{margin-top:8.5px;margin-bottom:8.5px;}
        h4{font-size:15px;}
        h6{font-size:11px;}
        .text-center{text-align:center;}
        .row{margin-left:-15px;margin-right:-15px;}
        .col-sm-4,.col-md-6,.col-sm-12,.col-md-12{position:relative;min-height:1px;padding-left:15px;padding-right:15px;}
        @media (min-width: 768px){
            .col-sm-4,.col-sm-12{float:left;}
            .col-sm-12{width:100%;}
            .col-sm-4{width:33.33333333%;}
        }
        @media (min-width: 992px){
            .col-md-6,.col-md-12{float:left;}
            .col-md-12{width:100%;}
            .col-md-6{width:50%;}
        }
        table{background-color:transparent;}
        th{text-align:left;}
        .table{width:100%;max-width:100%;margin-bottom:17px;}
        .table > thead > tr > th,.table > tbody > tr > td{padding:6px;line-height:1.1;
            vertical-align:top;border-top:1px solid #ebebeb;}
        .table > thead > tr > th{vertical-align:bottom;border-bottom:2px solid #ebebeb;}
        .table > thead:first-child > tr:first-child > th{border-top:0;}
        .table-bordered{border:1px solid #ebebeb;}
        .table-bordered > thead > tr > th,.table-bordered > tbody > tr > td{border:1px solid #ebebeb;}
        .table-bordered > thead > tr > th{border-bottom-width:2px;}
        .table-responsive{overflow-x:auto;min-height:0.01%;}
        @media screen and (max-width: 767px){
            .table-responsive{width:100%;margin-bottom:12.75px;overflow-y:hidden;-ms-overflow-style:-ms-autohiding-scrollbar;border:1px solid #ebebeb;}
        }
        .badge{display:inline-block;min-width:10px;padding:3px 7px;font-size:11px;font-weight:normal;color:#fff;
            line-height:1;vertical-align:middle;white-space:nowrap;text-align:center;background-color:#999999;}
        .badge:empty{display:none;}
        .panel{margin-bottom:17px;background-color:#fff;border:1px solid transparent;}
        .panel-body{padding:15px;}
        .panel-heading{padding:10px 15px;border-bottom:1px solid transparent;}
        .panel-title{margin-top:0;margin-bottom:0;font-size:14px;color:inherit;}
        .panel > .table{margin-bottom:0;}
        .panel > .table:last-child{}
        .panel > .table:last-child > tbody:last-child > tr:last-child{}
        .panel > .table:last-child > tbody:last-child > tr:last-child td:first-child{}
        .panel > .table:last-child > tbody:last-child > tr:last-child td:last-child{}
        .panel > .table-bordered{border:0;}
        .panel > .table-bordered > thead > tr > th:first-child,.panel > .table-bordered > tbody > tr > td:first-child{border-left:0;}
        .panel > .table-bordered > thead > tr > th:last-child,.panel > .table-bordered > tbody > tr > td:last-child{border-right:0;}
        .panel > .table-bordered > tbody > tr:first-child > td,.panel > .table-bordered > thead > tr:first-child > th{border-bottom:0;}
        .panel > .table-bordered > tbody > tr:last-child > td{border-bottom:0;}
        .panel > .table-responsive{border:0;margin-bottom:0;}
        .panel-primary{border-color:#949494;}
        .panel-primary > .panel-heading{color:#fff;background-color:#949494;border-color:#949494;}
        .clearfix:before,.clearfix:after,.row:before,.row:after,.panel-body:before,.panel-body:after{content:" ";display:table;}
        .clearfix:after,.row:after,.panel-body:after{clear:both;}
        @media (max-width: 767px){
            .hidden-xs{display:none!important;}
        }
        .panel{margin-bottom:17px;background-color:#fff;border:1px solid transparent;}
        .panel > .panel-heading .panel-title{font-size:13px;}
        .panel-body{position:relative;padding:15px;}
        .panel-body:before,.panel-body:after{content:" ";display:table;}
        .panel-body:after{clear:both;}
        .panel > .table{margin-bottom:0;}

        .panel > .table:last-child > tbody:last-child > tr:last-child td:first-child{}
        .panel > .table:last-child > tbody:last-child > tr:last-child td:last-child{}

        .panel > .table-bordered{border:0;}
        .panel > .table-bordered > thead > tr > th:first-child,.panel > .table-bordered > tbody > tr > td:first-child{border-left:0;}
        .panel > .table-bordered > thead > tr > th:last-child,.panel > .table-bordered > tbody > tr > td:last-child{border-right:0;}
        .panel > .table-bordered > thead > tr:first-child > th,.panel > .table-bordered > tbody > tr:first-child > td{border-top:0;}
        .panel > .table-bordered > thead > tr:last-child > th,.panel > .table-bordered > tbody > tr:last-child > td{border-bottom:0;}
        .panel > .table-responsive{border:0;margin-bottom:0;}

        .panel-heading{border-bottom:1px solid transparent;}
        .panel-heading:before,.panel-heading:after{content:" ";display:table;}
        .panel-heading:after{clear:both;}
        .panel-heading > .panel-title{float:left;padding:10px 15px;}
        .panel-heading > .panel-options{float:right;padding-right:15px;}
        .panel-heading > .panel-options > a{margin-top:10px;}
        .panel-title{margin-top:0;margin-bottom:0;font-size:14px;}
        .panel-primary{border-color:#ebebeb;-webkit-background-clip:padding-box;
           -moz-background-clip:padding;background-clip:padding-box;}
        .panel-primary > .panel-heading{color:#373e4a;background-color:#ffffff;border-color:#ebebeb;padding:0;}
        .panel-primary > .panel-heading > .panel-options > a{display:inline-block;color:#373e4a;text-align:center;line-height:1;
            padding:4px 2px;-webkit-background-clip:padding-box;-moz-background-clip:padding;
            background-clip:padding-box;}
        .panel-primary > .panel-heading > .panel-options > a i{margin:0;padding:0;display:inline-block;}
        .panel-primary{border-color:#ebebeb;-webkit-background-clip:padding-box;
            -moz-background-clip:padding;background-clip:padding-box;}
        .panel-primary > .panel-heading{color:#373e4a;background-color:#92d0508a;border-color:#ebebeb;padding:0;}
        .panel-primary > .panel-heading > .panel-options > a{display:inline-block;color:#373e4a;text-align:center;
            line-height:1;padding:4px 2px;-webkit-background-clip:padding-box;
            -moz-background-clip:padding;background-clip:padding-box;}

        .panel-primary > .panel-heading > .panel-options > a i{margin:0;padding:0;display:inline-block;}
        table{max-width:100%;background-color:transparent;}
        th{text-align:left;font-weight:400;color:#303641;}
        .table-bordered{border:1px solid #ebebeb;}
        .table-bordered > thead > tr > th,.table-bordered > tbody > tr > td{border:1px solid #ebebeb;}
        .table-bordered > thead > tr > th{background-color:#f5f5f6;border-bottom-width:0px;color:#323232;border-bottom:0!important;}
        .badge{background-color:#ebebeb;color:#373e4a;}
        .badge.badge-success{background-color:#00a651;color:#fff;}
        .badge.badge-warning{background-color:#fad839;color:#fff;}
        .badge.badge-danger{background-color:#cc2424;color:#fff;}
        .badge:empty{display:none;}
        body{height:100%;position:relative;}
        .page-container{width:100%;display:table;height:100%;table-layout:fixed;}
        @media screen and (max-width: 768px){
            .page-container{display:block;}
        }
        .page-container .main-content{position:relative;display:table-cell;vertical-align:top;padding:20px;
            background:#ffffff;width:100%;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}
        @media screen and (max-width: 767px){
            .page-container .main-content{display:block;}
        }
        @media (max-width: 767px){
            .page-body .page-container{padding-left:0;}
            .page-body .page-container .main-content{min-height:auto!important;}
            .page-body .page-container .main-content{min-height:0!important;}
        }
        body{font-family:"Helvetica Neue", Helvetica, "Noto Sans", sans-serif;}
        a{color:#373e4a;}
        a:hover{text-decoration:none;color:#818da2;}
        footer.main{margin-top:15px;padding-top:15px;border-top:1px solid #ebebeb;}
        footer.main:before,footer.main:after{content:" ";display:table;}
        footer.main:after{clear:both;}
        .panel > .panel-body.with-table{position:relative;padding:0;margin:-1px;border:0;}
        .panel > .panel-body.with-table > table{margin:0;}
        footer {page-break-after: always;}

        </style>
    <title>Meeting Pack Report</title>
</head>
<body class="page-body" data-url="http://neon.dev">

<div class="page-container">
    <!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

    <div class="main-content">

        <div class="row">
            <div class="col-md-6 col-sm-4 clearfix hidden-xs">
            </div>
        </div>
        <div id="contentpage">

            <?php
            $green_up = base64_encode(file_get_contents(APPPATH.'../assets/images/green_up.png'));
            $red_down = base64_encode(file_get_contents(APPPATH.'../assets/images/red_down.png'));
            $yellow_static = base64_encode(file_get_contents(APPPATH.'../assets/images/yellow_static.png'));
            $grey_static = base64_encode(file_get_contents(APPPATH.'../assets/images/grey_static.png'));

            $green_dot = base64_encode(file_get_contents(APPPATH.'../assets/images/green_dot.png'));
            $red_dot = base64_encode(file_get_contents(APPPATH.'../assets/images/red_dot.png'));
            $yellow_dot = base64_encode(file_get_contents(APPPATH.'../assets/images/yellow_dot.png'));
            $grey_dot = base64_encode(file_get_contents(APPPATH.'../assets/images/grey_dot.png'));

            foreach ($collection as $data):
                extract($data); ?>


                <div class="col-md-12 col-sm-12 clearfix">

                    <h4>Dashboard report for: <?= urldecode($emulated_name); ?> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                        Year: <?= $year; ?> &nbsp;&nbsp;&nbsp; |&nbsp; &nbsp;&nbsp;Period: <?= $period; ?>
                        (<?= $periods[$period]; ?>)</h4>

                    <?php if ($utswide) : ?>
                        <h6><?= $completed_proportion; ?> Org Units have committed data for this period.</h6>
                    <?php endif; ?>

                </div>

                <table style="width: 100%;">
                <!--<div class="row">
                    <div class="col-sm-6">-->
                    <tr style="vertical-align: top;">
                        <td>
                        <div class="panel panel-primary">
                            <div class="panel-body with-table">
                                <table class="table table-bordered table-responsive">
                                    <tr>
                                        <td><img style="width:20px" alt="green up" src="data:image/png;base64,<?=$green_dot;?>"/> &nbsp;On Track</td>
                                        <td><img style="width:25px" alt="green up" src="data:image/png;base64,<?=$green_up;?>"/> Performance
                                            Improving
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img style="width:20px" alt="red down" src="data:image/png;base64,<?=$red_dot;?>"/> &nbsp;Needs Improvement</td>
                                        <td><img style="width:25px" alt="red down" src="data:image/png;base64,<?=$red_down;?>"/>&nbsp;Performance
                                            Declining
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img style="width:20px" alt="green up" src="data:image/png;base64,<?=$yellow_dot;?>"/> &nbsp;Further Work Required</td>
                                        <td><img style="width:25px" alt="yellow static" src="data:image/png;base64,<?=$yellow_static;?>"/>&nbsp;Performance
                                            Static
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <?php
                        $counter = 1;
                        foreach ($sections as $key => $value) : ?>


                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="panel-title"><?= $this->config->item($key) ?></div>

                                <!--
                                <div class="panel-options">
                                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                                </div>
                            -->
                            </div>
                            <table class="table table-bordered table-responsive">
                                <thead>
                                <tr>

                                    <th></th>
                                    <th>Previous</th>
                                    <th>Current</th>
                                    <th>Target</th>
                                    <th>Trend</th>
                                </tr>
                                </thead>

                                <tbody>

                                <?php
                                $current = 0;
                                $previous = 0;
                                foreach ($value as $row) {
                                    $current += $row['current'];
                                    //$previous += $row['previous'];
                                }
                                if (!$current) : ?>
                                    <tr>
                                        <td style="text-align: center;" colspan="5"><b>No data yet submitted for this
                                                period</b></td>
                                    </tr>
                                <?php endif; ?>

                                <?php foreach ($value as $row):
                                    $arrow = '';
                                    $button = '';
                                    $badge = '';
                                    $indicator_threshold = $this->config->item('indicator_threshold');
                                    $percent = '';


                                    if ($row['current'] > $row['previous']) {
                                        $arrow = 'entypo-up';
                                        $button = 'btn-green';
                                        $img_url = base_url().'../assets/images/green_up.png';
                                        $img_src = 'data:image/png;base64,'.$green_up;
                                    }
                                    if ($row['current'] < $row['previous']) {
                                        $arrow = 'entypo-down';
                                        $button = 'btn-red';
                                        $img_url = base_url().'../assets/images/red_down.png';
                                        $img_src = 'data:image/png;base64,'.$red_down;
                                    }
                                    if ($row['current'] == $row['previous']) {
                                        $arrow = 'entypo-switch';
                                        $button = 'btn-gold';
                                        $img_url = base_url().'../assets/images/yellow_static.png';
                                        $img_src = 'data:image/png;base64,'.$yellow_static;
                                    }


                                    if ($row['type'] == 'True/False') {
                                        $badge = ($row['current']) ? 'badge-success' : 'badge-danger';
                                        if (isset($row['previous'])) {
                                            $row['previous'] = ($row['previous'] ? 'Yes' : 'No');
                                        }
                                        if (isset($row['current'])) {
                                            $row['current'] = ($row['current'] ? 'Yes' : 'No');
                                        }
                                    }
                                    if ($row['type'] == 'Absolute') {
                                        $badge = ($row['current'] > $row['value']) ? 'badge-success' : 'badge-danger';
                                    }
                                    if ($row['type'] == 'Percentage') {
                                        $percent = '%';
                                        if ($row['current'] > $row['value']) {
                                            $badge = 'badge-success';
                                            $badge_src = 'data:image/png;base64,'.$green_dot;
                                        } else if ($row['current'] > $row['value'] - $indicator_threshold) {
                                            $badge = 'badge-warning';
                                            $badge_src = 'data:image/png;base64,'.$yellow_dot;
                                        } else {
                                            $badge = 'badge-danger';
                                            $badge_src = 'data:image/png;base64,'.$red_dot;
                                        }
                                    }

                                    if (!$row['traffic_light']) {
                                        $button = 'btn-grey';
                                        $badge = '';
                                        $badge_src = 'data:image/png;base64,'.$grey_dot;
                                        $img_src = 'data:image/png;base64,'.$grey_static;
                                    }

                                    if ($row['traffic_light'] && $row['traffic_light_reverse']) {
                                        if ($badge == 'badge-danger') {
                                            $badge = 'badge-success';
                                            $badge_src = 'data:image/png;base64,'.$green_dot;
                                        }
                                        else if ($badge == 'badge-success') {
                                            $badge = 'badge-danger';
                                            $badge_src = 'data:image/png;base64,'.$red_dot;
                                        }

                                    }

                                    ?>
                                    <tr>

                                        <td><?= $row['description']; ?></td>
                                        <td><?= $row['previous'] ?> <?= isset($row['previous']) ? $percent : ''; ?></td>
                                        <td><?= $row['current'] ?> <?= isset($row['current']) ? $percent : ''; ?></td>
                                        <td class="text-center">
                                            <img style="width:20px" alt="indicator" src="<?=$badge_src;?>"/></td>
                                        <td class="text-center" style="padding-top:6px">
                                            <img style="width:25px" alt="indicator" src="<?=$img_src;?>"/>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                        <?php if ($counter == floor(count($sections) / 2.0)): ?>
                   <!--</div>
                    <div class="col-sm-6">
                    -->
                        </td><td style="padding-left: 20px;">

                        <?php endif;

                        $counter++; ?>

                        <?php endforeach; ?>
                    <!--
                    </div>
                </div>
                -->
                </td></tr></table>

                <?php if (!$utswide && isset($date_committed)): ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-primary">
                            <div class="panel-body ">
                                Dashboard report for <?= $period_txt; ?> <?= $year; ?> committed
                                on <?= date("g:i a d/m/Y", strtotime($date_committed)); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
                <?php if (!$utswide && isset($comments)): ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-primary">
                            <div class="panel-body ">
                                Comments: <?= $comments; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
            <?php endif; ?>

                <footer><hr/>&nbsp;</footer>
            <?php endforeach; ?>

        </div>
        <!-- Footer -->
        <div class="main">

            Copyright &copy; 2017 <a target="_blank" href="http://www.uts.edu.au">uts.edu.au</a>
        </div>
    </div>

</div>

</body>
</html>

