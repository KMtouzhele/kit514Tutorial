<?php
class ViewCustomerList
{
    public function output($customers)
    {
        ?>
        <html>  
            <head></head>  
            <body>  
                <?php   
                foreach ($customers as $id => $customer)  
                {  
                    echo "Cust ID: ".$customer->id."<br/>";
                    echo "Cust Fname: ".$customer->fname."<br/>";
                    echo "Cust Lname: ".$customer->lname."<br/>";
                    echo "Cust Email: ".$customer->email."<br/>";
                    echo "<br/>";
                }  
                ?>  
            </body>  
        </html>  
        <?php
    }
}
?>