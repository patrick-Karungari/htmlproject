<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

use Carbon\Carbon;

$depositsModel = new \App\Models\Deposits();
$withdrawsModel = new \App\Models\Withdraws();
$transactionsModel = new \App\Models\Transactions();
?>
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between flex-wrap">
            <div class="d-flex align-items-center dashboard-header flex-wrap mb-3 mb-sm-0">
                <h5 class="mr-4 mb-0 font-weight-bold">Dashboard</h5>
            </div>
            <div class="d-flex">
                <div class="mr-3">
                    <button type="button" class="btn btn-primary"><?php echo date('d F Y') ?></button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-6 col-md-3 grid-margin stretch-card">
        <div class="card icon-card-primary">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="icon mb-0 mb-md-2 mb-xl-0 mr-2">
                        <i class="mdi mdi-arrow-up"></i>
                    </div>
                    <p class="font-weight-medium mb-0">Total Deposits</p>
                </div>
                <div class="d-flex align-items-center mt-3 flex-wrap">
                    <h3 class="font-weight-medium mb-0 mr-2"><?php echo number_format((($depositsModel->selectSum('amount', 'totalAmount')->where('status', 'completed')->get()->getFirstRow('object')->totalAmount) - 25000), 2); ?></h3>
                    <div class="badge badge-outline-light badge-pill mt-md-2 mt-xl-0">
                        <div class="d-flex align-items-baseline">
                            <span class="mr-2">Today</span>
                            <span class="mb-0"><?php echo number_format($depositsModel->selectSum('amount', 'totalAmount')->where('status', 'completed')->like('date', date('Y-m-d'), 'after')->get()->getFirstRow('object')->totalAmount, 2) ?></span>
                        </div>
                    </div>
                </div>
                <small class="d-block mt-2">Total deposits</small>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3 grid-margin stretch-card">
        <div class="card icon-card-success">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="icon mb-0 mb-md-2 mb-xl-0 mr-2">
                        <i class="mdi mdi-arrow-down"></i>
                    </div>
                    <p class="font-weight-medium mb-0">Total Withdraws</p>
                </div>
                <div class="d-flex align-items-center mt-3 flex-wrap">
                     <?php

?>
                    <h3 class="font-weight-medium mb-0 mr-2"><?php echo number_format((($withdrawsModel->selectSum('amount', 'totalAmount')->where('status', 'completed')->get()->getFirstRow('object')->totalAmount) + 25000), 2) ?></h3>
                    <div class="badge badge-outline-light badge-pill mt-md-2 mt-xl-0">
                        <div class="d-flex align-items-baseline">
                            <span class="mr-2">Today</span>
                            <span class="mb-0"><?php echo number_format($withdrawsModel->selectSum('amount', 'totalAmount')->where('status', 'completed')->like('date', date('Y-m-d'), 'after')->get()->getFirstRow('object')->totalAmount, 2) ?></span>
                        </div>
                    </div>
                </div>
                <small class="d-block mt-2">Total withdraws</small>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3 grid-margin stretch-card">
        <div class="card icon-card-info">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="icon mb-0 mb-md-2 mb-xl-0 mr-2">
                        <i class="mdi mdi-account-plus"></i>
                    </div>
                    <p class="font-weight-medium mb-0">Total Users</p>
                </div>
                <div class="d-flex align-items-center mt-3 flex-wrap">
                    <h3 class="font-weight-medium mb-0 mr-2"><?php echo count((new \App\Libraries\Auth())->users(2)) ?></h3>
                </div>
                <small class="d-block mt-2">Registered Members</small>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3 grid-margin stretch-card">
        <div class="card icon-card-dark">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="icon mb-0 mb-md-2 mb-xl-0 mr-2">
                        <i class="mdi mdi-plus"></i>
                    </div>
                    <p class="font-weight-medium mb-0">Registration Fee</p>
                </div>
                <div class="d-flex align-items-center mt-3 flex-wrap">
                    <h3 class="font-weight-medium mb-0 mr-2"><?php echo number_format($transactionsModel->selectSum('amount', 'totalAmount')->where('type', 'registration')->get()->getFirstRow('object')->totalAmount, 2); ?></h3>
                    <div class="badge badge-outline-light badge-pill mt-md-2 mt-xl-0">
                        <div class="d-flex align-items-baseline">
                            <span class="mr-2">Today</span>
                            <span class="mb-0"><?php echo number_format($transactionsModel->selectSum('amount', 'totalAmount')->where('type', 'registration')->like('date', date('Y-m-d'), 'after')->get()->getFirstRow('object')->totalAmount, 2); ?></span>
                        </div>
                    </div>
                </div>
                <small class="d-block mt-2">Total registration fee</small>
            </div>
        </div>
    </div>
     <div class="col-12 col-sm-6 col-md-3 grid-margin stretch-card">
        <div class="card icon-card-dark">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="icon mb-0 mb-md-2 mb-xl-0 mr-2">
                        <i class="mdi mdi-minus"></i>
                    </div>
                    <p class="font-weight-medium mb-0">Expenses Paid</p>
                </div>
                <div class="d-flex align-items-center mt-3 flex-wrap">
                <?php
