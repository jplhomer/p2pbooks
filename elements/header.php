<?php //session_start(); if (!isset($_SESSION['access_token'])) { header("Location: ./login.php"); } ?>
<?php require("./process.php"); ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>P2PBooks</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">

        <!-- Facebook OpenGraph Data -->
        <meta property="og:title" content="" />
        <meta property="og:type" content="website" />
        <!-- If it's an article:
        <meta property="og:type" content="article" />
        <meta property="article:published_time" content = "" />
        -->
        <meta property="og:description" content="" />        
        <meta property="og:url" content=""/>
        <meta property="og:image" content="" />
        <meta property="og:site_name" content="" />
        <meta property="fb:app_id" content=""> 

        <!-- Canonical URL for CMS SEO -->
        <link rel="canonical" href="" />

        <!-- Twitter Card Metadata. Must activate domain via https://dev.twitter.com/docs/cards -->
        <meta property="twitter:card" content="summary">
        <meta property="twitter:site" content="">
        <meta property="twitter:creator" content="">

        <link rel="stylesheet" href="./css/jquery-ui-1.9.2.custom.css">
        <link rel="stylesheet" href="./css/base.css">
            
        <!--[if lte IE 8]>
        <link rel="stylesheet" href="./css/fallback.css">
        <![endif]-->
        
        <script src="./js/vendor/modernizr-2.6.1.min.js"></script>
    </head>
    <body>

        <header class="top">
            <div class="wrapper">
                <div class="brand">
                    <a href="./"><img src="./img/logo.svg" alt="p2pbooks" /></a>
                </div>
                <div class="search">
                    <form action="./search.php" method="get">
                        <input name="query" placeholder="Title, Author, ISBN" />
                    </form>
                </div>
                <nav class="main">
                    <ul>
                        <li><a href="./add.php" title="Add Book">+</a></li>
                        <li><a href="#">Buy</a></li>
                        <li><a href="./sell.php">Sell</a></li>
                        <?php if (isset($_SESSION['access_token'])) { ?>
                        <li><a href="./sell.php"><img src="<?php echo $p2pbooksuser->thumbnail; ?>" width="23" height="23" /> <?php echo $p2pbooksuser->firstName . ' ' . $p2pbooksuser->lastName; ?><span class="caret"> &#9660;</span></a>
                            <ul>
                                <li><a href="?logout=true">Log Out</a></li>
                            </ul>
                        </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </header>

        <div class="content">
            <div class="wrapper">