<?php
require_once "DaO.php";

class ProductManager extends DaO {
    protected $table="products";
    protected $colonne=['pk',
       'name',
        'price',
        'vat',
        'price_vat',
        'price_total',
       'quantity'
    ];

    function update($data){
        //var_dump($data);
        $data['pk'] = -1;
        $product = $this->create([
            'pk' => $data['editpk'],
            'name' => htmlspecialchars($data['editablename']),
            'price' =>$data['editableprice'],
            'vat' => $data['editablevat'],
            'quantity' => $data['editablequantity']
        ]);
        if ($product) {
            try {
                $statement = $this->connection->prepare("UPDATE {$this->table} SET name = ? , price = ?, vat = ?, price_vat = ?, price_total = ?, quantity = ? WHERE pk = ?") ;
                $statement->execute([
                    $product->__get('name'),
                    $product->__get('price'),
                    $product->__get('vat'),
                    $product->__get('price_vat'),
                    $product->__get('price_total'),
                    $product->__get('quantity'),
                    $product->__get('pk')
                ]);
            } catch(PDOException $e) {
                print $e->getMessage();
            }
        }
    }

    function save($data) {
        $data['pk'] = -1;
        $product = $this->create([
            'pk' => $data['pk'],
            'name' =>htmlspecialchars($data['name']),
            'price' =>$data['price'],
            'vat' => $data['vat'],
            'quantity' => $data['quantity']
        ]);

        if ($product) {
            try {
                $statement = $this->connection->prepare(
                    "INSERT INTO {$this->table} (name, price, vat, price_vat, price_total, quantity) VALUES (?, ?, ?, ?, ?, ?)"
                );
                $statement->execute([
                    $product->__get('name'),
                    $product->__get('price'),
                    $product->__get('vat'),
                    $product->__get('price_vat'),
                    $product->__get('price_total'),
                    $product->__get('quantity')
                ]);
            } catch(PDOException $e) {
                print $e->getMessage();
            }
        }
    }

    function create($data){
        return new Product(
            $data['pk'],
            $data['name'],
            $data['price'],
            $data['vat'],
            $data['quantity']
        );
    }

}
