<?php

/**
 * PG\View\Exception
 *
 * Log:
 * - v0.0.1 2011-12-20 first version
 *
 * @package PG
 * @subpackage example
 * @version 0.0.1
 * @date 2011-12-20
 */

namespace PG\View;

class Exception extends \Exception
{
    
    public function __construct ($s)
    {
        
        print "Error: " . $s;
        exit;
        
    }
    
}
