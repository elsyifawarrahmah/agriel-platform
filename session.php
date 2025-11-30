<?php
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_strict_mode', 1);
    ini_set('session.cookie_lifetime', 0); 
    ini_set('session.gc_maxlifetime', 1800); 
    
    session_start();
    
    if (!isset($_SESSION['created'])) {
        $_SESSION['created'] = time();
    } else if (time() - $_SESSION['created'] > 1800) {
        session_regenerate_id(true);
        $_SESSION['created'] = time();
    }
}

function isLoggedIn() {
    return isset($_SESSION['user']) && !empty($_SESSION['user']);
}

function getUser() {
    return $_SESSION['user'] ?? null;
}

function requireAuth($redirectUrl = 'index.php') {
    if (!isLoggedIn()) {
        header('Location: ' . $redirectUrl . '?error=login_required');
        exit;
    }
    return true;
}

function debugSession() {
    if (isset($_SESSION['user'])) {
        error_log("User logged in: " . $_SESSION['user']['email']);
    } else {
        error_log("No user session");
    }
}
debugSession();
?>