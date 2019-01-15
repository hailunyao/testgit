<?php 
Class MysqlPDO{
	//����
	private $db=null;	
	private $dbname;
	private $dbms;
	private	$host;
	private	$user;
	private	$pass;
	private	$dbCharset;
	//˽�й���
	private function __construct($config){
 		$this->host = isset($config['host']) ? $config['host'] : 'localhost';
        $this->user = isset($config['user']) ? $config['user'] : 'root';
        $this->pass = isset($config['pass']) ? $config['pass'] : 'root';
        $this->dbms = isset($config['dbms']) ? $config['dbms'] : 'mysql';		
        $this->dbname = isset($config['dbname']) ? $config['dbname'] : 'db_compary';
        $this->dbCharset = isset($config['dbCharset']) ? $config['dbCharset'] : 'utf8';

	try {
	$this->db= new PDO('$dbms:host=$host;dbname=$dbname',$user,$pass);//��������
	$this->db->exec('SET character_set_connection='.$dbCharset.', character_set_results='.$dbCharset.', character_set_client=binary');//��ֹ���� ����������utf8 �ַ���ʽ��
	
	} catch (PDOException $e) {
		echo "Error".$e->getMessage().'<br>';
	}
	
	//���ڴ��ʵ��������
	static private $_instance= null;
	//������̬������ȡʵ��������
	static protected function getInstance($config){
		if (!(self::$_instance instanceof self)) {
			 self::$_instance=new self($config);
		}
		return self::$_instance;
	}

	//˽�п�¡
	private function __clone(){};
	
	//�N���Լ��Ĳ������ͬ�r�N���������˵�PDO����
	private function __destruct(){
		$this->db=null;
	}

	/* ������ݿⷽ����ɾ�Ĳ�*/	
	 public function up_query($sql){
		$db=$this->db;
		$row=$db->query($sql);	
		return $row;	
	 }
	 //������Ӱ�������
	 public function pdoExec($sql){
	 	return $ehis->db->exec($sql);
	 }
	 //����Ĳ�����Ϣ
	 privare function getPDOError(){
	 	if ($this->db->errorCode() !='00000') {
	 		$arrayError= $this->db->errorInfo();
	 		$this->outputError($arrayError[2]);
	 	}
	 }
	 //��ӡ��������Ϣ
	 private function debug($debuginfo){
	 	var_dump($debuginfo);
	 	exit();
	 }
	 //�������
	 private function outputError($strErrMsg){
	 	throw new Exception('Mysql Error:'.$strErrMsg);
	 }
	 //���ָ���ֶ��Ǹ���ָ�������ݱ��г���
	 public function checkFields($table,$arrayFields){
	 	$fields=$thie->getFields($table);
	 	foreach ($arrayFields as $key => $value) {
	 		if (!in_array($key, $fields)) {
	 			$this->outputError("Unknow column '$key' in field list");
	 		}
	 	}
	 }
	 //��ȡ���е������ֶ�����
	 public function getFields($table){
	 	$fields=array();
	 	$recordset=$this->db->query("SHOW COLUMNS FROM $table");//show columus �鿴���ݽṹ
	 	$this->getPDOError();//���������������
	 	$recordset=setFrtchMode(PDO::FETCH_ASSOC);
	 	$result= $recordset->fetchAll();
	 	foreach ($result as $key ) {
	 		$fields[]=$key['Field'];
	 	}
	 	return $fields;
	 }


	 //��ѯ
	 public function check($sql,$qweuymode=='All',$debug=false){
	 	if ($edbug===true) $this->debug($sql);
	 	$result=$this->db->query($sql);
	 	$this->getPDOError();//��ȡ������Ϣ
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
	 //����
	 //$table ���� ��arrayDataValue �ֶ���ֵ $where ����
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
	//����
	public function insert($table,$arrayDataValue,$debug=dalse){
		$this->checkFields($table,$arrayDataValue);.
		$sql= "INSERT INTO `$table` (`".implode('`,`',array_keys($arrayDataValue))."`)VALUES('".implode("','",$arrayDataValue)."')";
		 if ($edbug===true) $this->debug($sql);	
		 $result=$this->db->exec($sql);
		 $this->getPDOError();
		 return $result;
	}
	//���ǲ��뷽��
	public function replace($table,$arrayDataValue,$debug=false){
		$this->checkFields($table,$arrayDataValue);
		$sql="REPLACE INTO `$table`(`".implode('`,`',array_keys($arrayDataValue))"`)VALUEAS('".implode("',",$arrayDataValue)."`)";
		if ($edbug===true) $this->debug($sql);
		$result=$this->db->exec($sql);
		$this->getPDOError();
		return $result;
	}
	//ɾ��
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

	//ִ��sql �����Դ�ӡ����
	public function execSql($sql,$debug=false){
		if ($edbug===true) $this->debug($sql);
		$result=$this->db->exec($sql);
		$this->getPDOError();
		return $result;		
	}
	//��ȡ�ֶ����ֵ
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
	// ��ȡָ����������
	public function getCount($table,$field_name,$where='',debug=false){
		$sql="SELECT COUNT($field_name) AS NUM FROM $tabel";
		if ($where!='')$sql.="where $where";
		if ($debig===true) $this->debug($sql);
		$arrTemp=$this->check($sql,'Row');
		return $arrTemp['NUM'];
	}
	//��ȡ������
	publit function getTableEngine($dbname,$tableName){
		$sql="show table status from $sbname where Name='"$tableName"' ";
		$arrayTableInfo=$this->check($sql);
		$this->getPDOError();
		return $arrayTableInfo[0]['Engine'];
	}
	//Ԥ����
	public function prepareSql=($sql=''){
		return $this->db->prepare($sql);
	}
	//Ԥִ��
	public function execute($presql){
		return $this->db->execute($presql);
	}
	//pdo��������
	public function setAttribute($a,$b){
		$this->db->setAttribute($a,$b);
	}
	//����ִ�п�ʼ����
	public function beginTransaction(){
		$this->db->baginTransaction();
	}
	//�ύ����
	public function commit(){
		$this->db->commit();
	}
	//��������
	public function rollback(){
		$this->db->rollback();
	}
	//ͨ��getTableEngine�жϱ������Ƿ�֧������
	public function execTransaction($sql){
		$retval=1;
		$this->beginTransaction();
		foreach ($sql as $str) {
			if ($this->execSql($sql)==0)$retval==0;	
		}
		if ($retval==0) {
			$this->rollback();//��������
			return false;
		}else{
			$this->commit();//�ύ����
			return true;
		}
	}
	//ͨ��transaction���������sql���
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