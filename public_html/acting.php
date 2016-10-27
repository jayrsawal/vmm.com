<!DOCTYPE html>
<html>
  
  <head>
  <!--CSS-->
    <link rel="stylesheet" type="text/css" href="stylesheets/acting.css" />
    <link rel="stylesheet" type="text/css" href="stylesheets/main.css" />
    <link rel="stylesheet" type="text/css" href="stylesheets/template.css" />
    <link rel="stylesheet" type="text/css" href="javascripts/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="javascripts/slick/slick-theme.css"/>
    <link rel="stylesheet" href="fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
    <link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
    <title>Victoria Marie | Acting</title>
  </head>

  <body>
    <!--CORNER RIBBON-->
    <div class="corner-ribbon">UNDER CONSTRUCTION</div>
    
    <!--HEADER (NAV)-->
    <header>
        <h1 class="">Victoria Marie</h1>
        <nav> 
          <span tabindex="0" class="nav-drop">
            <div class="nav-content">
              <a href="index.html">Home</a>
              <a href="about.html">About</a>
              <a href="music.php">Music</a>
              <a id="current-link" href="">Acting</a>
              <a href="gallery.php">Gallery</a>
            </div>
          </span>

          <div>
              <a href="index.html">Home</a>
              <a href="about.html">About</a>
              <a href="music.php">Music</a>
              <a id="current-link" href="">Acting</a>
              <a href="gallery.php">Gallery</a>
              <a class="fancybox contact-btn" data-fancybox-type="iframe" href="contact.php">Contact Me</a>
            </div>
        </nav>
    </header>
  
    <!-- COVER SECTION BANNER -->
    <section class="header-cover">
        <div><h2>Acting
        <br><img class="logo" src="img/icons/vm_logo_flat.png" /></div>
        <a href="#page-top"></a>
    </section>

    <!--  -->
    <div id="page-top" class="container">
      <section class="aside-section">
        <a class="fancybox-media" href="https://vimeo.com/118045022">
        <aside>
          <img id="democlap" src="img/icons/ico_clapper.png" />
          <span>WATCH MY <br>DEMO REEL 2015!</span>
          <img id="demowheel" src="img/icons/ico_reel.png" />
        </aside>
        </a>


        <article>
          <h2>Acting Biography</h2>
          <p>Victoria Marie is an independent actor from Toronto, Ontario Canada. Starting as a PA, finding her footing on set with Mentor and Director Romeo Candido, for &#39;Prison Dancer&#39; (2012), Victoria Marie has quickly risen up the ranks. She received her first big break while working as one of 500 Asian background extras on set of &#39;Pacific Rim&#39; (2013). She was spotted by Director Guillermo Del Toro, and upgraded to speaking role on the spot, returning one month later to film the larger scene. Since then, Victoria has appeared in many productions and projects, including three national commercial print Ads for Loblaws, GOtransit, and Bell; various Carlos Bulosan Theatre productions, David Cronenberg&#39;s experimental and interactive TIFF exhibition film; Millions: the webseries and feature length film, and her first leading role in the independent film &#39;Beat&#39; which had it&#39;s home town premiere at the 25th annual Inside Out Film festival at TIFF Bell Lightbox this past May.
          <p>Curriculum Vitae:<a class="content-button align-right clearfix" href="">Download RESUME</a>
        </article>
      </section>

      <section id="promos">
        <a href=""><img class="photo-link" src="img/1.jpg" /></a>
        <a href=""><img class="photo-link" src="img/2.jpg" /></a>
        <a href=""><img class="photo-link" src="img/5.jpg" /></a>
      </section>

      <section id="vimeofeed content-center">
      <div id="videos">
      <h2>MY VIMEO</h2>
      <h3>msvictoriamarie</h3>
      <br>
      <?php
        // fetch xml
        $xml = simplexml_load_file("https://vimeo.com/api/v2/user25157710/videos.xml");
        $return = array();

        foreach($xml->video as $video) {
          $vid = array();
          $vid["thumb"] = $video->thumbnail_medium;
          $vid["url"]   = $video->url;
          $vid["title"] = $video->title;
          
          echo "<a class='fancybox-media vim-link' href='",$vid["url"],"'><img class='vim-vid' src='",$vid["thumb"],"' /></a>";
        }
      ?>
      </div>
      <span class="clearfix"></span>
      </section>
    </div>

    <footer>
    <section class="content-center">
      <p class="align-left copy">Copyright &copy; 2015 <a href="http://victoriamariemusic.com">Victoria Marie</a>. All Rights Reserved.</p>
      <p class="align-right credit">Developed by Jayr @ <a href="http://www.oducado.com">oducado.com</a></p>
      <div class="clearfix"></div>
    </section>
    </footer>
    <!--SCRIPT-->
    <script src="jquery-2.1.0.min.js"></script>
    <script type="text/javascript" src="javascripts/slick/slick.min.js"></script>
    <script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    <script type="text/javascript" src="fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
    <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
    <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
    <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
    <script src="javascripts/navigation.js"></script>
    <script>
      $(document).ready(function() {
        $(".contact-btn").fancybox({
          maxWidth  : 800,
          maxHeight : 600,
          fitToView : false,
          width   : '70%',
          height    : '70%',
          autoSize  : false,
          closeClick: false
        });

        $('.fancybox-media').fancybox({
          fitToView : true,
          width   : '90%',
          height  : '90%',
          helpers : {
            media : {}
          }
        });

        $slider = $('#promos');
        $slider.slick({
          dots          : false,
          infinite      : true,
          speed         : 300,
          slidesToShow  : 1,
          adaptiveHeight: true,
          autoPlay      : true,
          autoplaySpeed : 3000
        });

        $slider.hover(
          function() { $slider.slick('slickPause');},
          function() { $slider.slick('slickPlay');}
        );
      });
    </script>
  </body>

  <!--SCRIPT-->
</html>