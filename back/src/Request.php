<?php

namespace App;

class Request
{
    private $params;
    private $reqMethod;
    private $contentType;

    public function __construct($params = [])
    {
        $this->params = $params;
        $this->reqMethod = trim($_SERVER['REQUEST_METHOD']);
        $this->contentType = !empty($_SERVER['CONTENT_TYPE']) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    }

    /**
     *
     * @return array|string
     */
    public function getBody()
    {
        if ('POST' !== $this->reqMethod) {
            return '';
        }

        $body = [];
        foreach($_POST as $key => $value) {
            $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return $body;
    }

    public function getJSON()
    {
        if ('POST' !== $this->reqMethod) {
            return [];
        }

        if (0 !== strcasecmp($this->contentType, 'application/json')) {
            return [];
        }

        $content = trim(file_get_contents("php://input"));
        return json_decode($content);
    }
}
