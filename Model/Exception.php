<?php

/**
 * PG\Model\Exception
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

namespace PG\Model;

class Exception extends \Exception
{
    
    public function __construct ($s)
    {
        print "Error: " . $s;
        exit;
    }
    
}
