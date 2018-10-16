# Pardot-API
PHP package to interact with the Pardot API

[![Latest Stable Version](https://poser.pugx.org/cyber-duck/Pardot-API/v/stable)](https://packagist.org/packages/cyber-duck/Pardot-API)
[![Latest Unstable Version](https://poser.pugx.org/cyber-duck/Pardot-API/v/unstable)](https://packagist.org/packages/cyber-duck/Pardot-API)
[![Total Downloads](https://poser.pugx.org/cyber-duck/Pardot-API/downloads)](https://packagist.org/packages/cyber-duck/Pardot-API)
[![License](https://poser.pugx.org/cyber-duck/Pardot-API/license)](https://packagist.org/packages/cyber-duck/Pardot-API)

Author: [Andrew Mc Cormack](https://github.com/Andrew-Mc-Cormack)

## Pardot API PHP Library

A library to integrate with the Pardot API through PHP objects

This library simplifies the process of authentication and querying the Pardot API and provides access to all of the v4 API features.

### Setup

To initalise the Pardot API object pass your user email, password, and key credentials.

```php
use CyberDuck\Pardot\PardotApi;

$pardot = new PardotApi(
    'EMAIL',
    'PASSWORD',
    'USER_KEY'
);
```

## Debugging

Error messages can be enabled by turning debugging on. Requests to the Pardot API will fail silently by default so as to prevent
fatal application errors. Extra response checking should be conducted when implementing this library as most methods will return
null when there is an issue with the API query.

```php
$pardot->setDebug(true);
```

## Method Objects

Methods can be called on the PardotApi instance which correspond to the object types in Pardot. When calling a method a specific Object instance is returned granting access to the object query methods.

```php
$pardot->account(); // returns an account object instance
$pardot->account()->read(); // calls an account object query method to return a result
```

The above read() call would return the account information similar to the below XML code.

```xml
<rsp stat="ok" version="1.0">
    <account>
        <id>1</id>
        <company>Company Name</company>
        <level>Pardot Account Level</level>
        <website>http://www.company-website.com</website>
        <vanity_domain>http://go.localhost.com</vanity_domain>
        <plugin_campaign_id>1</plugin_campaign_id>
        <tracking_code_template>[... Tracking code template ...]</tracking_code_template>
        <address1>1234 Any Streep</address1>
        <address2>Suite 9876</address2>
        <city>Atlanta</city>
        <state>Georgia</state>
        <territory/>
        <zip>30326</zip>
        <country>United States</country>
        <phone>555-555-5555</phone>
        <fax/>
        <created_at>2008-03-26 09:42:51</created_at>
        <updated_at>2016-11-10 15:06:33</updated_at>
    </account>
</rsp>
```

The full list of objects available are as follows:

```php
$pardot->account();
$pardot->campaigns();
$pardot->customFields();
$pardot->customRedirects();
$pardot->dynamicContent();
$pardot->emailClicks();
$pardot->email();
$pardot->emailTemplates();
$pardot->forms();
$pardot->lifecycleHistories();
$pardot->lifecycleStages();
$pardot->listMemberships();
$pardot->lists();
$pardot->opportunities();
$pardot->prospectAccounts();
$pardot->prospects();
$pardot->tagObjects();
$pardot->tags();
$pardot->users();
$pardot->visitorActivities();
$pardot->visitors();
$pardot->visits();
```
