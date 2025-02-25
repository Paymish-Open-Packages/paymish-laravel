# Paymish Laravel Package

This is a Laravel package for integrating the Paymish payment gateway into your Laravel applications.

## Installation

Install the package using Composer:

```
composer require paymish/paymish-laravel
```

Publish the configuration file:

```
php artisan paymish:publish --tag=paymish-config
```

Add your Paymish credentials to the `.env` file:

```
PAYMISH_BASE_URL=https://production-api.paymish.com/api/
PAYMISH_PUBLIC_KEY=your_public_key_here
PAYMISH_SECRET_KEY=your_secret_key_here
```

## Configuration

The package uses a configuration file located at `config/paymish.php`. Ensure your `.env` variables are properly set.

## Usage

### Initialize Payment

```
use Paymish\Facades\Paymish;

$transaction = Paymish::initializePayment([
    'amount' => 5000,
    'email' => 'customer@example.com',
    'currency' => 'NGN',
    'callback_url' => 'https://yourwebsite.com/callback',
]);
```

### Create a Split Code

```
$split = Paymish::createSplitCode([
    'name' => 'Revenue Split',
    'type' => 'percentage',
    'currency' => 'NGN',
    'integration' => 0,
    'domain' => 'test',
    'active' => true,
    'is_dynamic' => true,
    'subaccounts' => [
        [
            'share' => 40,
            'subaccount' => 'SUB_ABC123'
        ]
    ]
]);
```

### Create a Subaccount

```
$subaccount = Paymish::createSubaccount([
    'business_name' => 'Tech Corp',
    'account_number' => '1234567890',
    'percentage_charge' => 5,
    'currency' => 'NGN',
    'bank' => 999004,
    'account_name' => 'Tech Corp Ltd'
]);
```

### Get All Subaccounts

```
$subaccounts = Paymish::getAllSubaccounts();
```

### Get a Subaccount by ID

```
$subaccount = Paymish::getSubaccountById('SUB_ABC123');
```

### Update a Subaccount

```
$updatedSubaccount = Paymish::updateSubaccount('SUB_ABC123', [
    'business_name' => 'Updated Corp',
    'percentage_charge' => 10
]);
```

### Delete a Subaccount

```
$deleted = Paymish::deleteSubaccount('SUB_ABC123');
```

## Webhooks

To handle Paymish webhooks, set up the following route in your Laravel application:

```
use Illuminate\Support\Facades\Route;
use Paymish\Controllers\WebhookController;

Route::post('/paymish/webhook', [WebhookController::class, 'handle'])->name('paymish.webhook');
```

## License

This package is open-source and available under the MIT License.
