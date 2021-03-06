<?php 
namespace DGvai\Invoicer;

use DGvai\Invoicer\InvoicerParams;
use Barryvdh\DomPDF\Facade as PDF;

class Invoicer extends InvoicerParams
{
    public function __construct()
    {
        return $this;
    }

    public function setupInvoice($invoice_no, $issue_date = null)
    {
        $this->invoice_no = $invoice_no;
        $this->issue_date = is_null($issue_date) ? date('m-d-Y') : $issue_date;
        return $this;
    }

    public function setBuyer($name, $email, $phone = null)
    {
        $this->buyer_email = $email;
        $this->buyer_name = $name;
        $this->buyer_phone = $phone;
        return $this;
    }

    public function setShippingAddr($address)
    {
        $this->shipping_address = $address;
        return $this;
    }

    public function setShippingCost($cost)
    {
        $this->ship_total += $cost;
        return $this;
    }

    public function setHomeDeliveryCost($cost)
    {
        $this->home_cost += $cost;
        return $this;
    }

    public function addItem($title, $qty, $unit, $unit_price, $discount, $extra_cost = 0, $additional_shipping = 0)
    {
        $item['title'] = $title;
        $item['qty'] = $qty.' '.$unit;
        $item['price'] = $unit_price; 
        $item['discount'] = $discount; 
        $item['extra'] = $extra_cost; 
        $item['addship'] = $additional_shipping; 
        $item['subtotal'] = $this->getSubTotal($unit_price, $qty, $discount, $extra_cost, $additional_shipping);
        $this->sum_total += $item['subtotal'];
        
        array_push($this->items,$item);
        return $this;
    }

    public function applyCoupon($code, $discount)
    {
        $this->coupon_code = $code;
        $this->coupon_discount = $discount;
        return $this;
    }

    public function setPaymentState($state, $label='info', $additional=null)
    {
        $this->payment_state = $state;
        $this->additional = $additional;
        switch(strtolower($label))
        {
            case 'success' : $this->label = 'success'; break;
            case 'important' : $this->label = 'important'; break;
            case 'warning' : $this->label = 'warning'; break;
            default : $this->label = 'info'; break;
        }
        
        return $this;
    }

    public function generate($path_to_save=null)
    {
        $this->vatCalculate();
        $this->totalCalculate();

        $path = null;
        $filename = null;

        $pdf = PDF::loadView('invoicer::invoice',['that' => $this])
                    ->setPaper('a4')
                    ->setOptions(['pdf_backend' => 'PDFLib']);

        if(is_null($path_to_save))
        {
            if (!is_dir(public_path('invoices'))) 
            {
                mkdir(public_path('invoices'), 0777, true);
            }
            $path = public_path('invoices');
            $filename = 'invoice-'.mt_rand(1000,9999).date('d-m-Y').'.pdf';
            $pdf->save($path.'/'.$filename);
        }
        else 
        {
            $pdf->save($path_to_save);
        }

        return (object)[
            'success' =>    true,
            'path'    =>    $path,
            'filename'=>    $filename
        ];
    }
}