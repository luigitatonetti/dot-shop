<?php

class Orders
{

	protected $pdo;

	function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	function selectAll()
	{
		$sql = "
		SELECT
			id_order, p.id_product, p.product_name, o.product_quantity, 
			(o.product_quantity * p.cost) AS cost, product_name

		FROM orders AS o

			LEFT JOIN products AS p
				ON p.id_product = o.id_product
				
		ORDER BY id_order ASC";

		$st = $this->pdo->getConnection()->prepare($sql);
		if ($st->execute()) {
			$rows = array();
			while (($row = $st->fetch(PDO::FETCH_ASSOC)) !== false) {
				$rows[] = $row;
			}

			$orders = array();
			$order = array();
			foreach ($rows as $row) {

				if (!isset($orders[(int)$row['id_order']])) {

					$order['id_order'] = (int)$row['id_order'];
					$order['total_cost'] = (float)$row['cost'];
					$order['products'] = array();

					$order['products'][] = array(
						'id_product' => $row['id_product'],
						'product_name' => $row['product_name'],
						'product_quantity' => (int)$row['product_quantity'],
						'cost' => (float)$row['cost']
					);

					$orders[(int)$row['id_order']] = $order;
				} else {
					$orders[(int)$row['id_order']]['total_cost'] += (float)$row['cost'];

					$orders[(int)$row['id_order']]['products'][] = array(
						'id_product' => $row['id_product'],
						'product_name' => $row['product_name'],
						'product_quantity' => (int)$row['product_quantity'],
						'cost' => (float)$row['cost']
					);
				}
			}
			return $orders;
		} else {
			return false;
		}
	}

	function select($data)
	{
		$sql = "
		SELECT
			id_order, p.id_product, o.id_user, p.product_name, o.product_quantity, 
			(o.product_quantity * p.cost) AS cost

		FROM orders AS o

			LEFT JOIN products AS p
				ON p.id_product = o.id_product
		WHERE id_user = :id_user
		ORDER BY id_order ASC";

		$st = $this->pdo->getConnection()->prepare($sql);
		if ($st->execute(array('id_user' => $data['id_user']))) {
			$rows = array();
			while (($row = $st->fetch(PDO::FETCH_ASSOC)) !== false) {
				$rows[] = $row;
			}

			$orders = array();
			foreach ($rows as $row) {
				
				if(!isset($orders[(int)$row['id_order']])){

					$order = array();
					if (empty($order)) {

						$order['id_order'] = (int)$row['id_order'];
						$order['total_cost'] = (float)$row['cost'];
						$order['products'] = array();
						
						$order['products'][] = array(
							'id_product' => $row['id_product'],
							'product_name' => $row['product_name'],
							'product_quantity' => (int)$row['product_quantity'],
							'cost' => (float)$row['cost']
						);
					} else {
	
						if(isset($order['total_cost']))
							$order['total_cost'] += (float)$row['cost'];
	
						$order['products'][] = array(
							'id_product' => $row['id_product'],
							'product_name' => $row['product_name'],
							'product_quantity' => (int)$row['product_quantity'],
							'cost' => (float)$row['cost']
						);
					}
					$orders[(int)$row['id_order']] = $order;
				} else {
					

					$orders[(int)$row['id_order']]['total_cost'] += (float)$row['cost'];

					$orders[(int)$row['id_order']]['products'][] = array(
						'id_product' => $row['id_product'],
						'product_name' => $row['product_name'],
						'product_quantity' => (int)$row['product_quantity'],
						'cost' => (float)$row['cost']
					);

					
				}
				


			}
			$ordersClean = array();
			foreach($orders as $order){
				$ordersClean[] = $order;
			}
			
			return $ordersClean;
		} else {
			return false;
		}
	}

	function create($data)
	{
		$id_order = $this->getLastId() + 1;

		foreach ($data['products'] as $row) {
			$sql = "
				INSERT INTO orders
					(id_order, id_product, id_user, product_quantity)
				VALUES
					(:id_order, :id_product, :id_user, :product_quantity)
			";

			$st = $this->pdo->getConnection()->prepare($sql);

			$params = array(
				'id_order' => $id_order,
				'id_product' => $row['id_product'],
				'id_user' => $data['id_user'],
				'product_quantity' => $row['product_quantity']
			);

			$succ = $st->execute($params);
		}

		if ($succ)
			return true;
		else
			return false;
	}

	function delete(array $data)
	{

		$sql = "
			DELETE FROM orders 
			WHERE id_order = :id_order";
		$st = $this->pdo->getConnection()->prepare($sql);

		if ($st->execute(array('id_order' => $data['id_order']))) {
			return true;
		}
	}

	protected function getLastId()
	{
		$sql = "SELECT MAX(id_order) as max FROM orders";

		$st = $this->pdo->getConnection()->prepare($sql);

		if ($st->execute()) {
			$max = $st->fetch(PDO::FETCH_ASSOC);
			return $max['max'];
		}
	}
}
