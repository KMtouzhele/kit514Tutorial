<?php
class ViewHome
{
    private $user;
    public function output($user, $buttons)
    {
        if (
            !isset($_SESSION['logged_in'])
            || $_SESSION['logged_in'] !== true
            || $_SESSION['id'] !== $user->id
        ) {
            header("Location: /?page=register");
            exit();
        }
        ?>
        <html>

        <head>
            <title>Home</title>
            <link rel="stylesheet" type="text/css" href="css/style.css">
        </head>

        <body>
            <h1>Welcome, <?php echo htmlspecialchars($user->username); ?>!</h1>
            <p>Description: <?php echo htmlspecialchars($user->description); ?></p>

            <form method="POST" action="">
                <?php foreach ($buttons as $button): ?>
                    <input type="submit" name="action" value="<?php echo htmlspecialchars($button); ?>">
                <?php endforeach; ?>
            </form>
        </body>

        </html>
        <?php
    }


}
?>