<?php
$model = new \App\Models\Notifications();

$notifications = $model->orderBy('id', 'DESC')->findAll();

?>
<!-- User Invoice Starts-->
<div class="row invoice-list-wrapper">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-2">My Notifications</h4>
            </div>
            <div class="card-datatable table-responsive pb-1">
                <?php
                if (count($notifications) > 0) {
                    ?>
                    <table class="referrals-list-table table p-1">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Notification</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $n = 0;
                        foreach ($notifications as $notification) {
                            $n++;
                            ?>
                            <tr>
                                <td><?php echo $n; ?></td>
                                <td><?php echo $notification->time; ?></td>
                                <td><?php echo $notification->title; ?></td>
                                <td><?php echo $notification->notification; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php
                } else {
                    ?>
                    <h5>No notifications</h5>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
//Mark all notifications for this user as read
try {
    $model->where('user', user_id())->set('read', '1')->update();
} catch (ReflectionException $e) {
}
?>
<!-- /User Invoice Ends-->
