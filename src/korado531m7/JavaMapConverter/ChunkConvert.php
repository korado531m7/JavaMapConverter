<?php


namespace korado531m7\JavaMapConverter;


use pocketmine\level\Level;

class ChunkConvert{
    /** @var Level */
    private $level;
    /** @var bool[][] */
    private $fixed = [];

    public function __construct(Level $level){
        $this->level = $level;
    }

    public function addCoordinates(int $x, int $z) : void{
        $this->fixed[$x][$z] = true;
    }

    public function hasConverted(int $x, int $z) : bool{
        return isset($this->fixed[$x][$z]);
    }
}