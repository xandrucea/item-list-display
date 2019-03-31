<?php


namespace Xandrucea\ItemListDisplay\Infrastructure\Controllers;


use Xandrucea\ItemListDisplay\Infrastructure\Controller;

class ListController extends Controller
{
    protected static $templatePath = '.'.DIRECTORY_SEPARATOR.'templates';
    protected static $contentPath = '.'.DIRECTORY_SEPARATOR.'content';
    protected static $templateFile = 'item.html';

    public function run()
    {
        $this->setMethod('default');
        $this->setParams(array_values(preg_grep('/^([^.])/', scandir(self::$contentPath))));

        $template = file_get_contents(self::$templatePath.DIRECTORY_SEPARATOR.self::$templateFile);
        $storage  = array_values(preg_grep('/^([^.])/', scandir(self::$templatePath)));
        $data     = $this->getParams();


        if (in_array(self::$templateFile, $storage, true)) {

            $index = 0;
            echo '<ul>';

            foreach ($data as $bit) {
                ++$index;

                print_r($this->template->process($template, [
                    '$itemKey' => 'entry',
                    '$link'    => preg_replace('/\\.[^.\\s]{3,4}$/', '', $bit)
                ]));

                if ($index < count($storage)) {
//                    echo '<br>';
                }
            }
            echo '</ul>';
        }
    }
}