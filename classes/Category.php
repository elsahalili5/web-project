<?php
class Category
{
    private $id;
    private $name;
    private $icon;

    public function __construct($id, $name, $icon)
    {
        $this->id = $id;
        $this->name = $name;
        $this->icon = $icon;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getIcon()
    {
        return $this->icon;
    }
    public function render()
    {
        return "
        <div class='category'>
            <a href='causes-bycategory.php?id={$this->id}'>
                <div class='cause-container'>
                    <i class='fa-solid {$this->icon}'></i>
                </div>
                <span>{$this->name}</span>
            </a>
        </div>";
    }
}
