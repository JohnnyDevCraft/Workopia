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
function loadView($name)
{
    $viewPath = basePath("views/{$name}.view.php");
    if (file_exists($viewPath)){
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
function loadPartial($name){
    $viewPath =  basePath("views/partials/{$name}.partial.php");

    if(file_exists($viewPath)){
        require $viewPath;
    } else {
        echo "Partial {$name} not found";
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
    echo '<pre>';
    die(var_dump($value));
    echo '</pre>';
}



