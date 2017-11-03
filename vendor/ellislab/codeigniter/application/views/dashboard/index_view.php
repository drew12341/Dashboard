

<?php if($this->ion_auth->logged_in()) : ?>
<h4>Dashboard report for: <?=$this->ion_auth->user()->row()->orgunit_name;?></h4>
<?php endif; ?>

<script type="text/javascript">



</script>

<div class="row">
    <div class="col-sm-6">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">Minimise Injuries / Maximise Wellbeing</div>

                <div class="panel-options">
                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                </div>
            </div>

            <table class="table table-bordered table-responsive">
                <thead>
                <tr>

                    <th></th>
                    <th>Previous</th>
                    <th>Current</th>
                    <th>Score</th>
                    <th>Trend</th>
                </tr>
                </thead>

                <tbody>
                <tr>

                    <td>No. Lost Time Injuries Reported</td>
                    <td>4</td>
                    <td>0</td>
                    <td class="text-center"><i class="badge badge-warning">&nbsp;</i></td>
                    <td class="text-center"><i class="entypo-up dashboard-icon btn-green"></i></td>
                </tr>

                <tr>
                    <td>Lost Time Injuries Reported</td>
                    <td>2</td>
                    <td>1</td>
                    <td class="text-center"><i class="badge badge-danger">&nbsp;</i></td>
                    <td class="text-center"><i class="entypo-down dashboard-icon btn-red"></i></td>
                </tr>

                <tr>

                    <td>Near Misses Reported</td>
                    <td>0</td>
                    <td>5</td>
                    <td class="text-center"><i class="badge badge-success">&nbsp;</i></td>
                    <td class="text-center"><i class="entypo-switch dashboard-icon btn-gold"></i></td>
                </tr>
                <tr>

                    <td>Wellbeing Participation</td>
                    <td>0</td>
                    <td>5</td>
                    <td class="text-center"><i class="badge badge-success">&nbsp;</i></td>
                    <td class="text-center"><i class="entypo-switch dashboard-icon btn-gold"></i></td>
                </tr>

                </tbody>
            </table>
        </div>

    </div>

</div>
