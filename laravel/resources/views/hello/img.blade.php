<form action="{{URL('/img')}}" method="post" enctype="multipart/form-data">
    <table>
            <input type="hidden" value="{{csrf_token()}}" name="_token">
            <tr>
                <td>留言:<textarea cols="8" rows="8" name="content"></textarea></td>
            </tr>
             <tr>
                 <td><input type="file" name="img" value="上传图片"></td>
            </tr>
            <tr>
                <td><input type="submit" value="留言" id="btn"></td>
            </tr>
        </table>
</form>
