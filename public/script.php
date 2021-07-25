<?php

use Xandrucea\ItemListDisplay;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Require once the Composer Autoload
$autoloader = dirname(__DIR__, 1).'/vendor/autoload.php';
if (file_exists($autoloader)) {
    require $autoloader;
}

$content = new ItemListDisplay([
    'contentDirectory'  => 'content/',
    'templateDirectory' => 'templates/',
    'itemKey'           => 'entry',
    'sortOrder'         => 'descending'
]);

$content->configureRouter([
    'list'    => 'item.html',
    'display' => 'display.html',
    'error'   => 'error-page.html',
]);


//$content->gettingToWork();
//echo $content->getConfig();

//$content->navigation();
//echo json_encode($content->navigation());

//$content->render();
//echo json_encode($content->newRender());
?>
<h1>script</h1>
