<?php
class User
{
    private $conn;
    private $table_name = 'users';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function register($name, $surname, $email, $password, $role = 'user')
    {
        try {
            $check = $this->conn->prepare("SELECT id FROM {$this->table_name} WHERE email = :email");
            $check->bindParam(":email", $email);
            $check->execute();

            if ($check->rowCount() > 0) {
                return "Email already registered!";
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO {$this->table_name} (name, surname, email, password, role)
                    VALUES (:name, :surname, :email, :password, :role)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":surname", $surname);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $hashedPassword);
            $stmt->bindParam(":role", $role);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return "Something went wrong: " . $e->getMessage();
        }
    }

    public function login($email, $password)
    {
        $query = "SELECT id, name, surname, email, password,role FROM {$this->table_name} WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row['password'])) {
                $_SESSION['user'] = [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'surname' => $row['surname'],
                    'email' => $row['email'],
                    'role' => $row['role']
                ];
                return true;
            }
        }
        return false;
    }


    public static function getName()
    {
        return self::isLoggedIn() ? $_SESSION['user']['name'] : '';
    }

    public static function getFullName()
    {
        return self::isLoggedIn() ? $_SESSION['user']['name'] . ' ' . $_SESSION['user']['surname'] : '';
    }

    public static function isLoggedIn()
    {
        return isset($_SESSION['user']);
    }

    public static function isAdmin()
    {
        return self::isLoggedIn() && $_SESSION['user']['role'] === 'admin';
    }
    public static function isUser()
    {
        return self::isLoggedIn() && $_SESSION['user']['role'] === 'user';
    }

    public function getAllUsers()
    {
        $sql = "SELECT id, name, surname, email, role, created_at FROM {$this->table_name}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteUser($id)
    {
        $sql = "DELETE FROM {$this->table_name} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updateUser($id, $name, $surname, $email)
    {
        $sql = "UPDATE users SET name=?, surname=?, email=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$name, $surname, $email, $id]);
    }

    public function getUserById($id)
    {
        $sql = "SELECT id, name, surname, email, role FROM {$this->table_name} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function logout()
    {
        session_start();
        unset($_SESSION['user']);
        session_destroy();

        header("Location: home.php");
        exit;
    }
    public function searchUsers($keyword)
    {
        $keyword = "%$keyword%";
        $stmt = $this->conn->prepare("
        SELECT id, name, surname, email, role, created_at
        FROM users
        WHERE CONCAT(name, ' ', surname) LIKE :keyword
           OR email LIKE :keyword
           OR role LIKE :keyword
        ORDER BY created_at DESC
    ");
        $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
