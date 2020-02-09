function likes(id, count) {
    if ($.cookie(id)==null) {
        $('.likes > span').text(count+1);
        $('.likes').addClass('disabled');
        $.post('/ajax/likes', {id: id}, function(data){
            $.cookie(id, true, { expires: 30 });
        });
    }

}
//$.cookie('likes', null, { expires: -1 });