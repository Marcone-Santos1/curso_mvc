<?php

namespace App\Utils;


class View
{

    /**
     * @var array
     */
    private static $vars = [];

    /**
     * @param array|mixed $vars
     */
    public static function init($vars = []) {
        self::$vars = $vars;
    }

    /**
     * método responsável por retornar o conteúdo de uma view
     * @param string $view
     * @return string
     */
    private static function getContentView($view) {
        $file = __DIR__ . '/../../resources/view/' . $view . '.html';
        return file_exists($file) ? file_get_contents($file) : '';
    }

    /**
     * método responsável por retornar o conteúdo renderizado de uma view
     * @param string $view
     * @param array $vars (string/numeric)
     * @return string
     */
    public static function render($view, $vars = []) {
        // conteúdo da view
        $contentView = self::getContentView($view);

        // merge de variáveis do layout
        $vars = array_merge(self::$vars, $vars);

        // chaves do array
        $keys = array_keys($vars);
        $keys = array_map(function ($item){
            return '{{'.$item.'}}';
        }, $keys);



        // retorna o conteúdo renderizado
        return str_replace($keys, array_values($vars), $contentView);
    }

}