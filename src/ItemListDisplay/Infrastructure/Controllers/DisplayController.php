<?php


namespace Xandrucea\ItemListDisplay\Infrastructure\Controllers;


use Xandrucea\ItemListDisplay\Infrastructure\Controller;

class DisplayController extends Controller
{
    public function run($content)
    {
        print_r($content);
    }
}