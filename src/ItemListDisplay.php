<?php

namespace Xandrucea;

use Xandrucea\ItemListDisplay\Application\Configuration;
use Xandrucea\ItemListDisplay\Infrastructure\Content;
use Xandrucea\ItemListDisplay\Infrastructure\Template;

class ItemListDisplay
{
    private static $config;

    private static $content = [];

    private static $templates;

    public function __construct(array $config)
    {
        if ($config) {
            self::$config = new Configuration($config);
            self::$content = new Content($config['contentDirectory']);
            self::$templates = new Template(self::$config->getTemplateDirectory());
        }
    }

    public function render()
    {
        $query = array_values(array_filter(explode('/', $_SERVER['REQUEST_URI'])));
        $fileDirectory = self::$content->getStorage();
        $fileName = $query[1].".".self::$config->getFileFormat();

        if (count($query) === 2) {
            return file_get_contents($fileDirectory.DIRECTORY_SEPARATOR.$fileName);

        } else {
            $items = self::$content->getContent();
            $output = '<ul>';
            foreach ($items as $item) {
                $output .= self::$templates->process([
                    'itemKey' => self::$config->getItemKey(),
                    'link' => preg_replace('/\\.[^.\\s]{3,4}$/', '', $item)
                ]);
            }
            $output .= "</ul>";
            return $output;
        }
    }

    public function showConfig(): array
    {
        return [
            "contentDirectory" => self::$config::getContentDirectory(),
            "templateDirectory" => self::$config::getTemplateDirectory(),
            "itemKey" => self::$config::getItemKey(),
            "fileFormat" => self::$config::getFileFormat(),
            "sortOrder" => self::$config::getSortOrder(),
            "baseDir" => self::$config::getBaseDir(),
        ];
    }

    public function showContent(): array
    {
        return [
            'storage' => self::$content->getStorage(),
            'content' => self::$content->getContent()
        ];
    }
}
