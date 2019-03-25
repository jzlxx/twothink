<?php
 
namespace app\home\validate;
use think\Validate; 

class Propert extends Validate{
    // 验证规则
    protected $rule = [
        ['title', 'require', '标题必须填写'],
        ['name', 'require', '姓名必须填写'],
        ['tel', 'require', '联系电话必须填写'],
        ['address', 'require', '地址必须填写'],
        ['content', 'require', '详情必须填写'],

    ];  

}