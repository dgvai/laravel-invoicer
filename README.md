# Invoicer - Invoice Generator Package for Laravel

[![Latest Stable Version](https://poser.pugx.org/dgvai/laravel-invoicer/v/stable)](https://packagist.org/packages/dgvai/laravel-invoicer)
[![Total Downloads](https://poser.pugx.org/dgvai/laravel-invoicer/downloads)](https://packagist.org/packages/dgvai/laravel-invoicer)
[![Latest Unstable Version](https://poser.pugx.org/dgvai/laravel-invoicer/v/unstable)](https://packagist.org/packages/dgvai/laravel-invoicer)
[![License](https://poser.pugx.org/dgvai/laravel-invoicer/license)](https://packagist.org/packages/dgvai/laravel-invoicer)
[![Monthly Downloads](https://poser.pugx.org/dgvai/laravel-invoicer/d/monthly)](https://packagist.org/packages/dgvai/laravel-invoicer)
[![Daily Downloads](https://poser.pugx.org/dgvai/laravel-invoicer/d/daily)](https://packagist.org/packages/dgvai/laravel-invoicer)
[![composer.lock](https://poser.pugx.org/dgvai/laravel-invoicer/composerlock)](https://packagist.org/packages/dgvai/laravel-invoicer)
    
This package is built for Invoice Management and Generation for Laravel 5.5+, 6.x, 7.x (not tested for lower versions)

## Contents

<!-- TOC -->

- [Invoicer - Invoice Generator Package for Laravel](#invoicer---invoice-generator-package-for-laravel)
    - [Contents](#contents)
    - [Installation](#installation)
        - [Publish Configuration](#publish-configuration)
        - [Setup and configure](#setup-and-configure)
    - [Usage](#usage)
        - [Generate Invoice](#generate-invoice)
    - [Available Methods](#available-methods)
        - [Setup Invoice](#setup-invoice)
        - [Setup Buyer Informations](#setup-buyer-informations)
        - [Set Shipping Address](#set-shipping-address)
        - [Add Items](#add-items)
        - [Set Payment State](#set-payment-state)
        - [Generate](#generate)
    - [Changelog](#changelog)
    - [License](#license)

<!-- /TOC -->

## Installation

You can install the package via composer:

``` bash
    composer require dgvai/laravel-invoicer
```

### Publish Configuration

Publish configuration file

```bash
    php artisan vendor:publish --provider="DGvai\Invoicer\InvoicerServiceProvider"
```

### Setup and configure

You can update your app environment (.env) (If needed). The environment Values are all your choice. Peek a look at ``config/invoicer.php``

**Configure** your configuration file, the required details for the values are documentated as commented in ``config/invoicer.php`` file.

After done configuraing
```bash
    php artisan config:cache
```

## Usage

### Generate Invoice
From your controller:

``` php

use DGvai\Invoicer\Invoicer;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function show()
    {

        $invoice = new Invoicer();
        $invoice->setupInvoice('#HDG-4657F-DH8')
                ->setBuyer('John Doe','email@email.com','0100001000')
                ->setShippingAddr('0/3B Abul Tabul Conference Road, DG Street, China');

        $invoice->addItem('Lorem Ipsum Product Name 1',3.5,'Pc',230.5,20)
                ->addItem('Lorem Ipsum Product Name 2',3,'Kg',120.33,10.2,60)
                ->addItem('Bigger Abul Tabul Product Name This Time',1,'Pc',550.52,10,10);

        $invoice->setPaymentState('UNPAID','important','Pay before 24-02-2020');

        $pdf = $invoice->generate();

        if($pdf->success)
        {
            return $pdf->filename;
        }
    }
}
```
**NOTE** This is the minimalist basic need to generate invoice PDF.  
**Example PDF** Have look at this [example](examples/demofile.pdf) pdf generated.

## Available Methods

### Setup Invoice
**Description:** Setup the invoice.
```php
    setupInvoice($invoice_no, $issue_date = null)
```
**Params**  
<kbd>required</kbd> Invoice No : ``string``  
<kbd>optional</kbd> Issue Date : ``string`` : By default it will take current date.  

### Setup Buyer Informations
**Description:** Set the buyer/user information.
```php
    setBuyer($name, $email, $phone = null)
```
**Params**  
<kbd>required</kbd> Buyer Name : ``string``  
<kbd>required</kbd> Buyer Email : ``string``  
<kbd>optional</kbd> Buyer Phone : ``string``  

### Set Shipping Address
**Description:** Set the buyer/user shiiping address.
```php
    setShippingAddr($address)
```
**Params**  
<kbd>required</kbd> Buyer Shipping Address : ``string``  

### Add Items
**Description:** Add the items buyer/user bought, eg. from cart or order history.
```php
    addItem($title, $qty, $unit, $unit_price, $discount, $shipping_cost = 0)
```
**Params**  
<kbd>required</kbd> Item Title : ``string``  
<kbd>required</kbd> Item Quantity : ``integer/float``   
<kbd>required</kbd> Item Unit : ``string``  : eg. Pc/Kg/Plate...  
<kbd>required</kbd> Item Unit Price : ``decimal``  
<kbd>required</kbd> Item Discount : ``decimal``  
<kbd>optional</kbd> Item Shipping Cost : ``decimal``  

### Set Payment State
**Description:** Set the payment state of the invoice. Also add some notes.
```php
    setPaymentState($state, $label='info', $additional=null)
```
**Params**  
<kbd>required</kbd> State : ``string``  : eg. PAID, UNPAID, PENDING...   
<kbd>optional</kbd> Label : ``enums`` : [success/important/warning]  
<kbd>optional</kbd> Additional : ``string`` : Additional note on payment to show  

### Generate
**Description:** Generate the Invoice PDF.
```php
    generate($path_to_save=null)
```
**Params**  
<kbd>optional</kbd> Path/to/filename.pdf : ``string`` : The full path of saving with filename. By default it will save on ``public/invoices`` path.


## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
