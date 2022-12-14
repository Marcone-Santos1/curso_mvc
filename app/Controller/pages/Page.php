<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Page
{

    /**
     * método responsável por renderizar o header da página
     * @return string
     */
    private static function getHeader() {
        return View::render('pages/header');
    }

    /**
     * método responsável por renderizar o footer da página
     * @return string
     */
    private static function getFooter() {
        return View::render('pages/footer');
    }

    /**
     * método responsável por retornar o conteúdo (view) da nossa page genérica
     * @return string
     */
    public static function getPage($title, $content)
    {
        return View::render('pages/page', [
            'title' => $title,
            'header' => self::getHeader(),
            'content' => $content,
            'footer' => self::getFooter()
        ]);
    }

}