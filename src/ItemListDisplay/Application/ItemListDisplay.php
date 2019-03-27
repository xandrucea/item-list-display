<?php

namespace Xandrucea\ItemListDisplay\Application;

use Xandrucea\ItemListDisplay\Infrastructure\Configuration;

class ItemListDisplay
{
    protected static $config;

    public function __construct(array $config = [])
    {
        self::$config = new Configuration($config);
    }

    public function render()
    {
        $entryId           = $_GET[self::$config->getItemKey()] ?? false;
        $contentDirectory  = self::$config->getContentDirectory();
        $templateDirectory = self::$config->getTemplateDirectory();
        $fileFormat        = self::$config->getFileFormat();
        $sortOrder         = self::$config->getSortOrder();
        $itemKey           = self::$config->getItemKey();

        if (empty($entryId)) {
            $storage = array_values(preg_grep('/^([^.])/', scandir($contentDirectory, $sortOrder)));

            $index = 0;
            foreach ($storage as $filename) {
                ++$index;

                $link = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
                echo '<a href="?'.$itemKey.'='.$link.'">'.$link.'</a>';

                if ($index < count($storage)) {
                    echo '<br>';
                }
            }
        } else {
            $entryFile = $contentDirectory.$entryId.'.'.$fileFormat;

            if (file_exists($entryFile)) {
                require $entryFile;

            } else {
                require $templateDirectory.'error-page.html';
            }
        }
    }

    public function showConfig()
    {
        echo '<pre>';
        echo '$contentDirectory : ', self::$config->getContentDirectory().'<br>';
        echo '$templateDirectory : ', self::$config->getTemplateDirectory().'<br>';
        echo '$itemKey : ', self::$config->getItemKey().'<br>';
        echo '</pre>';
    }
}