<?php

namespace app\api\model\flbooth;
use think\Model;

class Live extends Model
{


    // 表名
    protected $name = 'booth_live';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $created = 'created';
    protected $modified = 'modified';
	
	public function setGoodsIdsAttr($value)
	{
	    return is_array($value) ? implode(',', $value) : $value;
	}
	
	// 店铺
	public function shop()
	{
	    return $this->belongsTo('app\api\model\flbooth\Shop', 'shop_id', 'id', [], 'LEFT')->setEagerlyType(0);
	}
}
