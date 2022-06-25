<?php

namespace app\api\model\flbooth;

use think\Model;
use traits\model\SoftDelete;

class PayOutTrade extends Model
{

    use SoftDelete;

    // 表名
    protected $name = 'booth_pay_out_trade';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $created = 'created';
    protected $modified = 'modified';
    protected $deleted = 'deleted';
	
	protected function setPayIdAttr($value)
	{
	    return is_array($value) ? implode(',', $value) : $value;
	}
	
	protected function setOrderIdAttr($value)
	{
	    return is_array($value) ? implode(',', $value) : $value;
	}
}
