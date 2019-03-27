<?php

namespace Xandrucea\ItemListDisplay\Application;

use Xandrucea\ItemListDisplay\Infrastructure\Configuration;
use Xandrucea\ItemListDisplay\Infrastructure\Template;

class ItemListDisplay
{
    protected static $config;

    protected static $templates;

    public function __construct(array $config = [])
    {
        self::$config    = new Configuration($config);
        self::$templates = new Template(self::$config::getTemplateDirectory());
    }

    public function render()
    {
        $entryId          = $_GET[self::$config::getItemKey()] ?? false;
        $contentDirectory = self::$config::getContentDirectory();
        $fileFormat       = self::$config::getFileFormat();
        $sortOrder        = self::$config::getSortOrder();
        $itemKey          = self::$config::getItemKey();

        if (empty($entryId)) {
            $storage = array_values(preg_grep('/^([^.])/', scandir($contentDirectory, $sortOrder)));

            $index = 0;
            echo '<ul>';
            foreach ($storage as $filename) {
                ++$index;

                $link = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
//                echo '<a href="?'.$itemKey.'='.$link.'">'.$link.'</a>';
                echo self::$templates::item([
                    '$itemKey' => $itemKey,
                    '$link'    => $link
                ]);

                if ($index < count($storage)) {
                    echo '<br>';
                }
            }
            echo '</ul>';
        } else {
            $entryFile = $contentDirectory.$entryId.'.'.$fileFormat;

            if (file_exists($entryFile)) {
                require $entryFile;

            } else {
                require self::$templates::errorPage();
            }
        }
    }

    public function showConfig()
    {
        echo '<pre>';
        echo '$contentDirectory : ', self::$config::getContentDirectory().'<br>';
        echo '$templateDirectory : ', self::$config::getTemplateDirectory().'<br>';
        echo '$itemKey : ', self::$config::getItemKey().'<br>';
        echo '</pre>';
    }
}