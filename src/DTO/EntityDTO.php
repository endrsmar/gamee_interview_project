<?php
/**
 * Copyright (c) 2017 Martin Endršt (endrst.martin@gmail.com)
 * 
 * Created as part of interview process at GAMEE
 */
namespace Endrsmar\GameeInterviewProject\DTO;

abstract class EntityDTO
{
    
    /**
    * @var int
    */
    public $identification;
    
    /**
     * @param int $identification
     */
    public function __construct(int $identification)
    {
        $this->identification = $identification;
    }
    
    /**
     * Represents DTO as associative array
     * @return array
     */
    public function asArray() : array
    {
        $res = [];
        foreach ($this as $propertyName => $propertyValue) {
            $res[$propertyName] = $propertyValue;
        }
        return $res;
    }
    
}
