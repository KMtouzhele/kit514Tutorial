<?php
class LogTable
{
    public function output($logs)
    {
        ?>
        <div class="container">
            <table>
                <tr>
                    <th>Log ID</th>
                    <th>Username</th>
                    <th>Action</th>
                    <th>Timestamp</th>
                    <th>IP Address</th>
                </tr>
                <?php
                foreach ($logs as $log) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($log->id); ?></td>
                        <td><?php echo htmlspecialchars($log->username); ?></td>
                        <td><?php echo htmlspecialchars($log->action); ?></td>
                        <td><?php echo htmlspecialchars($log->timestamp); ?></td>
                        <td><?php echo htmlspecialchars($log->ipAddress); ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
        <?php
    }
}
?>