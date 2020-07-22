<?php


namespace korado531m7\JavaMapConverter\data;

/*
 * JavaMapConverter v1.1.4 by korado531m7
 * Developer: korado531m7
 * Copyright (C) 2020 korado531m7
 * Licensed under MIT (https://github.com/korado531m7/JavaMapConverter/blob/master/LICENSE)
 */

use korado531m7\JavaMapConverter\block\BlockIds as JavaBlockIds;
use pocketmine\block\BlockIds as BedrockBlockIds;

class BlockId{
    public static function getNewBlockId(int $current) : int{
        switch($current){
            case JavaBlockIds::STAINED_GLASS:
                return BedrockBlockIds::STAINED_GLASS;
            case JavaBlockIds::DOUBLE_WOODEN_SLAB:
                return BedrockBlockIds::DOUBLE_WOODEN_SLAB;
            case JavaBlockIds::WOODEN_SLAB:
                return BedrockBlockIds::WOODEN_SLAB;
            case JavaBlockIds::ACTIVATOR_RAIL:
                return BedrockBlockIds::ACTIVATOR_RAIL;
            case JavaBlockIds::DROPPER:
                return BedrockBlockIds::DROPPER;
            case JavaBlockIds::BARRIER:
                return BedrockBlockIds::INVISIBLE_BEDROCK;
            case JavaBlockIds::SPRUCE_FENCE:
            case JavaBlockIds::BIRCH_FENCE:
            case JavaBlockIds::JUNGLE_FENCE:
            case JavaBlockIds::DARK_OAK_FENCE:
            case JavaBlockIds::ACACIA_FENCE:
                return BedrockBlockIds::FENCE;
            case JavaBlockIds::END_ROD:
                return BedrockBlockIds::END_ROD;
            case JavaBlockIds::CHORUS_PLANT:
                return BedrockBlockIds::CHORUS_PLANT;
            case JavaBlockIds::BEETROOT_BLOCK:
                return BedrockBlockIds::BEETROOT_BLOCK;
            case JavaBlockIds::GRASS_PATH:
                return BedrockBlockIds::GRASS_PATH;
            case JavaBlockIds::REPEATING_COMMAND_BLOCK:
                return BedrockBlockIds::REPEATING_COMMAND_BLOCK;
            case JavaBlockIds::CHAIN_COMMAND_BLOCK:
                return BedrockBlockIds::CHAIN_COMMAND_BLOCK;
            case JavaBlockIds::FROSTED_ICE:
                return BedrockBlockIds::FROSTED_ICE;
            case JavaBlockIds::OBSERVER:
                return BedrockBlockIds::OBSERVER;
            case JavaBlockIds::WHITE_SHULKER_BOX:
            case JavaBlockIds::ORANGE_SHULKER_BOX:
            case JavaBlockIds::MAGENTA_SHULKER_BOX:
            case JavaBlockIds::LIGHT_BLUE_SHULKER_BOX:
            case JavaBlockIds::YELLOW_SHULKER_BOX:
            case JavaBlockIds::LIME_SHULKER_BOX:
            case JavaBlockIds::PINK_SHULKER_BOX:
            case JavaBlockIds::GRAY_SHULKER_BOX:
            case JavaBlockIds::LIGHT_GRAY_SHULKER_BOX:
            case JavaBlockIds::CYAN_SHULKER_BOX:
            case JavaBlockIds::PURPLE_SHULKER_BOX:
            case JavaBlockIds::BLUE_SHULKER_BOX:
            case JavaBlockIds::BROWN_SHULKER_BOX:
            case JavaBlockIds::GREEN_SHULKER_BOX:
            case JavaBlockIds::RED_SHULKER_BOX:
            case JavaBlockIds::BLACK_SHULKER_BOX:
                return BedrockBlockIds::SHULKER_BOX;
            case JavaBlockIds::WHITE_GLAZED_TERRACOTTA:
                return BedrockBlockIds::WHITE_GLAZED_TERRACOTTA;
            case JavaBlockIds::ORANGE_GLAZED_TERRACOTTA:
                return BedrockBlockIds::ORANGE_GLAZED_TERRACOTTA;
            case JavaBlockIds::MAGENTA_GLAZED_TERRACOTTA:
                return BedrockBlockIds::MAGENTA_GLAZED_TERRACOTTA;
            case JavaBlockIds::LIGHT_BLUE_GLAZED_TERRACOTTA:
                return BedrockBlockIds::LIGHT_BLUE_GLAZED_TERRACOTTA;
            case JavaBlockIds::YELLOW_GLAZED_TERRACOTTA:
                return BedrockBlockIds::YELLOW_GLAZED_TERRACOTTA;
            case JavaBlockIds::LIME_GLAZED_TERRACOTTA:
                return BedrockBlockIds::LIME_GLAZED_TERRACOTTA;
            case JavaBlockIds::PINK_GLAZED_TERRACOTTA:
                return BedrockBlockIds::PINK_GLAZED_TERRACOTTA;
            case JavaBlockIds::GRAY_GLAZED_TERRACOTTA:
                return BedrockBlockIds::GRAY_GLAZED_TERRACOTTA;
            case JavaBlockIds::LIGHT_GRAY_GLAZED_TERRACOTTA:
                return BedrockBlockIds::SILVER_GLAZED_TERRACOTTA;
            case JavaBlockIds::CYAN_GLAZED_TERRACOTTA:
                return BedrockBlockIds::CYAN_GLAZED_TERRACOTTA;
            case JavaBlockIds::PURPLE_GLAZED_TERRACOTTA:
                return BedrockBlockIds::PURPLE_GLAZED_TERRACOTTA;
            case JavaBlockIds::BLUE_GLAZED_TERRACOTTA:
                return BedrockBlockIds::BLUE_GLAZED_TERRACOTTA;
            case JavaBlockIds::BROWN_GLAZED_TERRACOTTA:
                return BedrockBlockIds::BROWN_GLAZED_TERRACOTTA;
            case JavaBlockIds::GREEN_GLAZED_TERRACOTTA:
                return BedrockBlockIds::GREEN_GLAZED_TERRACOTTA;
            case JavaBlockIds::RED_GLAZED_TERRACOTTA:
                return BedrockBlockIds::RED_GLAZED_TERRACOTTA;
            case JavaBlockIds::BLACK_GLAZED_TERRACOTTA:
                return BedrockBlockIds::BLACK_GLAZED_TERRACOTTA;
            case JavaBlockIds::CONCRETE:
                return BedrockBlockIds::CONCRETE;
            case JavaBlockIds::CONCRETE_POWDER:
                return BedrockBlockIds::CONCRETE_POWDER;
            case JavaBlockIds::STRUCTURE_BLOCK:
                return BedrockBlockIds::STRUCTURE_BLOCK;
        }
        return $current;
    }
}