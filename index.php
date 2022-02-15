<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav></nav>
    <!-- <div class="productpage">
        <div class="">
            <div class="">
                <div class="filter">
                    <input type="checkbox" name="valentines" id="valentines" value="1">
                    <p class="filtername">valentines</p>
                </div>
            </div>
            <div class=" products">
                <div class="product">
                    <div class="col-md-4 col-sm-12">
                        <div class="product img1 placeholdercol">
                            <img src="" alt="">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="details">
                            <p class="name"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat aliquid sint ea. Accusamus sapiente asper</p>
                            <div class="rating">
                               <img src="" alt="star"> 
                            </div>
                            <p class="price">12</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <form action="" method="get"></form>
    <div class="container products">
        <?php
        include("connect.php");

        ?>
        
    </div>
</body>

    
    ?>
<script>
    
    var testvar = '<?php echo json_encode(mysqli_query($db,"CALL get_all_products()"))?>';
    console.log(testvar)


</script>
</html>