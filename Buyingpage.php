

<?php
include_once 'PHPfunctions.php';
$Product_Code = "";
$First_Name = "";
$Last_Name = "";

$errorOccured = false;
$errorproductcode = "";
$errorfirstname = "";
$errorlastname = "";
$city = "";
$errorcity = "";
$comment = "";
$errorcomment = "";
$price = "";
$errorprice = "";
$quantity = "";
$errorquantity = "";
$confirmationmessage = "";
$pageTitle = "";

# validate the posted data
#check if the user clicked the submit button
if (isset($_POST["submitbutton"])) {
    #save the posted data into variables
    $Product_Code = htmlspecialchars(trim($_POST["productcode"]));
    $First_Name = htmlspecialchars(trim($_POST["firstname"]));
    $Last_Name = htmlspecialchars(trim($_POST["lastname"]));
    $city = htmlspecialchars(trim($_POST["city"]));
    $comment = htmlspecialchars(trim($_POST["comment"]));
    $price = htmlspecialchars(trim($_POST["price"]));
    $quantity = htmlspecialchars(trim($_POST["quantity"]));

    if (mb_strlen($Product_Code) > 0) {
        if ($Product_Code[0] != 'p') {
            $errorOccured = "true";
            $errorproductcode = "The product code starts with P";
        } else if (strlen($Product_Code) > 12) {
            $errorOccured = "true";
            $errorproductcode = "The product code cannot be more than 12";
        } else {
            // valid
        }
    } else {
        $errorOccured = "true";
        $errorproductcode = "The product code cannot be empty";
    }

    #validate the firstname(not empty + no more than 10 chars)
    if (mb_strlen($First_Name) == 0) {
        $errorOccured = "true";
        $errorfirstname = "The firstname cannot be empty";
    } else {
        if (mb_strlen($First_Name) > 10) {
            $errorOccured = "true";
            $errorfirstname = "The firstname cannot... 10 characters";
        }
    }
    #this goes below in the <form>

    if (mb_strlen($Last_Name) == 0) {
        $errorOccured = "true";
        $errorfirstname = "The lastname cannot be empty";
    } else {
        if (mb_strlen($Last_Name) > 15) {
            $errorOccured = "true";
            $errorlastname = "The lastname cannot... 15 characters";
        }
    }

    if (mb_strlen($city) == 0) {
        $errorOccured = "true";
        $errorcity = "The city cannot be empty";
    } else {
        if (mb_strlen($city) > 8) {
            $errorOccured = "true";
            $errorcity = "The city name cannot... 8 characters";
        }
    }

    if (mb_strlen($comment) > 200) {
        $errorOccured = "true";
        $errorcomment = "The comment cannot... 200 characters";
    }


    if (is_numeric($price) == 0) {
        $errorOccured = "true";
        $errorprice = "price cannot be empty";
    } else {
        if (is_numeric($price) > 10000) {

            $errorOccured = "true";
            $errorprice = "price cannot be more than 10000";
        }
    }
    if (is_numeric($quantity)) {
        if (strpos($quantity, '.') !== false) {
            echo "Your number is not an INTEGER ->" . $quantity;
        } else {
            $quantity = (int) $quantity;
            if (is_integer($quantity)) {
                if ($quantity <= 1 && $quantity >= 99) {

                    echo "You have to enter integer between " . 1 . " to " . 99;
                }
            } else {
                echo "Your number is not an INTEGER ->" . var_dump($quantity) . $quantity;
            }
        }
    } else {
        echo "Your value is string ->" . var_dump($quantity) . $quantity;
    }

    if ($errorOccured == false) {
//
//        echo $Product_Code;
//        echo $First_Name;
//        echo $Last_Name;
//        echo $city;
//        
        $confirmationmessage = "your info is correct";
        $myArray = "";
        $Subtotal = (floatval($price)) * (floatval($quantity));

        $Taxesamount = ($Subtotal * 13.45) / 100;
        $Grandtotal = $Subtotal + $Taxesamount;
        echo round($Grandtotal, 2);

        $myArray = array($Product_Code, $First_Name, $Last_Name, $city, $comment, $price, $quantity, $Subtotal,
            $Taxesamount, $Grandtotal);

        $JSONstring = json_encode($myArray);

        $fileHandle = fopen("orders.txt", "a")
                or die('cannot open the data file');
        fwrite($fileHandle, $JSONstring . "\r\n");

        #close the file
        fclose($fileHandle);

        #open/write/close file in one step
        
    }
    #this goes below in the <form>
    // <span class = "validationerror">
    // <?php echo $errorfirstname;
} {
    ?>
    <!DOCTYPE html>

    <html>
        <head><meta charset ="UTF-8">

            <title><?php echo $pageTitle ?></title>
            <style type="text/css">
                body{
                    background-color:aquamarine;
                }
                
                h1{
                    color:green;
                }
                #buttonAlign {
                    padding-left:25px;
                }
                input
                {
                    display: inline-block;
                    width: 150px;
                    text-align: right;
                }

                label
                {
                    display: inline-block;
                    width: 150px;
                    text-align: right;
                }
            </style>
        </head>

        <body>
            <?php ?> 
           
                <tr>

                    <td> <img src="<?php echo FILE_LOGO; ?>"
                              class="logo"
                              alt="company logo" height="200" width="600"> </td>
                    <td align="center"> </td></tr>


                <td> <a href="<?php echo FILE_INDEX; ?>">Homepage</a>
                <a href="<?php echo FILE_BUYING; ?>">Buying</a>
                <a href="<?php echo FILE_ORDERS; ?>">Orders</a></td> 

         
            <?php
            // echo phpinfo();
            # echo "<br>Method 1):" . filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_STRING);
