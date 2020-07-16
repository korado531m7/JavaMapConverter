<?php

/*
 * JavaMapConverter v1.1.3 by korado531m7
 * Developer: korado531m7
 * Copyright (C) 2020 korado531m7
 * Licensed under MIT (https://github.com/korado531m7/JavaMapConverter/blob/master/LICENSE)
 */

namespace korado531m7\JavaMapConverter;


use korado531m7\JavaMapConverter\data\BlockId;
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

        if($this->instance->isOutputProgress()){
            $convertedChunk->addProgress();
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
                    $tile->saveNBT();
                }
            }
        }

        if($this->instance->isAsyncEnabled()){
            $this->instance->getServer()->getAsyncPool()->submitTask(new AsyncConvertTask($level, $chunk));
        }else{
            self::convert($chunk);
            $convertedChunk->subtractProgress();
        }
    }

    private function getSignText(string $text) : string {
        $json = @json_decode($text, true);
        if($json === null){
            return json_encode(['text' => $text]);
        }

        $extra = $json['extra'][0] ?? null;
        $raw = $json['text'] ?? null;

        if($extra === null && $raw === null){
            return '';
        }elseif($extra === null){
            return $raw ?? '';
        }else{
            $res = '';
            if($extra['bold'] ?? false){
                $res .= TextFormat::BOLD;
            }
            if($extra['italic'] ?? false){
                $res .= TextFormat::ITALIC;
            }
            //TODO: Check more formats
            $res .= $this->getSignColor($extra['color'] ?? '');
            return $res . ($extra['text'] ?? '');
        }
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

    public static function convert(Chunk $chunk) : void{
        for($x = 0; $x < 4 * 4; ++$x){
            for($z = 0; $z < 4 * 4; ++$z){
                for($y = 0; $y < $chunk->getMaxY(); ++$y){
                    $oldBlockId = $chunk->getBlockId($x, $y, $z);
                    $newBlockFace = Face::getNewFace($oldBlockId, $chunk->getBlockData($x, $y, $z));
                    $chunk->setBlock($x, $y, $z, BlockId::getNewBlockId($oldBlockId), $newBlockFace);
                }
            }
        }
    }
}