<?php
require_once "../app/core/Database.php";
require_once "../app/core/FileHandler.php";

class User
{
    private $db;
    private $profilePic;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Register a new user
    public function registerUser($firstName, $lastName, $email, $password)
    {
        try {
            $this->db->beginTransaction();

            // Insert a new wallet with a balance of 0
            $this->db->query("INSERT INTO wallet (balance) values (:balance)");
            $this->db->bind(':balance', 0);
            $this->db->execute();

            $walletID = $this->db->lastInsertId();

            // Insert the new user with the wallet ID
            $this->db->query("INSERT INTO users (first_name, last_name, email, password, wallet_id) VALUES (:fName, :lName, :email, :password, :walletId)");
            $this->db->bind(':fName', $firstName);
            $this->db->bind(':lName', $lastName);
            $this->db->bind(':email', $email);
            $this->db->bind(':password', $password);
            $this->db->bind(':walletId', $walletID);
            $this->db->execute();

            // Retrieve the newly created user
            $this->db->query("SELECT * FROM users WHERE user_id=:UserID");
            $this->db->bind(':UserID', $this->db->lastInsertId());
            $this->db->execute();

            // Start a session for the new user if not an admin
            if (!(isset($_SESSION["user"]) && $_SESSION["user"]["user_role"] == "admin")) {
                session_start();
                $_SESSION["user"] = $this->db->result();
            }

            $this->db->commitTransaction();

            // Redirect user to home page if user role is 'user'
            if ($_SESSION["user"]["user_role"] == "user") {
                header("Location: ./");
            }

        } catch (Exception $e) {
            $this->db->rollBack();
            echo "Failed: " . $e->getMessage();
        }
    }

    // Log in a user
    public function login($email, $password)
    {
        try {
            $this->db->query("SELECT * FROM users WHERE email=:email");
            $this->db->bind(':email', $email);
            $this->db->execute();

            if ($this->db->result() == null) {
                return false;
            }

            $hashedPassword = $this->db->result()["password"];

            if (!password_verify($password, $hashedPassword)) {
                return false;
            }

            session_start();
            $_SESSION["user"] = $this->db->result();

            header("Location: ./");
        } catch (Exception $e) {
            echo "Failed: " . $e->getMessage();
            return false;
        }
    }

    // Change user profile information
    public function changeProfile()
    {
        // Retrieve user input or use existing session data
        $firstName = $_POST["first-name"] ?? $_SESSION["user"]["first_name"];
        $lastName = $_POST["last-name"] ?? $_SESSION["user"]["last_name"];
        $email = $_POST["email"] ?? $_SESSION["user"]["email"];
        $phone = $_POST["phone-number"] ?? $_SESSION["user"]["phone"];
        $address = $_POST["address"] ?? $_SESSION["user"]["address"];
        $street = $_POST["street"] ?? $_SESSION["user"]["street"];
        $city = $_POST["city"] ?? $_SESSION["user"]["city"];
        $district = $_POST["district"] ?? $_SESSION["user"]["district"];
        $province = $_POST["province"] ?? $_SESSION["user"]["province"];

        $this->profilePic = $_SESSION["user"]["profile_pic"];

        // Handle profile picture upload
        if (is_uploaded_file($_FILES["profile-pic"]['tmp_name'])) {
            $fileHandler = new FileHandler("profile-pic");
            $this->profilePic = $fileHandler->uploadFile("user" . $_SESSION["user"]["user_id"], "profileImages");
        }

        try {
            $this->db->beginTransaction();

            // Update user information
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
                        province=:province,
                        profile_pic=:profilePic
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
            $this->db->bind(':profilePic', $this->profilePic);
            $this->db->bind(':userId', $_SESSION["user"]["user_id"]);
            $this->db->execute();

            // Retrieve updated user information
            $this->db->query("SELECT * FROM users WHERE user_id=:UserID");
            $this->db->bind(':UserID', $_SESSION["user"]["user_id"]);
            $this->db->execute();

            $_SESSION["user"] = $this->db->result();

            $this->db->commitTransaction();

            // Redirect to profile page
            header("Location: dashboard/profile");

        } catch (Exception $e) {
            $this->db->rollBack();
            echo "Failed: " . $e->getMessage();
        }
    }

