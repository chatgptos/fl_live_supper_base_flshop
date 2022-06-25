<?php
namespace app\index\model\flbooth\groups;

use think\Model;
use traits\model\SoftDelete;

class GoodsSku extends Model
{

    use SoftDelete;

    // 表名
    protected $name = 'booth_groups_goods_sku';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $created = 'created';
    protected $modified = 'modified';
    protected $deleted = 'deleted';
	
}