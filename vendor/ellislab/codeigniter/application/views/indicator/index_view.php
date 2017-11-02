<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

    <h3>Indicators</h3>

    <div style="float:left"><a href="<?= site_url('Indicator/newIndicator');?>" class="btn btn-primary">Create Indicator</a></div>
<div style="clear:both"></div>
<br/>

    <table class="table table-striped table-bordered table-hover" style="border: 2px solid #ddd" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>&nbsp;</th>
            <th>Description</th>
            <th>Type</th>
            <th>Value</th>

            <th>Visible</th>
        </tr>
        </thead>
        <tbody>

<?php foreach($dataSet as $i): ?>

    <tr>
        <td style="width:130px"><a class="btn btn-primary" style="float:left" href="Indicator/editIndicator/<?=$i['id']?>">Edit</a>

        </td>

        <td><?=$i['description']?></td>
        <td><?=$i['type']?></td>
        <td><?=  $i['value']; ?></td>

        <td><?=$i['visible']?></td>
    </tr>
    <?php endforeach; ?>
        </tbody>
        <tfoot>
        <tr>
            <th>&nbsp;</th>
            <th>Description</th>
            <th>Type</th>
            <th>Value</th>

            <th>Visible</th>
        </tr>
        </tfoot>
    </table>

<script type="text/javascript">

    $(document).ready(function() {

        $('.table').DataTable({
            "order": [[1, "desc"]],


        });

    });

    $('[data-toggle=confirmation]').confirmation({
        rootSelector: '[data-toggle=confirmation]',
        // other options
    });

</script>
