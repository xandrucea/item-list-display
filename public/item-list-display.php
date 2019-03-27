<?php

$contentPath = './content/';
$fileFormat  = '.html';

$entryId = $_GET['entry'] ?? false;

if (empty($entryId)) {

    $storage = array_values(preg_grep('/^([^.])/', scandir($contentPath, SCANDIR_SORT_ASCENDING)));

    foreach ($storage as $filename) {
        $link = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
        echo '<a href="?entry='.$link.'">'.$link.'</a>';
    }

} else {

    $file = $contentPath.$entryId.$fileFormat;

    if (file_exists($file)) {

        require $file;

    } else {
        echo 'Computer says \'No\'!';
    }
}