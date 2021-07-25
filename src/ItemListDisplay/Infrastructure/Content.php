<?php


namespace Xandrucea\ItemListDisplay\Infrastructure;


class Content
{
    /**
     * Storage
     *
     * @var string
     */
    private static $storageDirectory;

    private static $files;

//    private static $folders;

    public function __construct(string $contentDirectory)
    {
        if (file_exists($contentDirectory)) {
            self::$storageDirectory = realpath($contentDirectory);
        }

        $directoryScan = scandir(self::$storageDirectory);
        $files = self::sanitizeDirectory($directoryScan);


        self::$files = $files;
    }

    private function sanitizeDirectory(array $content): array
    {
        return array_values(array_diff($content, ['.', '..']));
    }

    /**
     * @return string
     */
    public static function getStorage(): string
    {
        return self::$storageDirectory;
    }

    /**
     * @param string $storage
     */
    public static function setStorage(string $storage): void
    {
        return;
    }

    public static function getContent(): array
    {
        return self::$files;
    }

}