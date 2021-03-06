# Yii2 PayPal

![License](https://img.shields.io/packagist/l/cinghie/yii2-paypal.svg)
![Latest Stable Version](https://img.shields.io/github/release/cinghie/yii2-paypal.svg)
![Latest Release Date](https://img.shields.io/github/release-date/cinghie/yii2-paypal.svg)
![Latest Commit](https://img.shields.io/github/last-commit/cinghie/yii2-paypal.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/cinghie/yii2-paypal.svg)](https://packagist.org/packages/cinghie/yii2-paypal)

Yii2 PayPal Extension to manage: 

 - PayPal Payments: https://www.paypal.com
 - BrainTree Payments (PayPal Service): https://www.braintreepayments.com
 - HyperWallet Payments (PayPal Service): https://www.hyperwallet.com

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require cinghie/yii2-paypal "@dev"
```

or add this line to the require section of your `composer.json` file.

```
"cinghie/yii2-paypal": "@dev"
```

## PayPal

### Get credentials

1. Log into Dashboard and type your PayPal business account email and password.

2. In the REST API apps section, click Create App. The purpose of this app is to generate your credentials.

3. Type a name for your app and click Create App. The page shows your sandbox app information, which includes your credentials.  
Note: To show your live app information, toggle to Live.

4. Copy and save the client ID and secret for your sandbox app.

5. Review your app details and save your app.

### Create sandbox accounts

1. Log into Dashboard and type your PayPal business account email and password.  
Note: If you do not have a business account, click Sign Up.

2. Under Sandbox, click Accounts and click Create Account.

3. To create the buyer account, select the personal account type.  
Type these required and any optional fields and click Create Account:  
  
   - Email Address: A fake or valid email address.  
   If you use a valid address, you receive email notifications when you run test transactions    
   - Password: An easy-to-remember password, such as 12345678  
   - PayPal Balance: A high amount, such as 5000  

4. To create the merchant account, select the business account type, type account information, and click Create Account  

### Documentation

Documentation: http://paypal.github.io/PayPal-PHP-SDK/docs/   
Sample: http://paypal.github.io/PayPal-PHP-SDK/sample/    
Sandbox: https://www.sandbox.paypal.com/  
SDK PHP: https://github.com/paypal/PayPal-PHP-SDK/  
Support: https://developer.paypal.com/support/  
Wiki: https://github.com/paypal/PayPal-PHP-SDK/wiki  

## Configuration

Add in your common configuration file:

```
use cinghie\paypal\components\Paypal as PaypalComponent;
use cinghie\paypal\Paypal as PaypalModule;

'components' => [

    'paypal' => [
    	'class'        => 'cinghie\paypal\components\Paypal',
    	'clientId'     => 'YOUR_CLIENT_ID',
    	'clientSecret' => 'YOUR_CLIENT_SECRET',
    	'isProduction' => false,
    	'config' => [
    		'mode' => 'sandbox', // 'sandbox' (development mode) or 'live' (production mode)
    	]
    ]
    
],

'modules' => [

    'paypal' => [ 
    	'class' => PaypalModule::class, 
    	'paypalRoles' => ['admin'],
    	'showTitles' => false,
    ]
    
]
```

<ul>
  <li>clientid => your PayPal clientId</li>
  <li>clientSecret => your PayPal clientSecret</li>
  <li>isProduction => set yes if your site is on Production Mode, false otherwise</li>
  <li>mode => set 'sandbox' if your site is on Development Mode, or 'live' on Production Mode</li>
</ul>

You can set advanced settings in config array:

```
'config' => [
	'mode' => 'sandbox', // 'sandbox' (development mode) or 'live' (production mode)
	'http.ConnectionTimeOut' => 30,
	'http.Retry' => 1,
	'log.LogEnabled' => YII_DEBUG ? 1 : 0,
	'log.FileName' => '@runtime/logs/paypal.log',
	'log.LogLevel' => 'ERROR',
],
```

Add in your configuration file, in module section:

```
'paypal' => [
	'class' => 'cinghie\paypal\Paypal',
	'paypalRoles' => ['admin'],
	'showTitles' => false,
],
```

Add in your backend configuration file:

```
use cinghie\paypal\filters\BackendFilter as PaypalBackendFilter;

'modules' => [

    'paypal' => [
        'as backend' => PaypalBackendFilter::class,
    ],    

]
```

Add in your frontend configuration file:

```
use cinghie\paypal\filters\FrontendFilter as PaypalFrontendFilter;

'modules' => [

    'paypal' => [
        'as backend' => PaypalBackendFilter::class,
    ],  

]
```

## BrainTreee Configuration

Add in your common configuration file:

```
use cinghie\paypal\components\Braintree as BraintreeComponent;

'braintree' => [
	'class' => BraintreeComponent::class,
	'environment' => 'sandbox',
	'merchantId' => 'your_merchant_id',
	'publicKey' => 'your_public_key',
	'privateKey' => 'your_private_key'
],
```

## HyperWallet Configuration

Add in your common configuration file:

```
use cinghie\paypal\components\Hyperwallet as HyperwalletComponent;

'hyperwallet' => [
	'class' => HyperwalletComponent::class,
	'username' => 'HYPERWALLET_SERVER',
	'password' => 'HYPERWALLET_PASSWORD',
	'token' => 'HYPERWALLET_PROGRAM_TOKEN',
	'server' => 'https://sandbox.hyperwallet.com'
],
```

## Create database schema

Run the following command:

```
$ php yii migrate/up --migrationPath=@vendor/cinghie/yii2-paypal/migrations
```

## Use Component

```
\Yii::$app->braintree;
\Yii::$app->hyperwallet;
\Yii::$app->paypal;
```

## Use Demo (Only in Sandbox mode)

```
$demo = new \cinghie\paypal\models\Demo();
$demo->payByCreditCardDemo();
$demo->payByPaypalDemo();
```
