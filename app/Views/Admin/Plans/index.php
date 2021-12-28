<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

$plans = (new \App\Models\Plans())->findAll();
dd(json_encode($plans));

?>
<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
            <p class="card-title flex-grow">Investment Plans</p>
        </div>

        <?php
if (count($plans) > 0) {
    ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="pl-0 pt-0">ID</th>
                        <th class="pl-0 pt-0">Title</th>
                        <th class="pt-0">Days</th>
                        <th class="pt-0">Return %</th>
                        <th class="pt-0">is Active</th>
                        <th class="pr-0 pt-0">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$n = 0;
    foreach ($plans as $plan) {
        $n++;
        ?>
                    <tr>
                        <td class="pl-0"><?php echo $n; ?></td>
                        <td><?php echo $plan->title; ?></td>
                        <td><?php echo $plan->days; ?></td>
                        <td><?php echo $plan->returns; ?></td>
                        <td class="pr-0">
                            <?php
if ($plan->active == 1) {
            echo "YES";
        } else {
            echo "NO";
        }
        ?>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-info" href=""><i class="mdi mdi-eye"></i></a>
                            <a class="btn btn-sm btn-warning"
                                href="<?php echo site_url('admin/plans/edit/' . $plan->id) ?>"><i
                                    class="mdi mdi-pencil"></i></a>
                            <a class="btn btn-sm btn-danger" href=""><i class="mdi mdi-delete"></i></a>
                        </td>
                    </tr>
                    <?php
}
    ?>
                </tbody>
            </table>
        </div>
        <?php
} else {
    ?>
        <div class="alert alert-warning">
            No plans available
        </div>
        <?php
}
?>
    </div>
</div>
<script>
document.getElementById("plans").className += " active";
</script>
