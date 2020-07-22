<?php


namespace korado531m7\JavaMapConverter\data;


class ConvertResult{
    /** @var int */
    private $all = 0;
    /** @var int */
    private $diff = 0;

    public function __construct(int $all, int $diff){
        $this->all = $all;
        $this->diff = $diff;
    }

    /**
     * @return int
     */
    public function getAllBlocks() : int{
        return $this->all;
    }

    /**
     * @return int
     */
    public function getDiffBlocks() : int{
        return $this->diff;
    }
}