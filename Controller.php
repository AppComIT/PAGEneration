<?php

/**
 * PG\Controller
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

class Controller
{
    
    /**
     * @var array
     */
    protected $aModels;
    
    /**
     * @var array
     */
    protected $aViews;
    
    public function __construct ()
    {
        $this -> aModels = array ();
        $this -> aViews  = array ();
    }
    
    /**
     * addModel
     *
     * @return int
     */
    public function addModel (\PG\Model $oModel, $sType = "string", $sName = "")
    {
        $this -> aModels[] = array (
            "model" => $oModel,
            "type"  => $sType,
            "name"  => $sName,
        );
        
        return count ($this -> aModels);
    }
    
    /**
     * addView
     *
     * @return int
     */
    public function addView (\PG\View $oView)
    {
        $this -> aViews[] = $oView;
        
        return count ($this -> aViews);
    }
    
    /**
     * output
     *
     * @return string
     */
    public function output ()
    {
        $s = "";
        foreach ($this -> aViews as $oView) {
            $s .= $oView -> output ($this -> aModels);
        }
        
        return $s;
    }
    
}
