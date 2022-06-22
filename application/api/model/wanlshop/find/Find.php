<?php

namespace app\api\model\wanlshop\find;

use think\Model;
use traits\model\SoftDelete;

class Find extends Model
{

    use SoftDelete;

    // 表名
    protected $name = 'wanlshop_find';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = 'deletetime';

    // 追加属性
    protected $append = [
        'type_text',
		'createtime_text',
		'createtime_date'
    ];
	
	public function getCreatetimeTextAttr($value, $data)
	{
	    $value = $value ? $value : (isset($data['createtime']) ? $data['createtime'] : '');
	    return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
	}
	
	public function getCreatetimeDateAttr($value, $data)
	{
	    $value = $value ? $value : (isset($data['createtime']) ? $data['createtime'] : '');
	    return is_numeric($value) ? date("d", $value) : $value;
	}
	
	// 将图片数组转字符串输入
	public function getImagesAttr($value)
	{
		return $value ? explode(',', $value) : [];
	}
	
    public function getTypeList()
    {
        return ['new' => __('Type new'), 'live' => __('Type live'), 'want' => __('Type want'), 'activity' => __('Type activity'), 'show' => __('Type show'), 'video' => __('Type video')];
    }

    public function getTypeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['type']) ? $data['type'] : '');
        $list = $this->getTypeList();
        return isset($list[$value]) ? $list[$value] : '';
    }
	
	protected function setImagesAttr($value)
	{
	    return is_array($value) ? implode(',', $value) : $value;
	}
	
	protected function setGoodsIdsAttr($value)
	{
	    return is_array($value) ? implode(',', $value) : $value;
	}
	
	// 直播
	public function live()
	{
	    return $this->belongsTo('app\api\model\wanlshop\Live', 'live_id', 'id', [], 'LEFT')->setEagerlyType(0);
	}
	
	// 视频
	public function video()
	{
	    return $this->belongsTo('app\api\model\wanlshop\Video', 'video_id', 'video_id', [], 'LEFT')->setEagerlyType(0);
	}
	
	public function user()
	{
	    return $this->belongsTo('app\common\model\User', 'user_id', 'id', [], 'LEFT')->setEagerlyType(0);
	}
    
}
