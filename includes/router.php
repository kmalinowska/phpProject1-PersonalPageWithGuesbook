<?php
//routing logic to handling the routing/ obsługa routingu
declare(strict_types=1);

function dispatch(string $uri, string $method):void { //wysłanie prośby, mamy tu 2 argumenty: uri - część adresu url bez domeny oraz metoda
    //1) normalize the URI - dopasowanie go do nazwy pliku: GET /questbook -> routes/questbook_get.php
    //2) make sure to support given HTTP method: GET|POST - if it is different we return 404 error
    //3) converting URL and method to actual file path - PHP file path
    //4) check if this file exists, if not return 404 - page doesn't find
    //5) if file exists - handle the route by including the PHP file
} 