<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:95:"D:\phpStudy\PHPTutorial\WWW\twothink\public/../application/home/view/default/notice\tieshi.html";i:1552981464;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="/static/home/static/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/home/static/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .main{margin-bottom: 60px;}
        .indexLabel{padding: 10px 0; margin: 10px 0 0; color: #fff;}
    </style>
</head>
<body>
<div class="main">
    <!--导航部分-->
    <nav class="navbar navbar-default navbar-fixed-bottom">
        <div class="container-fluid text-center">
            <div class="col-xs-3">
                <p class="navbar-text"><a href="<?php echo url('Home/index'); ?>" class="navbar-link">首页</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="<?php echo url('Notice/fuwu'); ?>" class="navbar-link">服务</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="#" class="navbar-link">发现</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="<?php echo url('User/Index/index'); ?>" class="navbar-link">我的</a></p>
            </div>
        </div>
    </nav>
    <!--导航结束-->

    <div class="container-fluid">
        <div id="test">
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
            <div class="row noticeList">
                <a href="<?php echo url('info?id='.$list['id']); ?>">
                    <div class="col-xs-2">
                        <img class="noticeImg" src="/static/home/static/image/1.png" />
                    </div>
                    <div class="col-xs-10">
                        <p class="title"><?php echo $list['title']; ?></p>
                        <p class="intro"><?php echo $list['description']; ?></p>
                        <p class="info">浏览: <?php echo $list['view']; ?> <span class="pull-right"><?php echo time_format($notice['create_time']); ?></span> </p>
                    </div>
                </a>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div id="a" style="border: 1px solid #cbcbcb;width: 100%;text-align: center;border-radius: 5px">
            <?php
                if($a){
            ?>
            <a class="btn" onclick="test(<?php echo $count; ?>,<?php echo $on_page; ?>)">点击查看更多</a>
            <?php
                }else{
            ?>
            <a class="btn">没有更多了</a>
            <?php
                }
            ?>
        </div>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/static/home/static/jquery-1.11.2.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/static/home/static/bootstrap/js/bootstrap.min.js"></script>

<script>
    function test($count,$on_page) {
        var new_page = $on_page+3;
        if(new_page>$count){
            new_page =$count;
        }
        var ajax = new XMLHttpRequest();
        ajax.open('get','http://www.tp.test/home/notice/getPaget/on_page/'+new_page);
        ajax.send();
        ajax.onreadystatechange=function () {
            if(ajax.readyState=='4'&&ajax.status=='200'){
                $('#test').html('');
                var data =JSON.parse(ajax.responseText);
                for (var i=0;i<data['on_page'];i++){
                    var href = '/home/notice/info/id/'+data[i]["id"]+'.html';
                    $('#test').append(
                        '  <div class="row noticeList">' +
                        '                <a href="'+href+'">' +
                        '                    <div class="col-xs-2">' +
                        '                        <img class="noticeImg" src="/static/home/static/image/1.png" />' +
                        '                    </div>' +
                        '                    <div class="col-xs-10">' +
                        '                        <p class="title">'+data[i]['title']+'</p>' +
                        '                        <p class="intro">'+data[i]['description']+'</p>' +
                        '                        <p class="info">浏览: '+data[i]['view']+' <span class="pull-right">'+data[i]['create_time']+'</span> </p>\n' +
                        '                    </div>' +
                        '                </a>' +
                        '            </div>'
                    );
                }
                if(data['on_page']>=$count){
                    data['on_page']=$count;
                    $('#a').html('<a class="btn">没有更多了</a>')
                }else{
                    $('#a').html('<a class="btn" onclick="test(<?php echo $count; ?>,'+data['on_page']+')">点击查看更多</a>')
                }
            }
        }
    }
</script>
</body>
</html>