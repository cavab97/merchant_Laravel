<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e(config('app.name', 'Taskly Saas')); ?></title>
    <link rel="shortcut icon" href="<?php echo e(asset(Storage::url('logo/favicon.png'))); ?>">
    <!-- Landing External CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('landing/css/font-awesome.min.css')); ?>">
    <link href="<?php echo e(asset('landing/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo e(asset('landing/css/style.css')); ?>" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo e(asset('landing/css/responsive.css')); ?>" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo e(asset('landing/css/owl.carousel.min.css')); ?>" rel="stylesheet" type="text/css" media="all">
    <script src="<?php echo e(asset('landing/js/jquery-3.4.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('landing/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('landing/js/owl.carousel.min.js')); ?>"></script>
    <script src="<?php echo e(asset('landing/js/script.js')); ?>"></script>
</head>
<body>
<div class="content">
    <div class="top-header-part bg-gredient">
        <div class="container">
            <div class="row top-bar">
                <div class="col-lg-6 col-md-6 left-part">
                    <ul>
                        <li>
                            <a href="#">
                                <img src="<?php echo e(asset(Storage::url('logo/logo-white.png'))); ?>" class="landing-logo" alt="logo">
                            </a>
                        </li>
                        <li>
                            <a href="#features">Features</a>
                        </li>
                        <li>
                            <a href="#pricing">Pricing</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6 right-part">
                    <ul>
                        <li>
                            <a href="<?php echo e(route('login')); ?>">Login</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('register')); ?>" class="button">Signup</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 inner-text">
                    <h2>Taskly SaaS</h2>
                    <span class="sub-heading">Project Management Tool</span>
                    <div class="body-text">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    </div>
                    <a href="<?php echo e(route('register')); ?>" class="button">get started - it's free</a>
                    <span>no creadit card reqired</span>
                </div>
                <div class="col-lg-12 top-banner-img">
                    <img src="<?php echo e(asset('landing/images/top-banner.png')); ?>" alt="dashboard">
                </div>
            </div>
        </div>
    </div>
    <div class="logo-part-main back-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 logo-img">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-3 ">
                                    <img src="<?php echo e(asset('landing/images/nexo.png')); ?>" alt="">
                                </div>
                                <div class="col-3 ">
                                    <img src="<?php echo e(asset('landing/images/edge.png')); ?>" alt="">
                                </div>
                                <div class="col-3">
                                    <img src="<?php echo e(asset('landing/images/atomic.png')); ?>" alt="">
                                </div>
                                <div class="col-3">
                                    <img src="<?php echo e(asset('landing/images/brd.png')); ?>" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-3">
                                    <img src="<?php echo e(asset('landing/images/trust.png')); ?>" alt="">
                                </div>
                                <div class="col-3">
                                    <img src="<?php echo e(asset('landing/images/keep-key.png')); ?>" alt="">
                                </div>
                                <div class="col-3">
                                    <img src="<?php echo e(asset('landing/images/atomic.png')); ?>" alt="">
                                </div>
                                <div class="col-3">
                                    <img src="<?php echo e(asset('landing/images/edge.png')); ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="simple-sec odd main-image">
            <div class="responsive-image">
                <img src="<?php echo e(asset('landing/images/cal-sec.png')); ?>" alt="calander">
            </div>
            <div class="container">
                <div class="row com-padding">
                    <div class="col-lg-6 inner-text">
                        <div class="main-inner-text">
                            <span class="heading-btn">Features</span>
                            <h3>Lorem Ipsum is simply dummy</h3>
                            <span class="sub-heading">text of the printing</span>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting</p>
                            <a href="<?php echo e(route('register')); ?>" class="button">try our system</a>
                        </div>
                    </div>
                    <div class="col-lg-6 inner-image">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="simple-sec even bg-gredient1">
        <div class="responsive-image">
            <img src="<?php echo e(asset('landing/images/sec-2.png')); ?>" alt="calander">
        </div>
        <div class="container">
            <div class="row com-padding">
                <div class="col-lg-6 inner-text">
                    <div class="main-inner-text">
                        <span class="heading-btn">Features</span>
                        <h3>Lorem Ipsum is simply dummy</h3>
                        <span class="sub-heading">text of the printing</span>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting</p>
                        <a href="<?php echo e(route('register')); ?>" class="button">try our system</a>
                    </div>
                </div>
                <div class="col-lg-6 inner-image">
                </div>
            </div>
        </div>
    </div>
    <div class="simple-sec odd bg-gredient1">
        <div class="responsive-image">
            <img src="<?php echo e(asset('landing/images/sec-3.png')); ?>" alt="calander">
        </div>
        <div class="container">
            <div class="row com-padding">
                <div class="col-lg-6 inner-text">
                    <div class="main-inner-text">
                        <span class="heading-btn">Features</span>
                        <h3>Lorem Ipsum is simply dummy</h3>
                        <span class="sub-heading">text of the printing</span>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting</p>
                        <a href="<?php echo e(route('register')); ?>" class="button">try our system</a>
                    </div>
                </div>
                <div class="col-lg-6 inner-image">
                </div>
            </div>
        </div>
    </div>
    <div class="simple-sec even bg-gredient1">
        <div class="responsive-image">
            <img src="<?php echo e(asset('landing/images/sec-4.png')); ?>" alt="calander">
        </div>
        <div class="container">
            <div class="row com-padding">
                <div class="col-lg-6 inner-text">
                    <div class="main-inner-text">
                        <span class="heading-btn">Features</span>
                        <h3>Lorem Ipsum is simply dummy</h3>
                        <span class="sub-heading">text of the printing</span>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting</p>
                        <a href="<?php echo e(route('register')); ?>" class="button">try our system</a>
                    </div>
                </div>
                <div class="col-lg-6 inner-image">
                </div>
            </div>
        </div>
    </div>
    <div class="simple-sec odd bg-gredient1">
        <div class="responsive-image">
            <img src="<?php echo e(asset('landing/images/sec-5.png')); ?>" alt="calander">
        </div>
        <div class="container">
            <div class="row com-padding">
                <div class="col-lg-6 inner-text">
                    <div class="main-inner-text">
                        <span class="heading-btn">Features</span>
                        <h3>Lorem Ipsum is simply dummy</h3>
                        <span class="sub-heading">text of the printing</span>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting</p>
                        <a href="<?php echo e(route('register')); ?>" class="button">try our system</a>
                    </div>
                </div>
                <div class="col-lg-6 inner-image">
                </div>
            </div>
        </div>
    </div>
    <div class="simple-sec even bg-gredient1">
        <div class="responsive-image">
            <img src="<?php echo e(asset('landing/images/sec-6.png')); ?>" alt="calander">
        </div>
        <div class="container">
            <div class="row com-padding">
                <div class="col-lg-6 inner-text">
                    <div class="main-inner-text">
                        <span class="heading-btn">Features</span>
                        <h3>Lorem Ipsum is simply dummy</h3>
                        <span class="sub-heading">text of the printing</span>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting</p>
                        <a href="<?php echo e(route('register')); ?>" class="button">try our system</a>
                    </div>
                </div>
                <div class="col-lg-6 inner-image">
                </div>
            </div>
        </div>
    </div>
    <div class="features-inner-part">
        <div class="features-part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="see-more">
                            <span>See more features</span>
                        </div>
                    </div>
                    <div class="col-lg-12 inner-main-text">
                        <h3>All Features <span>in one place</span></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 features-card">
                        <div class="inner-text">
                            <h5>Attractive Dashboard
                                Customer & Vendor Login
                                Multi Languages
                            </h5>
                            <p>
                                Invoice, Billing & Transaction
                                Multi User & Permission
                                Paypal & Stripe for Invoice
                                User Friendly Invoice Theme
                                Make your own setting
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 features-card">
                        <div class="inner-text">
                            <p>Multi User & Permission
                                Paypal & Stripe for Invoice
                                User Friendly Invoice Theme
                                Make your own setting
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 features-card">
                        <div class="inner-text">
                            <p>Multi User & Permission
                                Paypal & Stripe for Invoice
                                User Friendly Invoice Theme
                                Make your own setting
                                User Friendly Invoice Theme
                                Make your own setting
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 features-card">
                        <div class="inner-text">
                            <p>Multi User & Permission
                                Paypal & Stripe for Invoice
                            </p>
                        </div>
                    </div>
                    <div class="features-button col-lg-12"><a href="<?php echo e(route('register')); ?>">TRY OUR SYSTEM</a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-gredient2 our-system" id="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>See our system <span> on images</span></h3>
                    <ul class="nav nav-tabs">
                        <li><a data-toggle="tab" href="#Dashboard" class="active">Dashboard</a></li>
                        <li><a data-toggle="tab" href="#Functions">Functions</a></li>
                        <li><a data-toggle="tab" href="#Reports"> Reports</a></li>
                        <li><a data-toggle="tab" href="#Tables"> Tables</a></li>
                        <li><a data-toggle="tab" href="#Settings"> Settings</a></li>
                        <li><a data-toggle="tab" href="#Contact"> Contact</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div id="Dashboard" class="tab-pane in active">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6 col-md-6">
                                <div class="panal-1">
                                    <figure>
                                        <img alt="data-1" src="<?php echo e(asset('landing/images/tab-1.png')); ?>">
                                        <figcaption>
                                            <div class="contant-tab">
                                                <h5>Dashboard</h5>
                                                <p>Main Page</p>
                                            </div>
                                            <a href="#" class="button">LIVE DEMO</a>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-6">
                                <div class="panal-1">
                                    <figure>
                                        <img alt="data-1" src="<?php echo e(asset('landing/images/tab-2.png')); ?>">
                                        <figcaption>
                                            <div class="contant-tab">
                                                <h5>Dashboard</h5>
                                                <p>Main Page</p>
                                            </div>
                                            <a href="#" class="button">LIVE DEMO</a>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-6">
                                <div class="panal-1">
                                    <figure>
                                        <img alt="data-1" src="<?php echo e(asset('landing/images/tab-3.png')); ?>">
                                        <figcaption>
                                            <div class="contant-tab">
                                                <h5>Dashboard</h5>
                                                <p>Main Page</p>
                                            </div>
                                            <a href="#" class="button">LIVE DEMO</a>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-6">
                                <div class="panal-1">
                                    <figure>
                                        <img alt="data-1" src="<?php echo e(asset('landing/images/tab-7.png')); ?>">
                                        <figcaption>
                                            <div class="contant-tab">
                                                <h5>Dashboard</h5>
                                                <p>Main Page</p>
                                            </div>
                                            <a href="#" class="button">LIVE DEMO</a>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-6">
                                <div class="panal-1">
                                    <figure>
                                        <img alt="data-1" src="<?php echo e(asset('landing/images/tab-4.png')); ?>">
                                        <figcaption>
                                            <div class="contant-tab">
                                                <h5>Dashboard</h5>
                                                <p>Main Page</p>
                                            </div>
                                            <a href="#" class="button">LIVE DEMO</a>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="Functions" class="tab-pane fade">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6 col-md-6">
                                <div class="panal-1">
                                    <figure>
                                        <img alt="data-1" src="<?php echo e(asset('landing/images/tab-5.png')); ?>">
                                        <figcaption>
                                            <div class="contant-tab">
                                                <h5>Dashboard</h5>
                                                <p>Main Page</p>
                                            </div>
                                            <a href="#" class="button">LIVE DEMO</a>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-6">
                                <div class="panal-1">
                                    <figure>
                                        <img alt="data-1" src="<?php echo e(asset('landing/images/tab-6.png')); ?>">
                                        <figcaption>
                                            <div class="contant-tab">
                                                <h5>Dashboard</h5>
                                                <p>Main Page</p>
                                            </div>
                                            <a href="#" class="button">LIVE DEMO</a>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-6">
                                <div class="panal-1">
                                    <figure>
                                        <img alt="data-1" src="<?php echo e(asset('landing/images/tab-7.png')); ?>">
                                        <figcaption>
                                            <div class="contant-tab">
                                                <h5>Dashboard</h5>
                                                <p>Main Page</p>
                                            </div>
                                            <a href="#" class="button">LIVE DEMO</a>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="Reports" class="tab-pane fade">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6 col-md-6">
                                <div class="panal-1">
                                    <figure>
                                        <img alt="data-1" src="<?php echo e(asset('landing/images/tab-1.png')); ?>">
                                        <figcaption>
                                            <div class="contant-tab">
                                                <h5>Dashboard</h5>
                                                <p>Main Page</p>
                                            </div>
                                            <a href="#" class="button">LIVE DEMO</a>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-6">
                                <div class="panal-1">
                                    <figure>
                                        <img alt="data-1" src="<?php echo e(asset('landing/images/tab-2.png')); ?>">
                                        <figcaption>
                                            <div class="contant-tab">
                                                <h5>Dashboard</h5>
                                                <p>Main Page</p>
                                            </div>
                                            <a href="#" class="button">LIVE DEMO</a>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="Tables" class="tab-pane fade">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6 col-md-6">
                                <div class="panal-1">
                                    <figure>
                                        <img alt="data-1" src="<?php echo e(asset('landing/images/tab-1.png')); ?>">
                                        <figcaption>
                                            <div class="contant-tab">
                                                <h5>Dashboard</h5>
                                                <p>Main Page</p>
                                            </div>
                                            <a href="#" class="button">LIVE DEMO</a>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-6">
                                <div class="panal-1">
                                    <figure>
                                        <img alt="data-1" src="<?php echo e(asset('landing/images/tab-2.png')); ?>">
                                        <figcaption>
                                            <div class="contant-tab">
                                                <h5>Dashboard</h5>
                                                <p>Main Page</p>
                                            </div>
                                            <a href="#" class="button">LIVE DEMO</a>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-6">
                                <div class="panal-1">
                                    <figure>
                                        <img alt="data-1" src="<?php echo e(asset('landing/images/tab-4.png')); ?>">
                                        <figcaption>
                                            <div class="contant-tab">
                                                <h5>Dashboard</h5>
                                                <p>Main Page</p>
                                            </div>
                                            <a href="#" class="button">LIVE DEMO</a>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-6">
                                <div class="panal-1">
                                    <figure>
                                        <img alt="data-1" src="<?php echo e(asset('landing/images/tab-1.png')); ?>">
                                        <figcaption>
                                            <div class="contant-tab">
                                                <h5>Dashboard</h5>
                                                <p>Main Page</p>
                                            </div>
                                            <a href="#" class="button">LIVE DEMO</a>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="Settings" class="tab-pane fade">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6 col-md-6">
                                <div class="panal-1">
                                    <figure>
                                        <img alt="data-1" src="<?php echo e(asset('landing/images/tab-1.png')); ?>">
                                        <figcaption>
                                            <div class="contant-tab">
                                                <h5>Dashboard</h5>
                                                <p>Main Page</p>
                                            </div>
                                            <a href="#" class="button">LIVE DEMO</a>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-6">
                                <div class="panal-1">
                                    <figure>
                                        <img alt="data-1" src="<?php echo e(asset('landing/images/tab-2.png')); ?>">
                                        <figcaption>
                                            <div class="contant-tab">
                                                <h5>Dashboard</h5>
                                                <p>Main Page</p>
                                            </div>
                                            <a href="#" class="button">LIVE DEMO</a>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="Contact" class="tab-pane fade">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6 col-md-6">
                                <div class="panal-1">
                                    <figure>
                                        <img alt="data-1" src="<?php echo e(asset('landing/images/tab-1.png')); ?>">
                                        <figcaption>
                                            <div class="contant-tab">
                                                <h5>Dashboard</h5>
                                                <p>Main Page</p>
                                            </div>
                                            <a href="#" class="button">LIVE DEMO</a>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-gredient2">
        <div class="container">
            <!-- TESTIMONIALS -->
            <section class="testimonials">
                <div class="container">
                    <h3>Testimonials</h3>
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="customers-testimonials" class="owl-carousel">
                                <div class="item">
                                    <div class="shadow-effect">
                                        <p>"We have been building AI projects for a long time and we decided it was time to build a
                                            platform that can streamline the broken process that we had to put up with. Here are some of the key things we wish we had when we were building projects before.”
                                        </p>
                                        <div class="img-testimonial">
                                            <img class="img-circle" src="<?php echo e(asset('landing/images/testimonials-img.png')); ?>" alt="">
                                            <div class="testimonial-name">
                                                <h4>Lorem Ipsum</h4>
                                                <h5>Founder and CEO at Rajodiya Infotech</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="shadow-effect">
                                        <p>"We have been building AI projects for a long time and we decided it was time to build a
                                            platform that can streamline the broken process that we had to put up with. Here are some of the key things we wish we had when we were building projects before.”
                                        </p>
                                        <div class="img-testimonial">
                                            <img class="img-circle" src="<?php echo e(asset('landing/images/testimonials-img.png')); ?>" alt="">
                                            <div class="testimonial-name">
                                                <h4>Lorem Ipsum</h4>
                                                <h5>Founder and CEO at Rajodiya Infotech</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="shadow-effect">
                                        <p>"We have been building AI projects for a long time and we decided it was time to build a
                                            platform that can streamline the broken process that we had to put up with. Here are some of the key things we wish we had when we were building projects before.”
                                        </p>
                                        <div class="img-testimonial">
                                            <img class="img-circle" src="<?php echo e(asset('landing/images/testimonials-img.png')); ?>" alt="">
                                            <div class="testimonial-name">
                                                <h4>Lorem Ipsum</h4>
                                                <h5>Founder and CEO at Rajodiya Infotech</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="shadow-effect">
                                        <p>"We have been building AI projects for a long time and we decided it was time to build a
                                            platform that can streamline the broken process that we had to put up with. Here are some of the key things we wish we had when we were building projects before.”
                                        </p>
                                        <div class="img-testimonial">
                                            <img class="img-circle" src="<?php echo e(asset('landing/images/testimonials-img.png')); ?>" alt="">
                                            <div class="testimonial-name">
                                                <h4>Lorem Ipsum</h4>
                                                <h5>Founder and CEO at Rajodiya Infotech</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="shadow-effect">
                                        <p>"We have been building AI projects for a long time and we decided it was time to build a
                                            platform that can streamline the broken process that we had to put up with. Here are some of the key things we wish we had when we were building projects before.”
                                        </p>
                                        <div class="img-testimonial">
                                            <img class="img-circle" src="<?php echo e(asset('landing/images/testimonials-img.png')); ?>" alt="">
                                            <div class="testimonial-name">
                                                <h4>Lorem Ipsum</h4>
                                                <h5>Founder and CEO at Rajodiya Infotech</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END OF TESTIMONIALS -->
        </div>
    </div>
    <section class="pricing-plan bg-gredient3" id="pricing">
        <div class="container our-system">
            <div class="row">
                <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-3 col-sm-6 mb-4">
                        <div class="plan-2">
                            <h6><?php echo e($plan->name); ?></h6>
                            <p class="price">
                                <small><h5><?php echo e((env('CURRENCY_SYMBOL')) ? env('CURRENCY_SYMBOL') : '$'); ?><?php echo e($plan->monthly_price); ?> Monthly Price</h5></small>
                                <small><h5><?php echo e((env('CURRENCY_SYMBOL')) ? env('CURRENCY_SYMBOL') : '$'); ?><?php echo e($plan->annual_price); ?> Annual Price</h5></small>
                            </p>
                            <p class="price-text">For companies that need a robust full-featured time tracker.</p>
                            <ul class="plan-detail">
                                <li><?php echo e(($plan->trial_days < 0)?__('Unlimited'):$plan->trial_days); ?> Trial Days</li>
                                <li><?php echo e(($plan->max_workspaces < 0)?__('Unlimited'):$plan->max_workspaces); ?> Workspaces</li>
                                <li><?php echo e(($plan->max_users < 0)?__('Unlimited'):$plan->max_users); ?> Users Per Workspace</li>
                                <li><?php echo e(($plan->max_clients < 0)?__('Unlimited'):$plan->max_clients); ?> Clients Per Workspace</li>
                                <li><?php echo e(($plan->max_projects < 0)?__('Unlimited'):$plan->max_projects); ?> Projects Per Workspace</li>
                            </ul>
                            <a href="<?php echo e(route('register')); ?>" class="button">Active</a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
