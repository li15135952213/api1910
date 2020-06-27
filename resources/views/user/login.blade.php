<form action="{{url('user/loginDo')}}" method="post">
    <table>
        <tr>
            <td>用户</td>
            <td><input type="text" name="user_name"></td>
        </tr>
        <tr>
            <td>密码</td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td><input type="submit" value="登录"></td>
            <td></td>
        </tr>
    </table>
</form>