<?php
$secure_hash_key = 'TEST_HASH_PLZ_CHANGE_THIS_!!';

print_r($_GET);
echo '����ʱ��:'.$_GET['trade_time']."<br/>\r\n";
echo '��������:'.$_GET['trade_title']."<br/>\r\n";
echo '���׽��:'.$_GET['trade_amout']."<br/>\r\n";
echo '�������:'.$_GET['trade_buyer_name']."(".$_GET['trade_buyer'].")<br/>\r\n";
echo '���׶���:'.$_GET['trade_id']."<br/>\r\n";

$hash = $_GET['trade_hash']; //��ϣ
$uri_s = '';
$uri_s .= 'trade_time='.$_GET['trade_time'].'&';
$uri_s .= 'trade_amout='.$_GET['trade_amout'].'&';
$uri_s .= 'trade_buyer='.$_GET['trade_buyer'].'&';
$uri_s .= 'trade_id='.$_GET['trade_id'].'&';
$uri_s2 = urldecode($uri_s);
echo $uri_s2.$secure_hash_key."<br/>\r\n";
$hash2 = md5($uri_s2.$secure_hash_key);
if($hash == $hash2){
  	echo $hash."ͨ��У��";
  	//�ж��Ƿ������ݿ����Ѵ���
  	$dbname = 'XWZGJnvbcLIPuatgrMBl';
 
	/*�ӻ���������ȡ�����ݿ�������Ҫ�Ĳ���*/
	$host = getenv('HTTP_BAE_ENV_ADDR_SQL_IP');
	$port = getenv('HTTP_BAE_ENV_ADDR_SQL_PORT');
	$user = getenv('HTTP_BAE_ENV_AK');
	$pwd = getenv('HTTP_BAE_ENV_SK');
 
	/*���ŵ���mysql_connect()���ӷ�����*/
	$link = @mysql_connect("{$host}:{$port}",$user,$pwd,true);
	if(!$link) {
	    die("Connect Server Failed: " . mysql_error());
	}
	/*���ӳɹ�����������mysql_select_db()ѡ����Ҫ���ӵ����ݿ�*/
	if(!mysql_select_db($dbname,$link)) {
	    die("Select Database Failed: " . mysql_error($link));
	}
 
	/*������������ȫ�������ͿɶԵ�ǰ���ݿ������Ӧ�Ĳ�����*/
	/*������ע�⣬�޷���ͨ���������ӵ���mysql_select_db���л����������ݿ��ˣ�����*/
	/* ��Ҫ�������������ݿ⣬����ʹ��mysql_connect+mysql_select_db������һ������*/
 
	/**
 	* �������Ϳ���ʹ��������׼php mysql���������������ݿ����
	 */
  
 	$query = mysql_query('SELECT * FROM alipay_order_list WHERE trade_id="'.addslashes($_GET['trade_id']).'"',$link);
  	if(!mysql_fetch_array($query,1)){
      	$sql = "INSERT INTO `alipay_order_list`".
	"(`id`, `trade_id`, `trade_time`, `trade_title`, `trade_amout`,".
	"`trade_buyer`, `trade_buyer_name`, `trade_hash`, `notify_time`,".
	" `processed`) VALUES (NULL, '".addslashes($_GET['trade_id'])."', '".addslashes($_GET['trade_time']).
	"', '".base64_encode($_GET['trade_title'])."', '".addslashes($_GET['trade_amout']).
    "', '".addslashes($_GET['trade_buyer'])."', '".base64_encode($_GET['trade_buyer_name']).
    "', '".addslashes($_GET['trade_hash'])."', CURRENT_TIMESTAMP, '1');";
      	echo $sql;
	 	$insert_query = mysql_query($sql,$link);
    }
	/*��ʽ�ر����ӣ��Ǳ���*/
	mysql_close($link);
}
else die();
?>