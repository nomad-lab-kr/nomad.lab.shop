<?
class DB extends VnTools{

	var $dbHost;
	var $dbUser;
	var $dbPass;
	var $dbConn;

	function __construct() {
		$this->dbHost		= DB_HOST;	// DB 서버 URL
		$this->dbUser		= DB_USER;	// DB 계정 아이디
		$this->dbPass		= DB_PASS;	// DB 계정 비밀번호
		$dbName				= DB_NAME;	// DB 계정 DB 명

		$this->connect($dbName);
	}

	function connect($dbName="") {
		$this->dbConn = mysqli_connect($this->dbHost, $this->dbUser, $this->dbPass);
		if (!$this->dbConn){
			 exit('데이터 베이스 연결 에러!!!');
		}
		if ($dbName) {
			$this->select($dbName);
		}
	}

	function select($dbName) {
		$status = mysqli_select_db($this->dbConn, $dbName);
		if (!$status) {
			exit("데이터 베이스 선택 에러!!!");
		}
		mysqli_query($this->dbConn, "set names utf8");
	}

	function password($password) {
		return md5($password);
	}

	function query($sql) {
		$result = mysqli_query($this->dbConn, $sql);
		if ($result) {
			return $result;
		}
	}

	function fetch($qry) {
		return mysqli_fetch_array($qry);
	}

	function insertID() {
		$result = mysqli_insert_id($this->dbConn);
		return $result;
	}

	function numRows($result) {
		if($result) {
			$rows = mysqli_num_rows($result);
		}
		if ($rows !== null) {
			return $rows;
		}
	}
}
?>