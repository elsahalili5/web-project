<?php
class Donation
{
    private $conn;
    private $table_name = 'donations';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($data)
    {
        $sql = "INSERT INTO {$this->table_name} 
            (cause_id, user_email, first_name, last_name, amount, payment_method, payment_status, anonymous) 
            VALUES 
            (:cause_id, :user_email, :first_name, :last_name, :amount, :payment_method, :payment_status, :anonymous)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':cause_id', $data['cause_id']);
        $stmt->bindParam(':user_email', $data['user_email']);
        $stmt->bindParam(':first_name', $data['first_name']);
        $stmt->bindParam(':last_name', $data['last_name']);
        $stmt->bindParam(':amount', $data['amount']);
        $stmt->bindParam(':payment_method', $data['payment_method']);
        $stmt->bindParam(':payment_status', $data['payment_status']);
        $stmt->bindParam(':anonymous', $data['anonymous'], PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function getAll()
    {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table_name} ORDER BY donated_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByUser($email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table_name} WHERE user_email = :email ORDER BY donated_at DESC");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table_name} WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE {$this->table_name} SET
            cause_id = :cause_id,
            user_email = :user_email,
            first_name = :first_name,
            last_name = :last_name,
            amount = :amount,
            payment_method = :payment_method,
            payment_status = :payment_status,
            anonymous = :anonymous
            WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':cause_id', $data['cause_id']);
        $stmt->bindParam(':user_email', $data['user_email']);
        $stmt->bindParam(':first_name', $data['first_name']);
        $stmt->bindParam(':last_name', $data['last_name']);
        $stmt->bindParam(':amount', $data['amount']);
        $stmt->bindParam(':payment_method', $data['payment_method']);
        $stmt->bindParam(':payment_status', $data['payment_status']);
        $stmt->bindParam(':anonymous', $data['anonymous'], PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table_name} WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
