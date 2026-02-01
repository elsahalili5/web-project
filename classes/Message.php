<?php
class Message
{
    private $conn;
    private $table_name = 'contact_messages';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function add($user_id, $name, $email, $subject, $message)
    {
        $sql = "INSERT INTO {$this->table_name} 
                (user_id, name, email, subject, message, created_at)
                VALUES (:user_id, :name, :email, :subject, :message, NOW())";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':user_id' => $user_id,
            ':name' => $name,
            ':email' => $email,
            ':subject' => $subject,
            ':message' => $message
        ]);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->table_name} ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getById($id)
    {
        $sql = "SELECT * FROM {$this->table_name} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table_name} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }


    public function reply($id, $replyMessage)
    {
        $sql = "UPDATE {$this->table_name} SET reply = :reply WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':reply' => $replyMessage,
            ':id' => $id
        ]);
    }
    public function getRepliesForUser($userId)
    {
        $sql = "SELECT * FROM {$this->table_name} 
            WHERE user_id = :user_id AND reply != '' 
            ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getReplyByIdAndUser($id, $user_id)
    {
        $sql = "SELECT * FROM {$this->table_name} 
                WHERE id = :id AND user_id = :user_id AND reply IS NOT NULL AND reply != '' 
                LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
