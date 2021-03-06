<?php
class Route {
    /**
     * @var
     * void
     */
    protected $routes=[];

    public function __construct($url = null) {
        var_dump(IS_ROUTE);
        if(!IS_ROUTE)
            return false;
        if(in_array($url, $this->routes)){
            var_dump($url);
            $res = $this->run_routes($url);
            return $res;
        }
        
        // var_dump($url);die;
    }

    static function get($route, $function){
        $routes[] = array($route => $function);
    }

    function run_routes($route){
        var_dump($route);
        if(is_callable($this->routes[$route]))
            $this->routes[$route];
        else{
            $controller = explode("@", $this->routes[$route]);
            $class = '';
            require_once APP_PATH . 'apps/controller/' . $controller[0] . '.php';
            $class = new $controller[0];
            call_user_func_array([$class, $controller[1]], []);
        }

        return true;
    }
}