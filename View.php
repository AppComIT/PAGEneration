<?php

/**
 * PG\View
 *
 * Log:
 * - v0.0.1 2011-12-20 first version
 *
 * @package PG
 * @subpackage example
 * @version 0.0.1
 * @date 2011-12-20
 * @author Michal Luberda <michal.luberda@appcom.it>
 */

namespace PG;

abstract class View
{
    
    /**
     * @var string
     */
    protected $sType;
    
    /**
     * @var boolean
     */
    public $isHeader;
    
    public function __set ($s, $v)
    {
        $this -> $s = $v;
    }
    
    public function __get ($s)
    {
        return $this -> $s;
    }
    
}
