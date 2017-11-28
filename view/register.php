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
    <h1>Register</h1>
    <div>
        <form action="./" method="post">
            <span>Username:</span>
            <input type="text" name="username">
            <br>
            <span>Password:</span>
            <input type="password" name="password">
            <br>
            <span>Password Verify:</span>
            <input type="password" name="password_verify">
            <br>
            <input type="radio" name="user_type" value="venue"> Venue<br>
            <input type="radio" name="user_type" value="artist"> Artist<br>
            <input type="radio" name="user_type" value="customer"> Customer
            <br>
            <input type="submit" value="Register">
            <input type="hidden" name="action" value="register_go">
        </form>
        <form action="./" method="post">
            <input type="submit" value="Login">
            <input type="hidden" name="action" value="login">
        </form>
        <form action="./" method="post">
            <input type="submit" value="Homepage">
        </form>
    </div>
</div>
</body>
</html>