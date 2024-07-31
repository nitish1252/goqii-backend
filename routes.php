<?php

require_once './controllers/UserController.php';

$routes = [
    '/backend_goqii/index.php/api/user/create' => 'UserController@createUser',
    '/backend_goqii/index.php/api/user/getdetails' => 'UserController@getUserDetails',
    '/backend_goqii/index.php/api/user/updateuser' => 'UserController@updateUser',
    '/backend_goqii/index.php/api/user/deleteuser' => 'UserController@deleteUser',
    // Add more routes as needed
];

$requestUri = $_SERVER['REQUEST_URI'];

// Finding a matching route
$routeFound = false;
$routeParameters = [];

foreach ($routes as $route => $action) {
    // Converting the route to a regex pattern by replacing {parameter} with a generic pattern
    $pattern = preg_replace('/\{.*?\}/', '([^/]+)', $route);
    $pattern = str_replace('/', '\/', $pattern);
    $pattern = '/^' . $pattern . '$/';

    if (preg_match($pattern, $requestUri, $matches)) {
        $routeFound = true;
        // Extracting parameters from the URI based on the matched pattern
        $routeParameters = array_slice($matches, 1);
        break;
    }
}

if ($routeFound) {
    list($controllerName, $methodName) = explode('@', $routes[$route]);

    $controller = new $controllerName();

    // Calling the method with extracted parameters
    echo call_user_func_array([$controller, $methodName], $routeParameters);
} else {
    echo "404 - Not Found";
}
?>

