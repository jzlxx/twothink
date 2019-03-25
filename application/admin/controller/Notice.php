<?php
// +----------------------------------------------------------------------
// | TwoThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.twothink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 艺品网络
// +---------------------------------------------------------------------- 

namespace app\admin\controller;

use app\admin\model\AuthGroup;

/**
 * 报修管理控制器
 */
class Notice extends Admin  {

    /**
     * 后台报修列表
     */
    public function group(){
        $title      =   trim(input('title'));
        if($title){
            $map['title'] = array('like',"%{$title}%");
        }
        $map['id'] = array('egt',0);
        $list = $this->lists('Propert',$map,'',true);
        $this->assign('list',$list);
        // 记录当前列表页的cookie
        Cookie('__forward__',$_SERVER['REQUEST_URI']);

        $this->assign('meta_title', '菜单列表');
        return $this->fetch();
    }


    /**
     * 新增
     */
    public function add(){
        if(request()->isPost()){
            $Propert = model('Propert');
            $post_data=request()->post();
            $validate = validate('Propert');
            if(!$validate->check($post_data)){
            	return $this->error($validate->getError());
            }
            $data = $Propert->create($post_data);
            if($data){
                    session('admin_propert_list',null);
                    //记录行为
                    action_log('update_propert', 'Propert', $data->id, UID);
                    $this->success('新增成功', Cookie('__forward__'));
            } else {
                $this->error($Propert->getError());
            }
        } else {
//            $this->assign('info',array('pid'=>input('pid')));
//            $menus = \think\Db::name('Menu')->field(true)->select();
//            $menus = model('Common/Tree')->toFormatTree($menus);
//            $menus = array_merge(array(0=>array('id'=>0,'title_show'=>'顶级菜单')), $menus);
//            $this->assign('Menus', $menus);
            $this->assign('meta_title','新增报修');
            return $this->fetch('edit');
        }
    }

    /**
     * 编辑
     */
    public function edit($id = 0){
        if(request()->isPost()){
            $Propert = model('Propert');
            $post_data=$this->request->post();
            $validate = validate('Propert');
            if(!$validate->check($post_data)){
            	return $this->error($validate->getError());
            }
            $data = $Propert->update($post_data);
            if($data){
                    session('admin_propert_list',null);
                    //记录行为
                    action_log('update_propert', 'Menu', $data->id, UID);
                    $this->success('更新成功', Cookie('__forward__'));
            } else {
                $this->error($Propert->getError());
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = \think\Db::name('propert')->field(true)->find($id);
            if(false === $info){
                $this->error('获取信息错误');
            }
            $this->assign('info', $info);
            $this->assign('meta_title', '编辑报修信息');
            return $this->fetch();
        }
    }

    /**
     * 删除
     */
    public function del(){
        $id = array_unique((array)input('id/a',0));

        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('id' => array('in', $id) );
        if(\think\Db::name('Propert')->where($map)->delete()){
            session('admin_propert_list',null);
            //记录行为
            action_log('update_propert', 'Propert', $id, UID);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }
}