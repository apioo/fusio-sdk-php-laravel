
# Fusio SDK Laravel

This library integrates the [Fusio SDK](https://github.com/apioo/fusio-sdk-php) into Laravel. That means you can control
the complete Fusio backend API through your laravel application.

## Configuration

In order to access the API you need to provide a `base_uri`, `app_key` and `app_secret` at the config. By default, we
load this data from the config.

## Usage

### Backend

Create an action:

```php

$config = new \Fusio\Sdk\Backend\Action_Config();
$config['response'] = \json_encode(['hello' => 'world']);

$action = new \Fusio\Sdk\Backend\Action_Create();
$action->setName('my-new-action');
$action->setClass('Fusio\Adapter\Util\Action\UtilStaticResponse');
$action->setConfig($config);

$response = FusioClient::backend()->getBackendAction()->backendActionActionCreate($action);

echo $response->getMessage() . "\n";

```

Create an app:

```php

$app = new \Fusio\Sdk\Backend\App_Create();
$app->setStatus(1);
$app->setUserId(1);
$app->setName('my-new-action');
$app->setUrl('https://myapp.com');
$app->setScopes(['foo', 'bar']);

$response = FusioClient::backend()->getBackendApp()->backendActionAppCreate($app);

echo $response->getMessage() . "\n";

```

Create a route:

```php

$get = new \Fusio\Sdk\Backend\Route_Method();
$get->setActive(true);
$get->setPublic(true);
$get->setDescription('My GET description');
$get->setOperationId('my_get_operation_id');
$get->setResponse('My_Response_Schema');
$get->setAction('My_Action');

$methods = new \Fusio\Sdk\Backend\Route_Methods();
$methods['GET'] = $get;

$version = new \Fusio\Sdk\Backend\Route_Version();
$version->setVersion(1);
$version->setStatus(1);
$version->setMethods($methods);

$route = new \Fusio\Sdk\Backend\Route_Create();
$route->setPath('/new/path');
$route->setController('Fusio\Impl\Controller\SchemaApiController');
$route->setConfig([$version]);

$response = FusioClient::backend()->getBackendRoutes()->backendActionRouteCreate($route);

echo $response->getMessage() . "\n";

```

Get routes:

```php

$entries = FusioClient::backend()->getBackendRoutes()->backendActionRouteGetAll(null)->getEntry();

foreach ($entries as $entry) {
    echo $entry->getPath() . "\n";
}

```

### Consumer

Change password:

```php

$changePassword = new \Fusio\Sdk\Consumer\Account_ChangePassword();
$changePassword->setOldPassword('test1234');
$changePassword->setNewPassword('test1234!');
$changePassword->setVerifyPassword('test1234!');

$response = FusioClient::consumer()->getConsumerAccountChangePassword()->consumerActionUserChangePassword($changePassword);

echo $response->getMessage() . "\n";

```
