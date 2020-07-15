<?php

/*
 * JavaMapConverter v1.1.0 by korado531m7
 * Developer: korado531m7
 * Copyright (C) 2020 korado531m7
 * Licensed under MIT (https://github.com/korado531m7/JavaMapConverter/blob/master/LICENSE)
 */

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