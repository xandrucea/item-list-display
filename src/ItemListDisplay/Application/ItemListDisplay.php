<?php

namespace Xandrucea\ItemListDisplay\Application;

class ItemListDisplay
{
    protected static $contentDirectory = 'content/';

    protected static $templateDirectory = 'templates/';

    protected static $itemKey = 'entry';

    protected static $fileFormat = 'html';

    public function __construct(array $config = [])
    {

        if (!empty($config['contentDirectory'])) {
            self::$contentDirectory = $config['contentDirectory'];
        }

        if (!empty($config['templateDirectory'])) {
            self::$templateDirectory = $config['templateDirectory'];
        }

        if (!empty($config['itemKey'])) {
            self::$itemKey = $config['itemKey'];
        }

        if (!empty($config['fileFormat'])) {
            self::$fileFormat = $config['fileFormat'];
        }
    }

    public function render()
    {
        $entryId = $_GET[self::$itemKey] ?? false;

        if (empty($entryId)) {
            $storage = array_values(preg_grep('/^([^.])/', scandir(self::$contentDirectory, SCANDIR_SORT_ASCENDING)));
            foreach ($storage as $filename) {
                $link = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
                echo '<a href="?'.self::$itemKey.'='.$link.'">'.$link.'</a>';
            }
        } else {
            $entryFile = self::$contentDirectory.$entryId.'.'.self::$fileFormat;

            if (file_exists($entryFile)) {
                require $entryFile;

            } else {
                echo 'Computer says \'No\'!';
            }
        }
    }
}