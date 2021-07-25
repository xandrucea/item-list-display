<?php

namespace Xandrucea\ItemListDisplay\Application;

class Configuration
{
    /**
     * Base directory path
     *
     * @var string
     */
    private static $baseDir = '';

    /**
     * Content directory path
     *
     * @var string
     */
    private static $contentDirectory = 'content/';

    /**
     * Template directory path
     *
     * @var string
     */
    private static $templateDirectory = 'templates/';

    /**
     * Item key
     *
     * @var string
     */
    private static $itemKey = 'entry';

    /**
     * File format
     *
     * @var string
     */
    private static $fileFormat = 'html';

    /**
     * Sort order
     *
     * @var string
     */
    protected static $sortOrder = 'ascending';

    public function __construct(array $config)
    {
        if (!empty($config['baseDir'])) {
            $this->setBaseDir($config['baseDir']);
        }

        if (!empty($config['contentDirectory'])) {
            $this->setContentDirectory($config['contentDirectory']);
        }

        if (!empty($config['templateDirectory'])) {
            $this->setTemplateDirectory($config['templateDirectory']);
        }

        if (!empty($config['itemKey'])) {
            $this->setItemKey($config['itemKey']);
        }

        if (!empty($config['fileFormat'])) {
            $this->setFileFormat($config['fileFormat']);
        }

        if (!empty($config['sortOrder'])) {
            $this->setSortOrder($config['sortOrder']);
        }

        return $this;
    }

    /**
     * @return string
     */
    public static function getBaseDir(): string
    {
        return self::$baseDir;
    }

    /**
     * @param string $baseDir
     */
    public static function setBaseDir(string $baseDir): void
    {
        // TODO: Implement base directory offset for route
        self::$baseDir = $baseDir;
    }

    /**
     * @return string
     */
    public static function getContentDirectory(): string
    {
        return self::$contentDirectory;
    }

    /**
     * @param string $contentDirectory
     */
    public static function setContentDirectory(string $contentDirectory): void
    {
        self::$contentDirectory = $contentDirectory;
    }

    /**
     * @return string
     */
    public static function getTemplateDirectory(): string
    {
        return self::$templateDirectory;
    }

    /**
     * @param string $templateDirectory
     */
    public static function setTemplateDirectory(string $templateDirectory): void
    {
        self::$templateDirectory = $templateDirectory;
    }

    /**
     * @return string
     */
    public static function getItemKey(): string
    {
        return self::$itemKey;
    }

    /**
     * @param string $itemKey
     */
    public static function setItemKey(string $itemKey): void
    {
        self::$itemKey = $itemKey;
    }

    /**
     * @return string
     */
    public static function getFileFormat(): string
    {
        return self::$fileFormat;
    }

    /**
     * @param string $fileFormat
     */
    public static function setFileFormat(string $fileFormat): void
    {
        self::$fileFormat = $fileFormat;
    }

    /**
     * @return string
     */
    public static function getSortOrder(): string
    {
        if (isset($_GET['sort'])) {
            $sortIndex = $_GET['sort'];
        }

        $sortOptions = [
            'ascending' => SCANDIR_SORT_ASCENDING,
            'descending' => SCANDIR_SORT_DESCENDING
        ];

        $sortOrder = self::$sortOrder;

        if (isset($sortIndex) && in_array($sortIndex, array_keys($sortOptions))) {
            $sortOrder = $sortIndex;
        }

        return $sortOptions[$sortOrder];
    }

    /**
     * @param string $sortOrder
     */
    public static function setSortOrder(string $sortOrder): void
    {
        if (in_array($sortOrder, ['ascending', 'descending'])) {
            self::$sortOrder = $sortOrder;
        }
    }
}