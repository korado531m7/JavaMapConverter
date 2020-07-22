<?php

/*
 * JavaMapConverter v1.1.4 by korado531m7
 * Developer: korado531m7
 * Copyright (C) 2020 korado531m7
 * Licensed under MIT (https://github.com/korado531m7/JavaMapConverter/blob/master/LICENSE)
 */

namespace korado531m7\JavaMapConverter;


use korado531m7\JavaMapConverter\data\BlockId;
use korado531m7\JavaMapConverter\data\ConvertResult;
use korado531m7\JavaMapConverter\data\Face;
use korado531m7\JavaMapConverter\task\AsyncConvertTask;
use pocketmine\level\format\Chunk;
use pocketmine\level\Level;
use pocketmine\Player;
use pocketmine\tile\Sign;
use pocketmine\utils\TextFormat;


class BlockFixer{
    /** @var Main */
    private $instance;

    public function __construct(Main $instance){
        $this->instance = $instance;
    }

    public function fix(Level $level, Chunk $chunk) : void{
        $convertedChunk = $this->instance->getConvertedChunk($level);
        if($convertedChunk->hasConverted($chunk)){
            return;
        }
        $convertedChunk->addCoordinates($chunk);

        $convertedChunk->addProgress();
        if($this->instance->isOutputProgress()){
            $this->instance->getLogger()->info('Converting Blocks in '.$convertedChunk->getLevel()->getName().' at '.$chunk->getX().','.$chunk->getZ().' (Progress '.$convertedChunk->getProgressCurrent().'/'.$convertedChunk->getProgressAll().')');
        }

        if($this->instance->isEnabledRemoveAllEntities()){
            foreach($chunk->getEntities() as $entity){
                if(!$entity instanceof Player){
                    $entity->close();
                }
            }
        }

        if($this->instance->isEnabledSignConvert()){
            foreach($chunk->getTiles() as $tile){
                if($tile instanceof Sign){
                    $texts = $tile->getText();
                    $tile->setText($this->getSignText($texts[0]), $this->getSignText($texts[1]), $this->getSignText($texts[2]), $this->getSignText($texts[3]));
                    if($this->instance->isEnabledForceSaveSign()){
                        $tile->saveNBT();
                    }
                    $convertedChunk->addSign();
                }elseif($this->instance->isEnabledResetTiles()){
                    $convertedChunk->addTile();
                    $tile->close();
                }
            }
        }

        if($this->instance->isAsyncEnabled()){
            $this->instance->getServer()->getAsyncPool()->submitTask(new AsyncConvertTask($level, $chunk));
        }else{
            $convertedChunk->addConvertResult(self::convert($chunk));
            $convertedChunk->subtractProgress();
        }
    }

    private function getSignText(string $text) : string {
        $json = @json_decode($text, true);
        if($json === null){
            return $this->instance->isEnabeldSignTextConvert() ? json_encode(['text' => $text]) : $text;
        }

        $line = '';
        $extras = $json['extra'] ?? null;

        if($extras !== null){
            foreach($extras as $extra){
                if($extra['reset'] ?? false){
                    $line .= TextFormat::RESET;
                }
                if($extra['bold'] ?? false){
                    $line .= TextFormat::BOLD;
                }
                if($extra['italic'] ?? false){
                    $line .= TextFormat::ITALIC;
                }
                //TODO: Check more formats
                $line .= $this->getSignColor($extra['color'] ?? '');
                $line .= ($extra['text'] ?? '');
            }
        }
        $line .= ($json['text'] ?? '');

        return $line;
    }

    private function getSignColor(string $color) : string{
        switch($color){
            case 'black':
                return TextFormat::BLACK;
            case 'dark_blue':
                return TextFormat::DARK_BLUE;
            case 'dark_green':
                return TextFormat::DARK_GREEN;
            case 'dark_aqua':
                return TextFormat::DARK_AQUA;
            case 'dark_red':
                return TextFormat::DARK_RED;
            case 'dark_purple':
                return TextFormat::DARK_PURPLE;
            case 'gold':
                return TextFormat::GOLD;
            case 'gray':
                return TextFormat::GRAY;
            case 'dark_gray':
                return TextFormat::DARK_GRAY;
            case 'blue':
                return TextFormat::BLUE;
            case 'green':
                return TextFormat::GREEN;
            case 'aqua':
                return TextFormat::AQUA;
            case 'red':
                return TextFormat::RED;
            case 'light_purple':
                return TextFormat::LIGHT_PURPLE;
            case 'yellow':
                return TextFormat::YELLOW;
            case 'white':
                return TextFormat::WHITE;
        }
        return '';
    }

    public static function convert(Chunk $chunk) : ConvertResult{
        $all = 0;
        $diff = 0;
        for($x = 0; $x < 16; ++$x){
            for($z = 0; $z < 16; ++$z){
                for($y = 0; $y < $chunk->getMaxY(); ++$y){
                    $oldBlockId = $chunk->getBlockId($x, $y, $z);
                    $oldBlockData = $chunk->getBlockData($x, $y, $z);
                    $newBlockId = BlockId::getNewBlockId($oldBlockId);
                    $newBlockFace = Face::getNewFace($oldBlockId, $oldBlockData);
                    if($newBlockId !== $oldBlockId || $newBlockFace !== $oldBlockData){
                        ++$diff;
                    }
                    ++$all;
                    $chunk->setBlock($x, $y, $z, $newBlockId, $newBlockFace);
                }
            }
        }
        $chunk->populateSkyLight();

        return new ConvertResult($all, $diff);
    }
}