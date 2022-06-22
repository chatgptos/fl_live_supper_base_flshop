<?php

namespace app\index\controller\wanlshop;

use app\common\controller\Wanlshop;
use think\Db;
use think\Exception;
use think\exception\PDOException;

use fast\Tree;

/**
 * 店铺管理
 * @internal
 */
class Shop extends Wanlshop
{
    protected $noNeedLogin = '';
    protected $noNeedRight = '*';
    /**
     * Shop模型对象
     */
    protected $model = null;
    
    public function _initialize()
    {
        parent::_initialize();
        
        
        $this->model = new \app\index\model\wanlshop\Shop;
        $this->view->assign("stateList", $this->model->getStateList());
        $this->view->assign("statusList", $this->model->getStatusList());
        
        $this->view->assign("typeList", $this->model->getTypeList());
        $tree = Tree::instance();
        $category = new \app\index\model\wanlshop\Category;// 类目
        $tree->init(collection($category->where(['type' => 'goods'])->order('weigh desc,id desc')->field('id,pid,type,name,name_spacer')->select())->toArray(), 'pid');
        $this->assignconfig('pageCategory', $tree->getTreeList($tree->getTreeArray(0), 'name_spacer'));
    }
    
    /**
     * 类目管理
     */
    public function index()
    {
        return $this->view->fetch('wanlshop/page/index');
    }
	
    /**
     * 品牌管理
     */
    public function brand()
    {
		$this->view->assign("stateList", model('app\index\model\wanlshop\Brand')->getStateList());
        return $this->view->fetch('wanlshop/brand/index');
    }
    
    /**
     * 店铺资料
     */
    public function profile($ids = null)
    {
        $row = $this->model->get($this->shop->id);
        if (!$row) {
            $this->error(__('No Results were found'));
        }
        // 判断用户权限
        if ($row['user_id'] !=$this->auth->id) {
            $this->error(__('You have no permission'));
        }
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $result = false;
                Db::startTrans();
                try {
                    $result = $row->allowField(true)->save($params);
                    Db::commit();
                } catch (PDOException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (Exception $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                }
                if ($result !== false) {
                    $this->success();
                } else {
                    $this->error(__('No rows were updated'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        $this->view->assign("row", $row);
        return $this->view->fetch();
    }
    
    /**
     * 图片空间
     */
    public function attachment()
    {
        $attachment = model('Attachment');
        $this->view->assign("picCount", $attachment->where('user_id', $this->auth->id)->count());
        $size = $attachment->where('user_id', $this->auth->id)->sum('filesize');
        $units = array('K','Kb','M','G','T');
        $i = 0;
        for (; $size>=1024 && $i<count($units); $i++) {
            $size /= 1024;
        }
        $this->view->assign("picSum", round($size, 2).$units[$i]);
		$this->view->assign("mimetypeList", \app\common\model\Attachment::getMimetypeList());
        return $this->view->fetch('wanlshop/attachment/index');
    }
    
    /**
     * 类目管理
     */
    public function category()
    {
        return $this->view->fetch('wanlshop/shopsort/index');
    }
    
	
    /**
     * 服务
     */
    public function service()
    {
        if ($this->request->isAjax()) {
			// 1.1.4升级
			$keyValue = $this->request->request('keyValue');
			if ($keyValue){
			   $where['id'] = ['in',$keyValue];
			}
            $where['status'] = 'normal';
            $total = model('app\index\model\wanlshop\ShopService')->where($where)->count();
            $list = model('app\index\model\wanlshop\ShopService')->where($where)->select();
            $list = collection($list)->toArray();
            $result = array("total" => $total, "rows" => $list);
            return json($result);
        }
    }
	
}
