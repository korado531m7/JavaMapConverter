<?php

/*
 * JavaMapConverter v1.1.3 by korado531m7
 * Developer: korado531m7
 * Copyright (C) 2020 korado531m7
 * Licensed under MIT (https://github.com/korado531m7/JavaMapConverter/blob/master/LICENSE)
 */

namespace korado531m7\JavaMapConverter;


use pocketmine\event\level\ChunkLoadEvent;
use pocketmine\event\Listener;
use pocketmine\level\Level;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener{

    /** @var BlockFixer */
    private $blockFixer;
    /** @var ChunkConvert[] */
    private $chunkConverts = [];

    public function onEnable(){
        $this->blockFixer = new BlockFixer($this);
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->alert('This plugin will convert your worlds immediately after player joined the server (chunks were loaded)');
        if(!$this->isAsyncEnabled()){
            $this->getLogger()->warning('Asynchronous mode is disabled. It causes a lag while converting. Use async mode to get more faster');
        }
        /*if($this->isOutputProgress()){
            $this->getLogger()->warning('Output Progress mode is enabled. All converting progress will be print on console.');
        }*/
        if($this->getServer()->getProperty('ticks-per.autosave', 6000) <= 0){ //6000 is from Server.php
            $this->getLogger()->warning('Autosave is turned off. It may restore from the not converted chunks while converting');
        }
    }

    public function onDisable(){
        foreach($this->chunkConverts as $chunkConvert){
            if($chunkConvert->getProgressCurrent() >= 1){
                $this->getLogger()->alert('This plugin has been disabled, but conversion in ' . $chunkConvert->getLevel()->getName() . ' hasn\'t finished yet');
            }
        }
    }

    public function onChunkLoad(ChunkLoadEvent $event) : void{
        $this->blockFixer->fix($event->getLevel(), $event->getChunk());
    }

    public function getConvertedChunk(Level $level) : ChunkConvert{
        if(!$this->isConvertedChunkExists($level)){
            $this->chunkConverts[$level->getId()] = new ChunkConvert($level);
        }
        return $this->chunkConverts[$level->getId()];
    }

    public function isConvertedChunkExists(Level $level) : bool{
        return isset($this->chunkConverts[$level->getId()]);
    }

    public function isOutputProgress() : bool{
        return $this->getConfig()->get('enable-output-progress', false);
    }

    public function isAsyncEnabled() : bool{
        return $this->getConfig()->get('enable-async-mode', true);
    }

    public function isEnabledSignConvert() : bool{
        return $this->getConfig()->get('enable-convert-sign', true);
    }

    public function isEnabledRemoveAllEntities() : bool{
        return $this->getConfig()->get('remove-all-entities', true);
    }
}