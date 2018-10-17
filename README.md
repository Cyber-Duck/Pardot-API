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

### Setup

To initalise the Pardot API object pass your user email, password, and user key credentials.

```php
use CyberDuck\PardotApi\PardotApi;

$pardot = new PardotApi(
    'EMAIL',
    'PASSWORD',
    'USER_KEY'
);
```

## Method Objects

Methods can be called on the PardotApi instance which correspond to the object types in Pardot. 
When calling a method a specific Object instance is returned granting access to the object methods.
Response are either arrays of or single PHP stdClass objects.
The full list of objects available are as follows:

### Account methods

```php
$pardot->account()->read(); // retrieves current account information
```

### Campaign methods

```php
$pardot->campaigns()->query([...]); // queries and returns a filtered list
$pardot->campaigns()->create([...]); // creates an object using passed array data
$pardot->campaigns()->read(1); // queries an object by ID
$pardot->campaigns()->update(1, [...]); // updates an object by ID using passed array data 
```

### Custom Fields methods

```php
$pardot->customFields()->query([...]); // queries and returns a filtered list
$pardot->customFields()->create([...]); // creates an object using passed array data
$pardot->customFields()->read(1); // queries an object by ID
$pardot->customFields()->update(1, [...]); // updates an object by ID using passed array data 
$pardot->customFields()->delete(1); // deletes an object by ID
```

### Custom Redirects methods

```php
$pardot->customRedirects()->query([...]); // queries and returns a filtered list
$pardot->customRedirects()->read(1); // queries an object by ID
```

### Dynamic Content methods

```php
$pardot->dynamicContent()->query([...]); // queries and returns a filtered list
$pardot->dynamicContent()->read(1); // queries an object by ID
```

### Email Clicks methods

```php
$pardot->emailClicks()->query([...]); // queries and returns a filtered list
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
$pardot->forms()->query([...]); // queries and returns a filtered list
$pardot->forms()->read(1); // queries an object by ID
```

### Lifecycle Histories methods

```php
$pardot->lifecycleHistories()->query([...]); // queries and returns a filtered list
$pardot->lifecycleHistories()->read(1); // queries an object by ID
```

### Lifecycle Stages methods

```php
$pardot->lifecycleStages()->query([...]); // queries and returns a filtered list
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
$pardot->tagObjects()->query([...]); // queries and returns a filtered list
$pardot->tagObjects()->read(1); // queries an object by ID
```

### Tags methods

```php
$pardot->tags()->query([...]); // queries and returns a filtered list
$pardot->tags()->read(1); // queries an object by ID
```

### Users methods

```php
$pardot->users()->query([...]); // queries and returns a filtered list
$pardot->users()->read(1); // queries an object by ID
$pardot->users()->readByEmail('name@example.com'); // queries an object by email
```

### Visitor Activities methods

```php
// @todo
```

### Visitors methods

```php
$pardot->visitors()->query([...]); // queries and returns a filtered list
$pardot->visitors()->read(1); // queries an object by ID
$pardot->visitors()->assign(1,2); // Assigns or reassigns the visitor by ID to a prospect ID.
```

### Visits methods

```php
$pardot->visits()->query([...]); // queries and returns a filtered list
$pardot->visits()->read(1); // queries an object by ID
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

