<?php
class Donation
{
    private $conn;
    private $table_name = 'donations';

    public function __construct($db)
    {
        $this->conn = $db;
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Create donation dhe rrit raised_amount tek causes
    public function create($data)
    {
        try {
            if (empty($data['user_email']) || empty($data['first_name']) || empty($data['last_name']) || empty($data['amount'])) {
                throw new Exception("Required fields are missing!");
            }

            $sql = "INSERT INTO {$this->table_name} 
                (cause_id, user_email, first_name, last_name, amount, payment_method, payment_status, anonymous, donated_at) 
                VALUES 
                (:cause_id, :user_email, :first_name, :last_name, :amount, :payment_method, :payment_status, :anonymous, NOW())";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':cause_id' => $data['cause_id'],
                ':user_email' => $data['user_email'],
                ':first_name' => $data['first_name'],
                ':last_name' => $data['last_name'],
                ':amount' => $data['amount'],
                ':payment_method' => $data['payment_method'],
                ':payment_status' => $data['payment_status'],
                ':anonymous' => $data['anonymous']
            ]);

            // Update raised_amount tek causes
            $update = $this->conn->prepare("UPDATE causes SET raised_amount = raised_amount + :amount WHERE id = :cause_id");
            $update->execute([':amount' => $data['amount'], ':cause_id' => $data['cause_id']]);

            return true;
        } catch (Exception $e) {
            echo "Donation error: " . $e->getMessage();
            return false;
        }
    }

    // Update donation dhe adjust raised_amount tek causes
    public function update($data)
    {
        try {
            // Merr donacionin aktual për të zbritur nga raised_amount
            $stmt = $this->conn->prepare("SELECT cause_id, amount FROM {$this->table_name} WHERE id = :id");
            $stmt->execute([':id' => $data['id']]);
            $oldDonation = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$oldDonation) return false;

            // Përditëso raised_amount: zbrit vlerën e vjetër dhe shto vlerën e re
            if ($oldDonation['cause_id'] == $data['cause_id']) {
                $diff = $data['amount'] - $oldDonation['amount'];
                $updateCause = $this->conn->prepare("UPDATE causes SET raised_amount = raised_amount + :diff WHERE id = :cause_id");
                $updateCause->execute([':diff' => $diff, ':cause_id' => $data['cause_id']]);
            } else {
                // Nëse ka ndryshuar Cause, zbrit nga ai i vjetri dhe shto tek ai i ri
                $updateOld = $this->conn->prepare("UPDATE causes SET raised_amount = raised_amount - :amount WHERE id = :cause_id");
                $updateOld->execute([':amount' => $oldDonation['amount'], ':cause_id' => $oldDonation['cause_id']]);

                $updateNew = $this->conn->prepare("UPDATE causes SET raised_amount = raised_amount + :amount WHERE id = :cause_id");
                $updateNew->execute([':amount' => $data['amount'], ':cause_id' => $data['cause_id']]);
            }

            // Update donacionin
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
            return $stmt->execute([
                ':cause_id' => $data['cause_id'],
                ':user_email' => $data['user_email'],
                ':first_name' => $data['first_name'],
                ':last_name' => $data['last_name'],
                ':amount' => $data['amount'],
                ':payment_method' => $data['payment_method'],
                ':payment_status' => $data['payment_status'],
                ':anonymous' => $data['anonymous'],
                ':id' => $data['id']
            ]);
        } catch (Exception $e) {
            echo "Donation update error: " . $e->getMessage();
            return false;
        }
    }

    // Get all donations
    public function getAll()
    {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table_name} ORDER BY donated_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get donations by user email
    public function getByUser($email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table_name} WHERE user_email = :email ORDER BY donated_at DESC");
        $stmt->execute([':email' => $email]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Delete donation dhe zvogëlo raised_amount tek causes
    public function delete($id)
    {
        try {
            // Merr donacionin për të zvogëluar raised_amount
            $stmt = $this->conn->prepare("SELECT cause_id, amount FROM {$this->table_name} WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $donation = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($donation) {
                $updateCause = $this->conn->prepare("UPDATE causes SET raised_amount = raised_amount - :amount WHERE id = :cause_id");
                $updateCause->execute([':amount' => $donation['amount'], ':cause_id' => $donation['cause_id']]);
            }

            // Delete donacionin
            $stmt = $this->conn->prepare("DELETE FROM {$this->table_name} WHERE id = :id");
            return $stmt->execute([':id' => $id]);
        } catch (Exception $e) {
            echo "Donation delete error: " . $e->getMessage();
            return false;
        }
    }
}
