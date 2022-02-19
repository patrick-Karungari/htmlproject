<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo get_option('site_title', "MLM Project") ?></title>
    <meta name="description" content="<?php echo get_option('site_description', "MLM Project") ?>">

    <link rel="shortcut icon" href="<?php echo base_url('assets/img/logo.png') ?>" type="image/png">

    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/bootstrap/css/bootstrap.min.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/fonts/LineIcons.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/css/owl.carousel.2.3.4.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/owl.theme.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/css/animate.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/css/responsive.css') ?>">
</head>
<body>

<header id="home" class="header">
    <div class="navbar-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="<?php echo site_url() ?>">
                            <img src="<?php echo base_url('assets/img/logo.png') ?>" alt="Logo">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ml-auto">
                                <li class="nav-item active">
                                    <a class="page-scroll" href="#hero-area">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" href="#plans">Investment Plans</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" href="#howitworks">How it Works</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" href="#testimonial">Testimonials</a>
                                </li>
                                <?php
                                if((new \App\Libraries\Auth())->loggedIn()) {
                                    ?>
                                    <li class="nav-item"><a href="<?php echo site_url('user/account') ?>">My Dashboard</a></li>
                                    <li class="nav-item"><a href="<?php echo site_url('auth/logout') ?>">Logout</a></li>
                                    <?php
                                } else {
                                    ?>
                                    <li class="nav-item"><a href="<?php echo site_url('auth') ?>">Login</a></li>
                                    <li class="nav-item"><a href="<?php echo site_url('auth/register') ?>">Sign Up</a></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>

<section id="hero-area" class="hero-area-bg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
                <div class="contents">
                    <h2 class="head-title">Invest<br>With the Best</h2>
                    <p>
                        Alpha Investments offers you the opportunity to build a rewarding career where you can…
                    </p>
                    <ul>
                        <li>Accelerate your professional growth with supportive leaders who invest in you</li>
                        <li>Be individually empowered and accountable as part of a collaborative, diverse, and inclusive team</li>
                        <li>Act with confidence but also humility</li>
                        <li>Own your work and its outcomes while driving positive impact in all we do</li>
                        <li>Share in a culture of excellence with a continuous improvement mindset</li>
                    </ul>




                    <div class="header-button">
                        <?php
                        if((new \App\Libraries\Auth())->loggedIn()) {
                            ?>
                            <a href="<?php echo site_url('user/account') ?>" class="btn btn-common">Dashboard</i></a>
                            <?php
                        } else {
                            ?>
                            <a href="<?php echo site_url('auth') ?>" class="btn btn-common">Login</i></a>
                            <a href="<?php echo site_url('auth/register') ?>" class="btn btn-border">Sign up</i></a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                <div class="intro-img">
                    <img class="img-fluid" src="<?php echo base_url('assets/img/intro-mobile.png') ?>" alt="">
                </div>
            </div>
        </div>
    </div>
</section>


<div id="howitworks" class="about-area section-padding bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-xs-12 info">
                <div class="about-wrapper wow fadeInLeft" data-wow-delay="0.3s">
                    <div>
                        <div class="site-heading">
                            <h2 class="section-title">How it works</h2>
                        </div>
                        <div class="content">
                            <p>
                                Investment with Alpha Investments is easy. We have a variety of plans best suited for your needs. Our highly qualified team of Stock, Forex, asset managers work round the clock to grow your money. For as little as $5 you can earn an interest of 8% after 24 hours. Investment made easy for you.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-xs-12 wow fadeInRight" data-wow-delay="0.3s">
                <img class="img-fluid" src="<?php echo base_url('assets/img/about/img-1.png') ?>" alt="">
            </div>
        </div>
    </div>
</div>

<section id="plans" class="section-padding">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title wow fadeInDown" data-wow-delay="0.3s">Investment Plans</h2>
            <div class="shape wow fadeInDown" data-wow-delay="0.3s"></div>
        </div>
        <div class="row">
            <?php
            $plans = (new \App\Models\Plans())->where('active', '1')->findAll();
            if (count($plans) > 0) {
                foreach ($plans as $plan) {
                    ?>
                    <div class="col-lg-4 col-md-6 col-xs-12">
                        <div class="table wow fadeInRight" data-wow-delay="0.3s">
                            <div class="icon-box">
                                <i class="lni lni-star"></i>
                            </div>
                            <div class="pricing-header">
                                <p class="price-value"><?php echo $plan->returns ?>%<span> /<?php echo $plan->days ?> days</span></p>
                            </div>
                            <div class="title">
                                <h3><?php echo $plan->title ?></h3>
                            </div>
                            <div class="description">
                                <?php echo $plan->description ?>
                            </div>
                            <?php
                            $url = (new \App\Libraries\Auth())->loggedIn() ? site_url('user/account') : site_url('auth');
                            ?>
                            <a class="btn btn-common" href="<?php echo $url; ?>">Invest Now</a>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>


<section id="testimonial" class="testimonial section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="testimonials" class="owl-carousel wow fadeInUp" data-wow-delay="0.3s">
                    <div class="item">
                        <div class="testimonial-item">
                            <div class="info">
                                <h2><a href="#">Mrs Lorna Koech,</a></h2>
                                <h3><a href="#">KE</a></h3>
                            </div>
                            <div class="content">
                                <p class="description">Alpha Investments understands the anxieties that come with investing and manages to reassure the client so that they leave feeling positive about the future.</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-item">
                            <div class="info">
                                <h2><a href="#">Frank Steele,</a></h2>
                                <h3><a href="#">CA</a></h3>
                            </div>
                            <div class="content">
                                <p class="description">Alpha Investments gave me a very comprehensive view of my investments. He also provided me with a fantastic picture of what income I would have on retirement.</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-item">
                            <div class="info">
                                <h2><a href="#">Mr & Mrs H. Mwangi,</a></h2>
                                <h3><a href="#">KE</a></h3>
                            </div>
                            <div class="content">
                                <p class="description">All one has to do is to look at your investment to see how well it is being looked after. Thank you Blair.</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-item">
                            <div class="info">
                                <h2><a href="#">Dallas Keen,</a></h2>
                                <h3><a href="#">US</a></h3>
                            </div>
                            <div class="content">
                                <p class="description">I have been doing investments with Alpha Investments since October of 2016. They are truly amazing and are a key to me being able to retire from my job ! I love their professionalism and responsiveness.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ======= Frequently Asked Questions Section ======= -->
<section id="faq" class="faq section-bg mt-5">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Frequently Asked Questions</h2>
             </div>

        <div class="faq-list">
            <ul>
                <li data-aos="fade-up">
                    <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" class="collapse" href="#faq-list-1">What is Alpha Investments? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                    <div id="faq-list-1" class="collapse show" data-parent=".faq-list">
                        <p>
                            Alpha Investments is one of the world’s leading multi-asset alternative investment firms. Our global team aligns our interests with those of our investors and partners for lasting impact.
                        </p>
                    </div>
                </li>

                <li data-aos="fade-up" data-aos-delay="100">
                    <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-2" class="collapsed">How do I register? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                    <div id="faq-list-2" class="collapse" data-parent=".faq-list">
                        <p>
                            Welcome and enjoy the fruits of your money. For onboarding, <a href="<?php echo site_url('auth/register') ?>">register here</a>
                        </p>
                    </div>
                </li>

                <li data-aos="fade-up" data-aos-delay="200">
                    <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-3" class="collapsed">How do I withdraw? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                    <div id="faq-list-3" class="collapse" data-parent=".faq-list">
                        <p>
                            - Once logged into the platform, you'll find a deposit button on the top bar. You're smart. We are sure you can't miss it.
                            <br/>
                            - Under tabs, you'll also find a withdraw tab.
                        </p>
                    </div>
                </li>

                <li data-aos="fade-up" data-aos-delay="300">
                    <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-4" class="collapsed">How do I deposit? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                    <div id="faq-list-4" class="collapse" data-parent=".faq-list">
                        <p>
                            You can automate the process by logging into your dashboard and click on Deposit or you can deposit directly from <b>USER DASHBOARD</b>
                        </p>
                    </div>
                </li>

            </ul>
        </div>

    </div>
</section><!-- End Frequently Asked Questions Section -->


<footer id="footer" class="footer-area section-padding">
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
                    <div class="widget">
                        <h3 class="footer-logo"><img src="<?php echo base_url('assets/img/logo.png') ?>" alt=""></h3>

                        <div class="social-icon">
                            <a class="facebook" href="#"><i class="lni lni-facebook-filled"></i></a>
                            <a class="twitter" href="#"><i class="lni lni-twitter-filled"></i></a>
                            <a class="instagram" href="#"><i class="lni lni-instagram-filled"></i></a>
                            <a class="linkedin" href="#"><i class="lni lni-linkedin-original"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright-content">
                        <p>Designed and Developed by <a rel="nofollow" href="https://alpha-capital-investments.com">Alpha Investments</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


<a href="#" class="back-to-top">
    <i class="lni lni-arrow-up"></i>
</a>

<div id="preloader">
    <div class="loader" id="loader-1"></div>
</div>


<script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/owl.carousel.2.3.4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/wow.js') ?>"></script>
<script src="<?php echo base_url('assets/js/frontend.js') ?>"></script>
<script src="<?php echo base_url('assets/js/form-validator.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/contact-form-script.min.js') ?>"></script>
<!-- Cloudflare Web Analytics --><script defer src='https://static.cloudflareinsights.com/beacon.min.js' data-cf-beacon='{"token": "0cf43922775746138cb8f1aa65b16931"}'></script><!-- End Cloudflare Web Analytics -->
</body>
</html>