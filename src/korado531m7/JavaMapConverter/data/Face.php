<?php

/*
 * JavaMapConverter v1.1.0 by korado531m7
 * Developer: korado531m7
 * Copyright (C) 2020 korado531m7
 * Licensed under MIT (https://github.com/korado531m7/JavaMapConverter/blob/master/LICENSE)
 */

namespace korado531m7\JavaMapConverter\data;


use korado531m7\JavaMapConverter\block\BlockIds as JavaBlockIds;
use pocketmine\block\BlockIds as BedrockBlockIds;


class Face{
    //Java id
    public static function getNewFace(int $blockId, int $face) : int{
        switch($blockId){
            case BedrockBlockIds::DOUBLE_STONE_SLAB:
            case BedrockBlockIds::STONE_SLAB:
                switch($face){
                    case 6:
                        return 7;
                    case 7:
                        return 6;
                    case 14:
                        return 15;
                    case 15:
                        return 14;
                }
                break;

            case BedrockBlockIds::TRAPDOOR:
            case BedrockBlockIds::IRON_TRAPDOOR:
                switch($face){
                    case 0:
                        return 3;
                    case 1:
                        return 2;
                    case 2:
                        return 1;
                    case 3:
                        return 0;
                    case 4:
                        return 11;
                    case 5:
                        return 10;
                    case 6:
                        return 9;
                    case 7:
                        return 8;
                    case 8:
                        return 7;
                    case 9:
                        return 6;
                    case 10:
                        return 5;
                    case 11:
                        return 4;
                    case 12:
                        return 15;
                    case 13:
                        return 14;
                    case 14:
                        return 13;
                    case 15:
                        return 12;
                }
                break;

            case BedrockBlockIds::STONE_BUTTON:
            case BedrockBlockIds::WOODEN_BUTTON:
                switch($face){
                    case 1:
                        return 5;
                    case 2:
                        return 4;
                    case 4:
                        return 2;
                    case 5:
                        return 1;
                }
                break;

            case JavaBlockIds::WHITE_GLAZED_TERRACOTTA:
            case JavaBlockIds::ORANGE_GLAZED_TERRACOTTA:
            case JavaBlockIds::MAGENTA_GLAZED_TERRACOTTA:
            case JavaBlockIds::LIGHT_BLUE_GLAZED_TERRACOTTA:
            case JavaBlockIds::YELLOW_GLAZED_TERRACOTTA:
            case JavaBlockIds::LIME_GLAZED_TERRACOTTA:
            case JavaBlockIds::PINK_GLAZED_TERRACOTTA:
            case JavaBlockIds::GRAY_GLAZED_TERRACOTTA:
            case JavaBlockIds::LIGHT_GRAY_GLAZED_TERRACOTTA:
            case JavaBlockIds::CYAN_GLAZED_TERRACOTTA:
            case JavaBlockIds::PURPLE_GLAZED_TERRACOTTA:
            case JavaBlockIds::BLUE_GLAZED_TERRACOTTA:
            case JavaBlockIds::BROWN_GLAZED_TERRACOTTA:
            case JavaBlockIds::GREEN_GLAZED_TERRACOTTA:
            case JavaBlockIds::RED_GLAZED_TERRACOTTA:
            case JavaBlockIds::BLACK_GLAZED_TERRACOTTA:
                switch($face){
                    case 0:
                        return 3;
                    case 1:
                        return 4;
                    case 3:
                        return 5;
                }
                break;

            case JavaBlockIds::WHITE_SHULKER_BOX:
                return 0;
            case JavaBlockIds::ORANGE_SHULKER_BOX:
                return 1;
            case JavaBlockIds::MAGENTA_SHULKER_BOX:
                return 2;
            case JavaBlockIds::LIGHT_BLUE_SHULKER_BOX:
                return 3;
            case JavaBlockIds::YELLOW_SHULKER_BOX:
                return 4;
            case JavaBlockIds::LIME_SHULKER_BOX:
                return 5;
            case JavaBlockIds::PINK_SHULKER_BOX:
                return 6;
            case JavaBlockIds::GRAY_SHULKER_BOX:
                return 7;
            case JavaBlockIds::LIGHT_GRAY_SHULKER_BOX:
                return 8;
            case JavaBlockIds::CYAN_SHULKER_BOX:
                return 9;
            case JavaBlockIds::PURPLE_SHULKER_BOX:
                return 10;
            case JavaBlockIds::BLUE_SHULKER_BOX:
                return 11;
            case JavaBlockIds::BROWN_SHULKER_BOX:
                return 12;
            case JavaBlockIds::GREEN_SHULKER_BOX:
                return 13;
            case JavaBlockIds::RED_SHULKER_BOX:
                return 14;
            case JavaBlockIds::BLACK_SHULKER_BOX:
                return 15;

            case JavaBlockIds::SPRUCE_FENCE:
                return 1;
            case JavaBlockIds::BIRCH_FENCE:
                return 2;
            case JavaBlockIds::JUNGLE_FENCE:
                return 3;
            case JavaBlockIds::ACACIA_FENCE:
                return 4;
            case JavaBlockIds::DARK_OAK_FENCE:
                return 5;
        }
        return $face;
    }
}