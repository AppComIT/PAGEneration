<?php

/**
 * PG\View\ViewAbstract
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

abstract class ViewAbstract extends \PG\View
{
    
    abstract function output (array $aModels);
    
}
