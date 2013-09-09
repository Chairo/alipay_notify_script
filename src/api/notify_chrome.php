<?php
$secure_hash_key = 'TEST_HASH_PLZ_CHANGE_THIS_!!';

print_r($_GET);
echo '交易时间:'.$_GET['trade_time']."<br/>\r\n";
echo '交易内容:'.$_GET['trade_title']."<br/>\r\n";
echo '交易金额:'.$_GET['trade_amout']."<br/>\r\n";
echo '交易买家:'.$_GET['trade_buyer_name']."(".$_GET['trade_buyer'].")<br/>\r\n";
echo '交易订单:'.$_GET['trade_id']."<br/>\r\n";

$hash = $_GET['trade_hash']; //哈希
$uri_s = '';
$uri_s .= 'trade_time='.$_GET['trade_time'].'&';
$uri_s .= 'trade_amout='.$_GET['trade_amout'].'&';
$uri_s .= 'trade_buyer='.$_GET['trade_buyer'].'&';
$uri_s .= 'trade_id='.$_GET['trade_id'].'&';
$uri_s2 = urldecode($uri_s);
echo $uri_s2.$secure_hash_key."<br/>\r\n";
$hash2 = md5($uri_s2.$secure_hash_key);
if($hash == $hash2){
  	echo $hash."通过校验";
  	//判断是否在数据库中已存在
  	$dbname = 'XWZGJnvbcLIPuatgrMBl';
 
	/*从环境变量里取出数据库连接需要的参数*/
	$host = getenv('HTTP_BAE_ENV_ADDR_SQL_IP');
	$port = getenv('HTTP_BAE_ENV_ADDR_SQL_PORT');
	$user = getenv('HTTP_BAE_ENV_AK');
	$pwd = getenv('HTTP_BAE_ENV_SK');
 
	/*接着调用mysql_connect()连接服务器*/
	$link = @mysql_connect("{$host}:{$port}",$user,$pwd,true);
	if(!$link) {
	    die("Connect Server Failed: " . mysql_error());
	}
	/*连接成功后立即调用mysql_select_db()选中需要连接的数据库*/
	if(!mysql_select_db($dbname,$link)) {
	    die("Select Database Failed: " . mysql_error($link));
	}
 
	/*至此连接已完全建立，就可对当前数据库进行相应的操作了*/
	/*！！！注意，无法再通过本次连接调用mysql_select_db来切换到其它数据库了！！！*/
	/* 需要再连接其它数据库，请再使用mysql_connect+mysql_select_db启动另一个连接*/
 
	/**
 	* 接下来就可以使用其它标准php mysql函数操作进行数据库操作
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
	/*显式关闭连接，非必须*/
	mysql_close($link);
}
else die();
?>