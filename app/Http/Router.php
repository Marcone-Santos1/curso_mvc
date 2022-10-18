<?php

namespace App\Http;
use \Closure;
use \Exception;

class Router
{

    /**
     * url completa do projeto
     * @var string
     */
    private $url = '';

    /**
     * prefixo de todas as rotas
     * @var string
     */
    private $prefix = '';

    /**
     * indice de rotas
     * @var array
     */
    private $routes = [];

    /**
     * Instância de resquest
     * @var Request
     */
    private $request;

    public function __construct($url)
    {
        $this->request = new Request();
        $this->url = $url;
        $this->setPrefix();
    }

    /**
     * método responsável por definir o prefixo das rotas
     */
    private function setPrefix() {
        // informações da url
        $parseUrl = parse_url($this->url);

        // define o prefixo
        $this->prefix = isset($parseUrl['path']) ? $parseUrl['path'] : '';
    }

    /**
     * método responsável por adicionar uma rota da classe
     * @param string $method
     * @param string $route
     * @param array $params
     */
    private function addRoute($method, $route, $params = []) {

        // validação dos parametros
        foreach ($params as $key=>$value) {
            if ($value instanceof Closure) {
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }

        // padrão de validação da url
        $patternRoute = '/^' . str_replace('/', '\/', $route) . '$/';

        // adiciona a rota dentro da classe
        $this->routes[$patternRoute][$method] = $params;

    }


    /**
     * método responsável por definir uma rota de GET
     * @param $route
     * @param $params
     */
     public function get($route, $params = []) {
        return $this->addRoute('GET', $route, $params);
     }

     /**
     * método responsável por definir uma rota de POST
     * @param $route
     * @param $params
     */
     public function post($route, $params = []) {
        return $this->addRoute('POST', $route, $params);
     }

     /**
     * método responsável por definir uma rota de PUT
     * @param $route
     * @param $params
     */
     public function put($route, $params = []) {
        return $this->addRoute('PUT', $route, $params);
     }

     /**
     * método responsável por definir uma rota de DELETE
     * @param $route
     * @param $params
     */
     public function delete($route, $params = []) {
        return $this->addRoute('DELETE', $route, $params);
     }

    /**
     * método responsável por retornar a URI desconsiderando o prefixo
     * @return string
     */
    private function getUri()
    {
        $uri = $this->request->getUri();

        // fatia a URI
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];

        // retorna a uri sem prefixo
        return end($xUri);
    }

    /**
     * método responsável por retorna um array com os dados da rota atual
     * @return array
     */
     private function getRoute() {
         // URI
         $uri = $this->getUri();
         $httpMethod = $this->request->getHttpMethod();

         // valida as rotas
         foreach ($this->routes as $patternRoute=>$methods) {
             // verifica se a uri bate com o padrão
             if(preg_match($patternRoute, $uri)) {
                 // verifica o método
                 if ($methods[$httpMethod]) {
                     // retorno dos parametros da rota
                     return $methods[$httpMethod];
                 }

                 throw new Exception("Método não permitido", 405);

             }
         }

         // url não encontrada
         throw new Exception("URL não encotrada", 404);

     }

    /**
     * método responsável por executar a rota atual
     * @return Response
     */
     public function run() {
         try {
            $route = $this->getRoute();

            // verifica o controlador
             if (!isset($route['controller'])) {
                 throw new Exception("URL não pode ser processada", 500);
             }

             // argumentos da função
             $args = [];
             // execução da função
             return call_user_func_array($route['controller'], $args);

         } catch (Exception $e) {
            return new Response($e->getCode(), $e->getMessage());
         }
     }



}