#echo "<br>Method 2):" . filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_SPECIAL_CHARS);
#echo "<br>Method 3):" . htmlspecialchars($_POST ["firstname"]);
#echo "<br>Method 4):" . htmlentities($_POST ["firstname"]);
#echo "<br> Original):" . ($_POST ["firstname"]);
            echo $confirmationmessage;
            ?>
            <form action="Buyingpage.php" method="POST">

                <p>
                    <label>Product Code*:-</label>
                    <input type ="text" name="productcode"
                           value="<?php echo $Product_Code; ?>">
                    <span style="color:red" class = "validationError">
                        <?php echo $errorproductcode; ?> </span>
                </p>
                <p>
                    <label>Customer First Name*:-</label>
                    <input type ="text" name="firstname"
                           value="<?php echo $First_Name; ?>">
                    <span style="color:red" class = "validationError">
                        <?php echo $errorfirstname; ?> </span>
                </p>

                <p>
                    <label>Customer Last Name*:-</label>
                    <input type ="text" name="lastname" 
                           value="<?php echo $Last_Name; ?>">
                    <span style="color:red" class = "validationError">
                        <?php echo $errorlastname; ?> </span>


                </p>
                <p>
                    <label>Customer City*:-</label>
                    <input type ="text" name="city" 
                           value="<?php echo $city; ?>">
                    <span style="color:red" class = "validationError">
                        <?php echo $errorcity; ?> </span>


                </p>
                <p>
                    <label>Comments:-</label>
                    <input type ="text" name="comment" 
                           value="<?php echo $comment; ?>">
                    <span style="color:red" class = "validationError">
                        <?php echo $errorcomment; ?> </span>


                </p>
                <p>
                    <label>Product Price*:-</label>
                    <input type ="text" name="price" 
                           value="<?php echo $price; ?>">
                    <span style="color:red" class = "validationError">
                        <?php echo $errorprice; ?> </span>


                </p><!-- comment -->
                <p>
                    <label>Product Quantity*:-</label>
                    <input type ="text" name="quantity" 
                           value="<?php echo $quantity; ?>">
                    <span style="color:red" class = "validationError">
                        <?php echo $errorquantity; ?> </span>


                </p>

                <p>
                    <input type= "submit" name ="submitbutton" value="Submit"  />
                    <input type="reset" value="Clear all fields"  /><!-- comment -->
                </p>

            </form>


        </body>
        <footer class="footer">
            <div class="footerContainer">
                <p class="copyright">Copyright Shivneet Kaur 2110438 (<?php echo date("Y"); ?>)</p>
            </div>
        </footer>
    </html>
    <?php
}
?>