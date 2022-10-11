<?php
$method = $_SERVER['REQUEST_METHOD'];

$parsed = parse_url($_SERVER['REQUEST_URI']);
$path = $parsed['path'];

$routes = [
    "GET" => [
        "/KODB_PHP10/" => "homeHandler",
        "/KODB_PHP10/termekek" => "productListHandler"
    ],
    "POST" => [
        "/KODB_PHP10/termekek" => "createProductHandler"
    ]
];
// ebbe a function-ba kötjük be a methodot és a path-t stringként
$handlerFunction = $routes[$method][$path] ?? "notFoundHandler";

// elírások kiküszöbölésére egy beépített függvényvizsgálatot hívunk
$safeHandlerFunction = function_exists($handlerFunction) ? $handlerFunction : "notFoundHandler";
$safeHandlerFunction();

function homeHandler()
{
    require "./views/home.php";
}

function productListHandler()
{
    $content = file_get_contents("./products.json");
    $products = json_decode($content, true);
    //echo "<pre>";
    //var_dump($products);
    $isSuccess = isset($_GET["siker"]);  //ha létezik ez a query paraméter true lesz, ha nem akkor faults
    require "./views/product-list.php";
}

function createProductHandler()
{
    $newProduct = [
        "name" => $_POST["name"],
        "price" => (int)$_POST["price"]
    ];

    //lekérjük a termékeket
    $content = file_get_contents("./products.json");
    $products = json_decode($content, true);
    // módosítjuk a terméklistát az új elemmel
    array_push($products, $newProduct);
    // vissza alakítjuk json formátummá a kibővített terméklistát
    $json = json_encode($products);
    // módosítjuk a products.json fájlunkat
    file_put_contents("./products.json", $json);

    header("Location: /KODB_PHP10/termekek?siker=1");
}

function notFoundHandler()
{
    echo "Az oldal nem talélható";
}
?>
