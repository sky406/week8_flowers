<?php
function get_rows($sqlquery)
{
    $sqldata = array();
    while($row = mysqli_fetch_array($sqlquery))
    {
     $product = array();
     $product[] = $row['id'];
     $product[] = $row['price'];
     $product[] = $row['images'];
     $product[] = $row['rating'];
     $product[] = $row['name'];
     $sqldata[] = $product;
    }
    return $sqldata; 
}

function get_data($ocassion,$con)
{   
    $sqlquery = "CALL `get_by_occasion`($ocassion)";
    $sql = mysqli_query($con,$sqlquery);
    return get_rows($sql);
}

function get_all($con)
{
    $sqlquery = "CALL `get_all_products`()";
    $sql = mysqli_query($con,$sqlquery);
    return get_rows($sql);
}

?>