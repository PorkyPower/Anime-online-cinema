<?php
// header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
// header('Cache-Control: no-store, no-cache, must-revalidate');
// header('Cache-Control: post-check=0, pre-check=0', false);
// header('Pragma: no-cache');
class RouterRequest
{
    public static $validMethods = 'GET|POST|PUT|DELETE|HEAD|OPTIONS|PATCH|ANY|AJAX|AJAXP|JOIN|LABELS|SCREENSHOT|LICENSE';

    public static function validMethod($data, $method)
    {
        $valid = false;
        if (strstr($data, '|')) {
            foreach (explode('|', $data) as $value) {
                $valid = self::checkMethods($value, $method);
                if ($valid) {
                    break;
                }
            }
        } else {
            $valid = self::checkMethods($data, $method);
        }

        return $valid;
    }

    protected static function checkMethods($value, $method)
    {
        $valid = false;
        if ($value === 'AJAX' && self::isAjax() && $value === $method) {
            $valid = true;
        } elseif ($value === 'AJAXP' && self::isAjax() && $method === 'POST') {
            $valid = true;
        } elseif (in_array($value, explode('|', self::$validMethods)) && ($value === $method || $value === 'ANY')) {
            $valid = true;
        }

        return $valid;
    }

    protected static function isAjax()
    {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest');
    }

    protected static function getRequestHeaders()
    {
        if (function_exists('getallheaders')) {
            return getallheaders();
        }
        $headers = [];
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_' || $name === 'CONTENT_TYPE' || $name === 'CONTENT_LENGTH') {
                $headers[str_replace([' ', 'Http'], ['-', 'HTTP'], ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }

    public static function getRequestMethod()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method === 'HEAD') {
            ob_start();
            $method = 'GET';
        } elseif ($method === 'POST') {
            $headers = self::getRequestHeaders();
            if (isset($headers['X-HTTP-Method-Override']) && in_array($headers['X-HTTP-Method-Override'], ['PUT', 'DELETE', 'PATCH', 'OPTIONS'])) {
                $method = $headers['X-HTTP-Method-Override'];
            } elseif (!empty($_POST['_method'])) {
                $method = strtoupper($_POST['_method']);
            }
        }

        return $method;
    }
}

class RouterCommand
{
    protected static $instance = null;

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function exception($message = '')
    {
        echo 'Msg=' . $message . ';_CMD3_;';
    }

    public function beforeAfter($command, $path = '', $namespace = '')
    {
        if (!is_null($command)) {
            if (is_array($command)) {
                foreach ($command as $key => $value) {
                    $this->beforeAfter($value, $path, $namespace);
                }
            } elseif (is_string($command)) {
                $controller = $this->resolveClass($command, $path, $namespace);
                if (method_exists($controller, 'handle')) {
                    return call_user_func([$controller, 'handle']);
                }

                return $this->exception('handle() method is not found in <' . $command . '> class.');
            }
        }

        return;
    }

    public function runRoute($command, $params = null, $path = '', $namespace = '')
    {
        if (!is_object($command)) {
            $segments = explode('@', $command);
            $controllerClass = str_replace([$namespace, '\\', '.'], ['', '/', '/'], $segments[0]);
            $controllerMethod = $segments[1];

            $controller = $this->resolveClass($controllerClass, $path, $namespace);
            if (method_exists($controller, $controllerMethod)) {

                $response = call_user_func_array(
                    [$controller, $controllerMethod],
                    (!is_null($params) ? $params : [])
                );
                if ($response)
                    if (is_string($response))
                        echo mb_convert_encoding($response, "Windows-1251", "utf-8");
                    else {
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response, JSON_UNESCAPED_UNICODE);
                    }
                return;
            }

            return $this->exception($controllerMethod . ' method is not found in ' . $controllerClass . ' class.');
        } else {
            if (!is_null($params)) {
                $response = call_user_func_array($command, $params);
                if ($response)
                    if (is_string($response))
                        echo mb_convert_encoding($response, "Windows-1251", "utf-8");
                    else {
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response, JSON_UNESCAPED_UNICODE);
                    }
                return;
            }
            $response = call_user_func($command);
            if ($response)
                if (is_string($response))
                    echo mb_convert_encoding($response, "Windows-1251", "utf-8");
                else {
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
                }
            return;
        }
    }

    protected function resolveClass($class, $path, $namespace)
    {
        $file = realpath(rtrim($path, '/') . '/' . $class . '.php');
        if (!file_exists($file)) {
            return $this->exception($class . ' class is not found. Please, check file.');
        }

        require_once($file);
        $class = $namespace . str_replace('/', '\\', $class);

        return new $class();
    }
}

