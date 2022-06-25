<?php
namespace app\admin\model\flbooth;

use think\Model;
use traits\model\SoftDelete;

class GroupsTeam extends Model
{
	use SoftDelete;
	
    // 表名
    protected $name = 'flbooth_groups_team';
	
	// 自动写入时间戳字段
	protected $autoWriteTimestamp = 'int';
	
	// 定义时间戳字段名
	protected $created = 'created';
	protected $modified = 'modified';
	protected $deleted = 'deleted';
    
	public function user()
	{
	    return $this->belongsTo('app\admin\model\User', 'user_id', 'id', [], 'LEFT')->setEagerlyType(0);
	}
	
}
