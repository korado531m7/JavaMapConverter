<?php

/*
 * JavaMapConverter v1.1.4 by korado531m7
 * Developer: korado531m7
 * Copyright (C) 2020 korado531m7
 * Licensed under MIT (https://github.com/korado531m7/JavaMapConverter/blob/master/LICENSE)
 */

namespace korado531m7\JavaMapConverter;


use korado531m7\JavaMapConverter\data\ConvertResult;
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
    /** @var int */
    private $blocksAll = 0;
    /** @var int */
    private $blocksDiff = 0;
    /** @var int */
    private $signs = 0;
    /** @var int */
    private $tiles = 0;

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

    public function addConvertResult(ConvertResult $result) : void{
        $this->blocksAll += $result->getAllBlocks();
        $this->blocksDiff += $result->getDiffBlocks();
    }

    public function addSign() : void{
        ++$this->signs;
    }

    public function addTile() : void{
        ++$this->tiles;
    }

    public function __toString(){
        $name = $this->level->getName();
        $folder = $this->level->getFolderName();

        $complete = $this->all - $this->progress;
        $label = "[$name]" . ($folder === $name ? '' : " ($folder)");

        return "[$label] Tried Chunks: $this->all, Completed: $complete, In Progress: $this->progress, Tried Blocks: $this->blocksAll (Affected: $this->blocksDiff), Affected Signs: $this->signs, Affected Tiles: $this->tiles\n";
    }
}