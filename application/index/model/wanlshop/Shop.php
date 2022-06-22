<?php
namespace app\index\model\wanlshop;

use think\Model;
use traits\model\SoftDelete;
use fast\Random;

class Shop extends Model
{

    use SoftDelete;

    // 表名
    protected $name = 'wanlshop_shop';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = 'deletetime';

    // 追加属性
    protected $append = [
        'state_text',
        'status_text',
		'user_no',
		'isself' //追加是否为自营店
    ];
    
	// 获取店铺 发现号
	public function getUserNoAttr($value, $data)
	{
		$findModel = new FindUser;
		$row = $findModel
			->where(['user_id' => $data['user_id']])
			->find();
		if(!$row){
			$findModel->user_id = $data['user_id'];
			$findModel->user_no = Random::nozero(9);
			$findModel->save();
			$user_no = $findModel->user_no;
		}else{
			$user_no = $row->user_no;
		}
		return $user_no;
	}
	
	
	public function getIsselfAttr($value, $data)
	{
	    return $data['isself'];
	}
	
    protected static function init()
    {
        self::afterInsert(function ($row) {
            $pk = $row->getPk();
            $row->getQuery()->where($pk, $row[$pk])->update(['weigh' => $row[$pk]]);
        });
    }

    
    public function getStateList()
    {
        return ['0' => __('State 0'), '1' => __('State 1'), '2' => __('State 2')];
    }

    public function getStatusList()
    {
        return ['normal' => __('Normal'), 'hidden' => __('Hidden')];
    }

	public function getTypeList()
	{
	   return ['shop' => __('Shop'), 'page' => __('Page')];
	}

    public function getStateTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['state']) ? $data['state'] : '');
        $list = $this->getStateList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }
}