    // Reset user password
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

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        try {
            $this->db->beginTransaction();

            // Update user password
            $this->db->query("
                    UPDATE users
                    SET password=:password 
                    WHERE user_id=:userId
                        ");
            $this->db->bind(':password', $hashedPassword);
            $this->db->bind(':userId', $_SESSION["user"]["user_id"]);
            $this->db->execute();

            // Retrieve updated user information
            $this->db->query("SELECT * FROM users WHERE user_id=:UserID");
            $this->db->bind(':UserID', $_SESSION["user"]["user_id"]);
            $this->db->execute();

            session_start();
            $_SESSION["user"] = $this->db->result();

            $this->db->commitTransaction();

            // Redirect to profile tab
            header("Location: dashboard?tab=profile");

        } catch (Exception $e) {
            $this->db->rollBack();
            echo "Failed: " . $e->getMessage();
        }
    }

    // Retrieve all users with optional filter and sort criteria
    public function getAllUsers($filter = "all", $sort = "default")
    {
        $queryFilter = '';
        $sortFilter = '';
        switch ($filter) {
            case "active":
                $queryFilter = " WHERE status='active'";
                break;
            case "deactivate":
                $queryFilter = " WHERE status='deactive'";
                break;
            case "admin":
                $queryFilter = " WHERE user_role='admin'";
                break;
            case "user":
                $queryFilter = " WHERE user_role='user'";
                break;
            default:
                $queryFilter = '';
                break;
        }

        switch ($sort) {
            case "latest":
                $sortFilter = " ORDER BY date_joined DESC";
                break;
            case "old":
                $sortFilter = " ORDER BY date_joined ASC";
                break;
            default:
                $sortFilter = '';
                break;
        }

        $this->db->query("SELECT * FROM users" . $queryFilter . $sortFilter);
        $this->db->execute();
        return $this->db->results();
    }

    // Change the status of a user
    public function changeStatus($id, $status)
    {
        try {
            $this->db->beginTransaction();
            $this->db->query("UPDATE users SET status=:status WHERE user_id=:user_id");
            $this->db->bind(':status', $status);
            $this->db->bind(':user_id', $id);
            $this->db->execute();
            $this->db->commitTransaction();
        } catch (PDOException $e) {
            $this->db->rollback();
            echo $e->getMessage();
        }
    }

    // Create a new user
    public function createNew(
        $firstName,
        $lastName,
        $email,
        $password,
        $userType,
        $phone,
        $address,
        $street,
        $city,
        $district,
        $province
    )
    {
        try {
            $this->db->beginTransaction();

            $walletID = '';

            // Create a wallet for user type 'user'
            if ($userType == "user") {
                $this->db->query("INSERT INTO wallet (balance) values (:balance)");
                $this->db->bind(':balance', 0);
                $this->db->execute();

                $walletID = $this->db->lastInsertId();
            }

            $this->profilePic = $_SESSION["user"]["profile_pic"];

            // Insert new user information
            $this->db->query(
                "
INSERT INTO users (first_name, last_name, email, password, wallet_id, phone, address, street, city, district, province, user_role)
VALUES (:fName, :lName, :email, :password, :walletId, :phone, :address, :street, :city, :district, :province, :user_role)
"
            );
            $this->db->bind(':fName', $firstName);
            $this->db->bind(':lName', $lastName);
            $this->db->bind(':email', $email);
            $this->db->bind(':password', $password);
            $this->db->bind(':walletId', $walletID == '' ? null : $walletID);
            $this->db->bind(':phone', $phone);
            $this->db->bind(':address', $address);
            $this->db->bind(':street', $street);
            $this->db->bind(':city', $city);
            $this->db->bind(':district', $district);
            $this->db->bind(':province', $province);
            $this->db->bind(':user_role', $userType);

            $this->db->execute();

            $userId = $this->db->lastInsertId();

            // Handle profile picture upload
            if (is_uploaded_file($_FILES["profile-pic"]['tmp_name'])) {
                $fileHandler = new FileHandler("profile-pic");
                $this->profilePic = $fileHandler->uploadFile("user" . $userId, "profileImages");
            }

            // Update user profile picture if uploaded
            if ($this->profilePic) {
                $this->db->query("UPDATE users SET profile_pic=:profile_pic WHERE user_id=:user_id");
                $this->db->bind(':profile_pic', $this->profilePic);
                $this->db->bind(':user_id', $userId);
                $this->db->execute();
            }

            $this->db->commitTransaction();
        }
        catch (PDOException $e) {
            $this->db->rollback();
            echo $e->getMessage();
        }
    }
}