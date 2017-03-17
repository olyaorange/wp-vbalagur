<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'vbalagur');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '<pNtG@sY}Ia-A[:KdNhMlc&~>vVGj/Cl0Hy[=B]Bp^FNy8|/Eq!IU$k94Atvo!^E');
define('SECURE_AUTH_KEY',  'xwZ>j?! Bl]e1+}fx>jf)|CpKt5+@#r=ZITe0D%[k7_&0w:kf9rg4/v %w=ZD~Rx');
define('LOGGED_IN_KEY',    'l]<#DGCkn|&u|%hU_iy%)axhXFPz89!?+;PgUbHxdGT5u>4gJ9qe<5+X~m<4@*5l');
define('NONCE_KEY',        'v3`O-!B(q7EjC:^H& EWiEYWA?7@f|1iX67}n2B3~ptO,k5xK.(_IF63aexa2?5m');
define('AUTH_SALT',        'JT4#`dtUAYCC38iN6_;BQ)wmW]BmjE=:Y;glrTD@0>>{BUJU?AlMXxkt9P1LI(mW');
define('SECURE_AUTH_SALT', 'w:DJ[vDRR&.|Q%M[6v?qi|v@B@~i$9z,4x)-x4oG^)7dSRrY-|}s%Hy21U,dHxIL');
define('LOGGED_IN_SALT',   'fr#^PW4#qH#_};:0/<}XH6>>e.++gW/ (C)h)~^GkGQeRZda@{&HXnLQB@wXSxjk');
define('NONCE_SALT',       '6Cl^n_:{9O?b(..ElI?fE;hu1.2L^bl(.CNb()/GDPf8e+b@Q?*YY[J_P*6SpT7t');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'vb_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 * 
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