class Router
{
    protected $baseFolder;
    protected $routes = [];
    protected $groups = [];
    protected $patterns = [
        '{a}' => '([^/]+)',
        '{d}' => '([0-9]+)',
        '{i}' => '([0-9]+)',
        '{i?}' => '([0-9]+?)',
        '{s}' => '([a-zA-Z]+)',
        '{base46}' => '([A-Za-z0-9+\/=]+)',
        '{w}' => '([a-zA-Z0-9_\-\(\)\/\.\[\]]+)',
        '{u}' => '([a-zA-Z0-9_\-\:\.]+)',
        '{*}' => '(.*)',
        '{ip}' => '([0-9\.\:]+)'
    ];

    protected $namespaces = [
        'middlewares' => '',
        'controllers' => ''
    ];

    protected $paths = [
        'controllers' => 'Controllers',
        'middlewares' => 'Middlewares'
    ];

    protected $mainMethod = 'main';
    protected $cacheFile = null;
    protected $cacheLoaded = false;
    protected $errorCallback;

    function __construct()
    {
        $this->baseFolder = realpath(getcwd());

        // if (empty($params)) {
        //     return;
        // }

        $this->setPaths(['base_folder' => './']);
    }

    protected function setPaths($params)
    {
        if (isset($params['paths']) && $paths = $params['paths']) {
            $this->paths['controllers'] =
                isset($paths['controllers'])
                    ? trim($paths['controllers'], '/')
                    : $this->paths['controllers'];

            $this->paths['middlewares'] =
                isset($paths['middlewares'])
                    ? trim($paths['middlewares'], '/')
                    : $this->paths['middlewares'];
        }

        if (isset($params['namespaces']) && $namespaces = $params['namespaces']) {
            $this->namespaces['controllers'] =
                isset($namespaces['controllers'])
                    ? trim($namespaces['controllers'], '\\') . '\\'
                    : '';

            $this->namespaces['middlewares'] =
                isset($namespaces['middlewares'])
                    ? trim($namespaces['middlewares'], '\\') . '\\'
                    : '';
        }

        if (isset($params['base_folder'])) {
            $this->baseFolder = rtrim($params['base_folder'], '/');
        }

        if (isset($params['main_method'])) {
            $this->mainMethod = $params['main_method'];
        }

        if (isset($params['cache'])) {
            $this->cacheFile = $params['cache'];
        } else {
            $this->cacheFile = realpath(__DIR__ . '/../cache.php');
        }
    }

    public function __call($method, $params)
    {
        if ($this->cacheLoaded) {
            return true;
        }

        if (is_null($params)) {
            return false;
        }

        if (!in_array(strtoupper($method), explode('|', RouterRequest::$validMethods))) {
            return $this->Exception($method . ' is not valid.');
        }

        $route = $params[0];
        $callback = $params[1];
        $settings = null;

        if (count($params) > 2) {
            $settings = $params[1];
            $callback = $params[2];
        }
        
        if (strstr($route, '{')) {
            $route1 = $route2 = '';
            foreach (explode('/', $route) as $key => $value) {
                if ($value != '') {
                    if (!strpos($value, '?')) {
                        $route1 .= '/' . $value;
                    } else {
                        if ($route2 == '') {
                            $this->addRoute($route1, $method, $callback, $settings);
                        }

                        $route2 = $route1 . '/' . str_replace('?', '', $value);
                        $this->addRoute($route2, $method, $callback, $settings);
                        $route1 = $route2;
                    }
                }
            }

            if ($route2 == '') {
                $this->addRoute($route1, $method, $callback, $settings);
            }
        } else {
            $this->addRoute($route, $method, $callback, $settings);
        }

        return true;
    }

    public function add($methods, $route, $settings, $callback = null)
    {
        if ($this->cacheLoaded) {
            return true;
        }

        if (is_null($callback)) {
            $callback = $settings;
            $settings = null;
        }

        if (strstr($methods, '|')) {
            foreach (array_unique(explode('|', $methods)) as $method) {
                if ($method != '') {
                    call_user_func_array([$this, strtolower($method)], [$route, $settings, $callback]);
                }
            }
        } else {
            call_user_func_array([$this, strtolower($methods)], [$route, $settings, $callback]);
        }

        return true;
    }

