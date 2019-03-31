<?php


namespace Xandrucea\ItemListDisplay\Infrastructure;


class Controller
{
    protected $method = '';
    protected $params = [];
    protected $template = '';

    public function template($template)
    {
        echo 'template: '.$template;
    }
}