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

    public function render()
    {
        $progress = ($this->goal_amount > 0) ? ($this->raised_amount / $this->goal_amount) * 100 : 0;
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
                <p class='fund-status'>\${$this->raised_amount}/<span class='goal'>\${$this->goal_amount}</span></p>
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
}
