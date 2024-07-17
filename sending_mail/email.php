<?php
// Load Composer's autoloader
require_once './vendor/autoload.php';

// Import Classess
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

$transport = Transport::fromDsn('smtp://vaghelaakshay9823@gmail.com:fwcvitlwhkfzejjt@smtp.gmail.com:587');

// Create a Mailer object
$mailer = new Mailer($transport);

// Create an Email object
$email = (new Email());

// Set the "From address"
$email->from('vaghelaakshay9823@gmail.com');

// Set the "To address"
$email->to(
    'vaghelaakshay1225@gmail.com'
);
// Set a "subject"
$email->subject('first mail from this project!');

// Set the plain-text "Body"
$email->text('The plain text version of the message.');

// Set HTML "Body"
$email->html('
    <h1 style="color: #fff300; background-color: #0073ff; width: 500px; padding: 16px 0; text-align: center; border-radius: 50px;">
    This message for first mail to my anther id by this project.
    </h1>
    <br>
    <h1 style="color: #ff0000; background-color: #5bff9c; width: 500px; padding: 16px 0; text-align: center; border-radius: 50px;">
    The End!
    </h1>
');
// Add an "Attachment"
//$email->attachFromPath('app_password.txt');


// Add an "Image"
$email->embed(fopen('konnichiwa.png', 'r'), ' photo send by email');

// Sending email with status
try {
    // Send email
    $mailer->send($email);

    // Display custom successful message
    die('<style> * { font-size: 100px; color: #444; background-color: #4eff73; } </style><pre><h1>&#127881;Email sent successfully!</h1></pre>');
} catch (TransportExceptionInterface $e) {
    // Display custom error message
    die('<style>* { font-size: 100px; color: #fff; background-color: #ff4e4e; }</style><pre><h1>&#128544;Error!</h1></pre>');
}