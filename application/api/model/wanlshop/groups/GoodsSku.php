<?php
namespace app\api\model\wanlshop\groups;

use think\Model;
use traits\model\SoftDelete;

class GoodsSku extends Model
{

    use SoftDelete;

    // 表名
    protected $name = 'wanlshop_groups_goods_sku';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $created = 'created';
    protected $updateTime = 'updatetime';
    protected $deleteTime = 'deletetime';
	
	
	// getDifferenceAttr
	public function getDifferenceAttr($value)
	{	
		return $value ? explode(',', $value) : [];
	}
}