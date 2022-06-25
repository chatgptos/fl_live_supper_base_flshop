<?php

namespace app\api\model\flbooth;
use think\Model;

class Cart extends Model
{


    // 表名
    protected $name = 'booth_cart';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $created = 'created';
    protected $modified = 'modified';
	
	
	public function getSkuAttr($value)
	{
	    return json_decode($value, true);
	}
	
	public function getCheckedAttr($value)
	{
	    return $value == 0 ? false : true; 
	}
	
	public function setCheckedAttr($value)
	{
	    return $value ? 1 : 0; 
	}
	
	public function setSkuAttr($value)
	{
	    return json_encode($value);
	}
	
	public function shop()
	{
	    return $this->belongsTo('app\api\model\flbooth\Shop', 'shop_id', 'id', [], 'LEFT')->setEagerlyType(0);
	}
	
	// 商品 1.0.2升级
	public function goods()
	{
	    return $this->belongsTo('app\api\model\flbooth\Goods', 'goods_id', 'id', [], 'LEFT')->setEagerlyType(0);
	}
	
	// 1.0.3升级
	public function suk()
	{
	    return $this->belongsTo('app\api\model\flbooth\GoodsSku', 'sku_id', 'id', [], 'LEFT')->setEagerlyType(0);
	}
}
