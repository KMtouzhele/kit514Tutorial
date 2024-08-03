<?php
class ViewCustomerTable
{
    public function output($customers)
    {
        ?>
        <html>  
            <head></head>  
            <body>  
                <table>  
                    <thead>
                        <tr>
                        <td>ID</td>
                        <td>First Name</td>
                            <td>Last Name</td>
                            <td>Email</td>
                        </tr>
                    </thead>  
                    <tbody>
                        <?php
                        foreach ($customers as $id => $customer)  
                        {  
                            echo '<tr><td><a href="index.php?customer='.$customer->id.'">'.$customer->id.'</a></td><td>'.$customer->fname.'</td><td>'.$customer->lname.'</td><td>'.$customer->email.'</td></tr>';  
                        }  
                        ?>
                    </tbody>
                </table>  
            </body>
        </html>
        <?php
    }
}
?>