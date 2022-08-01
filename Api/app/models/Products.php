<?php

class Products
{

    protected $pdo;

    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    function selectAll()
    {
        $sql = "
            SELECT id_product, product_name, cost, available_products 
            FROM products";

        $st = $this->pdo->getConnection()->prepare($sql);
        $st->execute();
        if ($st->execute()) {
            $rows = array();
            while (($row = $st->fetch(PDO::FETCH_ASSOC)) !== false) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return false;
        }
    }

    function select($data)
    {
        $sql = "
            SELECT id_product, product_name, cost, available_products 
            FROM products
            WHERE id_product = :id_product";

        $st = $this->pdo->getConnection()->prepare($sql);

        if ($st->execute(array('id_product' => $data['id_product']))) {

            return $st->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    function update($data)
    {

        foreach ($data['products'] as $row) {
            
            $recordset = $this->select($row);
            $newAvailable = ((int)$recordset['available_products'] + (int)$row['product_quantity']);
            $sql = "
				UPDATE products
                SET available_products = :available_products
                WHERE id_product = :id_product
			";

            $st = $this->pdo->getConnection()->prepare($sql);

            $params = array(
                'id_product' => (int)$row['id_product'],
                'available_products' => $newAvailable
            );
            $succ = $st->execute($params);
        }

		if ($succ)
			return true;
		else
			return false;
    }
}
