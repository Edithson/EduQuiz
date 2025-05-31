A lire attentivement!!!

Vous aurez besoins de télécharger la librerie PHPMailer et de la configurer au niveau du controlleur afin de permettre l'envoie des mails

Téléchargez PHPMailer depuis GitHub : https://github.com/PHPMailer/PHPMailer
Extractez les fichiers dans le projet
Incluez les fichiers manuellement comme vous le verrez dans le controlleur mailer.php, c'est à dire : 
<?php
require_once 'PHPMailer/src/Exception.php';
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Le reste du code de mailer.php ici...
?>

n'utiliser pas ma clé d'application google car c'est une fausse ;)
donc créez en la votre et configurez là toujours dans le controlleur mailer.php