<?php
class ViewPermission
{
    public function output($permissions)
    {
        ?>
        <html>

        <head>
            <title>
                Permission
            </title>
            <link rel="stylesheet" type="text/css" href="/css/style.css">
        </head>

        <body>
            <h1>Permission</h1>
            <div class="container">
                <table>
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($permissions as $permission): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($permission->user_id); ?></td>
                            <td><?php echo htmlspecialchars($permission->username); ?></td>
                            <td><?php echo htmlspecialchars($permission->role); ?></td>
                            <td>
                                <form method="POST" action="?action=setadmin">
                                    <input type="hidden" name="user_id"
                                        value="<?php echo htmlspecialchars($permission->user_id); ?>">
                                    <input type="submit" name="setrole" value="admin">
                                    <input type="submit" name="setrole" value="moderator">
                                    <input type="submit" name="setrole" value="basic">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

        </body>

        </html>
        <?php
    }
}
?>