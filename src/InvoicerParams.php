<?php 
namespace DGvai\Invoicer;

class InvoicerParams 
{
    public $invoice_no;
    public $issue_date;

    public $buyer_name;
    public $buyer_email;
    public $buyer_phone;
    public $shipping_address;

    public $items = [];

    public $sum_total = 0;
    public $ship_total = 0;
    public $total = 0;

    public $vat;

    public $payment_state;
    public $label;
    public $additional;

    protected function unitDiscount()
    {
        return config('invoicer.discount_type') == '1' ? true : false;
    }

    protected function getSubTotal($unit_price,$qty,$discount)
    {
        return $this->format($this->unitDiscount() ? ($unit_price - $discount) * $qty : ($unit_price * $qty) - $discount);
    }

    protected function vatCalculate()
    {
        if(config('invoicer.vat.allowed'))
        {
            $this->vat['number'] = config('invoicer.vat.title').': '.config('invoicer.vat.number');
            $this->vat['amount'] = $this->format($this->sum_total*(config('invoicer.vat.percent')/100));
        }
        else 
        {
            $this->vat['number'] = '';
            $this->vat['amount'] = 0;
        }
    }

    protected function totalCalculate()
    {
        $this->total = $this->format($this->sum_total + $this->vat['amount'] + $this->ship_total);
    }

    private function format($number)
    {
        return number_format($number,2);
    }
}