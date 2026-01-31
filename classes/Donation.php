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
            (cause_id, user_email, first_name, last_name, amount, payment_method, payment_status, anonymous, created_at) 
            VALUES 
            (:cause_id, :user_email, :first_name, :last_name, :amount, :payment_method, :payment_status, :anonymous, NOW())";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':cause_id', $data['cause_id']);
        $stmt->bindParam(':user_email', $data['user_email']);
        $stmt->bindParam(':first_name', $data['first_name']);
        $stmt->bindParam(':last_name', $data['last_name']);
        $stmt->bindParam(':amount', $data['amount']);
        $stmt->bindParam(':payment_method', $data['payment_method']);
        $stmt->bindParam(':payment_status', $data['payment_status']);
        $stmt->bindParam(':anonymous', $data['anonymous'], PDO::PARAM_INT);

        $success = $stmt->execute();

        if ($success) {
            $update = $this->conn->prepare("UPDATE causes SET raised_amount = raised_amount + :amount WHERE id = :cause_id");
            $update->execute([
                ':amount' => $data['amount'],
                ':cause_id' => $data['cause_id']
            ]);
            return true;
        }

        return false;
    }

    public function getAll()
    {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table_name} ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByUser($email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table_name} WHERE user_email = :email ORDER BY created_at DESC");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
