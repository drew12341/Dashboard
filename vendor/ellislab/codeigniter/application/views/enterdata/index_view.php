<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h3>Enter Data for: <?= $this->ion_auth->user()->row()->orgunit_name; ?></h3>
<br/>
<div class="row">
    <div class="col-lg-12">
        <form class="form-horizontal col-sm-12" autocomplete="on" method="post" accept-charset="utf-8">
            <div class="form-group">

                <label class="col-lg-1 control-label" for="year">Year</label>

                <div class="col-lg-2">
                    <select id="year" class="form-control col-lg-2">
                        <option><?= date("Y"); ?></option>
                        <option><?= date("Y", strtotime("-1 year")); ?></option>
                    </select>
                </div>

                <label class="col-lg-1 control-label" for="period">Period</label>

                <div class="col-lg-2">
                    <select id="period" class="form-control col-lg-2">
                        <?php
                        $count = 1;
                        foreach ($periods as $p): ?>
                            <option value="<?= $count; ?>"><?= $p ?></option>
                            <?php $count++; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <label class="col-lg-1 control-label" for="status">Status</label>
                <div class="col-lg-2">
                    <select id="status" class="form-control col-lg-2">
                        <option><?= date("Y"); ?></option>
                        <option><?= date("Y", strtotime("-1 year")); ?></option>
                    </select>
                </div>


            </div>


        </form>
    </div>
</div>


<!---- render page from array ---->
<?php foreach ($sections as $key => $value): ?>
    <div class="row">
        <div class="col-lg-12">

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th><?= $this->config->item($key) ?></th>
                    <th class="col-lg-2">Previous</th>
                    <th class="col-lg-2">Current</th>
                </tr>

                </thead>
                <tbody>
                    <?php foreach($value as $row): ?>
                        <tr>
                            <td>
                                <?= $row['description']; ?>
                            </td>
                            <td>
                                2
                            </td>
                            <td>
                                <input class="form-control"/>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>

<?php endforeach; ?>
