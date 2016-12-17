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
    <title>百度新闻后台管理</title>

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
                    <li><a href='javascript:;' id='btn_refresh'><span class='glyphicon glyphicon-refresh'></span></a></li>
                </ul>
                <!--<form class='navbar-form navbar-left' role='search'>
                    <div class='form-group'>
                        <input type='text' class='form-control' placeholder='请输入搜索关键字'>
                    </div>
                    <button type='submit' class='btn btn-default'><span class='glyphicon glyphicon-search'></span>
                    </button>
                </form>-->
                <ul class='nav navbar-nav navbar-right'>
                    <li><a href='javascript:;' id='login_out'>退出</a></li>
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
                        <li><a href='javascript:;'><span class='glyphicon glyphicon-th-list'></span>新闻列表</a></li>
                        <li><a href='./add-news.php'><span class='glyphicon glyphicon-plus'></span>添加新闻</a></li>
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
        <li><a href='javascript:;'>首页</a></li>
        <li><a href='javascript:;'>新闻管理</a></li>
        <li class='active'>新闻列表</li>
    </ol>

    <div class='content'>

        <table class='table table-hover' id='news_table'>
            <thead>
            <tr>
                <th>ID</th>
                <th>类型</th>
                <th>新闻标题</th>
                <th>图片地址</th>
                <th>新闻来源</th>
                <th>新闻时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>

    </div>
</main>


<!-- 确认删除弹出框 -->
<div class='modal fade' id='deleteModal'>
    <div class='modal-dialog modal-sm'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
                <h4 class='modal-title'>警告</h4>
            </div>
            <div class='modal-body'>
                <p>删除新闻？</p>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-default' data-dismiss='modal'>取消</button>
                <button type='button' class='btn btn-primary' id='confirmDel'>确认</button>
            </div>
        </div>
    </div>
</div>


<!-- 修改新闻 -->
<div class='modal fade' id='updateModal'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
                <h4 class='modal-title'>编辑</h4>
            </div>
            <div class='modal-body'>
                <form class='form-horizontal' role='form'>
                    <div class='form-group'>
                        <label for='unews_title' class='col-sm-2 control-label'>新闻标题</label>
                        <div class='col-sm-8'>
                            <input type='text' class='form-control' id='unews_title' placeholder='请输入新闻标题'>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label for='unews_type' class='col-sm-2 control-label'>新闻类型</label>
                        <div class='col-sm-8'>
                            <select class='form-control' id='unews_type'>
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
                        <label for='unews_img' class='col-sm-2 control-label'>新闻照片</label>
                        <div class='col-sm-8'>
                            <input type='text' class='form-control' id='unews_img' placeholder='请输入照片路径'>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label for='unews_time' class='col-sm-2 control-label'>新闻时间</label>
                        <div class='col-sm-8'>
                            <input type='date' class='form-control' id='unews_time'>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label for='unews_source' class='col-sm-2 control-label'>新闻来源</label>
                        <div class='col-sm-8'>
                            <input type='text' class='form-control' id='unews_source'>
                        </div>
                    </div>
                </form>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-default' data-dismiss='modal'>取消</button>
                <button type='button' class='btn btn-primary' id='confirmUpdate'>确认</button>
            </div>
        </div>
    </div>
</div>


<script src='scripts/jquery-3.1.1.min.js'></script>
<script src='scripts/bootstrap.min.js'></script>
<script src='scripts/admin.js'></script>
</body>
</html>

";

echo $html;

?>