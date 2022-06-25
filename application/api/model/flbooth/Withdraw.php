<?php
namespace app\api\model\flbooth;

use think\Model;

class Withdraw extends Model
{
	// 表名
	protected $name = 'withdraw';
	// 开启自动写入时间戳字段
	protected $autoWriteTimestamp = 'int';
	// 定义时间戳字段名
	protected $created = 'created';
	protected $modified = 'modified';
	// 追加属性
	protected $append = [
	];
	
	public function getSettledmoneyAttr($value, $data)
	{
	    return max(0, sprintf("%.2f", $data['money'] - $data['handingfee'] - $data['taxes']));
	}
}