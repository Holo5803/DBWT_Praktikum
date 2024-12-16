<?php
class AdminController
{
    public function showLogin()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return view('login_view');
    }

    // Verarbeitet die Login-Daten
    public function verifyLogin() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $email = $_POST['email'];
        $passwort = $_POST['passwort'];
        $salt = '1234'; // Der zentrale Salt

        // Verbindung zur Datenbank herstellen
        $link = connectdb();

        // Passwort-Hash berechnen
        $passwortHash = sha1($salt . $passwort);

        // SQL-Query: Benutzer prüfen
        $stmt = $link->prepare("SELECT * FROM benutzer WHERE email = ? AND passwort = ?");
        $stmt->bind_param("ss", $email, $passwortHash);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Erfolgreiche Anmeldung
            $admin = $result->fetch_assoc();
            $_SESSION['logged_in'] = true;
            $_SESSION['admin'] = $admin['name'];

            $_SESSION['admin_id'] = $admin['id'];


            // Zähler aktualisieren und letzte Anmeldung setzen
            $updateStmt = $link->prepare("
                UPDATE benutzer 
                SET anzahlanmeldungen = anzahlanmeldungen + 1, letzteanmeldung = NOW() 
                WHERE id = ?
            ");
            $updateStmt->bind_param("i", $admin['id']);
            $updateStmt->execute();
            $updateStmt->close();

            header("Location: /");
            exit();
        } else {
            // Fehlgeschlagene Anmeldung: Prüfen, ob die E-Mail existiert
            $checkStmt = $link->prepare("SELECT id FROM benutzer WHERE email = ?");
            $checkStmt->bind_param("s", $email);
            $checkStmt->execute();
            $resultCheck = $checkStmt->get_result();

            if ($resultCheck->num_rows > 0) {
                $user = $resultCheck->fetch_assoc();
                // Update letzterfehler auf aktuellen Zeitpunkt
                $errorStmt = $link->prepare("UPDATE benutzer SET letzterfehler = NOW() WHERE id = ?");
                $errorStmt->bind_param("i", $user['id']);
                $errorStmt->execute();
                $errorStmt->close();
                $SESSION['logged_in'] = false;
            }

            $_SESSION['error'] = "Login fehlgeschlagen. Bitte versuchen Sie es erneut.";
            header("Location: /admin/login");
            exit();
        }

        $stmt->close();
        $link->close();
    }

    // Logout-Funktion
    public function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header("Location: /admin/login");
        exit();
    }
}
?>
