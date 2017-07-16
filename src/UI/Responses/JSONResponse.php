<?php
/*
 * Copyright (c) 2017 Martin Endršt (endrst.martin@gmail.com)
 * Created as part of interview process at GAMEE
 */

namespace Endrsmar\GameeInterviewProject\UI\Responses;

class JSONResponse extends Response
{

    /**
     * @param int $statusCode
     * @param string $content
     */
    public function __construct(int $statusCode, array $content)
    {
        parent::__construct($statusCode);
        $this->setHeader('Content-type', 'application/json; charset=utf-8');
        $this->setContent(json_encode($content));
    }

}