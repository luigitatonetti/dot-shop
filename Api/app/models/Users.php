<?php

class Users
{

	protected $pdo;

	function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	function select($data)
	{
		$sql = "
			SELECT id_user, first_name, last_name, username, email
			FROM users
            WHERE email = :email AND password = :password";

		$params = array(
			'email' => $data['email'],
			'password' => hash("sha1",$data['password'])
		);

		$st = $this->pdo->getConnection()->prepare($sql);

		if ($st->execute($params)) {

			return $st->fetch(PDO::FETCH_ASSOC);
		} else {
			return false;
		}
	}

	function create($data)
	{

		$sql = "
			INSERT INTO users
				(id_user, first_name, last_name, username, email, password)
			VALUES
				(:id_user, :first_name, :last_name, :username, :email, :password)
		";

		$st = $this->pdo->getConnection()->prepare($sql);

		$params = array(
			'id_user' => $this->getLastId() + 1,
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'username' => $data['username'],
			'email' => $data['email'],
			'password' => hash("sha1",$data['password'])
		);

		$succ = $st->execute($params);


		if ($succ)
			return true;
		else
			return false;
	}

	protected function getLastId()
	{
		$sql = "SELECT MAX(id_user) as max FROM users";

		$st = $this->pdo->getConnection()->prepare($sql);

		if ($st->execute()) {
			$max = $st->fetch(PDO::FETCH_ASSOC);
			return $max['max'];
		}
	}
}
