<?php
//routing logic to handling the routing/ obsługa routingu
declare(strict_types=1);
const ALLOWED_METHODS = ['GET', 'POST']; //not hide it inside the function dispatch! z tego miejsca mogą być one uzyte w całym projekcie, nie tylko wewnątrz funkcji
const INDEX_URI = ''; //nawet jeśli index jest pustym stringiem to dobra praktyka aby było to ogólnie dostępne
const INDEX_ROUTE = 'index'; //to nam mówi, że jeśli przeglądamy strone główną bez konkretnego uri, route name to index

function normalizeUri(string $uri): string
{
    $uri = strtok($uri, '?'); //funkcja ta podzieli ciąg znaków na mniejsze fragmenty ograniczone w tym przypadku znakiem zapytania i zwróci ciąg znaków przed ogranicznikiem
    $uri = strtolower(trim($uri, '/'));
    return $uri === INDEX_URI ? INDEX_ROUTE : $uri;
}

function getFilePath(string $uri, string $method): string {
    return ROUTES_DIR . '/' . normalizeUri($uri) . '_' . strtolower($method) . '.php';
}

function notFound(): void
{
    http_response_code(404);
    echo "404 Not Found";
    exit; //stop the execution of the script
}

function badRequest(string $message = 'Bad request'):void
{
    http_response_code(400);
    echo $message;
    exit;
}

function serverError(string $message = 'Server error'):void {
    http_response_code(500);
    echo $message;
    exit;
}

function redirect(string $uri): void {
    header("Location: $uri");
    exit();
}

//wysłanie prośby, mamy tu 2 argumenty: uri - część adresu url bez domeny oraz metoda - musi byc ona wywołana wewnątrz index.php
function dispatch(string $uri, string $method): void
{
    //1) normalize the URI - dopasowanie go do nazwy pliku: GET /questbook -> routes/questbook_get.php
    $uri = normalizeUri($uri);
    $method = strtoupper($method);
    //var_dump($uri);die;
    //2) make sure to support given HTTP method: GET|POST - if it is different we return 404 error
    if (!in_array($method, ALLOWED_METHODS)) {
        notFound();
    }
    //3) converting URL and method to actual file path - PHP file path
    //var_dump(getFilePath($uri, $method));die;
    $filePath = getFilePath($uri, $method);
    
    if(file_exists($filePath)){
        include($filePath);
        return;
    }

    notFound();

    //4) check if this file exists, if not return 404 - page doesn't find
    //5) if file exists - handle the route by including the PHP file
}