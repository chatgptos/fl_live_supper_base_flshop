<?php

namespace app\api\model\flbooth;

use think\Model;
use traits\model\SoftDelete;

class PayAccount extends Model
{

    use SoftDelete;
    // 表名
    protected $name = 'booth_pay_account';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $created = 'created';
    protected $modified = 'modified';
    protected $deleted = 'deleted';
}