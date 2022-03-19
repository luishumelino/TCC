<?php

Class User{
	private $pdo;
	public $error ="";
	
	public function connect($db, $host, $user, $password){
		global $pdo;
		global $error;
		try {
			$pdo = new PDO("mysql:dbname=".$db.";host=".$host,$user,$password);
		} catch (PDOException $e) {
			$error = $e->getMessage();
		}
	}

	public function login($login, $senha){
		global $pdo;
		$sql = $pdo->prepare("SELECT id_user FROM login WHERE nome = :e AND senha = :s");
		$sql->bindValue(":e",$login);
		$sql->bindValue(":s",md5($senha));
		$sql->execute();
		if ($sql->rowCount() > 0){
			$dado = $sql->fetch();
			session_start();
			$_SESSION['id_user']=$dado['id_user'];
			return true;
		} else{
			return false; //nao logou
		}
	}	
}

?>
