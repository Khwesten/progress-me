<?php
// Routes

$app->post('/query/select', function ($request, $response, $args) {
    $query = $request->getParsedBody()['query'];

    $this->logger->info("Route: '/query/select', query: '{$query}'");

    try {
        $json = \controller\Query::select($query);
    } catch (Exception $exc) {
        $response = $response->withStatus(400);
        $response->getBody()->write($exc->getMEssage());

        return $response;
    }

    return $response->getBody()->write($json);
});

$app->post('/query/insert', function ($request, $response, $args) {
    $query = $request->getParsedBody()['query'];

    $this->logger->info("Route: '/query/insert', query: '{$query}'");

    try {
        $json = \controller\Query::insert($query);
    } catch (Exception $exc) {
        $response = $response->withStatus(400);
        $response->getBody()->write($exc->getMEssage());

        return $response;
    }

    return $response->getBody()->write($json);
});

$app->post('/query/update', function ($request, $response, $args) {
    $query = $request->getParsedBody()['query'];

    $this->logger->info("Route: '/query/update', query: '{$query}'");

    try {
        $json = \controller\Query::update($query);
    } catch (Exception $exc) {
        $response = $response->withStatus(400);
        $response->getBody()->write($exc->getMEssage());

        return $response;
    }

    return $response->getBody()->write($json);
});

$app->post('/query/delete', function ($request, $response, $args) {
    $query = $request->getParsedBody()['query'];

    $this->logger->info("Route: '/query/delete', query: '{$query}'");

    try {
        $json = \controller\Query::delete($query);
    } catch (Exception $exc) {
        $response = $response->withStatus(400);
        $response->getBody()->write($exc->getMEssage());

        return $response;
    }

    return $response->getBody()->write($json);
});
