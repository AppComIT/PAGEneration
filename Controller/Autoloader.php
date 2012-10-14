<?php

/**
 * PG\Controller\Autoloader
 *
 * Log:
 * - v0.0.1 2011-12-20 the first version
 *
 * @package PG
 * @subpackage example
 * @version 0.0.1
 * @date 2011-12-20
 * @author Michal Luberda <michal.luberda@appcom.it>
 */

namespace PG\Controller;

class Autoloader
{
    
    /**
     * load
     *
     * @access public
     * @param  string $s
     * @return boolean
     */
    static public function load ($s)
    {
        if (class_exists ($s, false)) {
            return false;
        }
        
        $s = str_replace (array ("\\", "_"), "/", $s);
        
        if (substr ($s, 0 ,3) == "PG/") {
            require_once dirname (__FILE__) . "/../". substr ($s, 3) . ".php";
        }
        elseif (is_file (dirname (__FILE__) . "/" . $s . ".php")) {
            require_once dirname (__FILE__) . "/" . $s . ".php";
        }
        else {
            return false;
        }
        
        return true;
    }
    
}
