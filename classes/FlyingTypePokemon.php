<?php
require_once 'Pokemon.php';

class FlyingTypePokemon extends Pokemon {
    protected $flightSpeed;
    
    public function __construct($name, $level, $hp, $specialMove) {
        parent::__construct($name, "Flying/Normal", $level, $hp, $specialMove);
        $this->flightSpeed = 100;
    }
    
    public function train($trainingType, $intensity) {
        $previousLevel = $this->level;
        $previousHP = $this->hp;
        
        switch($trainingType) {
            case "Attack":
                $this->level += floor($intensity / 10);
                $this->hp += $intensity * 2;
                $this->flightSpeed += $intensity / 2;
                break;
            case "Defense":
                $this->level += floor($intensity / 15);
                $this->hp += $intensity * 3;
                break;
            case "Speed":
                $this->level += floor($intensity / 8);
                $this->hp += $intensity * 1.5;
                $this->flightSpeed += $intensity;
                break;
        }
        
        return [
            'previousLevel' => $previousLevel,
            'previousHP' => round($previousHP),
            'newLevel' => $this->level,
            'newHP' => round($this->hp),
            'trainingType' => $trainingType,
            'intensity' => $intensity,
            'timestamp' => date('d-m-Y H:i:s')
        ];
    }
    
    public function specialMoveDescription() {
        return "{$this->name} menggunakan {$this->specialMove}! " .
               "Dengan kecepatan terbang " . round($this->flightSpeed) . 
               " km/jam, serangan ini sangat mematikan!";
    }
    
    public function getFlightSpeed() {
        return round($this->flightSpeed);
    }
}
?>