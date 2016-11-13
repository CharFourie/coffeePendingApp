<?php

    require_once __DIR__.'/vendor/autoload.php';
    require_once 'cafes.php';

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET,POST,HEAD,DELETE,PUT,OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type,X-Bearer-Token");

    // Silex support for accessing the HTTP Request and Response
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\ParameterBag;

    date_default_timezone_set("Africa/Johannesburg");
    $app = new Silex\Application();

    // After receiving a request, before doing anything else
    $app->before(function (Request $request)
    {
        // If we received JSON
        if (0 === strpos($request->headers->get('Content-Type'), 'application/json'))
        {
            // Decode it
            $data = json_decode($request->getContent(), true);
            // And replace the encoded data with the decoded data
            $request->request->replace(is_array($data) ? $data : array());
        }
    });

    // Return "OK" for all OPTIONS, no matter the url
    $app->match("{url}", function($url) use ($app)
    {
        return "OK";
    })->assert('url', '.*')->method("OPTIONS");

    
    $app->get('/cafes', function(Request $request)
    {
        return json_encode(cafes_index());
    });

    $app->run();

?>