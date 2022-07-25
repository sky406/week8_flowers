<?php
function get_rows($sqlquery)
{
    $sqldata = array();
    while($row = mysqli_fetch_array($sqlquery))
    {
     $product = array(
     0 => $row['id'],
     1 => $row['price'],
     2 => $row['images'],
     3 => $row['rating'],
     4 => $row['name']);
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

function get($get,$con)
{
    if($get == 0)
    {
        return get_all($con);
    }
    else
    {
        return get_data($get,$con);
    }
}

function starify($rating)
{
    if($rating > 10)
    {
        $rating = 10;
    }
    $stars = array();
    if($rating%2)
    {
        for($i =0;$i < ($rating-1)/2;$i++ )
        {
            $stars[]=2;
        }
        $stars[]=1;
    }
    else
    {
        for($i = 0;$i < $rating/2;$i++)
        {
            $stars[] = 2;
        }
    }
    if(count($stars)<5)
    {
        while(count($stars) < 5)
        {
            $stars[]=0;
        }
    }
    return $stars;
}

function starhtml($stardata)
{
    $html = '';
    for($i = 0; $i < count($stardata);$i++)
    {
        $html=$html."<div class='star".$stardata[$i]." star'></div>";
    }
    return $html;
}

function tohtml($products){
    $html = '';
    for($i = 0;$i < count($products);$i++)
    {
        
        echo json_encode($products[3]);
        $id = $products[0];
        $price = $products[1];
        $pics = explode(" ",$products[2]);
        $rating = starhtml(starify($products[3]));
        $name = $products[4];

        $html=$html.'
        <div class="product" id ="'.$id.'">
            <div class="images">
                <div class="img1" style="background-image: url('.$pics[0].')"></div>
                <div class="img2" style="background-image: url('.$pics[1].')"></div>
            </div>
            <div class="info">
                <h1 class="name">'.$name.'</h1>
                <div class="ratings">'.$rating.'</div>
                <h2 class="price">'.$price.'</h2>
                <button class="tocart"><p>add to cart</p></button>
            </div>
        </div>
        ';
        
    }
    return $html;
}
?>