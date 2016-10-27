<!DOCTYPE html>
<html>
  
  <head>
  <!--CSS-->
    <link rel="stylesheet" type="text/css" href="stylesheets/contact.css" />    
    <title>Victoria Marie | Home</title>
  </head>

  <body>
    <section class="side-bar">
      <ul>
        <li><a href="#contact">Contact Information</a></li>
        <li><a href="#comment">Comments & Requests</a></li>
        <li><a href="#download">Downloads</a></li>
      </ul>
    </section>
    <section class="content-view">
      <article class="slides">
        <div class="slide" id="contact"> 
          <div id="headshot"></div>
          <h1>VICTORIA MARIE</h1>
          <div id="contact-info">
            <p><span>p</span>(416) 993-3355
            <br><span>e</span>msvictoriamarie@gmail.com
            <br><span>i</span>@growingolden
            <br><span>f</span>facebook.com/victoria.marie
            <br><span>j</span>victoriamariemusic.com
          </div>
        </div>

        <div class="slide" id="comment"> Comments & Requests
            <form class="table" method="POST" action="theme-functions.php">
              <div class="row">
                <div class="cell">Name: </div>
                <div class="cell"><input name="name" type="text" /></div>
              </div>
              <div class="row">
                <div class="cell">E-Mail:</div>
                <div class="cell"><input name="mail" type="text" /></div>
              </div>
              <div class="row">
                <div class="cell">Phone:</div>
                <div class="cell"><input name="phone" type="text" /></div>
              </div>
              <div class="row">
                <div class="cell">Message: </div>
                <div class="cell"><input name="msgbody" type="text" /></div>
              </div>
              <input type="submit" value="SEND" name="submit" />
              
            </form>
        </div>
        <div class="slide" id="download"> Downloads
          <ul>
            <li>Resume and CV</li>
          </ul>
        </div>
    </section>
    <!--SCRIPT-->
    <script src="jquery-2.1.0.min.js"></script>
    <script>
    $(document).ready(function(){
      $('a[href^="#"]').on('click',function (e) {
          e.preventDefault();

          var target = this.hash;
          var $target = $(target);
          var distance = $('.slides').offset().top -$(target).offset().top;
          $('.slides').css({
            '-webkit-transform':'translateY('+ distance +'px)',
            '-moz-transform':'translateY('+ distance +'px)',
            '-ms-transform':'translateY('+ distance +'px)',
            '-o-transform':'translateY('+ distance +'px)',
            'transform':'translateY('+ distance +'px)'
          });
        });
      });
    </script>
  </body>

</html>