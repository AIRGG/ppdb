<?php
include_once("db.php");
session_start();
$db = new database();

function val($arr)
{
	$isi = [];
	foreach ($arr as $key => $value) {
		array_push($isi, $value);
	}
	return $isi;
}
function sql_batch($sql, $arr){
	// Bentuk kiriman arr = [[1,2,4], [2,3,5]]
	$sqlArr = [];
	foreach ($arr as $key) {
		$sqlArr[] =  "(". implode(",", array_fill(0, count($key), "?")) .")";

		foreach ($key as $v) {
			$param[] = $v;
		}
	}
	$sql.=implode(",", $sqlArr);
	return $sql;
}
function param_batch($arr){
	// Bentuk kiriman arr = [[1,2,4], [2,3,5]]
	$param = [];
	foreach ($arr as $key) {
		foreach ($key as $v) {
			$param[] = $v;
		}
	}
	return $param;
}
function show($sql, $param=null)
{
	global $db;
	try {
		$get = $db->s->prepare($sql);
		if ($param == null) {
			$get->execute();
		}else{
			$get->execute($param);
		}
		return $get->fetchAll();
	} catch (PDOException $e) {
		die("<b>Something Error:</b> ".$e->getMessage()." <br/>");
	}
}
function proses($sql, $param=null)
{
	global $db;
	try {
		if ($param == null) {
			$hasil = $db->s->prepare($sql)->execute();
		}else{
			$hasil = $db->s->prepare($sql)->execute($param);
		}
		return $hasil;
	} catch (PDOException $e) {
		die("<b>Something Error:</b> ".$e->getMessage()." <br/>");
	}
}
function proses_batch($sql, $param=null)
{
	// Bentuk kiriman arr = [[1,2,4], [2,3,5]]
	// Bentuk kiriman sql = "INSERT INTO table(namaField, namaField) values "
	if($param == null){
		die("PARAM NULL!");
	}else{
		$sql = sql_batch($sql, $param);
		$param = param_batch($param);
		return proses($sql, $param);
	}

}

// Custom Function !!
function validasi_login($tmplog, $username){
    if(isset($_SESSION["usr"]) && isset($_SESSION["tmplog"])){
        $sql = show("SELECT * FROM login WHERE username=?", [$_SESSION["usr"]["username"]]);
        if($sql[0]["tmplog"] == $tmplog) return 1;
        else return 0;
    }else{
        return 0;
    }
}
?>