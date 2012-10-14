<?php

/**
 * PG\View\XSLT
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

class XSLT extends \PG\View
{
    /**
     * @var string
     */
    protected $sTemplate;
    
    /**
     * @var array
     */
    protected $aFunctions;
    
    /**
     * @var string
     */
    protected $sMatch;
    
    /**
     * __construct
     *
     * @access public
     */
    public function __construct ($sTemplate, $sMatch = "proc")
    {
        $this -> sMatch = $sMatch;
        
        try {
            if (! $this -> sTemplate = \PG\Controller\Files :: read ($sTemplate)) {
                throw new Exception ("Cannot read " . $sTemplate);
            }
        }
        catch (Exception $e) {
        }
    }
    
    /**
     * registerFunction
     *
     * @access public
     */
    public function registerFunction ($s)
    {
        $this -> aFunctions[] = $s;
    }
    
    /**
     * output
     *
     * @access public
     */
    public function output (array $aModels)
    {
        $sXML = "";
        if (count ($aModels)) {
            foreach ($aModels as $a) {
                switch ($a["type"]) {
                    
                    case "xml":
                        // remove the first line from xml file
                        $s = str_replace (
                            "\r\n",
                            "\n",
                            $a["model"] -> get ()
                        );
                        $a = explode ("\n", "$s");
                        array_shift ($a);
                        $sXML .= implode ("", $a);
                        
                        break;
                        
                    default:
                        throw new Exception ("Unidentified Model Type " . $a["type"] . "!");
                }
            }
        }
        
        $sXML .= $this -> toXML (array ("post"    => $_POST),    "", 0, true);
        $sXML .= $this -> toXML (array ("get"     => $_GET),     "", 0, true);
        $sXML .= $this -> toXML (array ("cookie"  => $_COOKIE),  "", 0, true);
        $sXML .= $this -> toXML (array ("server"  => $_SERVER),  "", 0, true);
        $sXML .= $this -> toXML (array ("files"   => $_FILES),   "", 0, true);
        $sXML .= $this -> toXML (array ("session" => $_SESSION), "", 0, true);
        
        $oXML = new \DOMDocument ("1.0", "UTF-8");
        $oXML -> loadXML (
              "<" . "?xml version=\"1.0\" encoding=\"UTF-8\" ?" . ">"
            . "<" . $this -> sMatch . ">" . $sXML . "</" . $this -> sMatch . ">"
        );
        $oXSLTProc = new \XSLTProcessor ();
        
        if (count ($this -> aFunctions)) {
            foreach ($this -> aFunctions as $s) {
                $oXSLTProc -> registerPHPFunctions ($s);
            }
        }
        
        $oXSLT = new \DOMDocument ("1.0", "UTF-8");
        $oXSLT -> loadXML ($this -> sTemplate);
        
        $oXSLTProc -> importStylesheet ($oXSLT);
        $sXML =  $oXSLTProc -> transformToXML ($oXML);
        
        return str_replace (
            array (
                "<" . "?xml version=\"1.0\"?" . ">",
                "<data xmlns:php=\"http://php.net/xsl\">",
                "&lt;",
                "&gt;",
            ),
            array (
                "",
                "<data>",
                "<",
                ">",
            ),
            $sXML
        );
    }
    
    /**
     * convertTo
     *
     * @access public
     * @param  any $v
     * @param  string $sElem
     * @param  integer $i
     * @param  boolean $bCData
     * @return mixed string content if success or boolean false if file does not exist
     */  
    public function toXML ($v, $sElem = "", $i = 0, $bCData = false)
    {
        $i++;
        
        $s = "";
        if (is_array ($v)) {
            foreach ($v as $sKey => $v2) {
                if (! is_numeric ($sKey))
                    $s .= "<" . $sKey . ">";
                elseif ($sElem)
                    $s .= "<" . $sElem . ">";
                    
                $s .= $this -> toXML ($v2, "", $i, $bCData);
                
                if (! is_numeric ($sKey))
                    $s .= "</" . $sKey . ">";
                elseif ($sElem)
                    $s .= "</" . $sElem . ">";
            }

        }
        elseif (is_object ($v)) {
            foreach ($v as $sKey => $v2) {
                if (! is_array ($v2) || (! $sElem && $sKey))
                    $s .= "<" . $sKey . ">";
                
                $s .= $this -> toXML ($v2, $sKey, $i, $bCData);
                
                if (! is_array ($v2) || (! $sElem && $sKey))
                    $s .= "</" . $sKey . ">";
                    
            }
        }
        elseif ($v) {
            $s .= $bCData ? "<![CDATA[" . $v . "]]>" : $v;
        }
        
        return $s;
    }
    
}
