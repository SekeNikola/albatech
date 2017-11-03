<?php

/**
 * Основне поставке Вордпреса.
 *
 * Ова датотека се користи од стране скрипте за прављење wp-config.php током
 * инсталирања. Не морате да користите веб место, само умножите ову датотеку
 * у "wp-config.php" и попуните вредности.
 *
 * Ова датотека садржи следеће поставке:
 * * MySQL подешавања
 * * тајне кључеве
 * * префикс табеле
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

$_SERVER['HTTP_HOST'] = $_SERVER['HTTP_X_FORWARDED_HOST'];

define('WP_SITEURL', getenv('HOST'));

define('WP_HOME', getenv('HOST'));

define('FS_METHOD', 'direct');

// ** MySQL подешавања - Можете добити ове податке од свог домаћина ** //
/** Име базе података за Вордпрес */
define('DB_NAME', 'albatech_alba');

/** Корисничко име MySQL базе */
define('DB_USER', 'root');

/** Лозинка MySQL базе */
define('DB_PASSWORD', 'random');

/** MySQL домаћин */
define('DB_HOST', 'mysql');

/** Скуп знакова за коришћење у прављењу табела базе. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Не мењајте ово ако сте у сумњи. */
define('DB_COLLATE', '');

/**#@+
 * Јединствени кључеви за аутентификацију.
 *
 * Промените ово у различите јединствене изразе!
 * Можете направити ово користећи {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org услугу тајних кључева}
 * Ово можете променити у сваком тренутку да бисте поништили све постојеће колачиће.
 * Ово ће натерати кориснике да се поново пријаве.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '%-TmTC^NrUj09[~nort)h]R{T!uGPfa4IIWH&{Gi3J!S[7Eoe7^rEmhEnDc@B|Cb');
define('SECURE_AUTH_KEY',  '!YX!X<Yv|LFs6JwyuK#<fO/?xgLnzY>nBxv}7HFQWA66wko*MmbmMV^VJNJ6Rm j');
define('LOGGED_IN_KEY',    '2WqXq3CV S$dO:p4S00[S[N|%t@l0BSC{2HL4eWa/2Gk{],5$}-=~n.P{cx]>E+K');
define('NONCE_KEY',        'dh%<lBPt<9WhC(wl BMlQfS)Bxh2j)PaAp|R-|9Syishv^5U%7vk-+NEZ!4ulO~S');
define('AUTH_SALT',        '-cddg+6F/es<p{sM aN/$-h;5=Kv!6o.vIA,K DcIrt~nLo~q>QQG`xn<Yb%W9n<');
define('SECURE_AUTH_SALT', 's$Go&MMo)vXfNfNxiG!~E#=|T_,P}-[/HgG<nf@[adL.-D&T[`O (4e-Im2yi?`n');
define('LOGGED_IN_SALT',   'chBjs?>]2tf26NKOOyH]T/6[J(}NyU=IoMRy>N 2t-X1pR}|5q[4cCC;{!S{5X+)');
define('NONCE_SALT',       'd&1J/3)ipH!2#Fx@_:aclyL@u!ZV~Xi +}r=PPgA$V+mem1uqg#::>k><nCt3IA`');

/**#@-*/

/**
 * Префикс табеле Вордпресове базе података.
 *
 * Можете имати више инсталација Вордпреса у једној бази уколико
 * свакој дате јединствени префикс. Само бројеви, слова и доње цртице!
 */
$table_prefix  = 'wp_';

/**
 * За градитеље: исправљање грешака у Вордпресу ("WordPress debugging mode").
 *
 * Промените ово у true да бисте омогућили приказ напомена током градње.
 * Веома се препоручује да градитељи тема и додатака користе WP_DEBUG
 * у својим градитељским окружењима.
 *
 * За више података о осталим константама које могу да се
 * користе током отклањања грешака, посетите Документацију.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* То је све, престаните са уређивањем! Срећно блоговање. */

/** Апсолутна путања ка Вордпресовом директоријуму. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Поставља Вордпресове променљиве и укључене датотеке. */
require_once(ABSPATH . 'wp-settings.php');
