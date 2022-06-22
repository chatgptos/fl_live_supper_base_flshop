<?php
namespace app\index\model\wanlshop\groups;

use think\Model;
use traits\model\SoftDelete;

class Ladder extends Model
{

    use SoftDelete;

    // 表名
    protected $name = 'wanlshop_groups_ladder';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = 'deletetime';
	
}
