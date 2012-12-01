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
                    <a href="#"><img src="./img/logo.svg" alt="p2pbooks" /></a>
                </div>
                <div class="search">
                    <input name="query" placeholder="Search by Title, Author, ISBN" />
                </div>
                <nav class="main">
                    <ul>
                        <li><a href="#">Buy</a></li>
                        <li><a href="#">Sell</a></li>
                        <li><a href="#">Account<span class="caret"> &#9660;</span></a>
                            <ul>
                                <li><a href="#">Option 1</a></li>
                                <li><a href="#">Option 2</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>

        <div class="content">
            <div class="wrapper">
                <div class="cover-layout">
                    <a class="book">
                        <div class="cover">
                            <img src="http://placehold.it/200x250" />
                        </div>
                        <div class="info">
                            <h3>Book Title</h3>
                            <p>Book Description</p>
                        </div>
                    </a>
                    <a class="book">
                        <div class="cover">
                            <img src="http://placehold.it/200x250" />
                        </div>
                        <div class="info">
                            <h3>Book Title</h3>
                            <p>Book Description</p>
                        </div>
                    </a>
                    <a class="book">
                        <div class="cover">
                            <img src="http://placehold.it/200x250" />
                        </div>
                        <div class="info">
                            <h3>Book Title</h3>
                            <p>Book Description</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <footer class="bottom">
            A product of <a href="http://oldmacdonaldhackday.com/" target="_blank">Old MacDonald Hackathon</a>.
        </footer>
        
        <div class="modal-container">
            <div class="modal">
                <a class="btn close">×</a>
                <header>
                    <h2>Book Title</h2>
                </header>
                <div class="image"><img src="http://placehold.it/600x750" /></div>
                <div class="info">
                    <p>Book description</p>
                </div>
                <div class="actions">
                    <a class="btn">Request Book</a>
                </div>
            </div>
        </div>
        
        <script src="./js/vendor/jquery-1.8.0.min.js"></script>
        <script src="./js/plugins.js"></script>
        <script src="./js/main.js"></script>

    </body>
</html>
