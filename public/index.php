<?php
//Require once the Composer Autoload
$autoloader = dirname(__DIR__, 1).'/vendor/autoload.php';
if (file_exists($autoloader)) {
    require $autoloader;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Xandrucea\ItemListDisplay</title>
        <link rel="stylesheet" href="assets/css/styles.min.css">
    </head>
    <body>
        <?php
        $blog = new \Xandrucea\ItemListDisplay([
            'contentDirectory'  => 'content/',
            'templateDirectory' => 'templates/',
            'itemKey'           => 'entry',
            'sortOrder'         => 'descending'
        ]);

        $blog->configureRouter([
            'list'    => 'item.html',
            'display' => 'display.html',
            'error'   => 'error-page.html',
        ]);

        echo '<pre>';
        $blog->render();
        echo '</pre>';
        //        $blog->showConfig();
        ?>
        <div class="container">
            <div class="row">Header</div>
            <div class="row">
                <div class="col">Menymenu</div>
                <div class="col">Content</div>
            </div>
            <div class="row">Footer</div>
        </div>
    </body>
</html>