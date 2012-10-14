<?php

/**
 * Home
 *
 * example of simple MVC Pattern Design
 *
 * @package pageneration
 * @subpackage example
 * @date 2011-12-19
 * @version 0.0.1
 * @author Michal Luberda <michal.luberda@appcom.it>
 */

/**
 * Controller
 * - Autoloader
 * - Restore session or create a new one
 * - Init controller
 * - Restore cached informations
 * - Set initial variables
 */

// Autoloader
require_once "../Autoloader.php";
spl_autoload_register ("PG\Controller\Autoloader::load");

// Restore session or create a new one
session_name (\Config :: _SESSION_NAME);
session_start ();

// Init controller
$oCtrl = new \PG\Controller ();

// Set initial variables
date_default_timezone_set ("Europe/Rome");
$sPath = $_SERVER["DOCUMENT_ROOT"] . \Config :: _SYSTEM_FOLDER;


/**
 * Model
 * - Create models
 * - Manage models
 * - Add models to controller
 */

// Create models
$oModel = new \PG\Model ();

// Manage models
$oModel -> add (
    \PG\Controller\Files :: read ($sPath . "Model/xml/translate.xml")
);

// Add models to controller
$oCtrl -> addModel (
    $oModel,
    "xml",
    "translate"
);


/**
 * View
 * - Get view
 * - Add View to controller
 * - Render page
 */

// Get view
$oView = new \PG\View\XSLT ($sPath . "View/xsl/home.xsl");

// Add View to controller
$oCtrl -> addView ($oView);

// Render page
print $oCtrl -> output ();
