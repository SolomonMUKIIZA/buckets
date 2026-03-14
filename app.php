<?php
// ============================================================
// config/app.php — Application Configuration
// ============================================================

// ── Environment ──────────────────────────────────────────────
define('APP_ENV',    'development');   // 'production' in live
define('APP_DEBUG',  true);
define('APP_NAME',   'US-UG Connect');
define('APP_URL',    'http://localhost/us_ug_connect');
define('APP_VERSION','1.0.0');

// ── Security ─────────────────────────────────────────────────
define('APP_SECRET',     'CHANGE_THIS_TO_A_RANDOM_64CHAR_STRING_IN_PRODUCTION');
define('SESSION_NAME',   'uusc_session');
define('CSRF_TOKEN_NAME','_csrf_token');

// ── File Uploads ─────────────────────────────────────────────
define('UPLOAD_DIR',     __DIR__ . '/../uploads/');
define('UPLOAD_URL',     APP_URL . '/uploads/');
define('MAX_UPLOAD_MB',  5);
define('ALLOWED_IMAGES', ['image/jpeg','image/png','image/gif','image/webp']);

// ── Rewards Tiers (points thresholds) ────────────────────────
define('TIER_SILVER',    500);
define('TIER_GOLD',      1500);
define('TIER_PLATINUM',  4000);
define('TIER_AMBASSADOR',10000);

// ── Points per action ────────────────────────────────────────
define('POINTS_VISIT',       20);
define('POINTS_EVENT',       50);
define('POINTS_BOOK_BORROW', 10);
define('POINTS_BOOK_RETURN', 5);
define('POINTS_STREAK_BONUS',30);    // bonus for consecutive weekly visits
define('POINTS_REFERRAL',    100);
define('POINTS_FEEDBACK',    15);

// ── Chat ─────────────────────────────────────────────────────
define('CHAT_MESSAGES_PER_PAGE', 50);
define('CHAT_POLL_INTERVAL',     3);    // seconds (long-poll fallback)

// ── Timezone ─────────────────────────────────────────────────
define('APP_TZ', 'Africa/Kampala');
date_default_timezone_set(APP_TZ);

// ── Error handling ───────────────────────────────────────────
if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(0);
    ini_set('display_errors', '0');
}

// ── Autoload includes ────────────────────────────────────────
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/rewards.php';

// ── Session ──────────────────────────────────────────────────
if (session_status() === PHP_SESSION_NONE) {
    session_name(SESSION_NAME);
    session_set_cookie_params([
        'lifetime' => 86400 * 7,
        'path'     => '/',
        'secure'   => (APP_ENV === 'production'),
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}
