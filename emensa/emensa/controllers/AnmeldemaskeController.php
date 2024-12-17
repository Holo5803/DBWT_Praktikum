<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../beispiele/passwort.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../helpers/LoginException.php');


class AnmeldemaskeController
{
    public function indexAnmelden(RequestData $request)
    {
        $msg = $_SESSION['login_result_message'] ?? null;
        unset($_SESSION['login_result_message']);
        return view('anmeldung', [
            'rd' => $request,
            'msg' => $msg
        ]);
    }

    public function checkLogin(RequestData $request)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $email = $_POST['email'] ?? '';
            $passwort = $_POST['passwort'] ?? '';
        } else {
            return;
        }

        $message = "";


        //Validieren Input
        if (empty($email) || empty($passwort)) {
            $message = "Bitte geben Sie E-mail oder Passwort!";
            throw new LoginException($message);
        }

        $link = connectdb();
        $link->begin_transaction();

        try {
            $sql = 'SELECT * FROM benutzer WHERE email  = ?';
            $stmt = $link->prepare($sql);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();


            if (!$user) {
                $this->logFailedAttempt($email);
                $message = "Ungültige Anmeldedaten";
                $link->commit();
                throw new LoginException($message);
            }

            //Passwort verifizieren
            $hashPassword = hash('sha256', mein_salz . $passwort);
            if ($hashPassword !== $user['passwort']) {
                $this->incrementFailedLogin($user['id']);
                $message = "Ungültige Anmeldedaten";
                $link->commit();
                throw new LoginException($message);
            }

            //Erfolgreich login:
            $this->updateLoginDetails($user['id']);

            //Speichern User Session
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];

            //Transaktion commit
            $link->commit();

            header('location: /');
            exit();
        } catch (LoginException $e) {
            //Rollback zurück zu der Transaktion, falls es ein Fehler eintreten
            $link->rollback();
            if ($message !== "") {
                $_SESSION['login_result_message'] = "Ein Fehler ist aufgetreten: " . $e->getMessage();
            }

            header('location: /anmeldung');
            exit();
        }
    }

    private function logFailedAttempt($email)
    {
        $link = connectdb();
        $stmt = $link->prepare("UPDATE benutzer SET letzterfehler = ? WHERE email = ? ");
        $currentTime = date("Y-m-d H:i:s");
        $stmt->bind_param("ss", $currentTime, $email);
        $stmt->execute();
    }

    private function incrementFailedLogin($userId)
    {
        $link = connectdb();
        $stmt = $link->prepare("UPDATE benutzer SET anzahlfehler = anzahlfehler+1, letzterfehler = ? WHERE id = ? ");
        $currentTime = date("Y-m-d H:i:s");
        $stmt->bind_param("si", $currentTime, $userId);
        $stmt->execute();
    }

    private function updateLoginDetails($userID)
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

    public function logout()
    {
        session_destroy();
        header('location: /');
    }
}
