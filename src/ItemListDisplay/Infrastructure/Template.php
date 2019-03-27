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

    public static function item()
    {
        $filename = self::$templateDirectory.'item.html';

        try {
            $templateContents = file_get_contents($filename);

        } catch (\RuntimeException $exception) {
            throw new \Exception($exception->getMessage(), $exception->getCode());
        }

        return $templateContents;
    }
}