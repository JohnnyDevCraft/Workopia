<?php

/**
 * Get the base path
 *
 * @param string $path
 * @return string
 */
function basePath($path = '')
{
    return __DIR__ . '/' . $path;
}

/**
 * Load a View
 *
 * @param string $name
 * @return void
 */
function loadView($name, $data = [])
{
    $viewPath = basePath("App/views/{$name}.view.php");
    if (file_exists($viewPath)){
        extract($data);
        require $viewPath;
    } else {
        echo "View {$name} not found";
    }
}

/**
 * Load a Partial
 *
 * @param string $name
 * @return void
 *
 */
function loadPartial($name, $data = []){
    $viewPath =  basePath("App/views/partials/{$name}.partial.php");

    if(file_exists($viewPath)){
        extract($data);
        require $viewPath;
    } else {
        echo "<pre>Partial {$name} not found</pre>";
    }
}

/**
 * Inspect a value(S)
 *
 * @param mixed $value
 * @return void
 */
function inspect($value){
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}

/**
 * Inspect a value(S) and die
 *
 * @param mixed $value
 * @return void
 */
function inspectAndDie($value){
    preWrapCallback(die(var_dump($value)));
}

/**
 * Formats a string as currency.
 *
 * @param $salary
 * @return string
 */
function formatSalary($salary)
{
    return '$' . number_format(floatval($salary));
}


/**
 * Loads a layout that then loads a view.
 *
 * @param $layout - Name of layout to load
 * @return void
 */
function loadLayoutAndView($layout){
    $layoutPath = basePath("App/views/layouts/{$layout}.layout.php");
    if (file_exists($layoutPath)){
        require $layoutPath;
    } else {
        echo "Layout {$layout} not found";
    }
}


function preWrap($data){
    echo "<pre>{$data}</pre>";
}


function preWrapCallback($function){
    echo "<pre>";
    $function();
    echo "</pre>";
}

/**
 * Used to sanitize the data of a request
 *
 * @param $dirty
 * @return mixed
 */
function sanitizeData($dirty){
    return filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
}

/**
 * Redirect user to route
 *
 * @param string $url
 * @return void
 */
function redirect(string $url){
    header("Location: {$url}");
    exit;
}