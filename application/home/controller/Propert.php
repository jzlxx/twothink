<?php
// +----------------------------------------------------------------------
// | TwoThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.twothink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 艺品网络
// +---------------------------------------------------------------------- 

namespace app\home\controller;


/**
 * 报修管理控制器
 */
class Propert extends Home  {
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
                    session('user_propert_list',null);
                    //记录行为
                    action_log('update_propert', 'Propert', $data->id, UID);
                    $this->success('新增成功','Home/index');
            } else {
                $this->error($Propert->getError());
            }
        } else {
            $this->assign('meta_title','新增报修');
            return $this->fetch('edit');
        }
    }

}