<form action="{{URL('/message')}}" method="post" enctype="multipart/form-data">
    <table>
            <input type="hidden" value="{{csrf_token()}}" name="_token">
            <tr>
                <td>标题:<input type="text" name="title"></td>
            </tr>
            <tr>
                <td>留言:<textarea cols="8" rows="8" name="content"></textarea></td>
            </tr>
           <!--  <tr>
                 <td><input type="file" name="img" value="上传图片"></td>
            </tr> -->
            <tr>
                <td><input type="button" value="留言" id="btn"></td>
            </tr>
        </table>
</form>
<table border="2" class="table">
    <tr>
        <td><input type="checkbox"></td>
        <td>标题</td>
        <td>内容</td>
        <td>时间</td>
        <td>操作</td>
    </tr>
    <?php foreach($arr as $val) {?>
    <tr>
       <td><input type="checkbox" class="check" name="id" value="<?php echo $val['id']?>"></td>
        <td><?php echo $val['title']?></td>
        <td value="<?php echo $val['id']?>"><span><?php echo $val['content']?></span></td>
        <td><?php echo $val['time']?></td>
        <td><a href="<?=URL('/del')?>?id=<?=$val['id']?>">删除</a></td>
    </tr>
    <?php }?>
    <tr>
        <td><input type="button" id="whole" value="全选"></td>
        <td><input type="button" id="back" value="反选"></td>
        <td><input type="button" id="cancel" value="取消"></td>
        <td><input type="button" id="del" value="批量删除"></td>
    </tr>
</table>
{!! $arr->render() !!}
<script src="../resources/assets/js/jq.js"></script>
<script>
//数据添加
$(document).on('click','#btn',function(){
    var title=$("input[name='title']").val();
    var content=$("textarea[name='content']").val(); 
/*    var img=$("input[name='img']").val();
*/    $.post("{{URL('/message')}}",{title:title,content:content},function(msg){
      if(msg==1)
      {
        location.reload();
      }
      else
      {
        alert("留言失败");
      }
   })
});
//即点即改
$(document).on('click','span',function(){
    old_var=$(this).html();
    $(this).parent().html("<input type=\'text\' value="+old_var+">");
    $(document).on('blur','input',function(){
        var obj=$(this);
        var id=$(this).parent().attr('value');//获取要修改的内容的id
        var val=$(this).val();//获取修改后的值
        $.ajax({
            type: 'post',
            url:  "{{URL('/namely')}}",
            data:{
                id:id,
                val:val
            },
            success:function(msg){
                if(msg==1){
                    obj.parent().html("<span class='name'>"+val+"</span>")
                }
                else{
                  obj.parent().html("<span class='name'>"+old_var+"</span>")
                }
            }
        })

    })

})
//全选
$("#whole").click(function(){
    $(".check").each(function(){
        this.checked=true;
    })
})
//反选
$("#back").click(function(){
    $(".check").each(function(){
        if(this.checked==true){
         this.checked=false;
        }else{
            this.checked=true;
        }
    })
})
//取消
$("#cancel").click(function(){
    $(".check").each(function(){
        this.checked=false;
    })
})

//批量删除--至少选一项
$("#del").click(function(){
    //alert(123);
    var checkNum=$("input[name='id']:checked").length;
    if(checkNum==0)
    {
        alert("请至少选一项！");
        return;
    }
    //批量删除--接值删除
    if(confirm("确定要删除已选项目"))
    {
        var checkList=new Array();
        $("input[name='id']:checked").each(function(){
            checkList.push($(this).val());
        })
        $.ajax({
        
            type: 'post',
            url: "{{URL('/delete')}}",
            data: {'id':checkList.toString()},
            success:function(result){
                $("[name='id']:checkbox").attr("checked",false);
                window.location.reload();
        }
    })
  }
})
</script>