<!DOCTYPE html>
<html>
  
  <head>
  <!--CSS-->
    <link rel="stylesheet" type="text/css" href="stylesheets/music.css" />
    <link rel="stylesheet" type="text/css" href="stylesheets/main.css" />
    <link rel="stylesheet" type="text/css" href="stylesheets/template.css" />
    <link rel="stylesheet" href="fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
    <link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
    <title>Victoria Marie | Music</title>
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
              <a id="current-link" href="">Music</a>
              <a href="acting.php">Acting</a>
              <a href="gallery.php">Gallery</a>
            </div>
          </span>

          <div>
              <a href="index.html">Home</a>
              <a href="about.html">About</a>
              <a id="current-link" href="">Music</a>
              <a href="acting.php">Acting</a>
              <a href="gallery.php">Gallery</a>
              <a class="fancybox contact-btn" data-fancybox-type="iframe" href="contact.php">Contact Me</a>
            </div>
        </nav>
    </header>
  
    <!-- COVER SECTION BANNER -->
    <section class="header-cover">
        <div><h2>Music
        <br><img class="logo" src="img/icons/vm_logo_flat.png" /></div>
        <a href="#page-top"></a>
    </section>

    <!--  -->
    <div id="page-top" class="container">
    <section class="aside-section">
      <aside>
        <iframe width="100%" height="300" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/12784370&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>
      </aside>


      <article>
        <h2>Musical Background</h2>
       <p>Victoria Marie is a 21-year-old emerging musician originating from the quiet suburbs of Ajax, Ontario; to busking on the city streets of Toronto for 2 years; Until her hustle and sprightly character sparked the interest of the local arts community and industry giants alike. Now currently in the studio with an album in the works, Victoria has grown into a fearless performer and boundless artist, easily displaying an explosive musical palette. Indulging in her curiosity to experiment with everything from her style, to her sound, she began consuming and fusing her guilty pleasures like cheesy pop from the early 2000s, with 90&#39;s R&amp;B, pop punk, tribal hip hop and some good old soul music. Her time on stage is guaranteed to be brimming with youth-fuelled fire and fun.
      </article>
    </section>

    <section id="ytfeed content-center">
      <div id="videos">
      <h2>YOUTUBE</h2>
      <h3>msvictoriamarie</h3>
      <br>

      <iframe width="100%" height="500" src="https://www.youtube.com/embed/7piy-r3sp0M?list=PLSBG99fZaR6cgv1bhRmXOvrdwOQfFRWbh" frameborder="0" allowfullscreen></iframe>
      </div>
      <span class="clearfix"></span>
      </section>
    <section class="">
    
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
          closeClick  : false
        });
      });
    </script>
  </body>

  <!--SCRIPT-->
</html>