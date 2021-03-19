<?php
/**
 * Created by Prodvnet.
 * User: elnikov.a
 * Date: 21.02.19
 * Time: 15:20
 */

namespace Prodvnet\UnifiedSearch;


class Request
{
    /**
     * @var string
     */
    private $controller;

    /**
     * @var string
     */
    private $action;

    /**
     * @var string
     */
    private $method;

    /**
     * @var array
     */
    private $params;

    /**
     * @var bool
     */
    private $cancel;

    /**
     * @var array
     */
    private $body;

    /**
     * @var string
     */
    private $path;

    private $file;

    private $id;

    public function __construct(string $method, string $controller, string $action, $id, array $params, bool $cancel, $body, $file)
    {
        $this->method     = $method;
        $this->controller = $controller;
        $this->action     = $action;
        $this->params     = $params;
        $this->id         = $id;
        $this->cancel     = $cancel;
        $this->body       = $body?: [];
        $this->path       = $method . ':' . $controller . ($action ? '/' . $action : '' ) . ($id ? ('/id') : '');
        $this->file       = $file;

        return $this;
    }

    public function getUrl() {
        $url = '/public/'
               . $this->getController()
               . '/' . $this->getAction()
               . ($this->id ?: '')
               . ($this->cancel ? '/cancel' : '')
               . ($this->params ? $this->getParamsString() : '');

        return $url;
    }

    private function getParamsString():string {
        $string = '?';

        foreach ($this->params as $key => $param) {
            if (is_array($param)) {
                foreach ($param as $itemKey => $item) {
                    $string .= $key . '=' . $item . '&';
                }
            } else {
                $string .= $key . '=' . $param . '&';
            }
        }

        return $string;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path)
    {
        $this->path = $path;
    }

    public function getFile()
    {
        return $this->file;
    }
}