</div>
<div class="subscribe-part">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <span class="top-heading">Try for free</span>
                <h3>Lorem Ipsum is simply dummy text</h3>
                <span class="sub-heading">of the printing and typesetting industry</span>
                <p>Type your email address and click the button</p>
                <form action="#">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Type your email address.." id="demo" name="email">
                        <button type="submit" class="btn btn-default">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="social-links">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-sm-6 inner-text">
                <div class="links">
                    <a href="#">Facebook</a>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 inner-text">
                <div class="links">
                    <a href="#">LinkedIn</a>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 inner-text">
                <div class="links">
                    <a href="#">Twitter</a>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 inner-text">
                <div class="links">
                    <a href="#">Discord</a>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="bg-gredient4">
    <div class="container top-part-main">
        <div class="row">
            <div class="col-lg-3 top-part">
                <div class="first-sec">
                    <a href="#">
                        <img src="<?php echo e(asset(Storage::url('logo/logo-white.png'))); ?>" class="landing-logo" alt="logo">
                    </a>
                    <div class="copy-right">
                        ©
                        <script>document.write(new Date().getFullYear());</script>
                        All rights reserved.
                    </div>
                </div>
            </div>
            <div class="col-lg-3 top-part">
                <h3>Features</h3>
                <ul>
                    <li><a href="#">Staff</a></li>
                    <li><a href="#">Customer</a></li>
                    <li><a href="#">Vendor</a></li>
                    <li><a href="#">Goal</a></li>
                </ul>
            </div>
            <div class="col-lg-3 top-part">
                <h3>Income</h3>
                <ul>
                    <li><a href="#">Proposal</a></li>
                    <li><a href="#">Invoice</a></li>
                    <li><a href="#">Revenue</a></li>
                    <li><a href="#">Credit Note</a></li>
                </ul>
            </div>
            <div class="col-lg-3 top-part">
                <h3>Expense</h3>
                <ul>
                    <li><a href="#">Bill</a></li>
                    <li><a href="#">Payment</a></li>
                    <li><a href="#">Debit Note</a></li>
                </ul>
            </div>
            <div class="col-lg-3 top-part">
                <h3>Contact</h3>
                <ul>
                    <li><a href="#"><img src="<?php echo e(asset('landing/images/app-store.png')); ?>" alt="logo"></a></li>
                    <li><a href="#"><img src="<?php echo e(asset('landing/images/google-pay.png')); ?>" alt="logo"></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container bottom-part">
        <div class="row">
            <div class="col-lg-6 col-md-6 inner-text">
                <div class="copy-right">
                    ©
                    <script>document.write(new Date().getFullYear());</script>
                    All rights reserved.
                </div>
            </div>
            <div class="col-lg-6 col-md-6 inner-text">
                <ul>
                    <li>
                        <a href="#">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="#">Github</a>
                    </li>
                    <li>
                        <a href="#">Press Kit</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/chillibuddyLaravel/resources/views/layouts/landing.blade.php ENDPATH**/ ?>