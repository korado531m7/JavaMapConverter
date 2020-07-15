<?php

/*
 * JavaMapConverter v1.1.1 by korado531m7
 * Developer: korado531m7
 * Copyright (C) 2020 korado531m7
 * Licensed under MIT (https://github.com/korado531m7/JavaMapConverter/blob/master/LICENSE)
 */

namespace korado531m7\JavaMapConverter;


use pocketmine\level\format\Chunk;
use pocketmine\level\Level;

class ChunkConvert{
    /** @var Level */
    private $level;
    /** @var bool[][] */
    private $fixed = [];
    /** @var int */
    private $progress = 0;
    /** @var int */
    private $all = 0;

    public function __construct(Level $level){
        $this->level = $level;
    }

    public function getLevel() : Level{
        return $this->level;
    }

    public function addCoordinates(Chunk $chunk) : void{
        $this->fixed[$chunk->getX()][$chunk->getZ()] = true;
    }

    public function hasConverted(Chunk $chunk) : bool{
        return isset($this->fixed[$chunk->getX()][$chunk->getZ()]);
    }

    public function addProgress() : void{
        ++$this->progress;
        ++$this->all;
    }

    public function subtractProgress() : void{
        --$this->progress;
    }

    public function getProgressCurrent() : int{
        return $this->progress;
    }

    public function getProgressAll() : int{
        return $this->all;
    }
}