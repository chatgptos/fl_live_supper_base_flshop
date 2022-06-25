<?php

namespace app\api\model\flbooth;

use think\Model;
use traits\model\SoftDelete;

class Chat extends Model
{

    use SoftDelete;

    

    // 表名
    protected $name = 'booth_chat';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $created = 'created';
    protected $modified = 'modified';
    protected $deleted = 'deleted';

	
	public function getMessageAttr($value)
	{
		$status = json_decode($value, true);
	    return $status;
	}
	
	public function getFormAttr($value)
	{
		$status = json_decode($value, true);
	    return $status;
	}
}
