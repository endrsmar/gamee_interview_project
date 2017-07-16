<?php
/*
 * Copyright (c) 2017 Martin Endršt (endrst.martin@gmail.com)
 * Created as part of interview process at GAMEE
 */

namespace Endrsmar\GameeInterviewProject\DTO;

class WatchDTO extends EntityDTO
{
    
    /**
    * @var string
    */
    public $title;
    
    /**
    * @var int
    */
    public $price;
    
    /**
    * @var string
    */
    public $description;
    
    /**
    * @param int $identification
    * @param string $title
    * @param int $price
    * @param string $description
    */
    public function __construct(
        int $identification,
        string $title,
        int $price,
        string $description
    ) {
        parent::__construct($identification);
        $this->title = $title;
        $this->price = $price;
        $this->description = $description;
    }
    
}
