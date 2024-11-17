<?php

/**
 * Get the base path. 
 * Отримати абсолютний шлях до ФАЙЛУ. 
 * Використовується просто для того, щоб не писати ../../../
 * 
 * @param string $path
 * @return string
 */
function basePath($path = '')
{
    //__DIR__ дозволяє отримати абсолютний шлях до КАТАЛОГУ
    return __DIR__ . '/' . $path;
}


/**
 * Load a view
 * 
 * $param string $name
 * @return void
 * 
 */
function loadView($name, $data = [])
{
    extract($data);
    $viewPath = basePath("App/views/{$name}.view.php");

    if (file_exists($viewPath)) {
        require $viewPath;
    } else {
        echo "View '{$name} not found!'";
    }
}

/**
 * Load a Partials
 * 
 * $param string $name
 * @return void
 * 
 */
function loadPartial($name)
{
    $partialPath = basePath("App/views/partials/{$name}.php");
    if (file_exists($partialPath)) {
        require $partialPath;
    } else {
        echo "Partial '{$name} not found!'";
    }
}

//mixed (у народі 'any')

/**
 * Inspect a value 
 * 
 * @param mixed $value
 * @return void
 */
function inspect($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}

/**
 * Inspect a value and die
 * 
 * @param mixed $value
 * @return void
 */
function inspectAndDie($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die();
}


/**
 * format salary
 * 
 * @param string $salary
 * @return string formatted salary
 */
function formatSalary($salary)
{
    return '$' . number_format($salary);
}
