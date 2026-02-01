<?php

class Cause
{
    private $id;
    private $user_id;
    private $category_id;
    private $title;
    private $description;
    private $goal_amount;
    private $raised_amount;
    private $image;
    private $status;
    private $created_at;

    public function __construct($id, $user_id, $category_id, $title, $description, $goal_amount, $raised_amount, $image, $status, $created_at)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->category_id = $category_id;
        $this->title = $title;
        $this->description = $description;
        $this->goal_amount = $goal_amount;
        $this->raised_amount = $raised_amount;
        $this->image = $image;
        $this->status = $status;
        $this->created_at = $created_at;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getUserId()
    {
        return $this->user_id;
    }
    public function getCategoryId()
    {
        return $this->category_id;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getGoalAmount()
    {
        return $this->goal_amount;
    }
    public function getRaisedAmount()
    {
        return $this->raised_amount;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public function render()
    {
        $progress = ($this->goal_amount > 0)
            ? ($this->raised_amount / $this->goal_amount) * 100
            : 0;

        $progress = min($progress, 100);

        return "
    <a href='cause-details.php?id={$this->id}' class='cause-card-link'>
        <div class='cause-card'>
            <div class='card-image'>
                <img src='{$this->image}' alt='{$this->title}' />
            </div>
            <div class='card-content'>
                <h3 class='card-title'>{$this->title}</h3>
                <p class='card-description'>{$this->description}</p>
                <div class='progress-container'>
                    <div class='progress' style='width: {$progress}%;'></div>
                </div>

                <p class='fund-status'>
                    \${$this->raised_amount}
                    /
                    <span class='goal'>\${$this->goal_amount}</span>
                </p>
            </div>
        </div>
    </a>
    ";
    }


    public static function getByCategory($pdo, $category_id)
    {
        $stmt = $pdo->prepare("SELECT * FROM causes WHERE category_id = ? AND status='approved'");
        $stmt->execute([$category_id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $causes = [];
        foreach ($rows as $row) {
            $causes[] = new Cause(
                $row['id'],
                $row['user_id'],
                $row['category_id'],
                $row['title'],
                $row['description'],
                $row['goal_amount'],
                $row['raised_amount'],
                $row['image'],
                $row['status'],
                $row['created_at']
            );
        }
        return $causes;
    }
    public static function getById($pdo, $id)
    {
        $sql = "SELECT * FROM causes WHERE id = :id LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public static function getApprovedCount($pdo)
    {
        $stmt = $pdo->query("SELECT COUNT(*) FROM causes WHERE status = 'approved'");
        return $stmt->fetchColumn();
    }
    public static function getAllApprovedCauses($pdo, $limit = null)
    {
        $sql = "SELECT * FROM causes WHERE status='approved' ORDER BY created_at DESC";
        if ($limit) {
            $sql .= " LIMIT :limit";
        }
        $stmt = $pdo->prepare($sql);
        if ($limit) {
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        }
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $causes = [];
        foreach ($rows as $row) {
            $causes[] = new Cause(
                $row['id'],
                $row['user_id'],
                $row['category_id'],
                $row['title'],
                $row['description'],
                $row['goal_amount'],
                $row['raised_amount'],
                $row['image'],
                $row['status'],
                $row['created_at']
            );
        }
        return $causes;
    }
    public static function getAllCauses($conn)
    {
        $stmt = $conn->prepare("SELECT * FROM causes ORDER BY created_at DESC");
        $stmt->execute();

        $causes = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $causes[] = new Cause(
                $row['id'],
                $row['user_id'],
                $row['category_id'],
                $row['title'],
                $row['description'],
                $row['goal_amount'],
                $row['raised_amount'],
                $row['image'],
                $row['status'],
                $row['created_at']
            );
        }

        return $causes;
    }

    public static function add(
        PDO $pdo,
        int $user_id,
        int $category_id,
        string $title,
        string $description,
        float $goal_amount,
        string $image,
        string $status = 'pending'
    ) {
        try {
            $sql = "INSERT INTO causes 
        (user_id, category_id, title, description, goal_amount, raised_amount, image, status, created_at)
        VALUES 
        (:user_id, :category_id, :title, :description, :goal_amount, 0, :image, :status, NOW())";

            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':user_id', (int)$user_id, PDO::PARAM_INT);
            $stmt->bindValue(':category_id', (int)$category_id, PDO::PARAM_INT);
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':goal_amount', $goal_amount);
            $stmt->bindValue(':image', $image);
            $stmt->bindValue(':status', $status);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            die(" INSERT FAILED: " . $e->getMessage());
        }
    }

    public static function edit(
        $pdo,
        $id,
        $category_id,
        $title,
        $description,
        $goal_amount,
        $image,
        $status
    ) {
        $sql = "UPDATE causes SET
        category_id = :category_id,
        title = :title,
        description = :description,
        goal_amount = :goal_amount,
        image = :image,
        status = :status
        WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':category_id' => $category_id,
            ':title' => $title,
            ':description' => $description,
            ':goal_amount' => $goal_amount,
            ':image' => $image,
            ':status' => $status
        ]);
    }

    public static function getByUser(PDO $pdo, int $userId)
    {
        $sql = "SELECT * FROM causes 
            WHERE user_id = :user_id
            ORDER BY created_at DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $causes = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $causes[] = new Cause(
                $row['id'],
                $row['user_id'],
                $row['category_id'],
                $row['title'],
                $row['description'],
                $row['goal_amount'],
                $row['raised_amount'],
                $row['image'],
                $row['status'],
                $row['created_at']
            );
        }

        return $causes;
    }
}
