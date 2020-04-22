<?php



class Product
{
    private $pk;
    private $name;
    private $price;
    private $vat;
    private $price_vat;
    private $price_total;
    private $quantity;

    /**
     * Product constructor.
     * @param $pk
     * @param $name
     * @param $price
     * @param $vat
     * @param $price_vat
     * @param $price_total
     * @param $quantity
     */
    public function __construct($pk, $name, $price, $vat, $quantity)
    {
        $this->pk = $pk;
        $this->name = $name;
        $this->price = $price;
        $this->vat = $vat;
        $this->price_vat = $this->vat();
        $this->price_total = $this->total_price();
        $this->quantity = $quantity;
    }

    function vat() {
        return $this->price*($this->vat/100);
    }

    function total_price(){
        return $this->price*(1+($this->vat/100));
    }


    function __get($property){
        if(property_exists($this, $property)){
            return $this->$property;
        }
    }

    function __set($property, $value){
        if(property_exists($this, $property)){
            $this->$property = $value;
        }
    }

}