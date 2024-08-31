<?php
class ViewLogin
{
    public function output($error = null)
    {
        ?>
        <html>

        <head>
            <title>
                Login
            </title>
            <link rel="stylesheet" type="text/css" href="../css/style.css">
        </head>

        <body>
            <h1>Login</h1>
            <?php
            if ($error !== null) {
                echo "<div class='error-message'>" . htmlspecialchars($error) . "</div>";
            }
            ?>
            <form method="POST" action="/?page=auth">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username"></input>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password"></input>
                <input type="submit" value="Login">
            </form>
        </body>

        </html>
        <?php
    }
}
?>