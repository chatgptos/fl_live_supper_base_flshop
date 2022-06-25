<?php

namespace app\admin\controller\flbooth;

use app\common\controller\Backend;

/**
 * 会员余额变动管理
 *
 * @icon fa fa-circle-o
 */
class Money extends Backend
{
    
    /**
     * Money模型对象
     * @var \app\admin\model\flbooth\Money
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\flbooth\Money;
        $this->view->assign("typeList", $this->model->getTypeList());
    }

    public function import()
    {
        parent::import();
    }

    /**
     * 查看
     */
    public function index()
    {
        //当前是否为关联查询
        $this->relationSearch = true;
        //设置过滤方法
        $this->request->filter(['strip_tags', 'trim']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();

            $list = $this->model
                    ->with(['user'])
                    ->where($where)
                    ->order($sort, $order)
                    ->paginate($limit);

            foreach ($list as $row) {
                
                $row->getRelation('user')->visible(['id','username']);
            }

            $result = array("total" => $list->total(), "rows" => $list->items());

            return json($result);
        }
        return $this->view->fetch();
    }
	
	
	/**
	 * 资金详情
	 */
	public function detail($ids = null)
	{
	    $money = $this->model->get($ids);
	    if (!$money) {
	        $this->error(__('No Results were found'));
	    }
		$service = [];
		if($money['type'] && $money['type'] != 'sys'){
			if($money['type'] == 'pay'){
				$order = model('app\admin\model\flbooth\Order')
					->where('order_no', 'in', $money['service_ids'])
					->field('id,shop_id,created,paymenttime')
					->select();
				if(!$order){
					$this->error(__('订单异常'));
				}
				foreach($order as $vo){
					$vo->pay = model('app\admin\model\flbooth\Pay')
						->where(['order_id' => $vo['id'], 'type' => 'goods'])
						->find();
					$vo->shop->visible(['shopname']);
					$vo->goods = model('app\admin\model\flbooth\OrderGoods')
						->where(['order_id' => $vo['id']])
						->field('id,title,difference,image,price,number')
						->select();
				}
				$service = $order;
			}else if($money['type'] == 'groups'){
				$order = model('app\admin\model\flbooth\GroupsOrder')
					->where('order_no', 'in', $money['service_ids'])
					->field('id,shop_id,created,paymenttime')
					->select();
				if(!$order){
					$this->error(__('订单异常'));
				}
				foreach($order as $vo){
					$vo->pay = model('app\admin\model\flbooth\Pay')
						->where(['order_id' => $vo['id'], 'type' => $money['type']])
						->find();
					$vo->shop->visible(['shopname']);
					$vo->goods = model('app\admin\model\flbooth\GroupsOrderGoods')
						->where(['order_id' => $vo['id']])
						->field('id,title,difference,image,price,number')
						->select();
				}
				$service = $order;
			}else if($money['type'] == 'recharge' || $money['type'] == 'withdraw'){ // 用户充值
				if($money['type'] == 'recharge'){
					$model = model('app\api\model\flbooth\RechargeOrder');
					$field = 'id,paytype,orderid,memo';
				}else{
					$model = model('app\api\model\flbooth\Withdraw');
					$field = 'id,money,handingfee,status,type,account,orderid,memo,transfertime';
				}
				$row = $model
					->where(['id' => $money['service_ids']])
					->field($field)
					->find();
				$service = $row;
			}else if($money['type'] == 'refund'){
				$order = model('app\api\model\flbooth\Order')
					->where('order_no', $money['service_ids'])
					->field('id,shop_id,order_no,created,paymenttime')
					->find();
				if(!$order){
					$this->error(__('订单异常'));
				}
				$order->shop->visible(['shopname']);
				$order['refund'] = model('app\api\model\flbooth\Refund')
					->where(['order_id' => $order['id']])
					->field('id,price,type,reason,created,completetime')
					->find();
				$service = $order;
			}
		}
		$this->assignconfig('row', $money);
	    $this->assignconfig('service', $service);
		return $this->view->fetch();
	}
}
