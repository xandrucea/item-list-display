<?php


namespace Xandrucea\ItemListDisplay\Infrastructure;


class Template
{
    public function process(string $templateString, array $props)
    {
        $templateInput = $templateString;

        foreach (array_keys($props) as $prop) {
            $templateInput = str_replace('{'.$prop.'}', $props[$prop], $templateInput);
        }

        return $templateInput;
    }
}