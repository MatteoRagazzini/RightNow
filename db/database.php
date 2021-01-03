<?php
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname){
        $this->db = new mysqli($servername, $username, $password, $dbname);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function register($username, $email, $password, $random_salt){
         $stmt = $this->db->prepare("INSERT INTO user (username, email, password, salt) VALUES (?, ?, ?, ?)");
         $stmt->bind_param('ssss',$username,$email, $password, $random_salt);

         return $stmt->execute();
    }

    // public function login($username, $password){
    //     $stmt = $this->db->prepare("SELECT * FROM user WHERE disattivo = 0 AND password = ? AND (username = ? OR EMAIL = ?)");
    //     $stmt->bind_param('sss',$password,$username, $username);
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     return $result->fetch_all(MYSQLI_ASSOC);
    // }



    public function checkbrute($user_id) {
        // Recupero il timestamp
        $now = time();
        // Vengono analizzati tutti i tentativi di login a partire dalle ultime due ore.
        $valid_attempts = $now - (2 * 60 * 60);
            $stmt = $this->db->prepare("SELECT time FROM login_attempts WHERE user_id = ? AND time > '$valid_attempts'");
           $stmt->bind_param('i', $user_id);
           // Eseguo la query creata.
           $stmt->execute();
           $stmt->store_result();
           // Verifico l'esistenza di più di 5 tentativi di login falliti.
           if($stmt->num_rows > 5) {
              return true;
           } else {
              return false;
           }
        }


    public function login($email, $password) {
        // Usando statement sql 'prepared' non sarà possibile attuare un attacco di tipo SQL injection.
            $stmt = $this->db->prepare("SELECT userid, email, username, password, salt FROM user WHERE disattivo = 0  AND (username = ? OR EMAIL = ?)LIMIT 1");
           $stmt->bind_param('ss', $email, $email); // esegue il bind del parametro '$email'.
           $stmt->execute(); // esegue la query appena creata.
           $stmt->store_result();
           $stmt->bind_result($user_id, $db_email, $username, $db_password, $salt); // recupera il risultato della query e lo memorizza nelle relative variabili.
           $stmt->fetch();
           $password = hash('sha512', $password.$salt); // codifica la password usando una chiave univoca.

           if($stmt->num_rows == 1) { // se l'utente esiste
              // verifichiamo che non sia disabilitato in seguito all'esecuzione di troppi tentativi di accesso errati.
              if($this->checkbrute($user_id) == true) {
                 // Account disabilitato
                 // Invia un e-mail all'utente avvisandolo che il suo account è stato disabilitato.
                 return false;
              } else {
              if($db_password == $password) { // Verifica che la password memorizzata nel database corrisponda alla password fornita dall'utente.
                 // Password corretta!

                    $user_browser = $_SERVER['HTTP_USER_AGENT']; // Recupero il parametro 'user-agent' relativo all'utente corrente.
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id); // ci proteggiamo da un attacco XSS
                    $_SESSION['userid'] = $user_id;
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username); // ci proteggiamo da un attacco XSS
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $db_email;
                    $_SESSION['login_string'] = hash('sha512', $password.$user_browser);
                    // Login eseguito con successo.
                    return true;
              } else {
                 // Password incorretta.
                 // Registriamo il tentativo fallito nel database.
                 $now = time();
                 $this->db->query("INSERT INTO login_attempts (user_id, time) VALUES ('$user_id', '$now')");
                 return false;
              }
           }
           } else {
              // L'utente inserito non esiste.
              return false;
           }
    }


     function login_check() {
        // Verifica che tutte le variabili di sessione siano impostate correttamente
        if(isset($_SESSION['userid'], $_SESSION['username'], $_SESSION['login_string'])) {
          $user_id = $_SESSION['userid'];
          $login_string = $_SESSION['login_string'];
          $username = $_SESSION['username'];
          $user_browser = $_SERVER['HTTP_USER_AGENT']; // reperisce la stringa 'user-agent' dell'utente.
          if ($stmt = $this->db->prepare("SELECT password FROM user WHERE userid = ? LIMIT 1")) {
             $stmt->bind_param('i', $user_id); // esegue il bind del parametro '$user_id'.
             $stmt->execute(); // Esegue la query creata.
             $stmt->store_result();

             if($stmt->num_rows == 1) { // se l'utente esiste
                $stmt->bind_result($password); // recupera le variabili dal risultato ottenuto.
                $stmt->fetch();
                $login_check = hash('sha512', $password.$user_browser);
                if($login_check == $login_string) {
                   // Login eseguito!!!!
                   return true;
                } else {
                   //  Login non eseguito
                   return false;
                }
             } else {
                 // Login non eseguito
                 return false;
             }
          } else {
             // Login non eseguito
             return false;
          }
        } else {
          // Login non eseguito
          return false;
        }
     }

    public function isAdmin($userid){
        $stmt = $this->db->prepare("SELECT * FROM admin WHERE user=?");
        $stmt->bind_param('i', $userid);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_all(MYSQLI_ASSOC);
        return count($result) == 1;
    }

    public function createVisual($name, $imgpath, $imgtitle, $imgtext, $title1, $title2, $title3, $text1, $text2, $text3, $credits){
        $stmt = $this->db->prepare("INSERT INTO visual (name, imgpath, imgtitle, imgtext, title1, title2, title3, text1, text2, text3, credits) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssssssss', $name, $imgpath, $imgtitle, $imgtext, $title1, $title2, $title3, $text1, $text2, $text3, $credits);
        return $stmt->execute();
    }

    public function getVisuals(){
        $stmt = $this->db->prepare("SELECT * FROM visual");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getVisual($visualid){
        $stmt = $this->db->prepare("SELECT * FROM visual WHERE visualid = ?");
        $stmt->bind_param('i',$visualid);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteVisual($visualid){
        $query = "DELETE FROM visual WHERE visualid=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$visualid);
        $stmt->execute();
        var_dump($stmt->error);
        return true;
    }

    public function getVisualInUse(){
        $stmt = $this->db->prepare("SELECT * FROM visual WHERE used=1 LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_all(MYSQLI_ASSOC);
        return $result[0];
    }

    public function useVisual($visualid){
        $stmt = $this->db->prepare("UPDATE visual SET used = 0");
        $stmt->execute();
        $stmt = $this->db->prepare("UPDATE visual SET used = 1 WHERE visualid = ?");
        $stmt->bind_param('i',$visualid);
        return $stmt->execute();
    }

    public function updateVisual($visualid, $name, $imgpath, $imgtitle, $imgtext, $title1, $title2, $title3, $text1, $text2, $text3, $credits){
        $stmt = $this->db->prepare("UPDATE visual SET name = ?, imgpath = ?, imgtitle = ?, imgtext = ?, title1 = ?, title2 = ?, title3 = ?, text1 = ?, text2 = ?, text3 = ?, credits = ? WHERE visualid = ?");
        $stmt->bind_param('sssssssssssi', $name, $imgpath, $imgtitle, $imgtext, $title1, $title2, $title3, $text1, $text2, $text3, $credits, $visualid);
        return $stmt->execute();
    }


    public function getUser($userid){
        $stmt = $this->db->prepare("SELECT * FROM user WHERE userid = ?");
        $stmt->bind_param('i',$userid);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createEvent($name, $city, $description, $preview, $maxtickets, $date, $price, $public, $img, $organiser){
        $stmt = $this->db->prepare("INSERT INTO event (eventname, eventcity, eventdescription, eventpreview, maxtickets, date, price, public, imgevent, organiser) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $null = NULL;
        $stmt->bind_param('ssssisdibs',$name,$city, $description, $preview, $maxtickets, $date, $price, $public, $null, $organiser);
        $stmt->send_long_data(8, file_get_contents($img));
        return $stmt->execute();
    }

    public function getEvent($eventid){
        $stmt = $this->db->prepare("SELECT * FROM event WHERE eventid=?");
        $stmt->bind_param('s',$eventid);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addToCart($userid, $eventid){
        $query = "DELETE FROM invitation WHERE event = ? AND user = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$eventid, $userid);
        $stmt->execute();
        $query = "INSERT INTO ticket (event, user) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$eventid, $userid);


        return $stmt->execute();;
    }


    public function removeFromCart($userid, $eventid){
        $query = "DELETE FROM ticket WHERE event = ? AND user = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$eventid, $userid);

        return $stmt->execute();;
    }

    public function buy($userid, $eventid){
        $query = "UPDATE ticket SET bought = 1 WHERE event = ? AND user = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$eventid, $userid);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function getCart($userid){
        $stmt = $this->db->prepare("SELECT * FROM ticket,event WHERE event=eventid AND user=? AND bought=0");
        $stmt->bind_param('i',$userid);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function removePastEventsFromCart($userid){
        $stmt = $this->db->prepare("SELECT * FROM ticket,event WHERE event=eventid AND user=? AND bought=0 AND date < CURDATE()");
        $stmt->bind_param('i',$userid);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_all(MYSQLI_ASSOC);

        foreach($result as $ticket){
            $query = "DELETE FROM ticket WHERE user = ? AND event = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ii', $ticket["user"], $ticket["event"]);
            $stmt->execute();
        }
        return true;
    }

    public function isInCart($userid, $eventid){
        $stmt = $this->db->prepare("SELECT * FROM ticket WHERE event=? AND user=? AND bought=0");
        $stmt->bind_param('ii',$eventid, $userid);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_all(MYSQLI_ASSOC);
        return count($result) == 1;
    }

    public function isInMyEvents($userid, $eventid){
        $stmt = $this->db->prepare("SELECT * FROM ticket WHERE event=? AND user=? AND bought=1");
        $stmt->bind_param('ii',$eventid, $userid);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_all(MYSQLI_ASSOC);
        return count($result) == 1;
    }

    public function myEvents($userid){
        $stmt = $this->db->prepare("SELECT * FROM ticket t, event e WHERE t.event = e.eventid AND user=? AND bought=1 AND e.date >= CURDATE()");
        $stmt->bind_param('s',$userid);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getModifiedEvents($userid) {
      $stmt = $this->db->prepare("SELECT eventid, eventname FROM ticket t, event e WHERE e.eventid = t.event AND user=? AND notification = 1");
      $stmt->bind_param('s',$userid);
      $stmt->execute();
      $result = $stmt->get_result();

      return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function pastEvents($userid){
        $stmt = $this->db->prepare("SELECT * FROM ticket t, event e WHERE t.event = e.eventid AND user=? AND bought=1 AND e.date < CURDATE()");
        $stmt->bind_param('s',$userid);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function ticketsSold($eventid){
        $stmt = $this->db->prepare("SELECT * FROM ticket WHERE event=? AND bought = 1");
        $stmt->bind_param('s',$eventid);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function hostedEvents($userid){
        $stmt = $this->db->prepare("SELECT * FROM event WHERE organiser=? ORDER BY date DESC");
        $stmt->bind_param('i',$userid);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function isPast($eventid){
        $stmt = $this->db->prepare("SELECT * FROM event WHERE eventid=? AND date < CURDATE()");
        $stmt->bind_param('i',$eventid);
        $stmt->execute();
        $result = $stmt->get_result();

        return count($result->fetch_all(MYSQLI_ASSOC)) == 1;
    }


    public function updateEvent($eventid, $name, $city, $description, $preview, $maxtickets, $date, $price, $public, $image){
        $stmt = $this->db->prepare("UPDATE ticket SET notification = 1 WHERE event = ?");
        $stmt->bind_param('i',$eventid);
        $stmt->execute();
        $stmt = $this->db->prepare("UPDATE event SET eventname = ?, eventcity = ?, eventdescription = ?, eventpreview = ?, maxtickets = ?, date = ?, price = ?, public = ?, imgevent = ? WHERE eventid = ?");
        $null = NULL;
        $stmt->bind_param('ssssisdibs',$name, $city, $description, $preview, $maxtickets, $date, $price, $public, $null, $eventid);
        $stmt->send_long_data(8, file_get_contents($image));
        return $stmt->execute();
    }

    public function updateEventNoImage($eventid, $name, $city, $description, $preview, $maxtickets, $date, $price, $public){
        $stmt = $this->db->prepare("UPDATE ticket SET notification = 1 WHERE event = ?");
        $stmt->bind_param('i',$eventid);
        $stmt->execute();
        $stmt = $this->db->prepare("UPDATE event SET eventname = ?, eventcity = ?, eventdescription = ?, eventpreview = ?, maxtickets = ?, date = ?, price = ?, public = ? WHERE eventid = ?");
        $stmt->bind_param('ssssisdis',$name, $city, $description, $preview, $maxtickets, $date, $price, $public, $eventid);
        return $stmt->execute();
    }
//
//    public function updateEventPrice($price, $eventid){
//        $stmt = $this->db->prepare("UPDATE event SET price = ? WHERE eventid = ?");
//        $stmt->bind_param('di',$price, $eventid);
//
//        return $stmt->execute();
//    }
//
//    public function updateEventCity($city, $eventid){
//        $stmt = $this->db->prepare("UPDATE event SET eventcity = ? WHERE eventid = ?");
//        $stmt->bind_param('si',$city, $eventid);
//
//        return $stmt->execute();
//    }
//
//    public function updateEventDate($date, $eventid){
//        $stmt = $this->db->prepare("UPDATE event SET date = ? WHERE eventid = ?");
//        $stmt->bind_param('si',$date, $eventid);
//
//        return $stmt->execute();
//    }
//
//
//    public function updateEventScope($scope, $eventid){
//        $stmt = $this->db->prepare("UPDATE event SET public = ? WHERE eventid = ?");
//        $stmt->bind_param('ii',$scope, $eventid);
//
//        return $stmt->execute();
//    }
//
//    public function updateEventPreview($preview, $eventid){
//        $stmt = $this->db->prepare("UPDATE event SET eventpreview = ? WHERE eventid = ?");
//        $stmt->bind_param('si',$preview, $eventid);
//
//        return $stmt->execute();
//    }
//
//    public function updateEventDescription($description, $eventid){
//        $stmt = $this->db->prepare("UPDATE event SET eventdescription = ? WHERE eventid = ?");
//        $stmt->bind_param('si',$description, $eventid);
//
//        return $stmt->execute();
//    }
//
//    public function updateEventImage($image, $eventid){
//        $stmt = $this->db->prepare("UPDATE event SET imgevent = ? WHERE eventid = ?");
//        $stmt->bind_param('bi',$image, $eventid);
//
//        return $stmt->execute();
//    }


    public function searchEvents($name=null, $city=null, $datefrom = "CURDATE()", $dateto = "2050-01-20", $pricefrom = 0, $priceto = 1000000){
        if($name == ""){
            $name = null;
        }
        if($city == ""){
            $city = null;
        }
        if($datefrom == ""){
            $datefrom = date("Y-m-d");
        }
        if($dateto == ""){
            $dateto = "2050-01-20";
        }
        if($pricefrom == ""){
            $pricefrom = 0;
        }
        if($priceto == ""){
            $priceto = 1000000;
        }
        $query = "SELECT * FROM event WHERE public = 1 AND date >= ? AND date <= ? AND price >= ? AND price <= ?";
        if(isset($name)){
            $query .= " AND eventname = ?";
        }
        if(isset($city)){
            $query .= " AND eventcity = ?";
        }
        $query .= " ORDER BY date ASC";
        $stmt = $this->db->prepare($query);
        if(isset($name) && isset($city)){
            $stmt->bind_param('ssddss',$datefrom, $dateto, $pricefrom, $priceto, $name, $city);
        }
        if(isset($name) && !isset($city)){
            $stmt->bind_param('ssdds',$datefrom, $dateto, $pricefrom, $priceto, $name);
        }
        if(!isset($name) && isset($city)){
            $stmt->bind_param('ssdds',$datefrom, $dateto, $pricefrom, $priceto, $city);
        }
        if(!isset($name) && !isset($city)){
            $stmt->bind_param('ssdd',$datefrom, $dateto, $pricefrom, $priceto);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }



    public function createList($name, $organiser){
        $query = "INSERT INTO list (listname, listorganiser) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si',$name, $organiser);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function addUserToList($userid, $listid){
        $query = "INSERT INTO enlist (list, user) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$listid, $userid);

        return $stmt->execute();
    }

    public function deleteList($listid){
        $query = "DELETE FROM enlist WHERE list = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$listid);
        $stmt->execute();
        $query = "DELETE FROM list WHERE listid = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$listid);
        //var_dump($stmt->error);
        return $stmt->execute();;
    }

    public function deleteUserFromList($userid, $listid){
        $query = "DELETE FROM enlist WHERE user = ? AND list = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$userid, $listid);
        $stmt->execute();
        var_dump($stmt->error);
        return true;
    }

    public function getListsOf($organiserid){
        $stmt = $this->db->prepare("SELECT * FROM list WHERE listorganiser=?");
        $stmt->bind_param('i',$organiserid);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getList($listid){
        $stmt = $this->db->prepare("SELECT * FROM list WHERE listid=?");
        $stmt->bind_param('i',$listid);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC)[0];
    }



    public function getUsernames(){
        $stmt = $this->db->prepare("SELECT username FROM user WHERE disattivo=0");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCities($articolo){
        $stmt = $this->db->prepare("SELECT eventcity FROM event WHERE date >= CURDATE()");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getInvitations($userid){
        $stmt = $this->db->prepare("SELECT * FROM invitation, event WHERE event = eventid AND user = ?");
        $stmt->bind_param('i',$userid);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function removeInvitation($userid, $eventid){
        $stmt = $this->db->prepare("DELETE FROM invitation WHERE event = ? AND user = ?");
        $stmt->bind_param('ii',$eventid, $userid);

        return $stmt->execute();
    }

    public function inviteUser($userid, $eventid, $sendername){
        $query = "INSERT INTO invitation (event, user, sendername) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iis',$eventid, $userid, $sendername);


        return $stmt->execute();
    }

    public function inviteUserById($userid, $eventid, $sendername){
        $query = "INSERT INTO invitation (event, user, sendername) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iii',$eventid, $userid, $sendername);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function inviteList($listid, $eventid, $organiserid){
        foreach($this->getUsersEnlist($listid) as $user){
            $this->inviteUserById($user["userid"], $eventid, $organiserid);
        }
        return $this;
    }

    public function getUsersEnlist($listid){
        $stmt = $this->db->prepare("SELECT * FROM user,enlist WHERE user=userid AND list=?");
        $stmt->bind_param('i',$listid);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getListId($listname, $organiserid){
        $stmt = $this->db->prepare("SELECT listid FROM list WHERE listname = ? AND listorganiser = ?");
        $stmt->bind_param('si',$listname, $organiserid);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_all(MYSQLI_ASSOC);
        if(count($result) != 0){
            $result = $result[0]["listid"];
        }else{
            $result = 0;
        }
        return $result;
    }

    public function removeNotification($userid, $eventid){
        $query = "UPDATE ticket SET notification = 0 WHERE event = ? AND user = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$eventid, $userid);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function getUserId($username){
        $stmt = $this->db->prepare("SELECT userid FROM user WHERE username = ?");
        $stmt->bind_param('s',$username);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_all(MYSQLI_ASSOC);
        if(count($result) != 0){
            $result = $result[0]["userid"];
        }else{
            $result = 0;
        }
        return $result;
    }




}
?>
