<?php


namespace Xandrucea\ItemListDisplay\Infrastructure\Controllers;


use Xandrucea\ItemListDisplay\Infrastructure\Controller;

class DisplayController extends Controller
{
    public function run($content, $data)
    {
        $this->setMethod('display');

        $this->setParams($content);

        $contentDirectory = 'content/';
        $contentName      = $this->getParams()[0];
        $contentFile      = $contentDirectory.$contentName.'.html';

        if (file_exists($contentFile))
        {
            echo file_get_contents($contentFile);
        }

    }
}