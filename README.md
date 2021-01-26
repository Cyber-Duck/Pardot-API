# Pardot-API
PHP package to interact with the Pardot API

[![Latest Stable Version](https://poser.pugx.org/cyber-duck/pardot-api/v/stable)](https://packagist.org/packages/cyber-duck/pardot-api)
[![Latest Unstable Version](https://poser.pugx.org/cyber-duck/pardot-api/v/unstable)](https://packagist.org/packages/cyber-duck/pardot-api)
[![Total Downloads](https://poser.pugx.org/cyber-duck/pardot-api/downloads)](https://packagist.org/packages/cyber-duck/pardot-api)
[![License](https://poser.pugx.org/cyber-duck/pardot-api/license)](https://packagist.org/packages/cyber-duck/pardot-api)

Author: [Andrew Mc Cormack](https://github.com/Andrew-Mc-Cormack)

## Pardot API PHP Library

A library to integrate with the Pardot API through PHP objects

This library simplifies the process of authentication and querying the Pardot API and provides access to all of the v4 API features. 

Latest Version 2.0.0 supports Salesforce SSO authentication.

### Setup

To initalise the Pardot API object pass your user email, password, client id, client secret and business unit id credentials.
Any subsequent request to fetch data from the API will automatically perform the authentication actions before trying to fetch data.

```php
use CyberDuck\PardotApi\PardotApi;

$pardot = new PardotApi(
    'EMAIL',
    'PASSWORD',
    'CLIENT_ID',
    'CLIENT_SECRET',
    'BUSINESS_UNIT_ID',
);
```

## Querying the API

You can call the query method on an any pardot object passing the object, operator, and data array (optional)

```php
$result = $pardot->request('campaign', 'read/id/1');

$result = $pardot->request('campaign', 'query', ['created_after' => 'today']);
```

## Object Methods

The PardotApi instance has functions which correspond to the object types in Pardot to simplify calls to the API.
When calling one of these functions a query object is returned (->campaigns() returns a CampaignsQuery object).
These returned objects in turn have functions corresponding to different object actions such as query, create, update, insert, delete etc.
The full list of objects available are as follows:

### Account methods

```php
$pardot->account()->read(); // retrieves current account information
```

### Campaign methods

```php
$pardot->campaign()->query([...]); // queries and returns a filtered list
$pardot->campaign()->create([...]); // creates an object using passed array data
$pardot->campaign()->read(1); // queries an object by ID
$pardot->campaign()->update(1, [...]); // updates an object by ID using passed array data 
```

### Custom Fields methods

```php
$pardot->customField()->query([...]); // queries and returns a filtered list
$pardot->customField()->create([...]); // creates an object using passed array data
$pardot->customField()->read(1); // queries an object by ID
$pardot->customField()->update(1, [...]); // updates an object by ID using passed array data 
$pardot->customField()->delete(1); // deletes an object by ID
```

### Custom Redirects methods

```php
$pardot->customRedirect()->query([...]); // queries and returns a filtered list
$pardot->customRedirect()->read(1); // queries an object by ID
```

### Dynamic Content methods

```php
$pardot->dynamicContent()->query([...]); // queries and returns a filtered list
$pardot->dynamicContent()->read(1); // queries an object by ID
```

### Email Clicks methods

```php
$pardot->emailClick()->query([...]); // queries and returns a filtered list
```

### Email methods

```php
$pardot->email()->read(1); // queries an object by ID
$pardot->email()->stats(1); // Returns the statistical data for the list email 
$pardot->email()->sendToID(1, [...]); // Sends a 1 to 1 email to an ID using an array of email config / data
$pardot->email()->sendToEmail('name@example.com', [...]); // Sends a 1 to 1 email to a email address an array of email config / data
$pardot->email()->send([...]); // send an email to a list of IDs
```

### Email Templates methods

```php
$pardot->emailTemplate()->listOneToOne(); // Returns a list of email templates used in 1 to 1 emails
```

### Forms methods

```php
$pardot->form()->query([...]); // queries and returns a filtered list
$pardot->form()->read(1); // queries an object by ID
```

### Lifecycle Histories methods

```php
$pardot->lifecycleHistory()->query([...]); // queries and returns a filtered list
$pardot->lifecycleHistory()->read(1); // queries an object by ID
```

### Lifecycle Stages methods

```php
$pardot->lifecycleStage()->query([...]); // queries and returns a filtered list
```

### List Memberships methods

```php
// @todo
```

### Lists methods

```php
// @todo
```

### Opportunities methods

```php
// @todo
```

### Prospect Accounts methods

```php
// @todo
```

### Prospects methods

```php
// @todo
```

### Tag Objects methods

```php
$pardot->tagObject()->query([...]); // queries and returns a filtered list
$pardot->tagObject()->read(1); // queries an object by ID
```

### Tags methods

```php
$pardot->tag()->query([...]); // queries and returns a filtered list
$pardot->tag()->read(1); // queries an object by ID
```

### Users methods

```php
$pardot->user()->query([...]); // queries and returns a filtered list
$pardot->user()->read(1); // queries an object by ID
$pardot->user()->readByEmail('name@example.com'); // queries an object by email
```

### Visitor Activities methods

```php
// @todo
```

### Visitors methods

```php
$pardot->visitor()->query([...]); // queries and returns a filtered list
$pardot->visitor()->read(1); // queries an object by ID
$pardot->visitor()->assign(1,2); // Assigns or reassigns the visitor by ID to a prospect ID.
```

### Visits methods

```php
$pardot->visit()->query([...]); // queries and returns a filtered list
$pardot->visit()->read(1); // queries an object by ID
```

## Debugging

Error messages can be enabled by turning debugging on. Requests to the Pardot API will fail silently by default so as to prevent
fatal application errors. Extra response checking should be conducted when implementing this library as most methods will return
null when there is an issue with the API query.

```php
$pardot->setDebug(true);
```

## Output Type

You can change the output type to full, simple, mobile, or bulk. Defaults to full.

```php
$pardot->setOuput('full');
```

