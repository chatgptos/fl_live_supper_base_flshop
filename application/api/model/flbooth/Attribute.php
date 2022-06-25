<?php

namespace app\api\model\flbooth;

use think\Model;

class Attribute extends Model
{
    // 表名
    protected $name = 'booth_category_attribute';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $created = 'created';
    protected $modified = 'modified';
	
	/**
	 * 将value字段转换数组
	 */
	public function getValueAttr($value)
	{
		$status = json_decode($value, true);
	    return $status;
	}
}