?>
                <h3 class="font-weight-medium mb-0 mr-2"> 20,650.00</h3>

                </div>
                <small class="d-block mt-2"> Total Expenses</small>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3 grid-margin stretch-card">
        <div class="card icon-card-dark">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="icon mb-0 mb-md-2 mb-xl-0 mr-2">
                        <i class="mdi mdi-plus"></i>
                    </div>
                    <p class="font-weight-medium mb-0">Working Balance</p>
                </div>
                <div class="d-flex align-items-center mt-3 flex-wrap">
                <?php
$total_deposits = $depositsModel->selectSum('amount', 'totalAmount')->where('status', 'completed')->get()->getFirstRow('object')->totalAmount - 25000;
$t_w = $withdrawsModel->selectSum('amount', 'totalAmount')->where('status', 'completed')->get()->getFirstRow('object')->totalAmount + 25000;
?>
                <h3 class="font-weight-medium mb-0 mr-2"> <?php echo number_format(($total_deposits - $t_w - 20650), 2) ?></h3>

                </div>
                <small class="d-block mt-2">Working Capital</small>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <p class="card-title flex-grow">Day's Payouts</p>
                </div>
                <?php
$year = !empty(\Config\Services::request()->getGet('year')) ? \Config\Services::request()->getGet('year') : date('Y');
$month = !empty(\Config\Services::request()->getGet('month')) ? \Config\Services::request()->getGet('month') : date('m');
$day = !empty(\Config\Services::request()->getGet('date')) ? \Config\Services::request()->getGet('date') : date('d');
?>
                <form class="">
                    <select class="form-control-sm d-inline" name="year">
                        <?php
$old_year = date('Y') - 2;
for ($i = $old_year; $i <= $old_year + 2; $i++) {
    ?>
                            <option <?php echo ($i == date('Y') || $i == $year) ? 'selected' : '' ?> value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php
}
?>
                    </select>
                    <select class="form-control-sm d-inline" name="month">
                        <?php
for ($i = 1; $i <= 12; $i++) {
    ?>
                            <option <?php echo ($i == date('m') || $i == $month) ? 'selected' : '' ?> value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?php echo Carbon::parse('2021-' . str_pad($i, 2, '0', STR_PAD_LEFT) . '-01')->isoFormat('MMM') ?></option>
                            <?php
}
?>
                    </select>
                    <select class="form-control-sm d-inline" name="date">
                        <?php
for ($i = 1; $i <= 31; $i++) {
    ?>
                            <option <?php echo ($i == date('d') || $i == $day) ? 'selected' : '' ?> value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                            <?php
}
?>
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary d-inline">View</button>
                </form>
                <?php
$date = date('Y-m-d');

if ($year && $month && $day) {
    $date = $year . '-' . $month . '-' . $day;
}
$start_of_day = Carbon::parse($date)->startOfDay()->getTimestamp();
$end_of_day = Carbon::parse($date)->endOfDay()->getTimestamp();
//d($start_of_day);
//d($end_of_day);
$amountCOB = (new \App\Models\Investments())->selectSum('total', 'totalAmount')->where('end_time >=', $start_of_day)->where('end_time <=', $end_of_day)->get()->getFirstRow('object')->totalAmount;
//d($amountCOB);
?>
                <h5 class="text-white mt-3 mb-3">Payouts for <?php echo Carbon::parse($date)->format('M, d Y') ?> </h5>
                <h1 class="font-weight-medium mb-0 pt-3 mr-2 text-center">Kshs <?php echo number_format($amountCOB, 2); ?></h1>
            </div>
        </div>
    </div>
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <p class="card-title flex-grow">Deposit/Withdraw Trend</p>
                </div>
                <div class="d-flex justify-content-between align-items-start flex-wrap ">
                    <p class=" mb-0">Deposits and withdraws Performance</p>
                    <div class="online-revenue-chart-legend mt-2 mt-sm-0 mt-md-2 mt-xl-0 mr-1"
                         id="online-revenue-legend"></div>
                </div>
                <canvas id="online-revenue-chart-dark"></canvas>
            </div>
        </div>
    </div>
