<?php
class Anmeldemaske
{
    private $link;

    public function __construct()
    {
        $this->link = connectdb(); // Verbindung zur Datenbank herstellen
    }
    public function getUserByEmail($email)
    {
        $sql = 'SELECT * FROM benutzer WHERE email = ?';
        $stmt = $this->link->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function logFailedAttempt($email)
    {
        $link = connectdb();
        $stmt = $link->prepare("UPDATE benutzer SET letzterfehler = ? WHERE email = ? ");
        $currentTime = date("Y-m-d H:i:s");
        $stmt->bind_param("ss", $currentTime, $email);
        $stmt->execute();
    }

    public function incrementFailedLogin($userId)
    {
        $link = connectdb();
        $stmt = $link->prepare("UPDATE benutzer SET anzahlfehler = anzahlfehler+1, letzterfehler = ? WHERE id = ? ");
        $currentTime = date("Y-m-d H:i:s");
        $stmt->bind_param("si", $currentTime, $userId);
        $stmt->execute();
    }

    public function updateLoginDetails($userID)
    {
        $link = connectdb();
//        $stmt = $link->prepare("UPDATE benutzer SET anzahlanmeldungen = anzahlanmeldungen+1, letzteanmeldung = ? WHERE id = ? ");
//        $currentTime = date("Y-m-d H:i:s");
//        $stmt->bind_param("si", $currentTime, $userID);
//        $stmt->execute();

        $stmt = $link->prepare("CALL benutzerAnzahlanmeldung_inkrement(?)");
        if($stmt){
            $stmt->bind_param("i", $userID);
            $stmt->execute();
        }
    }
    public function beginTransaction()
    {
        $this->link->begin_transaction();
    }

    public function commit()
    {
        $this->link->commit();
    }

    public function rollback()
    {
        $this->link->rollback();
    }
}