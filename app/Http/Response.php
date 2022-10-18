<?php

namespace App\Http;

class Response
{

    /**
     * código do status HTTP
     * @var int
     */
    private $httpCode = 200;

    /**
     * cabeçalho do response
     * @var array
     */
    private $headers = [];

    /**
     * tipo de conteúdo à ser retornado
     * @var string
     */
    private $contentType = 'text/html';

    /**
     * conteúdo do response
     * @var mixed
     */
    private $content;


    /**
     * método responsável por iniciar a classe e definir os valores
     * @param integer $httpCode
     * @param string $content
     * @param mixed $contentType
     */
    public function __construct($httpCode, $content, $contentType = 'text/html')
    {
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setContentType($contentType);
    }

    /**
     * método responsável por alterar o content type do resonse
     * @param string $contentType
     */
    public function setContentType($contentType) {
        $this->contentType = $contentType;
        $this->addHeader('Content-Type', $contentType);
    }

    /**
     * método responsável por adicionar um registro no cabeçalho de response
     * @param string $key
     * @param string $value
     */
    public function addHeader($key, $value) {
        $this->headers[$key] = $value;
    }

    /**
     * método responsável por enviar os headers para o navegador
     */
    private function sendHeaders() {
        // Status
        http_response_code($this->httpCode);

        // enviar todos os headers
        foreach ($this->headers as $key=>$value) {
            header($key.': '. $value);
        }
    }

    /**
     * método responsável por enviar a resposta para o usuário
     */
    public function sendResponse()
    {
        // envia os headers
        $this->sendHeaders();

        // imprime o conteúdo
        switch ($this->contentType) {
            case 'text/html':
                echo $this->content;
                exit;
        }
    }

}