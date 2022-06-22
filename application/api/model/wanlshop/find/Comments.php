<?php

namespace app\api\model\wanlshop\find;

use think\Model;
use traits\model\SoftDelete;

class Comments extends Model
{

    use SoftDelete;

    // 表名
    protected $name = 'wanlshop_find_comments';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $created = 'created';
    protected $updateTime = 'updatetime';
    protected $deleteTime = 'deletetime';
	
	// 追加属性
	protected $append = [
		'created_text'
	];
	
	public function getcreatedTextAttr($value, $data)
	{
	    $value = $value ? $value : (isset($data['created']) ? $data['created'] : '');
	    return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
	}
	
	public function user()
	{
	    return $this->belongsTo('app\common\model\User', 'user_id', 'id', [], 'LEFT')->setEagerlyType(0);
	}
}