<?php
class ViewHome
{
    private $user;

    public function output($user, $buttons)
    {
        ?>
        <html>

        <head>
            <title>Home</title>
            <link rel="stylesheet" type="text/css" href="/css/style.css">
        </head>

        <body>
            <h1>Welcome, <?php echo htmlspecialchars($user->username); ?>!</h1>

            <div class="container">
                <p>Description: <?php echo htmlspecialchars($user->description); ?></p>
            </div>
            <?php foreach ($buttons as $button):
                $subpage = urlencode(strtolower(htmlspecialchars($button)));
                $actionUrl = "?action=to{$subpage}";
                ?>
                <form method="POST" action="<?php echo htmlspecialchars($actionUrl); ?>">
                    <input type="submit" value="<?php echo htmlspecialchars($button); ?>">
                </form>
            <?php endforeach; ?>
        </body>

        </html>
        <?php
    }
}
?>