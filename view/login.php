<html>
<style>
    h1{

    }

    .base{
        margin-top: 10em;
        text-align: center;

    }
    input{
        width: 8em;
    }
</style>
<body>
<div class="base">
    <h1>Login</h1>
    <div>
        <form action="./" method="post">
            <span>Username:</span>
            <input type="text" name="username">
            <br>
            <span>Password:</span>
            <input type="password" name="password">
            <br>
            <input type="submit" value="Login">
            <input type="hidden" name="action" value="login_go">
        </form>
        <form action="./" method="post">
            <input type="submit" value="Register">
            <input type="hidden" name="action" value="register">
        </form>
        <form action="./" method="post">
            <input type="submit" value="Homepage">
        </form>
    </div>
</div>
</body>
</html>