<?php
namespace app\api\model\flbooth\groups;

use think\Model;
use traits\model\SoftDelete;

class Team extends Model
{

    use SoftDelete;

    // 表名
    protected $name = 'booth_groups_team';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $created = 'created';
    protected $modified = 'modified';
    protected $deleted = 'deleted';
	
	public function user()
	{
	    return $this->belongsTo('app\common\model\User', 'user_id', 'id', [], 'LEFT')->setEagerlyType(0);
	}
}
