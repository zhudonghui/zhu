<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
   <table>
       <tr>
           <td>ID</td>
           <td>姓名</td>
           <td>邮箱</td>
       </tr>
       <?php foreach($user as $val){?>
       <tr>
           <td><?php echo $val['u_id']?></td>
           <td><?php echo $val['u_name']?></td>
           <td><?php echo $val['email']?></td>
           <td><a href="<?=URL('/del')?>?u_id=<?=$val['u_id']?>">删除</a></td>
       </tr></br>
   </table>
<?php }?>
</body>
</html>