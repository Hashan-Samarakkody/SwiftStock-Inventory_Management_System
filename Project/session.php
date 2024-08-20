<?php

session_set_cookie_params([
    'lifetime' => 0,          // Session cookie duration (0 means until the browser is closed)
    'path' => '/',            // Path where the cookie is available
    'domain' => '',           // Domain for the cookie (empty for current domain)
    'secure' => true,        // Secure flag (true means cookie only sent over HTTPS)
    'httponly' => true,      // HttpOnly flag (true means cookie not accessible via JavaScript)
    'samesite' => 'Strict'   // SameSite attribute for CSRF protection
]);

// Enforce strict mode for session management
ini_set('session.use_strict_mode', 1);

// Start the session
session_start();

// Regenerate session ID to prevent session fixation attacks
session_regenerate_id(true);
?>
