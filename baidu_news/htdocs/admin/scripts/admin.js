/**
 * Created by CAN on 2016/10/7.
 */

$(function () {

    //退出
    $("#login_out").click(function () {
        $.ajax({
            url: '../server/login.php',
            type: 'GET',
            data: {action: 'logout'},
            success: function (data) {
            },
            error: function (data) {

            }
        })
    });

    //新闻内容
    var newsTable = $("#news_table tbody");
    refreshNews('');

    //新闻提交
    $("#btnSubmit").click(function (e) {

        e.preventDefault();

        var newsTitle = $("#news_title");
        var newsType = $("#news_type");
        var newsImg = $("#news_img");
        var newsTime = $("#news_time");
        var newsSource = $("#news_source");

        if (newsTitle.val() == '') {
            newsTitle.parent().addClass("has-error");
            return false;
        } else {
            newsTitle.parent().removeClass("has-error");
        }

        if (newsImg.val() == '') {
            newsImg.parent().addClass("has-error");
            return false;
        } else {
            newsImg.parent().removeClass("has-error");
        }

        if (newsTime.val() == '') {
            newsTime.parent().addClass("has-error");
            return false;
        } else {
            newsTime.parent().removeClass("has-error");
        }

        if (newsSource.val() == '') {
            newsSource.parent().addClass("has-error");
            return false;
        } else {
            newsSource.parent().removeClass("has-error");
        }

        //提交新闻
        var jsonNews = {
            newsTitle: newsTitle.val(),
            newsType: newsType.val(),
            newsImg: newsImg.val(),
            newsTime: newsTime.val(),
            newsSrc: newsSource.val()
        };

        $.ajax({
            url: '../server/insert.php',
            type: 'POST',
            data: jsonNews,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                window.location.href = './index.php';
            }
        })
    });


    //删除新闻
    var deleteId = '';
    newsTable.on("click", ".btn-danger", function () {
        $("#deleteModal").modal("show");
        deleteId = $(this).parent().prevAll().eq(5).html();
    });
    $("#deleteModal #confirmDel").click(function () {
        if (deleteId) {
            $.ajax({
                url: '../../server/delete.php',
                type: 'POST',
                data: {newsid: deleteId},
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    $("#deleteModal").modal("hide");
                    refreshNews('');
                }
            })
        }
    });

    //修改新闻
    var updateId = '';
    newsTable.on("click", ".btn-primary", function () {
        $("#updateModal").modal("show");
        updateId = $(this).parent().prevAll().eq(5).html();
        $.ajax({
            url: '../server/curnews.php',
            type: 'GET',
            data: {newsid: updateId},
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $("#unews_title").val(data[0]['newstitle']);
                $("#unews_type").val(data[0]['newstype']);
                $("#unews_img").val(data[0]['newsimg']);
                $("#unews_source").val(data[0]['newssrc']);
                var utime = data[0].newstime.split(' ')[0];
                $("#unews_time").val(utime);
            }
        })
    });
    $("#updateModal #confirmUpdate").click(function () {
        if (updateId) {
            $.ajax({
                url: '../server/update.php',
                type: 'POST',
                data: {
                    newstitle: $("#unews_title").val(),
                    newstype: $("#unews_type").val(),
                    newsimg: $("#unews_img").val(),
                    newstime: $("#unews_time").val(),
                    newssrc: $("#unews_source").val(),
                    id: updateId
                },
                success: function (data) {
                    console.log(data);
                    $("#updateModal").modal("hide");
                    refreshNews('');
                }
            })
        }
    });


    //获取数据
    function refreshNews(type) {
        //清空数据
        newsTable.empty();
        $.ajax({
            url: '../server/getnews.php',
            type: 'GET',
            dataType: 'json',
            data: {newstype: type},
            success: function (data) {
                $.each(data, function (index, item) {
                    var news_id = $("<td>").html(item['id']);
                    var news_type = $("<td>").html(item['newstype']);
                    var news_title = $("<td>").html(item['newstitle']);
                    var news_img = $("<td>").html(item['newsimg']);
                    var news_src = $("<td>").html(item['newssrc']);
                    var news_time = $("<td>").html(item['newstime']);
                    var btn_box = $("<td>");
                    var btn_update = $("<button>").addClass("btn btn-primary btn-xs m-r-6").html("修改");
                    var btn_delete = $("<button>").addClass("btn btn-danger btn-xs").html("删除");
                    var row = $("<tr>");
                    btn_box.append(btn_update, btn_delete);
                    row.append(news_id, news_type, news_title, news_img, news_src, news_time, btn_box);
                    newsTable.append(row);
                });

            }
        })
    }


    //新闻列表手动刷新
    $("#btn_refresh").click(function () {
        refreshNews('');
    });


});
