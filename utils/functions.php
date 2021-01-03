<?php
function logUser($user){
    $_SESSION["userid"] = $user["userid"];
    $_SESSION["username"] = $user["username"];
    $_SESSION["email"] = $user["email"];
}
function logout(){
    unset($_SESSION);
}

function saveEvents($events){
    $_SESSION["events"] = $events;
}

function isUserLoggedIn(){
    return !empty($_SESSION["userid"]);
}

function getTotal($eventsInCart){
    $sum = 0;
    foreach($eventsInCart as $event):
        $sum += $event["price"];
    endforeach;
    return $sum;
}

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

function sec_session_start() {
    $session_name = 'sec_session_id'; // Imposta un nome di sessione
    $secure = false; // Imposta il parametro a true se vuoi usare il protocollo 'https'.
    $httponly = true; // Questo impedirà ad un javascript di essere in grado di accedere all'id di sessione.
    ini_set('session.use_only_cookies', 1); // Forza la sessione ad utilizzare solo i cookie.
    $cookieParams = session_get_cookie_params(); // Legge i parametri correnti relativi ai cookie.
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
    session_name($session_name); // Imposta il nome di sessione con quello prescelto all'inizio della funzione.
    session_start(); // Avvia la sessione php.
    session_regenerate_id(); // Rigenera la sessione e cancella quella creata in precedenza.
}

?>