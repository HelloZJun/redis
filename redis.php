<?php
   //连接本地的 Redis 服务
   $redis = new Redis();
   $redis->connect('127.0.0.1', 6379);
   //初始化
   $redis->delete('good');
   $redis->delete('good_res');
   for($i=1;$i<=500;$i++){//设置秒杀数量$i
      $redis->lpush('good', 'good_id'.$i);
   }
   echo "库存".$redis->llen('good').",已下单".$redis->llen('good_res');
   print_r($redis->lrange('good',0,-1));exit;
?>