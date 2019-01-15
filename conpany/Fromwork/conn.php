<?php 
Class MysqlPDO{
	//对象
	private $db=null;	
	private $dbname;
	private $dbms;
	private	$host;
	private	$user;
	private	$pass;
	private	$dbCharset;
	//私有构造
	private function __construct($config){
 		$this->host = isset($config['host']) ? $config['host'] : 'localhost';
        $this->user = isset($config['user']) ? $config['user'] : 'root';
        $this->pass = isset($config['pass']) ? $config['pass'] : 'root';
        $this->dbms = isset($config['dbms']) ? $config['dbms'] : 'mysql';		
        $this->dbname = isset($config['dbname']) ? $config['dbname'] : 'db_compary';
        $this->dbCharset = isset($config['dbCharset']) ? $config['dbCharset'] : 'utf8';

	try {
	$this->db= new PDO('$dbms:host=$host;dbname=$dbname',$user,$pass);//连接数据
	$this->db->exec('SET character_set_connection='.$dbCharset.', character_set_results='.$dbCharset.', character_set_client=binary');//防止乱码 上面是设置utf8 字符格式的
	
	} catch (PDOException $e) {
		echo "Error".$e->getMessage().'<br>';
	}
	
	//用于存放实例化对象
	static private $_instance= null;
	//公共静态方法获取实例化对象
	static protected function getInstance($config){
		if (!(self::$_instance instanceof self)) {
			 self::$_instance=new self($config);
		}
		return self::$_instance;
	}

	//私有克隆
	private function __clone(){};
	
	//銷毀自己的操作類是同時銷毀被創建了的PDO對象
	private function __destruct(){
		$this->db=null;
	}

	/* 添加数据库方法增删改查*/	
	 public function up_query($sql){
		$db=$this->db;
		$row=$db->query($sql);	
		return $row;	
	 }
	 //返回受影响的行数
	 public function pdoExec($sql){
	 	return $ehis->db->exec($sql);
	 }
	 //错误的捕获信息
	 privare function getPDOError(){
	 	if ($this->db->errorCode() !='00000') {
	 		$arrayError= $this->db->errorInfo();
	 		$this->outputError($arrayError[2]);
	 	}
	 }
	 //打印出错误信息
	 private function debug($debuginfo){
	 	var_dump($debuginfo);
	 	exit();
	 }
	 //错误输出
	 private function outputError($strErrMsg){
	 	throw new Exception('Mysql Error:'.$strErrMsg);
	 }
	 //检查指定字段是附在指定的数据表中出现
	 public function checkFields($table,$arrayFields){
	 	$fields=$thie->getFields($table);
	 	foreach ($arrayFields as $key => $value) {
	 		if (!in_array($key, $fields)) {
	 			$this->outputError("Unknow column '$key' in field list");
	 		}
	 	}
	 }
	 //获取表中的所有字段名称
	 public function getFields($table){
	 	$fields=array();
	 	$recordset=$this->db->query("SHOW COLUMNS FROM $table");//show columus 查看数据结构
	 	$this->getPDOError();//如果出错就输出错误
	 	$recordset=setFrtchMode(PDO::FETCH_ASSOC);
	 	$result= $recordset->fetchAll();
	 	foreach ($result as $key ) {
	 		$fields[]=$key['Field'];
	 	}
	 	return $fields;
	 }


	 //查询
	 public function check($sql,$qweuymode=='All',$debug=false){
	 	if ($edbug===true) $this->debug($sql);
	 	$result=$this->db->query($sql);
	 	$this->getPDOError();//获取错误信息
	 	if ($result) {
	 		$recordest->setFrtchMode(PDO::FETCH_ASSOC);
	 		if ($qweuymode=="All") {
	 			$ewsult=$recordest->fetchAll();
	 		}elseif ($qweuymode=="Row") {
	 			$result=$recordest->fetch();
	 		}else{
	 			$result=null;
	 		}
	 		return $result;
	 	}
	 	
	 }
	 //更新
	 //$table 表名 ￥arrayDataValue 字段于值 $where 条件
	 publit function update($table,$arrayDataValue,$where='',$debug=false){
	 	$this->checkFields($table,$arrayDataValue);
	 	if ($where) {
	 		foreach($arrayDataValue as $key=>$value){
	 			$steSql.=",'$key'='$value'";
	 		}
	 		$steSql=substr($strSql,1);
	 		$strSql="UPDATE '$table' SET $strSql WHERE $where";
	 	}else{
	 		$strSql="UPDATE INTO `$table`(`".implode('`,`',array_keys($arrayDataValue))."`)VALUES ('".implode("','",$arrayDataValue)."')";
	 	}
	 	 if ($edbug===true) $this->debug($strSql);
	 	 $result=$this->db->exec($strSql);
	 	
	 	 return $return;
	 }
	//插入
	public function insert($table,$arrayDataValue,$debug=dalse){
		$this->checkFields($table,$arrayDataValue);.
		$sql= "INSERT INTO `$table` (`".implode('`,`',array_keys($arrayDataValue))."`)VALUES('".implode("','",$arrayDataValue)."')";
		 if ($edbug===true) $this->debug($sql);	
		 $result=$this->db->exec($sql);
		 $this->getPDOError();
		 return $result;
	}
	//覆盖插入方法
	public function replace($table,$arrayDataValue,$debug=false){
		$this->checkFields($table,$arrayDataValue);
		$sql="REPLACE INTO `$table`(`".implode('`,`',array_keys($arrayDataValue))"`)VALUEAS('".implode("',",$arrayDataValue)."`)";
		if ($edbug===true) $this->debug($sql);
		$result=$this->db->exec($sql);
		$this->getPDOError();
		return $result;
	}
	//删除
	public function dalete($table,$where='',$debug=false){
		$($where==''){
			$this->outputError("'WHERE'is null");
		}else{
		$sql=" DELETE FROM $table WHERE $where";
			if ($edbug===true) $this->debug($sql);
			$result=$this->db->exec($sql);
			$this->getPDOError();
			return $result;			
		}
	}

	//执行sql 语句可以打印调试
	public function execSql($sql,$debug=false){
		if ($edbug===true) $this->debug($sql);
		$result=$this->db->exec($sql);
		$this->getPDOError();
		return $result;		
	}
	//获取字段最大值
	public function getMaxValuer($table,$field_name,$shere,$debug=false){
		$sql="SELECT NAX(".$field_name") AS MAX_VALUE FROM $table";
		if ($where!='') $sql.="where $where";
		if ($debug===true) $this->debug($sql);
		$arrTemp=$this->check($sql,'Row');
		$maxValue=$arrTemp['MAX_VALUE'];
		if ($maxValue=="" || $maxValue==null) {
			$maxValue=0;
		}
		return $result;			
	}
	// 获取指定的列数量
	public function getCount($table,$field_name,$where='',debug=false){
		$sql="SELECT COUNT($field_name) AS NUM FROM $tabel";
		if ($where!='')$sql.="where $where";
		if ($debig===true) $this->debug($sql);
		$arrTemp=$this->check($sql,'Row');
		return $arrTemp['NUM'];
	}
	//获取表引擎
	publit function getTableEngine($dbname,$tableName){
		$sql="show table status from $sbname where Name='"$tableName"' ";
		$arrayTableInfo=$this->check($sql);
		$this->getPDOError();
		return $arrayTableInfo[0]['Engine'];
	}
	//预处理
	public function prepareSql=($sql=''){
		return $this->db->prepare($sql);
	}
	//预执行
	public function execute($presql){
		return $this->db->execute($presql);
	}
	//pdo属性设置
	public function setAttribute($a,$b){
		$this->db->setAttribute($a,$b);
	}
	//事务执行开始事务
	public function beginTransaction(){
		$this->db->baginTransaction();
	}
	//提交事务
	public function commit(){
		$this->db->commit();
	}
	//滚回事务
	public function rollback(){
		$this->db->rollback();
	}
	//通过getTableEngine判断表引擎是否支持事务
	public function execTransaction($sql){
		$retval=1;
		$this->beginTransaction();
		foreach ($sql as $str) {
			if ($this->execSql($sql)==0)$retval==0;	
		}
		if ($retval==0) {
			$this->rollback();//滚回事务
			return false;
		}else{
			$this->commit();//提交事务
			return true;
		}
	}
	//通过transaction事务处理多条sql语句
	public function execTransaction($sql){
		$retval=1;
		$this->beginTransaction();
		foreach ($sql as $strSql) {
			if ($this->execSql($strSql)==0) $retval=0;
		}
		if ($retval==0) {
			$this->rollback();
			return false;
		}else{
			$this->commit();
			return true;
		}
	}

	

	}		

 ?>