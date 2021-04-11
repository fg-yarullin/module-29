<?php
// ini_set('display_errors', 1);
require __DIR__ . '/../config/config.php';

// require __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../app/bootstrap.php';

// twig
// include __DIR__ . '/../app/views/first.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\HtmlFormatter;

// Создаем логгер 
$log = new Logger('mylog');

// Хендлер, который будет писать логи в "mylog.log" и слушать все ошибки с уровнем "WARNING" и выше .
$log->pushHandler(new StreamHandler('mylog.log', Logger::WARNING));

// Хендлер, который будет писать логи в "troubles.log" и реагировать на ошибки с уровнем "ALERT" и выше.
$log->pushHandler(new StreamHandler('troubles.log', Logger::ALERT));

$log->pushHandler(new StreamHandler('troubles.log', Logger::INFO));


// Добавляем записи
$log->warning('Предупреждение');
$log->error('Большая ошибка');
$log->info('Просто тест');