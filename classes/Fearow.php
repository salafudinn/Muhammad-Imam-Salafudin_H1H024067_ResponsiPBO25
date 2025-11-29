<?php
require_once 'FlyingTypePokemon.php';

class Fearow extends FlyingTypePokemon {
    private $wingspan;
    
    public function __construct() {
        parent::__construct("Fearow", 20, 165, "Drill Peck");
        $this->wingspan = 1.2;
    }
    
    public function specialMoveDescription() {
        return "Fearow menukik dari ketinggian dengan Drill Peck! " .
               "Paruhnya yang tajam berputar seperti bor dengan kecepatan " .
               $this->getFlightSpeed() . " km/jam, mampu menembus pertahanan musuh!";
    }
    
    public function intimidate() {
        return "Fearow merentangkan sayapnya yang lebar ({$this->wingspan}m) " .
               "dan mengeluarkan teriakan mengintimidasi!";
    }
    
    public function getWingspan() {
        return $this->wingspan;
    }
}
?>