    public function pattern($pattern, $attr = null)
    {
        if (is_array($pattern)) {
            foreach ($pattern as $key => $value) {
                if (!in_array('{' . $key . '}', array_keys($this->patterns))) {
                    $this->patterns['{' . $key . '}'] = '(' . $value . ')';
                } else {
                    return $this->Exception($key . ' pattern cannot be changed.');
                }
            }
        } else {
            if (!in_array('{' . $pattern . '}', array_keys($this->patterns))) {
                $this->patterns['{' . $pattern . '}'] = '(' . $attr . ')';
            } else {
                return $this->Exception($pattern . ' pattern cannot be changed.');
            }
        }

        return true;
    }

    public function run()
    {
        $documentRoot = realpath($_SERVER['DOCUMENT_ROOT']);
        $getCwd = realpath(getcwd());

        $base = str_replace('\\', '/', str_replace($documentRoot, '', $getCwd) . '/');
        $uri = $_SERVER['REQUEST_URI'];//parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = str_replace("/index.php", "", $uri);;

        if (($base !== $uri) && (substr($uri, -1) === '/')) {
            $uri = substr($uri, 0, (strlen($uri) - 1));
        }

        if ($uri === '') {
            $uri = '/';
        }
        $uri = str_replace('?', '', $uri);
        //echo $uri;
        
        $method = RouterRequest::getRequestMethod();
        $searches = array_keys($this->patterns);
        $replaces = array_values($this->patterns);
        $foundRoute = false;

        $routes = [];
        foreach ($this->routes as $data) {
            array_push($routes, $data['route']);
        }

        // check if route is defined without regex
        if (in_array($uri, array_values($routes))) {
            foreach ($this->routes as $data) {
                if (RouterRequest::validMethod($data['method'], $method) && ($data['route'] === $uri)) {
                    $foundRoute = true;
                    $this->runRouteMiddleware($data, 'before');
                    $this->runRouteCommand($data['callback']);
                    $this->runRouteMiddleware($data, 'after');
                    break;
                }
            }
        } else {
            foreach ($this->routes as $data) {
                $route = $data['route'];

                if (strpos($route, '{') !== false) {
                    $route = str_replace($searches, $replaces, $route);
                }
                if (preg_match('#^' . $route . '$#', $uri, $matched)) {
                    if (RouterRequest::validMethod($data['method'], $method)) {
                        $foundRoute = true;

                        $this->runRouteMiddleware($data, 'before');

                        array_shift($matched);
                        $newMatched = [];
                        foreach ($matched as $key => $value) {
                            if (strstr($value, '/')) {
                                foreach (explode('/', $value) as $k => $v) {
                                    $newMatched[] = trim(urldecode($v));
                                }
                            } else {
                                $newMatched[] = trim(urldecode($value));
                            }
                        }
                        $matched = $newMatched;

                        $this->runRouteCommand($data['callback'], $matched);
                        $this->runRouteMiddleware($data, 'after');
                        break;
                    }
                }
            }
        }

        // If it originally was a HEAD request, clean up after ourselves by emptying the output buffer
        if (strtoupper($_SERVER['REQUEST_METHOD']) === 'HEAD') {
            ob_end_clean();
        }

        if ($foundRoute === false) {
            if (!$this->errorCallback) {
                $this->errorCallback = function () {
                    header($_SERVER['SERVER_PROTOCOL'] . " 200 Not Found");
                    return $this->Exception('Route not found. Looks like something went wrong. Please try again.');
                };
            }
            call_user_func($this->errorCallback);
        }
    }

    public function group($name, $settings = null, $callback = null)
    {
        if ($this->cacheLoaded) {
            return true;
        }

        $groupName = trim($name, '/');
        $group = [];
        $group['route'] = '/' . $groupName;
        $group['before'] = $group['after'] = null;

        if (is_null($callback)) {
            $callback = $settings;
        } else {
            $group['before'][] = (!isset($settings['before']) ? null : $settings['before']);
            $group['after'][] = (!isset($settings['after']) ? null : $settings['after']);
        }

        $groupCount = count($this->groups);
        if ($groupCount > 0) {
            $list = [];
            foreach ($this->groups as $key => $value) {
                if (is_array($value['before'])) {
                    foreach ($value['before'] as $k => $v) {
                        $list['before'][] = $v;
                    }
                    foreach ($value['after'] as $k => $v) {
                        $list['after'][] = $v;
                    }
                }
            }

            if (!is_null($group['before'])) {
                $list['before'][] = $group['before'][0];
            }

            if (!is_null($group['after'])) {
                $list['after'][] = $group['after'][0];
            }

            $group['before'] = $list['before'];
            $group['after'] = $list['after'];
        }

        $group['before'] = array_values(array_unique((array)$group['before']));
        $group['after'] = array_values(array_unique((array)$group['after']));

        array_push($this->groups, $group);

        if (is_object($callback)) {
            call_user_func_array($callback, [$this]);
        }

        $this->endGroup();

        return true;
    }

