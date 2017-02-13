

var url="http://sc.boetech.cn";
//喜欢
      function dolike(id) {
          sendLikeInfo("sheqv/topic/like/" + id,id);
      }

      function getLikeSignInfo(path,guid,param,signature,time,version){
        if(!checkTimeInter(3000)) {
          return;
        }
        var t = url+path;
        $.ajax({
              type: 'POST',
              data: {'param':"",'guid':guid,'version':version,'signature':signature,'time':time},
              url: t,
              dataType:'json',
              async:true,
              success: function (msg) {
                  if(msg=='1'){
                    $('#img_'+param+' img').attr('src',"http://sc.boetech.cn/dist/scimages/mang.png");
                    $('#img_'+param).removeAttr("onclick");//去掉事件
                  }
              }
          });
      }
      

      // function dozhaun(type,guid,topic_id,cite_id,plate_id,father_id,yuantie) {
      //   if(!checkTimeInter(3000)) {
      //     return;
      //   }
      //   var path;
      //   var content=$('#zhuanCon_'+topic_id).val();
      //   if(type==1){
      //     var t = url+"/sheqv/forward/"+plate_id+"/"+topic_id+"/"+father_id;
      //     path="sheqv/forward/"+plate_id+"/"+topic_id+"/"+father_id;
      //   }else if(type==2){
      //     var t = url+"/sheqv/forward/"+plate_id+"/"+yuantie+"/"+topic_id;
      //     path="sheqv/forward/"+plate_id+"/"+yuantie+"/"+topic_id;
      //   }else{
      //     var t = url+"/sheqv/forward/"+plate_id+"/"+topic_id+"/"+father_id;
      //     path="sheqv/forward/"+plate_id+"/"+topic_id+"/"+father_id;
      //   }
      //   sendZhuanInfo(path,content);
      // }

      // function getSign(path,guid,param,signature,time,version){
      //   alert(path);
      //   var t = url+path;
      //   alert(t);
      //   $.ajax({
      //       type: 'POST',
      //       data: {'param':param,'guid':guid,'version':version,'signature':signature,'time':time},
      //       //data: {'param':"aaaaaa"},
      //       url: t,
      //       dataType:'json',
      //       async:true,
      //       success: function (msg) {
      //         alert(msg);
      //           if(msg==1){
      //             alert('成功');
      //             document.location.reload();
      //           }else{
      //             alert('失败');
      //           }
      //       }
      //   });
      // }

      function doping(guid,topic_id,father_id) {
        if(!checkTimeInter(3000)) {
          return;
        }
        var content=$('#pingCon_'+topic_id).val();
        var path = "sheqv/addcomment/"+topic_id+"/"+father_id;
        sendCommentInfo(path,content);
      }

      // function getPingSign(path,guid,param,signature,time,version){
      //   alert(path);
      //   var t = url+path;
      //   alert(t);
      //   $.ajax({
      //       type: 'POST',
      //       data: {'param':param,'guid':guid,'version':version,'signature':signature,'time':time},
      //       dataType:'json',
      //       async:true,
      //       url: t,
      //       success: function (msg) {
      //           alert(msg);
      //           if(msg==1){
      //             document.location.reload();
      //           }
      //       }
      //   });
      // }

  // 回复显示隐藏
   function slideToggle(obj) {
        if ($("#" + obj).css("display") == "none") {
            var aa=$(".divobj").css("display", "none");
            //alert(aa);
            $("#" + obj).css("display", "block");
        } else {
            $("#" + obj).css("display", "none");
        }
    }

    //回复
    function doreply(guid,topic_id,father_id,k) {
        if(!checkTimeInter(3000)) {
          return;
        }
        var content=$('#pingCon_'+k+father_id).val();
        var t = url+"/sheqv/comment/"+topic_id+"/"+father_id;
        $.ajax({
            type: 'POST',
            data: {'content':content,'guid':guid},
            dataType:'json',
            async:true,
            url: t,
            success: function (msg) {
                if(msg==1){
                  document.location.reload();
                }
            }
        });
      }

      var time_s = null,time_e = null,time_i = null,num = 1;
      function checkTimeInter(minTime) {
        if(num == 1) {
          time_s = new Date().getTime();
          num ++;
          return true;
        } else {
          time_e = new Date().getTime();
          time_i = time_e - time_s;
          time_s = time_e;
          if(time_i > minTime) {
            return true;
          } else {
            return false;
          }
        }
      }


