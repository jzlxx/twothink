<?php
// +----------------------------------------------------------------------
// | TwoThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.twothink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 艺品网络
// +---------------------------------------------------------------------- 

namespace app\home\controller;


use app\home\model\Document;
use think\Db;

/**
 * 报修管理控制器
 */
class Notice extends Home  {

    /**
     * 小区通知列表
     */
    public function index($info,$on_page)
    {
        if($info == 46){
            $map['deadline'] = array('>',strtotime(date('Y-m-d')));
        }
        $map['category_id'] = array('eq',"$info");
        $list=Document::where($map)->where('status','=',1)->order('create_time','desc')->paginate($on_page);
        $count=Document::where($map)->where('status','=',1)->order('create_time','desc')->count();
        $this->assign('_list', $list);
        $this->assign('on_page', $on_page);
        $this->assign('count', $count);
        $this->assign('info', $info);
        if($on_page<$count){
            $this->assign('a',true);
        }
        return $this->fetch();
    }


    public function info($id = 0)
    {
        $wh['uid'] = is_login();
        $wh['aid'] = $id;
        $num = Db::name(event)->where($wh)->count();
        $notice = Db::name("Document")->find($id);
        $notice['view'] += 1;
        Document::update($notice);
        $notice_article = Db::name("DocumentArticle")->find($id);
        $user = Db::name("Member")->find($notice['uid']);
        $this->assign('notice',$notice);
        $this->assign('notice_article',$notice_article);
        $this->assign('user',$user);
        $this->assign('num',$num);
        return $this->fetch();
    }

    public function getPage($info,$on_page){
        $map['category_id'] = array('eq',"$info");
        $list=Document::where($map)->where('status','=',1)->order('create_time','desc')->paginate($on_page)->toArray();
        $count=Document::where($map)->where('status','=',1)->order('create_time','desc')->count();
        foreach ($list['data'] as $vv){
            $list['data']['on_page']=$on_page;
            $list['data']['count']=$count;
            $list['data']['info']=$info;
        }
        return json_encode($list['data']);
    }

    public function eve($aid = 0)
    {
        $uid=is_login();
        $sql = "insert into event (uid,aid) values ('$uid','$aid')";
        Db::name('event')->query($sql);
        return $this->success('报名成功',('Notice/info?id='.$aid));
    }

    public function zs()
    {
        $zmap['category_id'] = array('=',47);
        $zmap['keywords'] = array('=','z');
        $zmap['status'] = array('=',1);
        $zmap['deadline'] = array('>',strtotime(date('Y-m-d')));
        $zlist = Document::where($zmap)->select();
//        dump($zlist);
        $smap['category_id'] = array('=',47);
        $smap['keywords'] = array('=','s');
        $smap['status'] = array('=',1);
        $smap['deadline'] = array('>',strtotime(date('Y-m-d')));
        $slist = Document::where($smap)->select();
        $this->assign('zlist',$zlist);
        $this->assign('slist',$slist);
        return $this->fetch();
    }

    public function zsdetail($id = 0)
    {
        $zs = Db::name('Document')->find($id);
        $zs_article = Db::name("DocumentArticle")->find($id);
        $user = Db::name("Member")->find($zs['uid']);
        $this->assign('zs',$zs);
        $this->assign('zs_article',$zs_article);
        $this->assign('user',$user);
        return $this->fetch();
    }

    public function fuwu()
    {
        return $this->fetch();
    }

    public function about()
    {
        $map['status'] = array('=',1);
        $about = Document::where($map)->find(143);
        $about_article = Db::name('Document_article')->find(143);
        $this->assign('about',$about);
        $this->assign('about_article',$about_article);
        return $this->fetch();
    }

    public function tieshi($on_page)
    {
        $ids = [43,44,46];
        $map['status'] = array('=',1);
        $list = Db::name('Document')->where($map)->whereIn('category_id',$ids,'and')->paginate($on_page);
        for ($i = 0;$i < count($list);$i++){
            if ($list[$i]['category_id'] == 46 && $list[$i]['deadline'] < strtotime(date('Y-m-d'))){
                unset($list[$i]);
            }
        }
        $lists = Db::name('Document')->where($map)->whereIn('category_id',$ids,'and')->select();
        for ($i = 0;$i < count($lists);$i++){
            if ($lists[$i]['category_id'] == 46 && $lists[$i]['deadline'] < strtotime(date('Y-m-d'))){
                unset($lists[$i]);
            }
        }
        $count=count($lists);
        $this->assign('list',$list);
        $this->assign('on_page', $on_page);
        $this->assign('count', $count);
        if($on_page<$count){
            $this->assign('a',true);
        }
        return $this->fetch();
    }

    public function getPaget($on_page){
        $ids = [43,44,46];
        $map['status'] = array('=',1);
        $list = Db::name('Document')->where($map)->whereIn('category_id',$ids,'and')->paginate($on_page)->toArray();
        for ($i = 0;$i < count($list);$i++){
            if ($list[$i]['category_id'] == 46 && $list[$i]['deadline'] < strtotime(date('Y-m-d'))){
                unset($list[$i]);
            }
        }
        $lists = Db::name('Document')->where($map)->whereIn('category_id',$ids,'and')->select();
        for ($i = 0;$i < count($lists);$i++){
            if ($lists[$i]['category_id'] == 46 && $lists[$i]['deadline'] < strtotime(date('Y-m-d'))){
                unset($lists[$i]);
            }
        }
        $count=count($lists);
        foreach ($list['data'] as $vv){
            $list['data']['on_page']=$on_page;
            $list['data']['count']=$count;
        }
        return json_encode($list['data']);
    }
}