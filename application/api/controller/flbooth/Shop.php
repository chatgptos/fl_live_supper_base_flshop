<?php

namespace app\api\controller\flbooth;

use app\common\controller\Api;
use fast\Tree;
/**
 * flbooth展商接口
 */
class Shop extends Api
{
    protected $noNeedLogin = ['getShopInfo'];
    protected $noNeedRight = ['*'];
	
	public function _initialize()
	{
	    parent::_initialize();
		$this->model = model('app\api\model\flbooth\Shop');
	}
	
	/**
	 * 一次性获取展商相关数据 1.0.0升级
	 *
	 * @ApiSummary  (flbooth 一次性获取店铺相关数据)
	 * @ApiMethod   (GET)
	 *
	 * @param string $id 页面ID
	 */
	public function getShopInfo($id = null)
	{
		//设置过滤方法
		$this->request->filter(['strip_tags']);
		// 获取店铺信息
		$row = $this->model->get($id);
		if (!$row) {
		    $this->error(__('未找到此商家'));
		}
		// 获取商家类目
		$tree = Tree::instance();
		$tree->init(
			model('app\api\model\flbooth\ShopSort')
				->where(['shop_id' => $row['id']])
				->field('id, pid, name, image')
				->order('weigh asc')
				->select()
		);
		$row['category'] = $tree->getTreeArray(0);
		// 查看是否被关注
		$row['isFollow'] = model('app\api\model\flbooth\find\Follow')
			->where([
				'user_no' => $row['find_user']['user_no'], 
				'user_id' => $this->auth->id
			])
			->count();
		$row['isLive'] = model('app\api\model\flbooth\Live')
			->where(['shop_id' => $row['id'], 'state' => 1])
			->field('id')
			->find();
		// 获取类目样式配置
		$shopConfig = model('app\api\model\flbooth\ShopConfig')
			->where(['shop_id' => $row['id']])
			->find();
		$row['categoryStyle'] = (int)$shopConfig['category_style'];
		// 获取商家自定义页面
		$row['page'] = model('app\api\model\flbooth\Page')
			->where([
				'shop_id' => $row['id'], 
				'type' => 'shop'
			])
			->field('id, name, page, item')
			->find();
		$this->success('返回成功', $row);
	}
	
	/**
	 * 展商入驻
	 *
	 * @ApiSummary  (flbooth 店铺接口商家入驻)
	 * @ApiMethod   (POST)
	 */
	public function apply()
	{
		//设置过滤方法
		$this->request->filter(['strip_tags']);
		$row = model('app\api\model\flbooth\Auth')
			->where(['user_id' => $this->auth->id])
			->find();
		if ($this->request->isPost()) {
			$params = $this->request->post();
			$data = [
				'name' => $params['name'],
				'user_id' => $this->auth->id,
				'number' => $params['number'],
				'image' => $params['image'],
				'trademark' => $params['trademark'],
				'wechat' => $params['wechat'],
				'mobile' => $params['mobile'],
				'state' => 1
			];
			if($row){
				$row->save($data);
			}else{
				model('app\api\model\flbooth\Auth')->data($data)->save();
			}
			$this->success('返回成功', $params);
		}
		$this->success('返回成功', $row);
	}
}