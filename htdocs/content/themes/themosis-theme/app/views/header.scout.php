<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        
        <script src="//use.typekit.net/neb2zsr.js"></script>
        <script>try{Typekit.load();}catch(e){}</script>
        
        <?php wp_head(); ?>
    </head>

<body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <div class="wrapper">
            
            <header>
                <div id="header-container" class="container-fluid">
                    <h1 id="logo" class="hide-text">The Solution</h1>

                    <div class="cta-btns">
                        <span>Call <a href="tel:18001234567">1-800-123-4567</a> now to book</span>
                        <a class="btn" id="btn-gift">Gift Now</a>
                        <a class="btn" id="btn-book">Book Now</a>
                    </div>

                    <nav id="primary-nav">
                        <a href="#" id="nav-trigger">
                            <div id="top-bar"></div>
                            <div id="center-bar"></div>
                            <div id="bottom-bar"></div>
                        </a>
                    </nav>
                </div>                    
            </header>
            <?php 
            
            wp_nav_menu($hm_defaults); ?>
           