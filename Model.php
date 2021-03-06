<?php

/**
 * PG\Model
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

class Model
{
    
    /**
     * @var mixed
     */
    protected $v;
    
    /**
     * add
     */
    public function add ($v)
    {
        $this -> v = $v;
    }
    
    /**
     * get
     */
    public function get ()
    {
        return $this -> v;
    }
    
}
