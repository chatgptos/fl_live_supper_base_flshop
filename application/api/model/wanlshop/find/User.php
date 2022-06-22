<?php

namespace app\api\model\wanlshop\find;

use think\Model;
use traits\model\SoftDelete;

class User extends Model
{

    use SoftDelete;

    // 表名
    protected $name = 'wanlshop_find_user';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = 'deletetime';
	
	public function user()
	{
	    return $this->belongsTo('app\common\model\User', 'user_id', 'id', [], 'LEFT')->setEagerlyType(0);
	}
}
