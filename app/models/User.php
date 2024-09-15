<?php
require_once "../app/core/Database.php";

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    private function getUserCredentials($email)
    {
        $this->db->query("SELECT email password FROM users WHERE email=:email");
        $this->db->bind(':email', $email);
        $this->db->execute();
        return $this->db->result();
    }

    public function registerUser($firstName, $lastName, $email, $password)
    {
        try {
            $this->db->beginTransaction();

            $this->db->query("INSERT INTO wallet (balance) values (:balance)");
            $this->db->bind(':balance', 0);
            $this->db->execute();

            $walletID = $this->db->lastInsertId();

            $this->db->query("INSERT INTO users (first_name, last_name, email, password, wallet_id) VALUES (:fName, :lName, :email, :password, :walletId)");
            $this->db->bind(':fName', $firstName);
            $this->db->bind(':lName', $lastName);
            $this->db->bind(':email', $email);
            $this->db->bind(':password', $password);
            $this->db->bind(':walletId', $walletID);
            $this->db->execute();

            $this->db->query("SELECT * FROM users WHERE user_id=:UserID");
            $this->db->bind(':UserID', $this->db->lastInsertId());
            $this->db->execute();

            session_start();
            $_SESSION["user"] = $this->db->result();

            $this->db->commitTransaction();

            header("Location: ./");
        } catch (Exception $e) {
            $this->db->rollBack();
            echo "Failed: " . $e->getMessage();
        }

    }

    public function login($email, $password)
    {
        try {

            $this->db->query("SELECT * FROM users WHERE email=:email");
            $this->db->bind(':email', $email);
            $this->db->execute();

            if ($this->db->result() == null) {
                return;
            }

            $hashedPassword = $this->db->result()["password"];

            if (!password_verify($password, $hashedPassword)) {
                return;
            }

            session_start();
            $_SESSION["user"] = $this->db->result();

            header("Location: ./");
        } catch (Exception $e) {
            echo "Failed: " . $e->getMessage();
        }
    }

    public function changeProfile()
    {
        $firstName = $_POST["first-name"] ?? $_SESSION["user"]["first_name"];
        $lastName = $_POST["last-name"] ?? $_SESSION["user"]["last_name"];
        $email = $_POST["email"] ?? $_SESSION["user"]["email"];
        $phone = $_POST["phone-number"] ?? $_SESSION["user"]["phone"];
        $address = $_POST["address"] ?? $_SESSION["user"]["address"];
        $street = $_POST["street"] ?? $_SESSION["user"]["street"];
        $city = $_POST["city"] ?? $_SESSION["user"]["city"];
        $district = $_POST["district"] ?? $_SESSION["user"]["district"];
        $province = $_POST["province"] ?? $_SESSION["user"]["province"];

        try {
            $this->db->beginTransaction();

            $this->db->query("
                    UPDATE users
                    SET first_name=:fName,
                        last_name=:lName,
                        email=:email,
                        phone=:phone,
                        address=:address,
                        street=:street,
                        city=:city,
                        district=:district,
                        province=:province
                    WHERE user_id=:userId
                        ");
            $this->db->bind(':fName', $firstName);
            $this->db->bind(':lName', $lastName);
            $this->db->bind(':email', $email);
            $this->db->bind(':phone', $phone);
            $this->db->bind(':address', $address);
            $this->db->bind(':street', $street);
            $this->db->bind(':city', $city);
            $this->db->bind(':district', $district);
            $this->db->bind(':province', $province);
            $this->db->bind(':userId', $_SESSION["user"]["user_id"]);
            $this->db->execute();

            $this->db->query("SELECT * FROM users WHERE user_id=:UserID");
            $this->db->bind(':UserID', $_SESSION["user"]["user_id"]);
            $this->db->execute();

            session_start();
            $_SESSION["user"] = $this->db->result();

            $this->db->commitTransaction();

            header("Location: dashboard/profile");

        } catch (Exception $e) {
            $this->db->rollBack();
            echo "Failed: " . $e->getMessage();
//            header("Location: error/on/sql");
        }
    }

    public function resetPassword()
    {

        $currentPassword = $_POST["currentPassword"];
        $newPassword = $_POST["newPassword"];
        $confirmPassword = $_POST["confirmPassword"];

        if (!isset($currentPassword) || !isset($newPassword) || !isset($confirmPassword)) {
            echo "Null";
            return;
        }

        if ($newPassword !== $confirmPassword) {
            echo "Wrong";
            return;
        }

        if (!password_verify($currentPassword, $_SESSION["user"]["password"])) {
            echo "Incorrect";
            return;
        }

        echo "$currentPassword $newPassword $confirmPassword";

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        try {
            $this->db->beginTransaction();

            $this->db->query("
                    UPDATE users
                    SET password=:password 
                    WHERE user_id=:userId
                        ");
            $this->db->bind(':password', $hashedPassword);
            $this->db->bind(':userId', $_SESSION["user"]["user_id"]);
            $this->db->execute();

            $this->db->query("SELECT * FROM users WHERE user_id=:UserID");
            $this->db->bind(':UserID', $_SESSION["user"]["user_id"]);
            $this->db->execute();

            session_start();
            $_SESSION["user"] = $this->db->result();

            $this->db->commitTransaction();

            header("Location: dashboard?tab=profile");

        } catch (Exception $e) {
            $this->db->rollBack();
            echo "Failed: " . $e->getMessage();
        }
    }
}