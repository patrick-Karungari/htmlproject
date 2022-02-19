<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

//$users = (new \App\Models\Users())->findAll();
$users = (new \App\Libraries\Auth())->users(2);
?>
<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
            <p class="card-title flex-grow">Registered Users</p>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th class="pl-0 pt-0">ID</th>
                    <th class="pl-0 pt-0">Name</th>
                    <th class="pt-0">Phone</th>
                    <th class="pt-0">Email</th>
                    <th class="pt-0">Balance</th>
                    <th class="pt-0">Status</th>
                    <th class="pt-0">Referred By</th>
                    <th class="pt-0">Active Downlines</th>
                    <th class="pr-0 pt-0">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
$n = 0;
foreach ($users as $user) {
    $n++;
    $referrals = (new \App\Models\Referrals())->where('user', $user->id)->where('status', 'completed')->orderBy('id', 'DESC')->findAll();
    ?>
                    <tr>
                        <td class="pl-0"><?php echo $n; ?></td>
                        <td><?php echo $user->name; ?></td>
                        <td><?php echo $user->phone; ?></td>
                        <td><?php echo $user->email; ?></td>
                        <td><?php echo $user->account; ?></td>
                        <td class="pr-0">
                            <?php
if ($user->registration == 1) {
        echo "Active";
    } else {
        echo "Inactive";
    }
    ?>
                        </td>
                        <td>
                            <?php
echo $user->refBy ? '<a href="' . site_url('admin/users/view/' . $user->refBy->id) . '">' . $user->refBy->name . '</a>' : '-';
    ?>
                        </td>
                        <td><?php echo count($referrals) ?></td>
                        <td>
                            <a class="btn btn-sm btn-info" href="<?php echo site_url('admin/users/view/' . $user->id); ?>"><i class="mdi mdi-eye"></i></a>
                            <?php
if ($user->id != 1) {
        ?>
                                <a class="btn btn-sm btn-danger" href="<?php echo site_url('admin/users/delete/' . $user->id); ?>"
                                   onclick="return confirm('Are you sure you want to delete this user? ALL DATA ASSOCIATED WITH THE ACCOUNT WILL BE LOST COMPLETELY!!')"
                                ><i class="mdi mdi-delete"></i></a>
                                <?php
}
    ?>
                        </td>
                    </tr>
                    <?php
}
?>
                </tbody>
            </table>
        </div>
    </div>
</div>