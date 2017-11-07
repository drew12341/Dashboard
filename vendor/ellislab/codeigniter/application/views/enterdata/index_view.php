<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h3>Enter Data for: <?= $this->ion_auth->user()->row()->orgunit_name; ?></h3>
<br/>
<div class="row">
    <div class="col-lg-12">

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <form class="form-horizontal col-sm-12" autocomplete="on" method="post" accept-charset="utf-8">
            <div class="form-group">

                <label class="col-lg-1 control-label" for="year">Year</label>

                <div class="col-lg-2">
                    <select id="year" name="year" class="form-control col-lg-2">
                        <option>--</option>
                        <option value="<?= date("Y"); ?>"><?= date("Y"); ?></option>
                        <option value="<?= date("Y", strtotime("-1 year")); ?>"><?= date("Y", strtotime("-1 year")); ?></option>
                    </select>
                </div>

                <label class="col-lg-1 control-label" for="period">Period</label>

                <div class="col-lg-2">
                    <select id="period" name="period" class="form-control col-lg-2">
                        <option>--</option>
                        <?php

                        foreach ($periods as $key=>$value): ?>
                            <option value="<?= $key; ?>"><?= $value ?></option>

                        <?php endforeach; ?>
                    </select>
                </div>


            </div>

            <input type="submit" class="btn btn-primary" value="Next"/>
        </form>
    </div>
</div>

