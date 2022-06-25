<?php

namespace app\admin\model\flbooth;

use think\Model;

class WechatResponse extends Model
{

	// 表名
	protected $name = 'flbooth_wechat_response';
	
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
	
    // 定义时间戳字段名
    protected $created = 'created';
    protected $modified = 'modified';

}
