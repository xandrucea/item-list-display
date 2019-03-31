<?php


namespace Xandrucea\ItemListDisplay\Infrastructure\Controllers;


use Xandrucea\ItemListDisplay\Infrastructure\Controller;

class ListController extends Controller
{
    public function __construct()
    {
        $this->setMethod('default');
    }

    public function run()
    {
        $sortOrder = [];
        $storage = array_values(preg_grep('/^([^.])/', scandir('./templates')));
        print_r($storage);
    }
}