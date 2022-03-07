<?php
define("FILE_INDEX", "index.php");
define("FILE_HOME", "Homepage.php");
define("FILE_BUYING", "Buyingpage.php");
define("FILE_ORDERS", "Orders.php");



define ("FOLDER_PICTURES", "Images/");

define ("FILE_LOGO",FOLDER_PICTURES. "logo.png");
define ("FOLDER_CSS","CSS/");
define ("FILE_CSS", FOLDER_CSS . "style.css");



//define ("FILE_CSS_BIG", FOLDER_CSS . "contact.php");






function pageTop($pageTitle)
{
?><html>
<head><meta charset ="UTF-8">

<title><?php echo $pageTitle ?></title>
<style type="text/css">
body{ background-color:pink; }

h1{ color:green; }
#buttonAlign { padding-left:25px; }
</style>
</head>
<body>
<table width="100%">
<tr>

<td> <img src="<?php echo FILE_LOGO; ?>"
class="logo"
alt="company logo" height="200" width="400"> </td>
<td align="center"> <h1 style="font-family:verdana;">THE MAGIC OF WORDS</h1>
    <P>We know that school can get expensive and 
        the last thing that we want to do is create more unnecessary expenses 
        when that time of year rolls around. That's why we are committed to offering 
        great quality textbooks for the most affordable prices around!
        Here is best Place to buy Books Online.</P></td></tr>

<?php

}
function pageBottom()
{ ?><td><?php
$myArray = array(PICTURE_1, PICTURE_2, PICTURE_3, PICTURE_4, PICTURE_5 );
shuffle($myArray);
?>



<img src="<?php echo $myArray[0]; ?>" class ="advertising" alt="advertising" height ="360" width="400"></td>
 <?php
navigationMenu();



}
function navigationMenu()
{ ?>

<td> <a href="<?php echo FILE_HOME;?>">  Homepage  </a>
<a href="<?php echo FILE_BUYING;?>">Buying</a>
<a href="<?php echo FILE_ORDERS;?>">Orders</a></td>


</body></html>
<?php
}
?>