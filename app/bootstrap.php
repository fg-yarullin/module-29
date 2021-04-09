<?php
// use App\core;
// подключаем файлы ядра
// var_dump(__DIR__);
// exit(0);
// require_once __DIR__ . '/core/controller.php';
// require_once __DIR__ . '/core/model.php';
// require_once __DIR__ . '/core/view.php';

/**
 * Здкесь обычно дополнительные модули, реализующие 
 * дополнительные функции:
 * > аутентификацию
 * > кеширование
 * > работу с формами
 * > абстракция для доступа к данным
 * > ORM
 * > Unit testing
 * > Benchmarking
 * > Работу с изображениями
 * > Backup
 * > и другие
 */

// require_once __DIR__ . '/core/route.php';
include 'app_routes.php';
include __DIR__ . '/../config/db_connection.php';
Route::run();