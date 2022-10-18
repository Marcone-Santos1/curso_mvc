<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;

class About extends Page
{
    /**
     * método responsável por retornar o conteúdo (view) da nossa home
     * @return string
     */
    public static function getHome()
    {

        /**
         * organização
         */
        $obOrganization = new Organization;

        $content = View::render('pages/about', [
            'name' => $obOrganization->name,
            'description' => $obOrganization->description
        ]);

        // retorna a view da página
        return parent::getPage('Sobre', $content);
    }

}