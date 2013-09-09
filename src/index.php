<?php

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
 
 	$query = mysql_query('SELECT * FROM alipay_order_list ORDER BY `trade_time` DESC ',$link);
?>
<h4>交易记录：</h4>
<table border="1">
<tr>
  <td>支付宝交易号</td>
  <td>交易内容</td>
  <td>买家账号</td>
  <td>金额</td>
  <td>交易时间</td>
  <td>入库时间</td>
</tr>
<?php
	while($data = mysql_fetch_array($query,1)){
      //print_r($data);
      ?>
<tr>
  <td><?php echo $data['trade_id'];?></td>
  <td><?php echo base64_decode($data['trade_title']);?></td>
  <td><?php echo base64_decode($data['trade_buyer_name']);?></td>
  <td><?php echo number_format($data['trade_amout'],2);?></td>
  <td><?php echo $data['trade_time'];?></td>
  <td><?php echo $data['notify_time'];?></td>
</tr>
	  <?php
	}
?>
</table>
