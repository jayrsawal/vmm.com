<!DOCTYPE html>
<html>
  <body>
  <?php
function sendMail() { 
  $email = $_POST["mail"];
  $to = "msvictoriamarie.s@gmail.com";
  $subject = "victoriamariemusic.com: Message Received";
  $headers = "From: admin@victoriamariemusic.com\r\n";
  $headers .= "CC: jayrsawal@gmail.com\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
  $msg = $_POST["msgbody"];
  $pnum = $_POST["phone"];
  $name = $_POST["name"]; 
  $message = "A visitor to your site has sent the following email: <br/><br/>

  Name: ".$name."<br/>
  Email Address: ".$email."<br/>
  Phone: "."$pnum"."<br/><br/>
  <b>Message:</b>
  <div style='border: 1px solid black; padding: 1em;'>
  <b><i>".$msg."</i></b>
  </div>";
  $user = "do-not-reply@victoriamariemusic.com";
  $usersubject = "Victoria Marie - MESSAGE CONFIRMATION";
  $userheaders = "From: do-not-reply@victoriamariemusic.com\r\n";
  $userheaders .= "MIME-Version: 1.0\r\n";
  $userheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
  $usermessage = "Greetings ".$name.",

  Thank you for sending me a message! I will get back to you as soon as I can.

  Sincerely,

  <b>Victoria Marie</b>";
  mail($to,$subject,$message,$headers);
  mail($user,$usersubject,$usermessage,$userheaders);
}

if(isset($_POST['submit'])) {
   sendMail();
   echo "Mail has been sent!";
}
 ?>
  </body>
</html>