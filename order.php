<?php
	include 'db.php';
	// 创建连接
    $conn = new mysqli($servername, $username, $password,"shop");

    $sql="select good_num from good where id=1";
    $data=mysqli_query($conn,$sql);
    $data=mysqli_fetch_row($data);
    $good_num=$data['0'];
    if($good_num>0){
    	$sql="insert into `order` values()";
	    mysqli_query($conn,$sql);
	    
		$sql="update good set good_num=good_num-1";
		mysqli_query($conn,$sql);
	}

    $sql="select good_num from good where id=1";
    $data=mysqli_query($conn,$sql);
    $data=mysqli_fetch_row($data);
    $good_num=$data['0'];
    $sql="select count(*) from `order`";
    $data=mysqli_query($conn,$sql);
    $data=mysqli_fetch_row($data);
    $order_num=$data['0'];
    mysqli_close($conn);
    echo "库存".$good_num.",已下单".$order_num;
?>