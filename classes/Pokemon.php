<?php
abstract class Pokemon {
    protected $name;
    protected $type;
    protected $level;
    protected $hp;
    protected $specialMove;
    
    public function __construct($name, $type, $level, $hp, $specialMove) {
        $this->name = $name;
        $this->type = $type;
        $this->level = $level;
        $this->hp = $hp;
        $this->specialMove = $specialMove;
    }
    
    abstract public function train($trainingType, $intensity);
    abstract public function specialMoveDescription();
    
    public function getName() { 
        return $this->name; 
    }
    
    public function getType() { 
        return $this->type; 
    }
    
    public function getLevel() { 
        return $this->level; 
    }
    
    public function getHP() { 
        return $this->hp; 
    }
    
    public function getSpecialMove() { 
        return $this->specialMove; 
    }
}
?>