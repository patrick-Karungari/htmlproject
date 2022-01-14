<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

$investments = (new \App\Models\Investments())->where('user', $current_user->id)->orderBy('id', 'DESC')->findAll();
?>

<?php
$plans = (new \App\Models\Plans())->where('active', '1')->orderBy('days', 'ASC')->findAll();
if (count($plans) > 0) {
    ?>
<div class="card">

    <div class="card-body">
        <div class="container text-center">
            <h3 class="mb-3 mt-5">Start up your investment today</h3>
            <p class="w-75 mx-auto mb-5">Choose a plan that suits you the best.</p>
            <div class="row d-flex flex-row align-items-stretch">
                <?php
$n = 0;
    foreach ($plans as $plan) {
        $n++;
        ?>
                <div class="col-md-6 h-100 col-xl-4 ">
                    <div class="card px-3 py-2 shadow-none bg-transparent border-info">
                        <?php
                          if ($plan->days < 2) {
                                      $class = "ribbon ribbon-top-right blink_me";
                                      $title = "NEW !!!";
                                  } else {
                                      $class = "ribbon ribbon-top-right";
                                      if ($plan->days == 3) {
                                          $title = "HOT !!!";
                                      } elseif ($plan->days == 7) {
                                          $title = "POPULAR !!!";
                                      } else {
                                          $title = "";
                                          $class = "";
                                      }

                                  }
                                  //echo '';
                        ?>
                        <div class=" <?php echo $class ?>"><span><?php echo $title ?></span></div>
                        <div class="text-center card-body">
                            <h1 class="mb-1"><?php echo $plan->title ?></h1>
                            <h6 class="card-subtitle mb-1 text-muted"><?php echo $plan->days ?> day(s) investment</h6>
                            <h1 class="font-weight-normal mb-2"><?php echo $plan->returns . '%'; ?></h1>
                        </div>
                        <div class="plan-features mb-2">
                            <p class="card-text"> <?php
echo $plan->description;
        ?></p>
                        </div>
                        <div class="wrapper">
                            <form method="post" action="<?php echo site_url('user/invest/create'); ?>">
                                <input type="hidden" name="plan" value="<?php echo $plan->id; ?>">
                                <div class="form-group">
                                    <p class="mb-1">Amount to Invest</p>
                                    <?php

        if ($plan->returns >= 100 && $plan->returns <= 150) {
            $minimum_investment = 30000;
        } elseif ($plan->returns > 150 && $plan->returns <= 200) {
            $minimum_investment = 65000;
        } elseif ($plan->returns > 200) {
            $minimum_investment = 100000;
        } else {
            $minimum_investment = get_option('minimum_investment', 0);
        }
        ?>
                                    <input type="number" class="form-control" name="amount"
                                        min=" <?php echo $minimum_investment ?>"
                                        placeholder="<?php echo $minimum_investment ?>" required />
                                </div>
                                <button type="submit" class="btn btn-block btn-primary">Invest</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
}
    ?>

            </div>
        </div>
    </div>
</div>
<?php
} else {
    ?>
<div class="alert alert-danger">
    No investment plans available yet
</div>
<?php
}
?>

<script>
id = '<?php echo $current_user->id ?>';
document.getElementById("investments").className += " active";
</script>
<style>
@import url(https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600);



/* common */
.ribbon {
    width: 150px;
    height: 150px;
    overflow: hidden;
    position: absolute;
}

.ribbon::before,
.ribbon::after {
    position: absolute;
    z-index: -1;
    content: '';
    display: block;
    border: 5px solid #2980b9;
}

.ribbon span {
    position: absolute;
    display: block;
    width: 225px;
    padding: 15px 0;
    background-color: #9d0208;
    box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
    color: #fff;
    font: 700 18px/1 'Lato', sans-serif;
    text-shadow: 0 1px 1px rgba(0, 0, 0, .2);
    text-transform: uppercase;
    text-align: center;
}

/* top left*/
.ribbon-top-left {
    top: -10px;
    left: -10px;
}

.ribbon-top-left::before,
.ribbon-top-left::after {
    border-top-color: transparent;
    border-left-color: transparent;
}

.ribbon-top-left::before {
    top: 0;
    right: 0;
}

.ribbon-top-left::after {
    bottom: 0;
    left: 0;
}

.ribbon-top-left span {
    right: -25px;
    top: 30px;
    transform: rotate(-45deg);
}

/* top right*/
.ribbon-top-right {
    top: -10px;
    right: -10px;
}

.ribbon-top-right::before,
.ribbon-top-right::after {
    border-top-color: transparent;
    border-right-color: transparent;
}

.ribbon-top-right::before {
    top: 0;
    left: 0;
}

.ribbon-top-right::after {
    bottom: 0;
    right: 0;
}

.ribbon-top-right span {
    left: -25px;
    top: 30px;
    transform: rotate(45deg);
}

/* bottom left*/
.ribbon-bottom-left {
    bottom: -10px;
    left: -10px;
}

.ribbon-bottom-left::before,
.ribbon-bottom-left::after {
    border-bottom-color: transparent;
    border-left-color: transparent;
}

.ribbon-bottom-left::before {
    bottom: 0;
    right: 0;
}

.ribbon-bottom-left::after {
    top: 0;
    left: 0;
}

.ribbon-bottom-left span {
    right: -25px;
    bottom: 30px;
    transform: rotate(225deg);
}

/* bottom right*/
.ribbon-bottom-right {
    bottom: -10px;
    right: -10px;
}

.ribbon-bottom-right::before,
.ribbon-bottom-right::after {
    border-bottom-color: transparent;
    border-right-color: transparent;
}

.ribbon-bottom-right::before {
    bottom: 0;
    left: 0;
}

.ribbon-bottom-right::after {
    top: 0;
    right: 0;
}

.ribbon-bottom-right span {
    left: -25px;
    bottom: 30px;
    transform: rotate(-225deg);
}

.blink_me {
    animation: blinker 1s linear infinite;
}

@keyframes blinker {
    50% {
        opacity: 0;
    }
}

</style>
