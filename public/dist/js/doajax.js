$(function(){
/*******************************/
    //章的事件
    /*******************************/
    $('.chaptersubmit').click(function(){
        var url = $(".form-horizontal").attr("action");
        var chapter_title = $('.title').val();
        var chapter_describe = $('.describe').val();
        var order = $('.order').val();
        $.ajax({
        type: 'POST',
        url:url,
        data: {'order':order,'chapter_title':chapter_title,'chapter_describe':chapter_describe},
        dataType: 'json',
        success: function($data){
                if($data['ResultData']=='成功'){
                    $('.modal-title').html('添加成功！');
                    $('.modal-body').html('数据添加成功！');
                    $('.confirm').hide();
                    $('.example-modal').show();
                    $('button.exit').val('关闭');
                    $('.exit').click(function(){
                        $('.example-modal').hide();
                        window.location.reload(); 
            });
                }else{
                        $('.modal-title').html('好像出了点问题');
                        $('.modal-body').html('添加失败,请检查程序！');
                        $('.confirm').hide();
                        $('.example-modal').show();
                        $('.exit').val('关闭');
                        $('.exit').click(function(){
                             $('.example-modal').hide();
                         });
                }
            }
            });
    });
    

    //添加节
    $('.sectionsubmit').click(function(){
        var order = $('.order').val();
        var video = $('.video option:selected').val();
        var new_m3u8 = $('.video option:selected').attr('alt');
        var length = $('.video option:selected').attr('for');
        var vi_describe = $('.video option:selected').attr('str');
        var co_describe = $('.co_describe').val();
        var markdown = $('.markdown option:selected').val();
        var task = $('.task option:selected').val();
        var appendix = $('.appendix option:selected').val();
        var url = $(".form-horizontal").attr("action");
        $.ajax({
        type: 'POST',
        url:url,
        data: {'order':order,'video':video,'m3u8':new_m3u8,'length':length,'vi_describe':vi_describe,'co_describe':co_describe,'markdown':markdown,'task':task,'appendix':appendix},
        dataType: 'json',
        success: function($data){
                if($data['ResultData']=='成功'){
                    $('.modal-title').html('添加成功！');
                    $('.modal-body').html('数据添加成功！');
                    $('.confirm').hide();
                    $('.example-modal').show();
                    $('button.exit').val('关闭');
                    $('.exit').click(function(){
                        $('.example-modal').hide();
                        window.location.reload(); 
            });
                }else{
                        $('.modal-title').html('好像出了点问题');
                        $('.modal-body').html('添加失败,请检查程序！');
                        $('.confirm').hide();
                        $('.example-modal').show();
                        $('.exit').val('关闭');
                        $('.exit').click(function(){
                             $('.example-modal').hide();
                         });
                }
            }
            });
    });



    $('.coursesubmit').click(function(){
        var url = $(".form-horizontal").attr("action");
        var course_name = $('.name').val();
        var course_describe = $('.describe').val();
        var course_pic = $('.pic').val();
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: {'course_name': course_name,'course_describe':course_describe,'course_pic':course_pic},
            success:function($data){
                if($data['ResultData']=='成功'){
                    $('.modal-title').html('添加成功！');
                    $('.modal-body').html('数据添加成功！');
                    $('.confirm').hide();
                    $('.example-modal').show();
                    $('button.exit').val('关闭');
                    $('.exit').click(function(){
                        $('.example-modal').hide();
                        window.location.reload(); 
                    });
                }else{
                    $('.modal-title').html('好像出了点问题');
                    $('.modal-body').html('添加失败,请检查程序！');
                        $('.confirm').hide();
                        $('.example-modal').show();
                        $('.exit').val('关闭');
                        $('.exit').click(function(){
                            $('.example-modal').hide();
                        });
                }
                }
            })
        });
        
    
    /***********/
    //添加已有节
    /***********/
    $('.addchapter').click(function(){
    var url = $(this).attr('url');
    var name = $(this).attr('alt');
    $('.chapter_name').val(name);
    $('.addkuang').show();
    $('.exit1').click(function(){
        $('.addkuang').hide();
    });
    $('.addsection').click(function(){
        var section_id = $('.vi_describe option:selected').val();
        $.ajax({
            type: 'get',
            url:url,
            data: {'section_id':section_id},
            dataType: 'json',
            success:function($data){
                if($data['ResultData']=='成功'){
                    $('.addkuang').hide();
                    $('.modal-title').html('添加成功！');
                    $('.modal-body').html('数据添加成功！');
                    $('.confirm').hide();
                    $('.example-modal').show();
                    $('button.exit').val('关闭');
                    $('.exit').click(function(){
                        $('.example-modal').hide();
                        window.location.reload();
                    });
                        }else{
                            $('.addkuang').hide();
                            $('.modal-title').html('好像出了点问题');
                            $('.modal-body').html('添加失败,请检查程序！');
                            $('.confirm').hide();
                            $('.example-modal').show();
                            $('.exit').val('关闭');
                            $('.exit').click(function(){
                                $('.example-modal').hide();
                            });
                        }
                }
            })
        })
    
    });

        
        
    

    /*******************************/
    //添加已有章
    /*******************************/
    $('.addcourse').click(function(){
    var url = $(this).attr('url');
    var name = $(this).attr('alt');
    $('.course_name').val(name);
    //显示弹框
        $('.addkuang').show();
    //弹框关闭
        $('.exit1').click(function(){
            $('.addkuang').hide();
    });
    //ajax提交数据
        $('.addchapter').click(function(){
            var chapter_id = $('.chapter_title option:selected').val();
            $.ajax({
            type: 'get',
            url:url,
            data: {'chapter_id':chapter_id},
            dataType: 'json',
            success: function($data){
                if($data['ResultData']=='成功'){
                    $('.addkuang').hide();
                    $('.modal-title').html('添加成功！');
                    $('.modal-body').html('数据添加成功！');
                    $('.confirm').hide();
                    $('.example-modal').show();
                    $('button.exit').val('关闭');
                    //关闭弹框
                    $('.exit').click(function(){
            $('.example-modal').hide();
            window.location.reload();
    });
                }else{
                    $('.addkuang').hide();
                    $('.modal-title').html('好像出了点问题');
                    $('.modal-body').html('添加失败,请检查程序！');
                    $('.confirm').hide();
                    $('.example-modal').show();
                    $('.exit').val('关闭');
                    //关闭弹框
                    $('.exit').click(function(){
            $('.example-modal').hide();
            //window.location.reload();
    });
                }
            }
            });
        });
    });



    /*******************************/
    //添加新节
    /*******************************/
    $('.addnewcourse').click(function() {
        var url = $(this).attr('url');
        var name = $(this).attr('alt');
        $('.course_name').val(name);
        //显示弹框
        $('.newaddkuang').show();
        //弹框关闭
        $('.exit1').click(function () {
            $('.newaddkuang').hide();
        });

        //ajax提交数据 新节
        $('.newaddchapter').click(function(){
            var new_video= $('.video option:selected').val();
            var new_m3u8 = $('.video option:selected').attr('alt');
            var new_vi_describe = $('.vi_describe').val();
            var new_co_describe = $('.co_describe').val();
            var new_markdown = $('.markdown option:selected').val();
            var new_task = $('.task option:selected').val();
            var new_appendix = $('.appendix option:selected').val();
            var order = $('.order').val();
            $.ajax({
                url:'/section',
                type: 'post',
                data: {'order':order,'video':new_video,'m3u8':new_m3u8,'vi_describe':new_vi_describe,'co_describe':new_co_describe,'markdown':new_markdown,'task':new_task,'appendix':new_appendix},
                dataType: 'json',
                success:function($data){
                    if($data['ResultData']=='成功'){
                        $.ajax({
                            url:url ,
                            type: 'get',
                            dataType: 'json',
                            data: {'section_id':$data['id']},
                            success:function($data){
                                if($data['ResultData']=='成功'){
                                    $('.newaddkuang').hide();
                                    $('.modal-title').html('添加成功！');
                                    $('.modal-body').html('数据添加成功！');
                                    $('.confirm').hide();
                                    $('.example-modal').show();
                                    $('button.exit').val('关闭');

                                    $('.exit').click(function(){
                                        $('.example-modal').hide();
                                        window.location.reload();
                                    });
                                }
                            }
                        })
                        
                    }
                }
            });
        });
       
    });

    
    /*******************************/
    //弹框显示
    /*******************************/
    $('.del').click(function(){
            $('.example-modal').show();
            var url = $(this).attr('url');
            //弹框关闭
    $('.exit').click(function(){
            $('.example-modal').hide();
            window.location.reload();
    });
    //提交删除
    $('.confirm').click(function(){
        $.ajax({
        type: 'get',
        url:url,
        data:null,
        dataType: 'json',
        success: function($data){
                if($data['ResultData']=='成功'){
                    window.location.reload();
                }else{
                    $('.modal-title').html('好像出了点问题');
                    $('.modal-body').html('删除失败,请检查程序！');
                }
            }
        
            });
        //window.location.reload()
    });
    
    });

    /*******************************/
    //添加新章节
    /*******************************/
    $('.addchapter1').click(function(){
        var url = $(this).attr('url');
        var name = $(this).attr('alt');
        $('.course_name').val(name);
        //显示弹框
        $('.addnewchapterk').show();
        //弹框关闭
        $('.exit2').click(function(){
        $('.addnewchapterk').hide();
    });
        
    
    $('.addnewchapter1').click(function() {
        var title = $('.title').val();
        var describe = $('.describe').val();
        var order = $('.order').val();
        $.ajax({
            url: '/chapter',
            type: 'post',
            dataType: 'json',
            data: {'order':order,'chapter_title': title,'chapter_describe':describe},
            success:function($data){
                if($data['ResultData']=='成功'){
                        $.ajax({
                        url:url,
                        type:'get',
                        dataType:'json',
                        data:{'chapter_id':$data['id']},
            success: function($data){
                if($data['ResultData']=='成功'){
                    $('.addnewchapterk').hide();
                    $('.modal-title').html('添加成功！');
                    $('.modal-body').html('数据添加成功！');
                    $('.confirm').hide();
                    $('.example-modal').show();
                    $('button.exit').val('关闭');
                    //关闭弹框
                    $('.exit').click(function(){
            $('.example-modal').hide();
            window.location.reload();
    });
                }else{
                    $('.addnewchapterk').hide();
                    $('.modal-title').html('好像出了点问题');
                    $('.modal-body').html('添加失败,请检查程序！');
                    $('.confirm').hide();
                    $('.example-modal').show();
                    $('.exit').val('关闭');
                    //关闭弹框
                    $('.exit').click(function(){
            $('.example-modal').hide();
            //window.location.reload();
    });
                }
            }
                })

                }
            
            }
        
    
    
    });

    });

});


    /*******************************/
    //课程中添加已有课程
    /*******************************/
    $('.addoldcourse').click(function(){
    var url = $(this).attr('url');
    var name = $(this).attr('alt');
    $('.course_name').val(name);
    //显示弹框
        $('.addkuang').show();
    //弹框关闭
        $('.exit1').click(function(){
            $('.addkuang').hide();
    });
    //鼠标移出
       $('#cdtype').mouseout(function(){
        var type = $('.cdtype option:selected').val();
        if(type==1){
            $('.courses').show();
            $('.chapters').hide();
            $('.sections').hide();
            $('.appendix').hide();
            var course_id = $('.chapter_title option:selected').val();
        } else if(type==2){
            $('.courses').hide();
            $('.chapters').show();
            $('.sections').hide();
            $('.appendix').hide();
            var chapter_id = $('.chapter1_title option:selected').val();
        } else if(type==3){
            $('.courses').hide();
            $('.chapters').hide();
            $('.sections').show();
            $('.appendix').hide();
            var section_id = $('.section_title option:selected').val();
        }else{
            $('.courses').hide();
            $('.chapters').hide();
            $('.sections').hide();
            $('.appendix').show();
            var appendix_id = $('.appendix_title option:selected').val();
        }
        });
    //ajax提交数据
        $('.addchapter').click(function(){
            var course_id = $('.chapter_title option:selected').val();
            var chapter_id = $('.chapter1_title option:selected').val();
            var section_id = $('.section_title option:selected').val();
            var appendix_id = $('.appendix_title option:selected').val();
            var type = $('.cdtype option:selected').val();
            var dataid=null;
            
            if(type=='1'){
                dataid = course_id;
            }
            if(type=='2'){
                dataid = chapter_id;
            }
            if(type=='3'){
                dataid = section_id;
            }
            if(type=='4'){
                dataid = appendix_id;
            }
            $('.chapter_title option:selected').val('0');
            $('.chapter1_title option:selected').val('0');
            $('.section_title option:selected').val('0');
            $('.appendix_title option:selected').val('0');
            $.ajax({
            type: 'get',
            url:url,
            data: {'course_id':dataid,'type':type},
            dataType: 'json',
            success: function($data){
                if($data['ResultData']=='成功'){
                    $('.addkuang').hide();
                    $('.modal-title').html('添加成功！');
                    $('.modal-body').html('数据添加成功！');
                    $('.confirm').hide();
                    $('.example-modal').show();
                    $('button.exit').val('关闭');
                    //关闭弹框
                    $('.exit').click(function(){
            $('.example-modal').hide();
            window.location.reload();
    });
                }else{
                    $('.addkuang').hide();
                    $('.modal-title').html('好像出了点问题');
                    $('.modal-body').html('添加失败,请检查程序！');
                    $('.confirm').hide();
                    $('.example-modal').show();
                    $('.exit').val('关闭');
                    //关闭弹框
                    $('.exit').click(function(){
            $('.example-modal').hide();
            //window.location.reload();
    });
                }
            }
            });
        });
    });


     /*******************************/
    //添加新课程
    /*******************************/
    $('.addnewcourse').click(function(){
        var url = $(this).attr('url');
        var name = $(this).attr('alt');
        $('.course_name').val(name);
        //显示弹框
        $('.addnewchapterk').show();
        //弹框关闭
        $('.exit2').click(function(){
        $('.addnewchapterk').hide();
    });
        
    
    $('.submitcourse').click(function() {
        var title = $('.title').val();
        var describe = $('.describe').val();
        $.ajax({
            url: '/goods',
            type: 'post',
            dataType: 'json',
            data: {'chapter_title': title,'chapter_describe':describe},
            success:function($data){
                if($data['ResultData']=='成功'){
                        $.ajax({
                        url:url,
                        type:'get',
                        dataType:'json',
                        data:{'chapter_id':$data['id']},
            success: function($data){
                if($data['ResultData']=='成功'){
                    $('.addnewchapterk').hide();
                    $('.modal-title').html('添加成功！');
                    $('.modal-body').html('数据添加成功！');
                    $('.confirm').hide();
                    $('.example-modal').show();
                    $('button.exit').val('关闭');
                    //关闭弹框
                    $('.exit').click(function(){
            $('.example-modal').hide();
            window.location.reload();
    });
                }else{
                    $('.addnewchapterk').hide();
                    $('.modal-title').html('好像出了点问题');
                    $('.modal-body').html('添加失败,请检查程序！');
                    $('.confirm').hide();
                    $('.example-modal').show();
                    $('.exit').val('关闭');
                    //关闭弹框
                    $('.exit').click(function(){
            $('.example-modal').hide();
            //window.location.reload();
    });
                }
            }
                })

                }
            
            }
        
    
    
    });

    });

});



/*******************************/
//产品以及结束时间
/*******************************/
        $('#cptype').mouseout(function(){
            var type = $('.cptype option:selected').val();
            if(type==2){
                $('#endtime').show();
            }else{
                $('#endtime').hide();
            }
        });


        });