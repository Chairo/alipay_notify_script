<?php

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
 
 	$query = mysql_query('SELECT * FROM alipay_order_list ORDER BY `trade_time` DESC ',$link);
?>
<h4>���׼�¼��</h4>
<table border="1">
<tr>
  <td>֧�������׺�</td>
  <td>��������</td>
  <td>����˺�</td>
  <td>���</td>
  <td>����ʱ��</td>
  <td>���ʱ��</td>
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
