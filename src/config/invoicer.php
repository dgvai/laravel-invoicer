<?php 

    return [

        /**
         * COMPANY DETAILS
         * ------------------------------
         * The details of the company to 
         * be displayed on the invoice
         * 
         */

        'company' => [
            'name'  =>  env('INVOICER_COMPANY_NAME','Compnay Name'),
            'address'  =>  env('INVOICER_COMPANY_ADDRESS', null),
            'email'  =>  env('INVOICER_COMPANY_EMAIL','shop@mail.com'),
            'phone'  =>  env('INVOICER_COMPANY_PHONE','+01000000000'),
        ],

        /**
         * THEME COLOR
         * ------------------------------
         * The theme color of the invoice
         * 
         */

        'theme' =>  [
            'color' =>  env('INVOICER_THEME_COLOR','#6a1b9a')
        ],

        /**
         * INVOICE TITLES
         * ------------------------------
         * The titles on the invoice
         * 
         */

        'invoice' =>  [
            'title' =>  env('INVOICER_INVOICE_TITLE','Invoice'),
            'issue' =>  env('INVOICER_INVOICE_ISSUE','Issued at'),
            'bill' =>  env('INVOICER_INVOICE_BILL','Billed To'),
            'address' =>  env('INVOICER_INVOICE_ADDRESS','Shipping Address'),
            'footer' =>  env('INVOICER_INVOICE_FOOTER','Thank You!'),
        ],

        /**
         * TABLE HEADER TITLES
         * ------------------------------
         * The titles on the invoice table
         * 
         */

        'header' =>  [
            'sl' =>  env('INVOICER_HEADER_SL','#'),
            'title' =>  env('INVOICER_HEADER_TITLE','Product Name'),
            'qty' =>  env('INVOICER_HEADER_QTY','Qty'),
            'unit' =>  env('INVOICER_HEADER_UNIT','Unit Price'),
            'discount' =>  env('INVOICER_HEADER_DISCOUNT','Discount'),
            'extra' =>  env('INVOICER_HEADER_EXTRA','Extra Cost'),
            'addship' =>  env('INVOICER_HEADER_ADDSHIP','Add. Shipping'),
            'subtotal' =>  env('INVOICER_HEADER_DISCOUNT','Subtotal'),
            'sumtotal' =>  env('INVOICER_HEADER_TOTAL','Sum Total'),
            'shipping' =>  env('INVOICER_HEADER_SHIPPING','Shipping Cost'),
            'homecost' =>  env('INVOICER_HEADER_HOMECOST','Home Delivery Cost'),
            'coupon' =>  env('INVOICER_HEADER_COUPON','Coupon Discount'),
        ],

        /**
         * DISCOUNT TYPE
         * ------------------------------
         * It is required in or to 
         * decide ho discount is given to
         * your product
         * 
         * 1 = Per Unit Item (default)
         * 2 = From Total
         * 
         */

        'discount_type' =>  '1',

        /**
         * CURRENCY
         * ------------------------------
         * The currency shown at invoice
         * Ex: USD, BDT, $ ..
         * 
         */

        'currency'  =>  'BDT',

        /**
         * VAT/TAX SETTINGS
         * -------------------------------
         * The settings for VAT/TAX
         * of your company
         * 
         */

        'vat' => [
            'allowed' => env('INVOICER_VAT_ALLOW',false),
            'percent' => env('INVOICER_VAT_PERCENT','15'),
            'title' => env('INVOICER_VAT_TITLE','VAT Reg. No'),
            'number' => env('INVOICER_VAT_NUMBER','000-00000-00000-0'),
        ],

        'enabled' => [
            'extra' => false,
            'addship' => false,
        ]


    ];