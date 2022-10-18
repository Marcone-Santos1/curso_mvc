<?php

namespace App\Http;

class Request
{

    /**
     * métodod http da requisição
     * @var string
     */
    private $httpMethod;

    /**
     * uri da página
     * @var string
     */
    private $uri;

    /**
     * Parâmetros da url ($_GET)
     * @var array
     */
    private $queryParams = [];

    /**
     * Variáveis recebidas no POST da página ($_POST)
     * @var array
     */
    private $postVars = [];

    /**
     * Cabeçalho da requisição
     * @var array
     */
    private $heades = [];


    /**
     * Construtor da classe
     */
    public function __construct()
    {
        $this->queryParams = isset($_GET) ? $_GET : [];
        $this->postVars = isset($_POST) ? $_POST : [];
        $this->heades = getallheaders();
        $this->httpMethod = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : '';
        $this->uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
    }

    /**
     * @return mixed|string
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    /**
     * @param mixed|string $httpMethod
     */
    public function setHttpMethod($httpMethod)
    {
        $this->httpMethod = $httpMethod;
    }

    /**
     * @return mixed|string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param mixed|string $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    /**
     * @return array
     */
    public function getQueryParams()
    {
        return $this->queryParams;
    }

    /**
     * @param array $queryParams
     */
    public function setQueryParams($queryParams)
    {
        $this->queryParams = $queryParams;
    }

    /**
     * @return array
     */
    public function getPostVars()
    {
        return $this->postVars;
    }

    /**
     * @param array $postVars
     */
    public function setPostVars($postVars)
    {
        $this->postVars = $postVars;
    }

    /**
     * @return array|false
     */
    public function getHeades()
    {
        return $this->heades;
    }

    /**
     * @param array|false $heades
     */
    public function setHeades($heades)
    {
        $this->heades = $heades;
    }

}