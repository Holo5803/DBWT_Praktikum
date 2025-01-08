<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../beispiele/passwort.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../helpers/LoginException.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/anmeldemaske.php');


class AnmeldemaskeController
{
    private $userAnmeldungen;
    public function indexAnmelden(RequestData $request)
    {
        echo "<script>console.log('hier0' );</script>";
        $msg = $_SESSION['login_result_message'] ?? null;
        unset($_SESSION['login_result_message']);
        return view('anmeldung', [
            'rd' => $request,
            'msg' => $msg
        ]);
    }
    public function __construct()
    {
        $this->userAnmeldungen = new Anmeldemaske();
    }

    public function checkLogin(RequestData $request)
    {
        echo "<script>console.log('hier1' );</script>";
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


        try {
            $this->userAnmeldungen->beginTransaction();

            $user = $this->userAnmeldungen->getUserByEmail($email);

            if (!$user) {
                $this->userAnmeldungen->logFailedAttempt($email);
                $message = "Ungültige Anmeldedaten";
                $this->userAnmeldungen->commit();
                throw new LoginException($message);
            }

            //Passwort verifizieren
            $hashPassword = hash('sha256', mein_salz . $passwort);
            if ($hashPassword !== $user['passwort']) {
                $this->userAnmeldungen->incrementFailedLogin($user['id']);
                $message = "Ungültige Anmeldedaten";
                $this->userAnmeldungen->commit();

                throw new LoginException($message);
            }

            //Erfolgreich login:
            $this->userAnmeldungen->updateLoginDetails($user['id']);

            //Speichern User Session
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['admin'] = $user['admin'];

            $log = logger();

            $log->info('Anmeldung abgeschlossen' , ['time' => date("Y-m-d H:i:s")]);

            //Transaktion commit
            $this->userAnmeldungen->commit();

            echo "<script>console.log('hier3 );</script>";

            if (isset($_SESSION['redirect_nach_login'])){
                echo "<script>console.log('hier4' );</script>";
                $redirectUrl = $_SESSION['redirect_nach_login'] ?? '/';
                unset($_SESSION['redirect_nach_login']); // Clear the session variable
                header('Location: ' . $redirectUrl);
                exit();
            }

            header('location: /');
            exit();
        } catch (LoginException $e) {
            //Rollback zurück zu der Transaktion, falls es ein Fehler eintreten
            $this->userAnmeldungen->rollback();
            if ($message !== "") {
                $_SESSION['login_result_message'] = "Ein Fehler ist aufgetreten: " . $e->getMessage();
            }

            header('location: /anmeldung');
            $log = logger();

            $log->info('Fehlgeschlagenen Anmeldungen' , ['time' => date("Y-m-d H:i:s")]);
            exit();
        }

    }


    public function logout()
    {
        session_destroy();
        header('location: /');

        $log = logger();

        $log->info('Abmeldung abgeschlossen' , ['time' => date("Y-m-d H:i:s")]);
    }
}
