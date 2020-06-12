@php 
$colspan = 4;
@endphp
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{asset('vendor/invoicer/bootstrap2.min.css')}}">
        <link rel="stylesheet" href="{{asset('vendor/invoicer/bootstrap2-responsive.min.css')}}">

        <title>Invoice</title>
    </head>
    <style>
        @page{margin: 0;padding: 0}body{margin: 0;padding: 0;font-family: Arial, Helvetica, sans-serif}h3{margin-bottom: 0}.header p{width: 50%}.fg-main{color: {{config('invoicer.theme.color')}}}.bg-main{background-color: {{config('invoicer.theme.color')}}; color: #FFFFFF}.mt-2{margin-top:40px}.mt-2-5{margin-top:50px}.mt-3{margin-top:60px}.block{display: block}.inline-block{display: inline-block}.title{font-weight: bold}.small{font-size: 12px}.smaller{font-size: 10px}.container-fluid{padding: 10px;margin: 10px 30px}.float-right{text-align: right !important}.float-left{text-align: left !important}.float-center{text-align: center !important}.bottom-class{position: absolute;bottom: 0}.no-top-tr{border-top: 0}
    </style>
    <body>
        <div class="container-fluid"> 
            <div class="row header">
                <div class="span6">
                    <h1 class="fg-main">{{config('invoicer.company.name')}}</h1>
                    <p>{{config('invoicer.company.address')}}</p>
                </div>
                <div class="span3 mt-3 text-right">
                    <span>Email: </span> <span>{{config('invoicer.company.email')}}</span><br>
                    <span>Phone: </span> <span>{{config('invoicer.company.phone')}}</span>
                </div>
            </div>
            <div class="row">
                <div class="span6 text-left">
                    <h3>{{config('invoicer.invoice.title')}}</h3>
                </div>
                <div class="span3 text-right">
                    <h3>{{$that->invoice_no}}</h3>
                    <span class="small">{{config('invoicer.invoice.issue')}}: {{$that->issue_date}}</span>
                </div>
            </div>
            <div class="row">
                <div class="span6 text-left">
                    <h3>{{config('invoicer.invoice.bill')}}</h3>
                    <span class="block title">{{$that->buyer_name}}</span>
                    <span class="block small">{{$that->buyer_email}}</span>
                    <span class="block small">{{$that->buyer_phone}}</span>
                </div>
                <div class="span3 text-left">
                    <span class="block title mt-2-5">{{config('invoicer.invoice.address')}}</span>
                    <p class="small">{{$that->shipping_address}}</p>
                </div>
            </div>
            <table class="table table-condensed">
                <thead>
                    <tr class="bg-main">
                        <td>{{config('invoicer.header.sl')}}</td>
                        <td>{{config('invoicer.header.title')}}</td>
                        <td class="float-center">{{config('invoicer.header.qty')}}</td>
                        <td class="float-right">{{config('invoicer.header.unit')}}</td>
                        <td class="float-right">{{config('invoicer.header.discount')}}</td>
                        @if(config('invoicer.enabled.extra'))
                        @php $colspan++ @endphp
                        <td class="float-right">{{config('invoicer.header.extra')}}</td>
                        @endif
                        @if(config('invoicer.enabled.addship'))
                        @php $colspan++ @endphp
                        <td class="float-right">{{config('invoicer.header.addship')}}</td>
                        @endif
                        <td class="float-right">{{config('invoicer.header.subtotal')}}</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($that->items as $i => $item)
                    <tr>
                        <td>{{$i+1}}</td>
                        <td>{{$item['title']}}</td>
                        <td class="float-center">{{$item['qty']}}</td>
                        <td class="float-right">{{$item['price']}} {{config('invoicer.currency')}}</td>
                        <td class="float-right">{{$item['discount']}} {{config('invoicer.currency')}}</td>
                        @if(config('invoicer.enabled.extra'))
                        <td class="float-right">{{$item['extra']}} {{config('invoicer.currency')}}</td>
                        @endif
                        @if(config('invoicer.enabled.addship'))
                        <td class="float-right">{{$item['addship']}} {{config('invoicer.currency')}}</td>
                        @endif
                        <td class="float-right">{{$item['subtotal']}} {{config('invoicer.currency')}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td class="no-top-tr" colspan="{{$colspan}}"></td>
                        <td class="float-right small">{{config('invoicer.header.sumtotal')}}</td>
                        <td class="float-right small">{{$that->sum_total}} {{config('invoicer.currency')}}</td>
                    </tr>
                    <tr>
                        <td class="no-top-tr float-left small" colspan="{{$colspan}}">{{$that->vat['number']}}</td>
                        <td class="float-right small">VAT/TAX</td>
                        <td class="float-right small">{{$that->vat['amount']}} {{config('invoicer.currency')}}</td>
                    </tr>
                    <tr>
                        <td class="no-top-tr" colspan="{{$colspan}}"></td>
                        <td class="float-right small">{{config('invoicer.header.shipping')}}</td>
                        <td class="float-right small">{{$that->ship_total}} {{config('invoicer.currency')}}</td>
                    </tr>
                    <tr>
                        <td class="no-top-tr" colspan="{{$colspan}}"></td>
                        <td class="float-right small">{{config('invoicer.header.homecost')}}</td>
                        <td class="float-right small">{{$that->home_cost}} {{config('invoicer.currency')}}</td>
                    </tr>
                    <tr>
                        <td class="no-top-tr" colspan="{{$colspan}}"></td>
                        <td class="float-right title">Total</td>
                        <td class="float-right">{{$that->total}} {{config('invoicer.currency')}}</td>
                    </tr>
                </tbody>
            </table>
            <div class="bottom-class">
                <h3>Payment Status <span class="label label-{{$that->label}}">{{$that->payment_state}}</span></h3>
                <span class="inline-block">{{$that->additional}}</span>
                <p class="text-center smaller">
                    {{config('invoicer.invoice.footer')}}
                </p>
            </div>
            
        </div>
    </body>
</html>