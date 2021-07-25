<?php
//Require once the Composer Autoload
$autoloader = dirname(__DIR__, 1).'/vendor/autoload.php';
if (file_exists($autoloader)) {
    require $autoloader;
}

use Xandrucea\ItemListDisplay;
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
        $content = new ItemListDisplay([
            'contentDirectory'  => 'content/',
            'templateDirectory' => 'templates/',
            'itemKey'           => 'entry',
            'fileFormat'        => 'html',
            'sortOrder'         => 'descending',
            'baseDir'           => '',
        ]);
        ?>
        <div class="container">
            <div class="row">Header</div>
            <div class="row">
                <div class="col">
                    <?php
                    // require_once('./assets/php/navigation.php')
                    ?>
                </div>
                <div class="col">
                    <pre><?= json_encode($content->showContent(), JSON_PRETTY_PRINT); ?></pre>
                    <?= $content->render(); ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    Footer
                </div>
            </div>
        </div>
    </body>
</html>