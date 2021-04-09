<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/../views/templates');
$twig = new Environment($loader);

echo $twig->render('first.html.twig', ['output' => 'templates/main_view.php']);