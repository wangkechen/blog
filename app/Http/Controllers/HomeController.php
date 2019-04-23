<?php

namespace App\Http\Controllers;

use App\Test;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        /*$test = Test::create([
            "name" => uniqid()
        ]);
        return $test;*/
        //return Test::find([1,2]); // 返回两条记录
        //return view('home');
    }
    public function redisString()
    {
        $redis = app('redis')->connection('default');
        //return view('home');
    
        //Redis::set("name","wang","ex",60);  //单位是秒
        //return Redis::get("name");
        
    
        //$redis->set('library','predis');
        //return $redis->get('library');
    
        /*
        $mkv = array(
            "usr:0001" => "First user",
            "usr:0002" => "Second user",
            "usr:0003" => "Third user"
        );
        $redis->mset($mkv);
        $retval = $redis->mget(array_keys($mkv));
        return $retval; //["First user","Second user","Third user"]
        */
    
        //$redis->setex('library',10,'predis');   //设置有效期10s
        //return $redis->get('library');
    
        //$redis->setnx('foo',12);    // 返回 1 ， 添加成功
        //$redis->setnx('foo',34);    //返回 0， 添加失败，因为已经存在键名为 foo 的记录
    
        //$redis->set('foo',12);
        //$redis->set('foo',34);
        //return $redis->getset('foo',56);    //有旧值返回34，没有旧值返回null
    
        //$redis->set('foo',56);
        //$redis->incr('foo');
        //$redis->incrby('foo',2);
        //return $redis->type('foo'); //string
        //return $redis->del('foo');  //1
        //return $redis->exists('foo');   //1
        //return $redis->get('foo');  //59
    
        //$redis->set('str','test');
        //$redis->append('str','_123');
        //return $redis->get('str');  //追加字符串test_123
    
        //$redis->setrange('str',0,'abc');    //若str没有值，相当于set操作，若abc有值，则从第0个开始替换，替换3个字符。
        //$redis->setrange('str',2,'cd');
        //return $redis->get('str');  //abcd
    
        //$redis->set('str','abcd');
        //return $redis->substr('str',0,2);   //abc 表示从第 0 个起，取到第 2 个字符
        //return $redis->strlen('str');   //4
    
        //$redis->setbit('binary',31,1);      //表示在第31位存入1,这边可能会有大小端问题?不过没关系, getbit 应该不会有问题
        //return $redis->getbit('binary',31);     //1
    
        //keys模糊查找
        //$redis->set('foo1',123);
        //$redis->set('foo2',456);
        //$redis->rename('foo1','fool1'); //重新赋值，可以覆盖
        //return $redis->renamenx('foo1','foo2'); //0重新赋值，不可以覆盖
        //return $redis->get('fool1');    //
        //return $redis->randomKey(); //可能是返回 'foo1' 或者是 'foo2' 及其它任何已存在的 key
        //return $redis->keys('foo*');   //返回 foo1 和 foo2 的 array
        //return $redis->keys('f?o?');   //同上
    
        $redis->set('foo','1234');
        $redis->expire('foo',10);
        $redis->persist('foo'); // 取消 expire 行为
        return $redis->dbsize();    //返回redis当前数据库的记录总数
        //return $redis->ttl('foo');  //返回有效期
        //return $redis->get('foo');
    
    }
    public function redisPush()
    {
        $redis = app('redis')->connection('default');
        $redis->flushdb();  //清空redis
        
        //$redis->rpush('fooList','bar1');    // 返回列表长度 1
        //$redis->lpush('fooList','bar0');    // 返回列表长度 2
        //$redis->rpushx('fooList','bar2');   // 返回 3, rpushx只对已存在的队列做添加,否则返回 0
        //return $redis->llen('fooList'); //返回列表长度
        //return $redis->lrange('fooList',0,1);   //["bar0","bar1"]
        //return $redis->lrange('fooList',0,-1); //返回全部 ["bar0","bar1","bar2"]
        //return $redis->lindex('fooList',1); // 第一个元素 bar1
        //$redis->lset('fooList',1,'123');    // 修改位置 1 的元素, 返回 true
    
        //$redis->rpush('fooList','1','2','3');   //一次插入多个元素
        //$redis->rpush('fooList','_');
        //$redis->rpush('fooList','5','6','7');
        //$redis->lpop('fooList');
        //$redis->rpop('fooList');
        //$redis->lrem('fooList',1,"_");  //删除队列中左起(右起使用-1) 1个 字符'_'(若有)
        //return $redis->lrange('fooList',0,-1);  //["2","3","_","5","6"]
        
        $redis->rpush('list1','ab0');
        $redis->rpush('list1','ab1');
        $redis->rpush('list2','ab2');
        $redis->rpush('list2','ab3');
        $redis->rpoplpush('list1','list2');   // 结果list1 =>array('ab0'), list2 =>array('ab1','ab2','ab3')
        $redis->rpoplpush('list2', 'list2'); // 也适用于同一个队列, 把最后一个元素移到头部 list2 =>array('ab3','ab1','ab2')
        $redis->linsert('list2','before','ab1','123');
        $redis->linsert('list2','after','ab1','456');
        return $redis->lrange('list2',0,-1);
    
        $redis->blpop('list3', 10) ; // 如果 list3 为空则一直等待,直到不为空时将第一元素弹出, 10 秒后
    } //列表
    public function redisSet()  //集合
    {
        $redis = app('redis')->connection('default');
        $redis->flushdb();
        
        //$redis->sadd('set1','ab');
        //$redis->sadd('set1','cd');
        //$redis->sadd('set1','ef','gh'); //添加多个元素
        //return $redis->smembers('set1');    //返回set中的所有元素["cd","gh","ef","ab"]
        //return $redis->srem('set1','gh'); //返回1 删除一个元素
        //return $redis->spop('set1');    //返回首个元素 'ab'
        
        //$redis->sadd('set2','123');
        //$redis->smove('set1','set2','ab');  // 移动'set1'中的'ab'到'set2', 返回true or false；此时 'set1'集合不存在 'ab' 这个值
        //return $redis->smembers('set2');    //["123","ab"]
        //return $redis->scard('set2');   //返回当前set表元素个数 2
        //return $redis->sismember('set2','123'); //返回1 或 0
        
        //sinter/sunion/sdiff 返回两个集合中元素的交集/并集/补集
        $redis->sadd('set1','ab','cd');
        $redis->sadd('set2','ab','123');
        //return $redis->srandmember('set1');   返回表中一个随机元素
        //return $redis->sinter('set2','set1');   //["ab"]
        //return $redis->sunion('set1','set2');   //["123","cd","ab"]
        //return $redis->sdiff('set1','set2');    //set2的补集，["cd"]
        //sinterstore/sunionstore/sdiffstore 将两个集合的交集/并集/补集元素 copy 到第三个集合中
        $redis->set('foo',0);
        $redis->sinterstore('foo','set1');  // 等同于将'set1'的内容copy到'foo'中，并将'foo'转为set集合，返回集合中的个数：2
        return $redis->sinterstore('foo',array('set1','set2'));     // 将'set1'和'set2'中相同的元素 copy 到'foo'表中, 覆盖'foo'原有内容 返回1或0
    }
    public function redisZset() //有序集合
    {
        $redis = app('redis');
        $redis->flushdb();
        
        $redis->zadd('zset1',1,'ab');
        $redis->zadd('zset1',2,'cd');
        $redis->zadd('zset1',3,'ef');
        //return $redis->zincrby('zset1',10,'ab'); //对指定元素索引值的增减,改变元素排列次序 返回11
        //$redis->zrem('zset1','ef'); //移除指定元素 返回1
        //$redis->zrem('zset1','ab','ef'); //移除多个指定元素 返回1
        //return $redis->zrange('zset1',0,-1);
        
        //return $redis->zrange('zset1',0,1); // 返回位置 0 和 1 之间(两个)的元素 ["ab","cd"]
        //return $redis->zrange('zset1',0,-1);    //返回位置 0 和倒数第一个元素之间的元素(相当于所有元素)
        //return $redis->zrevrange('zset1',0,-1);    //同上,返回表中指定区间的元素,按次序倒排 ["ef","cd","ab"]
        
        //zrangebyscore/zrevrangebyscore 按顺序/降序返回表中指定索引区间的元素
        $redis->zadd('zset1',5,'gh');
        //return $redis->zrangebyscore('zset1',2,9);  //返回索引值2-9之间的元素 ["cd","ef","gh"]
        //return $redis->zrangebyscore('zset1', 2, 9, 'withscores'); // 返回索引值2-9之间的元素并包含索引值 ["cd" => "2","ef" => "3","gh" => "5"]
        //返回索引值2-9之间的元素,'withscores' =>true表示包含索引值; 'limit'=>array(1, 2),表示偏移1条，返回2条,结果为array(array('ef',3),array('gh',5))
        //return $redis->zrangebyscore('zset1',2,9,array('withscores'=>true,'limit'=>array(1,2))); //["ef" => "3","gh" => "5"]
    
        //zunionstore/zinterstore 将多个表的并集/交集存入另一个表中
        //$redis->zunionstore('zset3', array('zset1', 'zset2', 'zset0'));  //将'zset1','zset2','zset0'的并集存入'zset3'
        //$redis->zunionstore('zset3', array('zset1', 'zset2'), array('weights' => array(2, 1))); //weights参数表示权重，其中表示并集后 zset1集合的分 * 2 后存储到 zset3 集合， zset2集合的分 * 1 后存储到 zset3 集合
        //$redis->zunionstore('zset3', array('zset1', 'zset2'), array('aggregate' => 'max')); //'aggregate' => 'max'或'min'表示并集后相同的元素是取大值或是取小值
        
        //return $redis->zcount('zset1',3,5); //统计一个索引区间的元素个数
        //return $redis->zcount('zset1', '(3', 5));  //'(3'表示索引值在3-5之间但不含3,同理也可以使用'(5'表示上限为5但不含5 语法有误，暂未解决
        
        //return $redis->zcard('zset1');  //统计元素个数 4
        //return $redis->zscore('zset1','ef'); //查询元素的索引 3
        //return $redis->zremrangebyscore('zset1',0,2);   // 删除索引在0-2之间的元素('ab','cd'), 返回删除元素个数2
        //return $redis->zrank('zset1','ef'); //2
        //return $redis->zrevrank('zset1','ef');  //1
        return $redis->zremrangebyrank('zset1',0,10); //删除表中指定位置区间的元素 4
        
    }
    public function redisHash()
    {
        $redis = app('redis');
        $redis->flushdb();
        
        $redis->hset('hash1','key1','v1');
        $redis->hset('hash1','key2','v2');
        //return $redis->hget('hash1','key1');
        //return $redis->hexists('hash1','key1');
        //return $redis->hdel('hash1','key2'); //1
        //return $redis->hlen('hash1');   //2
    
        //hsetnx 增加一个元素,但不能重复
        //return $redis->hsetnx('hash1','key1','v2'); //0
        //return $redis->hsetnx('hash1','key2','v2'); //0
        
        $redis->hmset('hash1',array('key3'=>'v3','key4'=>'v4'));
        //return $redis->hmget('hash1',array('key3','key4')); //["v3","v4"]
        
        $redis->hincrby('hash1','key5',3);  // 不存在，则存储并返回 3；存在，即返回 原有值 + 3；
        //return $redis->hincrby('hash1','key5',10);  // 返回13
        
        //return $redis->hkeys('hash1');  //["key1","key2","key3","key4","key5"]
        //return $redis->hvals('hash1');  //["v1","v2","v3","v4","3"]
        
        return $redis->hgetall('hash1');    //array('key1'=>'v1','key2'=>'v2','key3'=>'v3','key4'=>'v4','key5'=>13)
    } //哈希
    public function redisSort() //排序
    {
        $redis = app('redis');
        $redis->flushdb();
        
        $redis->rpush('tab',3);
        $redis->rpush('tab',2);
        $redis->rpush('tab',17);
    
        //return $redis->lrange('tab',0,-1);    //["3","2","17"]
        //$redis->sort('tab'); //返回["3","2","17"],不会对原列表产生影响
        //return $redis->sort('tab',array('sort'=>'desc'));   //["17","3","2"],不会对原列表产生影响
        //return $redis->lrange('tab',0,-1);
        //return $redis->sort('tab',array('limit'=>array(1,2)));  //返回顺序位置中1的元素2个(这里的2是指个数,而不是位置)，返回array(3,17)
        //return $redis->sort('tab',array('limit'=>array('alpha'=>true))); // 按首字母排序 ["2","3","17"]
        //return $redis->sort('tab',array('limit'=>array('store'=>'ordered'))); //表示永久性排序，返回元素个数
        //$redis->sort('tab', array('limit' => array('get' => 'pre_*')));  //使用了通配符'*'过滤元素，表示只返回以'pre_'开头的元素
        
        //return $redis->info();
        //$redis->select(4);   //OK
        //return $redis->flushdb(); //OK
        
        //move 移动当库的元素到其它数据库
        //$redis->set('tomove','bar');
        //$redis->move('tomove', 4);
    
        //slaveof 配置从服务器
        //$redis->slaveof('127.0.0.1', 80);  // 配置 127.0.0.1 端口 80 的服务器为从服务器
        //$redis->slaveof();  // 清除从服务器
        
        $redis->save(); //同步保存服务器数据到磁盘
        $redis->bgsave(); //异步保存服务器数据到磁盘
        return $redis->lastsave(); //返回最后更新磁盘的时间


    
    }
}
