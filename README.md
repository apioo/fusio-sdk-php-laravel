
# Fusio SDK Laravel

This library integrates the [Fusio SDK](https://github.com/apioo/fusio-sdk-php) into Laravel. That means you can control
the complete Fusio backend API through your laravel application.

## Configuration

In order to access the API you need to provide an `base_uri` and `access_token` at the config. By default we load this
data from the config, but you can also provide a custom `TokenStoreInterface` to i.e. get this data from a database.

## Usage

List available routes:

```php

$entries = BackendClient::getBackendRoutes()->backendActionRouteGetAll(null)->getEntry();

foreach ($entries as $entry) {
    echo $entry->getPath() . "\n";
}

```

Create a new action, which can be attache to a route:

```php

$config = new \Fusio\Sdk\Backend\Action_Config();
$config['response'] = \json_encode(['hello' => 'world']);

$action = new \Fusio\Sdk\Backend\Action_Create();
$action->setName('my-new-action');
$action->setClass('Fusio\Adapter\Util\Action\UtilStaticResponse');
$action->setConfig($config);

$response = BackendClient::getBackendAction()->backendActionActionCreate($action);

echo $response->getMessage() . "\n";

```
