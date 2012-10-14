<?php

/**
 * PG\Controller\Files
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

namespace PG\Controller;

class Files
{
    
    /**
     * read
     *
     * @access public
     * @param  string $sFile
     * @return mixed string content if success or boolean false if file does not exist
     */
    public static function read ($sFile, $sMode = "r")
    {        
        $idFile = @ fopen ($sFile, $sMode);
        
        if (! $idFile) {
            return false;
        }
        
        $sContent = "";
        while (! feof ($idFile)) {
            $sContent .= fread ($idFile, 4096);
        }
        
        if (! $sContent) {
            return false;
        }
        
        fclose ($idFile);
        
        return $sContent;
    }
    
}
