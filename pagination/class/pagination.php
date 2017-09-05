<?php
/***************************************************************************************************
FRAMEWORK CREATED BY NISHANTH
DOCUMENTATION
include the pagination class
create an object with parameter specifying limit
call get_pages() function with parameters table name,column name to arrange in desc order the page number
it returns the resource in associative array
call paginate() with active page number
get_num_pages returns number of pages required for the pagination by processing with the limit specified when creating the object

*****************************************************************************************************/
class Pagination
{
  //var host;
  //var username;
  //var password;
  private $post_resource;
  private $num_of_pages;
  private $limit;
  //private $act_page;
  function __construct($limit = 5)
  {
	$this->limit = $limit;
	
  }
  public function get_pages($table, $column="id", $page = 1)
  {
    $q1 = "SELECT * FROM `$table`";
    $r1 = mysql_query($q1) or die("error: ".mysql_error());
    $num_of_rows = mysql_num_rows($r1);

    $this->num_of_pages = ceil($num_of_rows/$this->limit);

    $begin = --$page;
    $begin = (int)$begin*$this->limit;

    $q2 = (string)"SELECT * FROM `".$table."` ORDER BY ".$column." DESC limit ".$begin.",".$this->limit;

    $r2 = mysql_query($q2) or die("error: ".mysql_error());
    //$row2 = mysql_fetch_array($r2);
    $this->post_resource = $r2;
    return $this->post_resource;
  }
  
  public function get_num_pages()
  {
	return $this->num_of_pages;
  }

  public function paginate($act_page)
  {
    print "<ul class=\"pagination\">";
    for($i=1;$i<=$this->num_of_pages;$i++)
    {
      print "<li class=\"waves-effect ";
      if($i==$act_page)
    {
      print "active teal";
    }
      print "\"><a href=\"".$_SERVER['PHP_SELF']."?page=".$i."\">".$i."</a></li>";
    }
    print "</ul>";
  }


}
?>
