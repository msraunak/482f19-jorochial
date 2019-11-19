<?php
$auction_title = "The Children's Auction";
$auction_description = "This auction is in support of the XYZ group and features items from Donors.";
$auction_start_date = date("l jS \of F Y h:i:s A", 1530054626);;
$auction_end_date= date("l jS \of F Y h:i:s A", 1530154626);
$auction_charity = "The Children's Project";
$item_arr = array("Chessboard","This chessboard was owned by King George back in 1945, seeing use by over three generations of royal family. It was sold to the French after the Battle of 1765 and was gifted to the King after the former owner when in against a Sicilian when death was on the line.","The Royal Family",1000, 500.00,100.02,);

include 'viewAuction.html';
?>
