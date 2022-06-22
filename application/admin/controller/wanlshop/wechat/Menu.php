<?php

namespace app\admin\controller\wanlshop\wechat;

use app\common\controller\Backend;

use EasyWeChat\Factory;
use addons\wanlshop\library\WeixinSdk\Mp;
use think\Exception;

/**
 * 菜单管理
 *
 * @icon fa fa-list-alt
 */
class Menu extends Backend
{
    protected $wechatcfg = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->wechatcfg = model('app\admin\model\wanlshop\WechatConfig')->get(['name' => 'menu']);
    }

    /**
     * 查看
     */
    public function index()
    {
        $responselist = array();
        $all = model('app\admin\model\wanlshop\WechatResponse')->all();
        foreach ($all as $k => $v) {
            $responselist[$v['eventkey']] = $v['title'];
        }
        $this->view->assign('responselist', $responselist);
        $this->view->assign('menu', (array)json_decode($this->wechatcfg->value, true));
        return $this->view->fetch();
    }

    /**
     * 修改
     */
    public function edit($ids = null)
    {
        $menu = $this->request->post("menu");
        $menu = (array)json_decode($menu, true);
        foreach ($menu as $index => &$item) {
            if (isset($item['sub_button'])) {
                foreach ($item['sub_button'] as &$subitem) {
                    if ($subitem['type'] == 'view') {
                        $allowFields = ['type', 'name', 'url'];
                        $subitem = ['type' => $subitem['type'], 'name' => $subitem['name'], 'url' => $subitem['url']];
                    } else {
                        if ($subitem['type'] == 'miniprogram') {
                            $allowFields = ['type', 'name', 'url', 'appid', 'pagepath'];
                            $subitem = ['type' => $subitem['type'], 'name' => $subitem['name'], 'url' => $subitem['url'], 'appid' => $subitem['appid'], 'pagepath' => $subitem['pagepath']];
                        } else {
                            $allowFields = ['type', 'name', 'key'];
                            $subitem = ['type' => $subitem['type'], 'name' => $subitem['name'], 'key' => $subitem['key']];
                        }
                    }
                    $subitem = array_intersect_key($subitem, array_flip($allowFields));
                }
            } else {
                if ($item['type'] == 'view') {
                    $allowFields = ['type', 'name', 'url'];
                } else {
                    if ($item['type'] == 'miniprogram') {
                        $allowFields = ['type', 'name', 'url', 'appid', 'pagepath'];
                    } else {
                        $allowFields = ['type', 'name', 'key'];
                    }
                }
                $item = array_intersect_key($item, array_flip($allowFields));
            }
        }
        $this->wechatcfg->value = json_encode($menu, JSON_UNESCAPED_UNICODE);
        $this->wechatcfg->save();
        $this->success();
    }

    /**
     * 加载远程菜单
     */
    public function remote()
    {
        $app = Factory::officialAccount(Mp::config());

        try {
            $list = $app->menu->list();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
        if (isset($list['menu']['button'])) {
            $buttons = $list['menu']['button'];
            foreach ($buttons as $index => &$item) {
                if (isset($item['sub_button'])) {
                    if ($item['sub_button']) {
                        foreach ($item['sub_button'] as $key => &$value) {
                            if (!isset($value['sub_button']) || !$value['sub_button']) {
                                unset($value['sub_button']);
                            }
                        }
                    } else {
                        unset($item['sub_button']);
                    }
                }
            }
            $this->wechatcfg->value = json_encode($buttons, JSON_UNESCAPED_UNICODE);
            $this->wechatcfg->save();
            $this->success();
        } else {
            $this->error("加载菜单失败");
        }
    }

    /**
     * 同步到服务器
     */
    public function sync($ids = null)
    {
        $app = Factory::officialAccount(Mp::config());
        try {
            $hasError = false;
            $menu = json_decode($this->wechatcfg->value, true);
            foreach ($menu as $k => $v) {
                if (isset($v['sub_button'])) {
                    foreach ($v['sub_button'] as $m => $n) {
                        if ($n['type'] == 'click' && isset($n['key']) && !$n['key']) {
                            $hasError = true;
                            break 2;
                        }
                    }
                } else {
                    if ($v['type'] == 'click' && isset($v['key']) && !$v['key']) {
                        $hasError = true;
                        break;
                    }
                }
            }
            if (!$hasError) {
                try {
                    $ret = $app->menu->create($menu);
                } catch (\Exception $e) {
                    $this->error($e->getMessage());
                }
                if ($ret['errcode'] == 0) {
                    $this->success();
                } else {
                    $this->error($ret['errmsg']);
                }
            } else {
                $this->error(__('Invalid parameters'));
            }
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
