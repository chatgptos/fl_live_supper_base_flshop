FlAdmin是一款基于ThinkPHP+Vue的稳健智能后台开发框架，
FlAdmin后端微服务解耦级解决方案
FlAdmin是蜂雷自研发系统后端框架，
FlAdmin主要用于构建 蜂雷直播基地产业园pass平台，
FlAdmin 是 FengleiAdmin 简称 FlAdmin
版权归 © 蜂雷 京ICP证030173号  科权科技（上海）有限公司 所有
© 2022 上海蜂雷网络科技有限公司 版权所有 All Rights Reserved 沪ICP备15022866号-2 

## 主要特性

* 基于`Auth`验证的权限管理系统
    * 支持基于 RSA对称加密算法基础上的 Auth 2.0 token授权安全机制
    * 支持无限级父子级权限继承，父级的管理员可任意增删改子级管理员及权限设置
    * 支持单管理员多角色
    * 支持管理子级数据或个人数据
* 强大的一键生成功能 GII 开发者规范
    * 一键生成CRUD,包括控制器、模型、视图、JS、语言包、菜单、回收站等
    * 一键压缩打包JS和CSS文件，一键CDN静态资源部署
    * 一键生成控制器菜单和规则
    * 一键生成API接口文档
* 强大的后台前端支持 
    * 基于复用原理，完善的前端功能组件开发 
    * 基于`AdminLTE`二次开发
    * 基于`Bootstrap`开发，自适应手机、平板、PC
    * 基于`RequireJS`进行JS模块管理，按需加载
    * 基于`Less`进行样式开发
* 强大的插件扩展功能

## 安装使用

https://doc.FlAdmin.net

## 在线演示

https://demo.FlAdmin.net

用户名：admin

密　码：123456

提　示：演示站数据无法进行修改，请下载源码安装体验全部功能

## 界面截图 

## 问题反馈

在使用中有任何问题，请使用以下联系方式联系我们

交流社区: https://ask.FlAdmin.net

QQ群: [1276789849](https://jq.qq.com/?_wv=1027&k=487PNBb)(满) [1154638287](https://jq.qq.com/?_wv=1027&k=5ObjtwM)(群2) 

Github: https://github.com/karsonzhang/FlAdmin

Gitee: https://gitee.com/karson/FlAdmin

## 特别鸣谢

感谢以下的项目,排名不分先后

ThinkPHP：http://www.thinkphp.cn

AdminLTE：https://adminlte.io

Bootstrap：http://getbootstrap.com

jQuery：http://jquery.com

Bootstrap-table：https://github.com/wenzhixin/bootstrap-table

Nice-validator: https://validator.niceue.com

SelectPage: https://github.com/TerryZ/SelectPage

Layer: https://layer.layui.com

DropzoneJS: https://www.dropzonejs.com


## 版权信息

FlAdmin遵循Apache2开源协议发布，并提供免费使用。

本项目包含的第三方源码和二进制文件之版权信息另行标注。

版权所有Copyright © 2017-2022 by FlAdmin （http://www.fenglei.shop/）
© 2022 上海蜂雷网络科技有限公司 版权所有 All Rights Reserved 沪ICP备15022866号-2 
All rights reserved。(https://www.fladmin.net) 












架构
架构总览
FlAdmin基于MSP的设计模式，将我们的应用分为三层（模型M、服务S（API）、控制器C）。

目录结构
FlAdmin目录结构遵循ThinkPHP5,Thinkphp6官方建议的模块设计：

FlAdmin项目目录
├── addons                  //扩展服务存放目录
├── application             //应用目录
│   ├── admin               //后台管理应用模块
│   ├── api                 //API应用模块
│   ├── common              //通用应用模块
│   ├── extra               //扩展配置目录
│   ├── index               //前台应用模块
│   ├── build.php
│   ├── command.php         //命令行配置
│   ├── common.php          //通用辅助函数
│   ├── config.php          //基础配置
│   ├── database.php        //数据库配置
│   ├── route.php           //路由配置
│   ├── tags.php            //行为配置
├── extend
│   └── fast                //FlAdmin扩展辅助类目录
├── public                  //框架入口目录
│   ├── assets
│   │   ├── build           //打包JS、CSS的资源目录
│   │   ├── css             //CSS样式目录
│   │   ├── fonts           //字体目录
│   │   ├── img             //图片资源目录
│   │   ├── js
│   │   │   ├── backend
│   │   │   └── frontend    //后台功能模块JS文件存放目录
│   │   ├── libs            //Bower资源包位置
│   │   └── less            //Less资源目录
│   └── uploads             //上传文件目录
│   ├── index.php           //应用入口主文件
│   ├── install.php         //FlAdmin安装引导
│   ├── admin.php           //后台入口文件(自动安装后会被修改为随机文件名）
│   ├── robots.txt
│   └── router.php
├── runtime                 //缓存目录
├── thinkphp                //ThinkPHP5,ThinkPHP6框架核心目录
├── vendor                  //Compposer资源包位置
├── .bowerrc                //Bower目录配置文件
├── .env.sample             //环境配置模板（可复制一份为 .env 生效）
├── LICENSE
├── README.md               //项目介绍
├── bower.json              //Bower前端包配置
├── build.php
├── composer.json           //Composer包配置
└── think                   //命令行控制台入口（使用 php think 命令进入）