<?php

namespace App\Models;

/**
 * 
 */
class HomeModel
{
	// private $con;
	// // private const TABELA = 'tb_form.curriculo';

	// public function __construct()
	// {
	// 	$this->con = new MysqlModel();
	// }

	public static function insert($nome,$email,$fone,$cargo,$escolaridade,$arquivo,$obs,$ip,$data)
	{
		$sql = MysqlModel::conectar()->prepare("INSERT INTO `form-curriculo` VALUES (null,?,?,?,?,?,?,?,?,?)");
		if($sql->execute(array($nome,$email,$fone,$cargo,$escolaridade,$arquivo,$obs,$ip,$data))) {
			return true;
		}else{
			return false;
		}
	}
}