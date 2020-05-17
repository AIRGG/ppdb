<?php
class database
{
	private $dbdrvr = "mysql";
	private $dbhost = "localhost";
	private $dbuser = "root";
	private $dbpass = "";
	private $dbname = "dbppdb";

	private $except = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
	public $s;
	function __construct()
	{
		try {
			$this->s = new PDO("$this->dbdrvr:host=$this->dbhost; dbname=$this->dbname;", $this->dbuser, $this->dbpass, $this->except);
		} catch (PDOException $e) {
			die("<b>Koneksi Error:</b> ".$e->getMessage()." <br/>");
		}
	}
}
//m6tl7u|#u{-hpa<b?/aeg

//sts {1:aktif, 0:hapus}
//stsresp = {0:belum, 1:proses, 3:gagal, 9:finish}
//stsapi = {1:aktif, 0:expire}
?>