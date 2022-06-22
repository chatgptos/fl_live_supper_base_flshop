<?php

namespace app\admin\model\wanlshop;

use think\Model;
use traits\model\SoftDelete;

class Video extends Model
{

    use SoftDelete;

    

    // 表名
    protected $name = 'wanlshop_video';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = 'deletetime';

    // 追加属性
    protected $append = [
        'suggestion_text'
    ];
    

    
    public function getSuggestionList()
    {
        return ['block' => __('Suggestion block'), 'review' => __('Suggestion review'), 'pass' => __('Suggestion pass')];
    }


    public function getSuggestionTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['suggestion']) ? $data['suggestion'] : '');
        $list = $this->getSuggestionList();
        return isset($list[$value]) ? $list[$value] : '';
    }




    public function wanlshopfind()
    {
        return $this->belongsTo('app\admin\model\wanlshop\Find', 'video_id', 'video_id', [], 'LEFT')->setEagerlyType(0);
    }
}
