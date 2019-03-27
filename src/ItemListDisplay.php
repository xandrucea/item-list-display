<?php

namespace Xandrucea;

use Xandrucea\ItemListDisplay\Application\ItemListDisplay as ItemListDisplayPort;

class ItemListDisplay extends ItemListDisplayPort
{
    public function render()
    {
        echo parent::render();
    }

    public function showConfig()
    {
        echo '<pre>';
        echo '$contentDirectory : ', self::$contentDirectory . '<br>';
        echo '$templateDirectory : ', self::$templateDirectory . '<br>';
        echo '$itemKey : ', self::$itemKey . '<br>';
        echo '</pre>';
    }
}