<?php
	include 'db.php';
	$redis = new Redis();
	$redis->connect('127.0.0.1', 6379);
	//插入抢购数据
	if($res = $redis->lpop('good')){
		$redis->lpush('good_res',$res);
		// 创建连接
    	$conn = new mysqli($servername, $username, $password,"shop");
    	if($conn->connect_error){	
    		$redis->lpush('good',$res);
    		die("连接失败:".$conn->connect_error);
    	}
		$sql="insert into `order` values()";
	    $conn->query($sql);
	    $conn->close();
		echo "已抢到";
	}else{
		echo "商品已售完";
	}
    echo "redis队列判断库存".$redis->llen('good').",已下单".$redis->llen('good_res');
    //如果已下单数大于生成订单数，则是有线程抢到redis队列值但未抢到mysql连接

    // 创建连接
    $conn = new mysqli($servername, $username, $password,"shop");
    if($conn->connect_error){
    	die("连接失败:".$conn->connect_error);
    }
    $sql="select count(*) from `order`";
    $data=$conn->query($sql);
    $data=$data->fetch_row();
    $order_num=$data['0'];
    $conn->close();

    echo "mysql数据库判断，生成订单数".$order_num;
?>