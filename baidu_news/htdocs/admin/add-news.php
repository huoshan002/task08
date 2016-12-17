<?php

session_start();

//检测是否登录，若没登录则转向登录界面
if(!isset($_SESSION['userid'])){
    header("Location:login.html");
    exit();
}

$html = "
<!doctype html>
<html lang=''>
<head>
    <meta charset='utf-8'>
    <meta name='description' content=''>
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no'>
    <title>百度新闻后台管理--新闻添加</title>

    <link rel='apple-touch-icon' href='apple-touch-icon.png'>
    <!-- Place favicon.ico in the root directory -->

    <link rel='stylesheet' href='styles/bootstrap.min.css'>

    <link rel='stylesheet' href='styles/main.css'>

</head>
<body>

<header>
    <nav class='navbar navbar-default'>
        <div class='container-fluid'>
            <div class='navbar-header'>
                <button type='button' class='navbar-toggle collapsed' data-toggle='collapse'
                        data-target='#bs-example-navbar-collapse-1' aria-expanded='false'>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                </button>
                <a class='navbar-brand' href='#'>Baidu -- News</a>
            </div>

            <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
                <ul class='nav navbar-nav'>
                    <li><a href='#'><span class='glyphicon glyphicon-refresh'></span></a></li>
                </ul>
                <!--<form class='navbar-form navbar-left' role='search'>
                    <div class='form-group'>
                        <input type='text' class='form-control' placeholder='请输入搜索关键字'>
                    </div>
                    <button type='submit' class='btn btn-default'><span class='glyphicon glyphicon-search'></span>
                    </button>
                </form>-->
                <ul class='nav navbar-nav navbar-right'>
                    <li><a href='#'>退出</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <div class='menu'>
        <div class='menu-list-wrap'>

            <ul>
                <li><a href='javascript:;'><span class='glyphicon glyphicon-home'></span>控制台</a></li>
                <li>
                    <a href='javascript:;'><span class='glyphicon glyphicon-list-alt'></span>新闻管理</a>
                    <ul>
                        <li><a href='./index.php'><span class='glyphicon glyphicon-th-list'></span>新闻列表</a></li>
                        <li><a href='javascript:;'><span class='glyphicon glyphicon-plus'></span>添加新闻</a></li>
                    </ul>
                </li>
                <li><a href='javascript:;'><span class='glyphicon glyphicon-heart'></span>健康管理</a></li>
                <li><a href='javascript:;'><span class='glyphicon glyphicon-th-list'></span>菜单管理</a></li>
                <li><a href='javascript:;'><span class='glyphicon glyphicon-signal'></span>统计数据</a></li>
                <li><a href='javascript:;'><span class='glyphicon glyphicon-cog'></span>系统配置</a></li>
            </ul>

        </div>
    </div>
</header>


<main>

    <ol class='breadcrumb'>
        <li><a href='#'>首页</a></li>
        <li><a href='#'>新闻管理</a></li>
        <li class='active'>添加新闻</li>
    </ol>

    <div class='content'>

        <div class='panel panel-default'>
            <div class='panel-heading'>添加新闻</div>
            <div class='panel-body'>
                <form onsubmit='return false' class='form-horizontal' role='form'>
                    <div class='form-group'>
                        <label for='news_title' class='col-sm-2 control-label'>新闻标题</label>
                        <div class='col-sm-8'>
                            <input type='text' class='form-control' id='news_title' placeholder='请输入新闻标题'>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label for='news_type' class='col-sm-2 control-label'>新闻类型</label>
                        <div class='col-sm-8'>
                            <select class='form-control' id='news_type'>
                                <option>精选</option>
                                <option>百家</option>
                                <option>本地</option>
                                <option>娱乐</option>
                                <option>社会</option>
                                <option>军事</option>
                            </select>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label for='news_img' class='col-sm-2 control-label'>新闻照片</label>
                        <div class='col-sm-8'>
                            <input type='text' class='form-control' id='news_img' placeholder='请输入照片路径'>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label for='news_time' class='col-sm-2 control-label'>新闻时间</label>
                        <div class='col-sm-8'>
                            <input type='date' class='form-control' id='news_time'>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label for='news_source' class='col-sm-2 control-label'>新闻来源</label>
                        <div class='col-sm-8'>
                            <input type='text' class='form-control' id='news_source'>
                        </div>
                    </div>

                    <div class='form-group'>
                        <div class='col-sm-offset-2 col-sm-10'>
                            <button type='submit' class='btn btn-primary' id='btnSubmit'>提交新闻</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
</main>


<script src='scripts/jquery-3.1.1.min.js'></script>
<script src='scripts/bootstrap.min.js'></script>
<script src='scripts/admin.js'></script>
</body>
</html>


";

echo $html;

?>