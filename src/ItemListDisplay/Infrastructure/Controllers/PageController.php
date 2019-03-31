<?php


namespace Xandrucea\ItemListDisplay\Infrastructure\Controllers;


use Xandrucea\ItemListDisplay\Infrastructure\Controller;

class PageController extends Controller
{
    public function __construct()
    {
        $this->setMethod('page');
    }

    public function run()
    {
        print_r($this);
    }
}