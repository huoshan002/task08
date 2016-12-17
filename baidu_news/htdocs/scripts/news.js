"use strict";

$(function () {
    //初始化获取新闻
    refreshNews('');

    //切换新闻分类
    $(".mainMenu li a").click(function (e) {
        e.preventDefault();
        var curType = $(this).attr("data-type");
        refreshNews(curType);
        $(this).parent().addClass("selected").siblings().removeClass("selected");
    })

});

//刷新新闻方法
function refreshNews(type) {
    var newsList = $(".newslist-container");
    newsList.empty();

    //请求新闻接口
    $.ajax({
        url: './server/getnews.php',
        type: 'get',
        dataType: 'json',
        data: {newstype:type},
        success:function (data) {
            console.log(data);
            $.each(data, function (index, element) {
                var newsItem = $("<div></div>").addClass("index-list-item").appendTo(newsList);
                var newsBody = $("<div></div>").addClass("index-list-main showleft").appendTo(newsItem);
                var newsImg = $("<div></div>").addClass("index-list-image").appendTo(newsBody);
                var img = $("<img/>").attr("src", element['newsimg']).appendTo(newsImg);
                var newsText = $("<div></div>").addClass("index-list-main-text").appendTo(newsBody);
                var newsTitle = $("<div></div>").addClass("index-list-main-title").html(element['newstitle']).appendTo(newsText);
                var newsBottom = $("<div></div>").addClass("index-list-bottom").appendTo(newsText);
                var newsTimeBox = $("<div></div>").addClass("index-list-main-time").appendTo(newsBottom);
                var newsTime = $("<b></b>").addClass("tip-time").html(element['newstime'].split(' ')[0]).appendTo(newsTimeBox);
                var newsHot = $("<b></b>").addClass("tip-hot tip-fillred").html(element['newssrc']).appendTo(newsTimeBox);
            });

        }
    });


}