</div>
<?php
$metrics = new \App\Libraries\Metrics();
$desposits = number_format((($depositsModel->selectSum('amount', 'totalAmount')->where('status', 'completed')->get()->getFirstRow('object')->totalAmount) - 27000), 2);
$withdrawals = number_format((($withdrawsModel->selectSum('amount', 'totalAmount')->where('status', 'completed')->get()->getFirstRow('object')->totalAmount) + 27000), 2)
?>
<script>
    $(document).ready(function () {
        if ($('#online-revenue-chart-dark').length) {
            var onlineRevenueCanvas = $("#online-revenue-chart-dark").get(0).getContext("2d");

            var gradient1 = onlineRevenueCanvas.createLinearGradient(0, 0, 0, 350);
            gradient1.addColorStop(0, 'rgba(5, 541, 186, .5)');
            gradient1.addColorStop(1, 'rgba(0,0,0,0)');
            var gradient2 = onlineRevenueCanvas.createLinearGradient(0, 0, 0, 300);
            gradient2.addColorStop(0, 'rgba(98, 1, 237, .5)');
            gradient2.addColorStop(1, 'rgba(0,0,0,0)');

            var data = {
                labels: <?php echo json_encode($metrics->getLabels()) ?>,
                datasets: [
                    {
                        label: 'Deposits',
                        data: <?php echo json_encode($metrics->getMonthlyDeposits()) ?>,
                        borderColor: [
                            '#00dac5'
                        ],
                        borderWidth: 4,
                        fill: true,
                        backgroundColor: gradient1
                    },
                    {
                        label: 'Withdraws',
                        data: <?php echo json_encode($metrics->getMonthlyWithdraws()) ?>,
                        borderColor: [
                            '#6201ed'
                        ],
                        borderWidth: 4,
                        fill: true,
                        backgroundColor: gradient2
                    }

                ]
            };
            var options = {
                scales: {
                    yAxes: [{
                        display: true,
                        gridLines: {
                            drawBorder: false,
                            lineWidth: 1,
                            color: "rgba(46, 50, 74, .7)",
                            zeroLineColor: "rgba(46, 50, 74, .7)",
                        },
                        ticks: {
                            min: 200,
                            max: 1200,
                            stepSize: 200,
                            fontColor: "#606A96",
                            fontSize: 11,
                            fontStyle: 400,
                            padding: 15
                        }
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: false,
                            drawBorder: false,
                            lineWidth: 1,
                            color: "#e9e9e9",
                        },
                        ticks : {
                            fontColor: "#606A96",
                            fontSize: 11,
                            fontStyle: 400,
                            padding: 15,
                        }
                    }]
                },
                legend: {
                    display: false
                },
                legendCallback : function(chart) {
                    var text = [];
                    text.push('<div class="d-flex align-items-center">');
                    text.push('<small>Online revenue</small>');
                    text.push('<div class="ml-3" style="width: 12px; height: 12px; background-color: ' + chart.data.datasets[0].borderColor[0] +' "></div>');
                    text.push('</div>');
                    text.push('<div class="d-flex align-items-center mt-2">');
                    text.push('<small>Offline revenue</small>');
                    text.push('<div class="ml-3" style="width: 12px; height: 12px; background-color: ' + chart.data.datasets[1].borderColor[0] +' "></div>');
                    text.push('</div>');
                    return text.join('');
                },
                elements: {
                    point: {
                        radius: 2,
                    },
                    line :{
                        tension: .35
                    }
                },
                stepsize: 1,
                layout : {
                    padding : {
                        top: 30,
                        bottom : 0,
                        left : 0,
                        right: 0
                    }
                }
            };
            var onlineRevenue = new Chart(onlineRevenueCanvas, {
                type: 'line',
                data: data,
                options: options
            });
            document.getElementById('online-revenue-legend').innerHTML = onlineRevenue.generateLegend();
        }
    })
</script>