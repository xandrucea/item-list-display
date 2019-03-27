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
        echo parent::showConfig();
    }
}