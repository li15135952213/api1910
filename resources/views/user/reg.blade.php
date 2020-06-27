<form action="{{url('user/regDo')}}" method="post">
    <table>
        <tr>
            <td>用户名</td>
            <td><input type="text" name="user_name"></td>
        </tr>
        <tr>
            <td>邮箱</td>
            <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <td>密码</td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td>确认密码</td>
            <td><input type="password" name="passwords"></td>
        </tr>
        <tr>
            <td><input type="submit" value="注册"></td>
            <td></td>
        </tr>
    </table>
</form>