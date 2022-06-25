<?php
namespace app\api\model\flbooth;

use think\Model;

class Category extends Model
{

    // 表名
    protected $name = 'booth_category';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $created = 'created';
    protected $modified = 'modified';
}
