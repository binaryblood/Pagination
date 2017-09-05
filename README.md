# Pagination
A pagination class for php webpages
# Customizable

Example:

<?php
include_once('class/pagination.php');
include_once('config/config.php');
(int)$page = isset($_GET['page'])? $_GET['page'] : 1; //filter the page numbers
$page = abs($page);
$obj = new Pagination(2); // create object for pagination class with number of posts per page limit
$res = $obj->get_pages('messages','id',$page); //syntax: RESOURCE get_pages(TABLENAME,COLUMN NAME, PAGENUMBER(DEFAULT 1))
print "<table>";
while($row = mysql_fetch_array($res))
{
print "<tr>";
print "<td>";
print $row['body'];
print "</td>";
print "</tr>";
}
print "</table>";
print "<br/><hr/>";
$active_page = $page;
$obj->paginate($active_page); // syntax: paginate(PAGENUMBER)
      if($obj->get_num_pages()!=0) // should check if there is no page itself
      {
        echo $obj->get_num_pages();// gives number of pages for the given limit
      } 
?>

