<?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
       // Sanitize and fetch form data
       $firstName = htmlspecialchars(strip_tags(trim($_POST["firstName"])));
       $lastName  = htmlspecialchars(strip_tags(trim($_POST["lastName"])));
       $mobile    = htmlspecialchars(strip_tags(trim($_POST["mobile"])));
       $email     = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
       $company   = htmlspecialchars(strip_tags(trim($_POST["company"])));
       $message   = htmlspecialchars(strip_tags(trim($_POST["message"])));
   
       // Validate email
       if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           echo "Invalid email format.";
           exit;
       }
   
       // Recipient
       $to = "sruthitk22@gmail.com"; // Your receiving email
       $subject = "New Quote Request from $firstName $lastName";
   
       // Email body
       $email_body = "
   You have received a new message from your website contact form:
   
   Name     : $firstName $lastName
   Email    : $email
   Mobile   : $mobile
   Company  : $company
   
   Message:
   $message
   ";
   
       // Headers
       $headers = "From: $firstName $lastName <$email>\r\n";
       $headers .= "Reply-To: $email\r\n";
   
       // Send mail
       if (mail($to, $subject, $email_body, $headers)) {
           echo "Thank you! Your message has been sent.";
       } else {
           echo "There was a problem sending your message. Please try again.";
       }
   }
   ?>