<!DOCTYPE html>
<html>
  
  <head>
  <!--CSS-->
    <link rel="stylesheet" type="text/css" href="stylesheets/main.css" />
    <link rel="stylesheet" type="text/css" href="stylesheets/template.css" />
    <link rel="stylesheet" type="text/css" href="javascripts/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="javascripts/slick/slick-theme.css"/>
    <link rel="stylesheet" type="text/css" href="stylesheets/gallery.css" />
    <link rel="stylesheet" href="fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
    <link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
        
    <title>Victoria Marie | Gallery</title>
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
              <a href="acting.php">Acting</a>
              <a id="current-link" href="">Gallery</a>
            </div>
          </span>

          <div>
              <a href="index.html">Home</a>
              <a href="about.html">About</a>
              <a href="music.php">Music</a>
              <a href="acting.php">Acting</a>
              <a id="current-link" href="">Gallery</a>
              <a class="fancybox contact-btn" data-fancybox-type="iframe" href="contact.php">Contact Me</a>
            </div>
        </nav>
    </header>
  
    <!-- COVER SECTION BANNER -->
    <section class="header-cover">
        <div><h2>Gallery
        <br><img class="logo" src="img/icons/vm_logo_flat.png" /></div>
        <a href="#page-top"></a>
    </section>

    <div id="page-top" class="container">
    <!-- MAIN CONTENT -->
    <section class="photo-gallery">
      <!-- GALLERY GENERATOR -->
      <?php
        ini_set('display_errors', 'On');
        error_reporting(E_ALL | E_STRICT);
        include "includes/gallery_helper.php"; // import helper functions

        // VARIABLES
        $galleries_dir = 'img/galleries/';
        $gallery_list  = get_dirs($galleries_dir);

        foreach($gallery_list as $sub_dir) {
          $images_dir = $galleries_dir.$sub_dir."/";
          $thumbs_dir = $images_dir."thumbs/";
          $thumb_width= 200;
          $images     = get_pics($images_dir);
          $index      = 0;
          echo "<article class='photo-gallery'><h2>".$sub_dir."</h2>";
          echo "<div class='photo-dump'>";
          foreach($images as $index=>$file) {
            $index++;
            $thumbnail_image = $thumbs_dir.$file;
            if(!file_exists($thumbnail_image)) {
              $extension = get_extension($thumbnail_image);
              if($extension) {
                make_thumb($images_dir.$file,$thumbnail_image,$thumb_width);
              }
            }
            echo '<a href="',$images_dir.$file,'" class="photo-link fancybox-thumb" rel="',$sub_dir,'" title="',$sub_dir,' (',$file,')"><img src="',$thumbnail_image,'" /></a>';
          }
          echo "</div></article>";
          echo '<div class="clearfix"></div>';
        }
      ?>
    </section>
    </div>
      <section class="instagram">
        <div id="instafeed"></div>
      </section>

    <footer>
    <section class="content-center">
      <p class="align-left copy">Copyright &copy; 2015 <a href="http://victoriamariemusic.com">Victoria Marie</a>. All Rights Reserved.</p>
      <p class="align-right credit">Developed by Jayr @ <a href="http://www.oducado.com">oducado.com</a></p>
      <div class="clearfix"></div>
    </section>
    </footer>
  <!--SCRIPT-->
  <script type="text/javascript" src="jquery-2.1.0.min.js"></script>
  <script type="text/javascript" src="javascripts/navigation.js"></script>
  <script type="text/javascript" src="javascripts/instafeed.min.js"></script>
  <script type="text/javascript" src="javascripts/slick/slick.min.js"></script>
  <script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
  <script type="text/javascript" src="fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
  <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
  <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
  <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

  <!--instafeed-->
  <script type="text/javascript">
    var userFeed = new Instafeed({
        get: 'user',
        userId: 392560340,
        accessToken: '197967644.e8e11da.d0d4bb4714604a68b6a980d901e92f80',
        clientId: 'e8e11da4271d4e568f3cd255fdc2a8b4',

        template: '<a href="{{link}}"><img class="insta-pic" src="{{image}}" /></a>',
        after: function () {
          $slider = $('#instafeed');
            $slider.slick({
              arrows: false,
              autoplay: true,
              autoplaySpeed: 1,
              speed: 1500,
              pauseOnHover: true,
              centerMode: true,
              infinite: true,
              variableWidth: true,
              lazyLoad: 'progressive'
            });

            $slider.hover(
              function() { $slider.slick('slickPause');},
              function() { $slider.slick('slickPlay');}
            );
        }
    });
    userFeed.run();
</script>
<!--fancybox-->
<script type="text/javascript">
  $(document).ready(function() {
    $(".fancybox-thumb").fancybox({
      prevEffect  : 'none',
      nextEffect  : 'none',
      helpers : {
        title : {
          type: 'inside'
        },
        thumbs  : {
          width : 50,
          height  : 50
        }
      }
    });

    $(".contact-btn").fancybox({
      maxWidth  : 800,
      maxHeight : 600,
      fitToView : false,
      width   : '70%',
      height    : '70%',
      autoSize  : false,
      closeClick  : false
    });
  });
</script>
  </body>

  <!--SCRIPT-->
</html>