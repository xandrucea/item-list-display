<?php


namespace Xandrucea\ItemListDisplay\Infrastructure;


class Template
{
    private static $templatePath;

    private static $templateFile = 'item.html';

    public function __construct($templateDirectory)
    {
        self::$templatePath = $templateDirectory;
    }

    public function process(array $props)
    {
        $templateInput = file_get_contents(self::$templatePath.DIRECTORY_SEPARATOR.self::$templateFile);

        foreach (array_keys($props) as $prop) {
            echo json_encode($prop);
            $templateInput = str_replace('{$'.$prop.'}', $props[$prop], $templateInput);
        }

        return $templateInput;
    }
}