    public function controller($route, $settings, $controller = null)
    {
        if ($this->cacheLoaded) {
            return true;
        }

        if (is_null($controller)) {
            $controller = $settings;
            $settings = [];
        }

        $controller = str_replace(['\\', '.'], '/', $controller);
        $controllerFile = realpath(
            rtrim($this->paths['controllers'], '/') . '/' . $controller . '.php'
        );

        if (!file_exists($controllerFile)) {
            return $this->Exception($controller . ' class is not found!');
        }

        if (!class_exists($controller)) {
            require $controllerFile;
        }

        $controller = str_replace('/', '\\', $controller);
        $classMethods = get_class_methods($this->namespaces['controllers'] . $controller);
        if ($classMethods) {
            foreach ($classMethods as $methodName) {
                if (!strstr($methodName, '__')) {
                    $method = "any";
                    foreach (explode('|', RouterRequest::$validMethods) as $m) {
                        if (stripos($methodName, strtolower($m), 0) === 0) {
                            $method = strtolower($m);
                            break;
                        }
                    }

                    $methodVar = lcfirst(str_replace($method, '', $methodName));
                    $r = new \ReflectionMethod($this->namespaces['controllers'] . $controller, $methodName);
                    $reqiredParam = $r->getNumberOfRequiredParameters();
                    $totalParam = $r->getNumberOfParameters();

                    $value = ($methodVar === $this->mainMethod ? $route : $route . '/' . $methodVar);
                    $this->{$method}(
                        ($value . str_repeat('/{a}', $reqiredParam) . str_repeat('/{a?}', $totalParam - $reqiredParam)),
                        $settings,
                        ($controller . '@' . $methodName)
                    );
                }
            }
            unset($r);
        }

        return true;
    }

    private function addRoute($uri, $method, $callback, $settings)
    {
        $groupItem = count($this->groups) - 1;
        $group = '';
        if ($groupItem > -1) {
            foreach ($this->groups as $key => $value) {
                $group .= $value['route'];
            }
        }

        $page = dirname($_SERVER['PHP_SELF']);
        $page = $page === '/' ? '' : $page;
        if (strstr($page, 'index.php')) {
            $data = implode('/', explode('/', $page));
            $page = str_replace($data, '', $page);
        }

        $route = $page . $group . '/' . trim($uri, '/');
        $route = rtrim($route, '/');
        if ($route === $page) {
            $route .= '/';
        }

        $data = [
            'route' => str_replace('//', '/', $route),
            'method' => strtoupper($method),
            'callback' => $callback,
            'name' => (isset($settings['name'])
                ? $settings['name']
                : null
            ),
            'before' => (isset($settings['before'])
                ? $settings['before']
                : null
            ),
            'after' => (isset($settings['after'])
                ? $settings['after']
                : null
            ),
            'group' => ($groupItem === -1) ? null : $this->groups[$groupItem]
        ];
        array_push($this->routes, $data);
    }

    private function runRouteCommand($command, $params = null)
    {
        $this->routerCommand()->runRoute(
            $command,
            $params,
            $this->baseFolder . '/' . $this->paths['controllers'],
            $this->namespaces['controllers']
        );
    }

    public function runRouteMiddleware($middleware, $type)
    {
        $middlewarePath = $this->baseFolder . '/' . $this->paths['middlewares'];
        $middlewareNs = $this->namespaces['middlewares'];
        if ($type == 'before') {
            if (!is_null($middleware['group'])) {
                $this->routerCommand()->beforeAfter(
                    $middleware['group'][$type], $middlewarePath, $middlewareNs
                );
            }
            $this->routerCommand()->beforeAfter(
                $middleware[$type], $middlewarePath, $middlewareNs
            );
        } else {
            $this->routerCommand()->beforeAfter(
                $middleware[$type], $middlewarePath, $middlewareNs
            );
            if (!is_null($middleware['group'])) {
                $this->routerCommand()->beforeAfter(
                    $middleware['group'][$type], $middlewarePath, $middlewareNs
                );
            }
        }
    }

    private function endGroup()
    {
        array_pop($this->groups);
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function Exception($message = '')
    {
        //file_put_contents('../exception.log', $_SERVER['REMOTE_ADDR'] . "\t - " . $_SERVER['REQUEST_URI'] . "\n", FILE_APPEND);
        header('Location: ../404.html');
        echo "Msg=Opps! An error occurred.\n($message);_CMD3_;";
    }

    public function routerCommand()
    {
        return RouterCommand::getInstance();
    }
}
