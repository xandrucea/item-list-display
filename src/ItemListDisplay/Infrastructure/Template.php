<?php


namespace Xandrucea\ItemListDisplay\Infrastructure;


class Template
{
    protected static $templateDirectory = '';

    protected static $templates = [];

    public function __construct(string $templateDirectory)
    {
        self::$templateDirectory = $templateDirectory;

        self::$templates = [
            'errorPage',
            'item'
        ];
    }

    public static function errorPage()
    {
        return self::$templateDirectory.'error-page.html';
    }

    public static function item($props)
    {
        $filename = self::$templateDirectory.'item.html';

        try {
            $templateContents = self::process(file_get_contents($filename), $props);

        } catch (\RuntimeException $exception) {
            throw new \Exception($exception->getMessage(), $exception->getCode());
        }

        return $templateContents;
    }

    protected static function process(string $templateString, array $props)
    {
        $templateInput = $templateString;

        foreach (array_keys($props) as $prop) {
            $templateInput = str_replace('{'.$prop.'}', $props[$prop], $templateInput);
        }

        return $templateInput;
    }
}