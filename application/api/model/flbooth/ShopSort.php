<?php

namespace app\api\model\flbooth;

use think\Model;


class ShopSort extends Model
{

    // 表名
    protected $name = 'booth_shop_sort';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $created = 'created';
    protected $modified = 'modified';
    protected $deleted = false;


}
