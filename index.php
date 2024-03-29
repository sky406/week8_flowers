<!DOCTYPE html>
<html lang="en">
<head>
    <?php
session_start()
?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>flowery</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="banner">

    </div>
    
    <form action="" method="get">
        <nav class="nav">
            <!-- <div><input type="submit" value="0" name="selection" class="selection">all</div>
            <div><input type="submit" value="1" name="selection" class="selection">valentines</div>
            <div><input type="submit" value="2" name="selection" class="selection">birthday</div>
            <div><input type="submit" value="3" name="selection" class="selection"></div> -->
            <div><input type="submit" value="all" name="selection" class="selection"></div>
            <div><input type="submit" value="valentines" name="selection" class="selection"></div>
            <div><input type="submit" value="birthday" name="selection" class="selection"></div>
            <div><input type="submit" value="wedding" name="selection" class="selection"></div>
        </nav>
    </form>
    
    <div class="products">
        <?php
        include("connect.php");
        include("functions.php");
        function pickselection($selection){
            if($selection == "all")
            {
                return 0;
            }
            elseif($selection =="valentines")
            {
                return 1;
            }
            elseif($selection =="birthday")
            {
                return 2;
            }
            else
            {
                return 3;
            }
        }
        echo pickselection($_GET["selection"]);
        // $data = get(($_GET["selection"]),$conn);
        $data = get(pickselection($_GET["selection"]),$conn)
        ?>
        <!-- process
        figure out which button was pressed 
        then make an output -->
        <div class="pcontainer">
            <div class="product">
                <div class="images">
                    <div class="img1"></div>
                    <div class="img2"></div>
                </div>
                <div class="info">
                    <h1 class="name">lorem</h1>
                    <div class="ratings"></div>
                    <h2 class="price"></h2>
                </div>
            </div>
        </div>
        
    </div>
</body>


<script>
    
    class queuenode{
        constructor(front=null,next=null)
        {
            this.front = front
            this.next = next
        }
        enqueue(queue){
            if(this.next == null)
            {
               this.next = queue 
            }
            else
            {
                this.next.enqueue(queue)
            }
        }
        dequeue()
        {
           data = this.front
           if(this.next!= null)
            {
            this.front = this.next.front 
            this.next = this.next.next
            }
            return data
        }
        peek()
        {
            return this.front
        }
        buildtxt()
        {
            if(this.next == null){
                return this.front
            }
            else
            {
                return this.front.concat(this.next.buildtxt())
            }
        }
        isempty()
        {
            return this.front == null
        }
        emptynodes()
        {
            this.front = null
            this.next = null
        }


    }
    const data = '<?php echo json_encode($data) ?>'
    console.log(data)
    
    function convertphparray(data)
    {
        let letterstorage = new queuenode()
        let temparray = []
        let products = []
        let layer = 0
        
        for(let i = 0; i < data.length;i++)
        {
            if(data[i] == '[')
            {
                layer +=1
                temparray = []
                letterstorage.emptynodes()

            }
            else if(data[i] == ']')
            {
                layer -=1
                if(layer == 1){
                    products.push(temparray)
                    temparray = []
                }
                // temparray.push(letterstorage.buildtxt())
            }
            else if(data[i] == '"' || data[i] == ',')
            {
                if(letterstorage.isempty()){
                   
                    console.log("skip") 
                }
                else
                {
                    temparray.push(letterstorage.buildtxt())
                    letterstorage.emptynodes()
                    
                }
            }
            else
            {
                let queue = new queuenode(front=data[i])
                if(letterstorage.front == null)
                {
                    letterstorage.front = queue.front
                }
                else
                letterstorage.enqueue(queue)
            }

        }
        return products
    }
    // function backtoarray(string)
    // {
    //     if(string[0]=="[")
    //     {
    //         array = []
    //         array.concat(backtoarray(string.substr(1)))
    //         return array
    //     }
    //     else if(string[0]=='"' || string[0]==",") 
    //     {

    //     }
    // }
    function starify(rating)
    {
        if (rating > 10) rating= 10;
        stars = []
        if(rating%2)
        {
            for(let i = 0;i < (rating-1)/2; i++)
            {
                stars.push(2)
            }
            stars.push(1)
        }
        else
        {
            for(let i = 0; i < rating/2; i++)
            {
                stars.push(2)
            }
        }
        if(stars.length < 5)
        {
            while(stars.length < 5)
            {
                stars.push(0)
            }
        }
        return stars
    }

    function starhtml(stardata)
    {
        html = ''
        for(let i = 0; i < stardata.length;i++)
        {
            html+= `<div class="star${stardata[i]} star"></div>`
        }
        return html
    }

    function tohtml(data)
    {
        let id = data[0]
        let price = data[1]
        let pics = data[2].split(" ")
        let rating = starhtml(starify(data[3]))
        let name = data[4]

        let html = `<div class="pcontainer"><div class="product">
            <div class="images">
                <div class="img1" style="background-image: url(${pics[0]})"></div>
                <div class="img2" style="background-image: url(${pics[1]})"></div>
            </div>
            <div class="info">
                <h1 class="name">${name}</h1>
                <div class="ratings">${rating}</div>
                <h2 class="price">${price}</h2>
                <button class="tocart"><p>add to cart</p></button>
            </div>
        </div></div>
        
        `
        return html
    }

    function process(array)
    {
        html = ''
        for(let i = 0;i < array.length;i++)
        {
            html+=tohtml(array[i])
        }
        return html
    }

    let products = process(convertphparray(data)) 

    $(document).ready(function () {
        $(".products").html(products);
        console.log(products)
        console.log(data)
    });


</script>
<style>
.body{
    margin: 0px 0px 0px 0px; 
}
.banner {
  margin: 0px;
  width: 100vw;
  height: 300px;
  background-image: url("./flowers.jpeg");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

.nav {
  display: flex;
  background-color: #d696b8;
  justify-content: space-around;
  align-items: center;
  padding: 10px;
}
.star2{
    background-image: url("./star2.svg");
}
.star1{
    background-image: url("./star1.svg");
}
.star0{
    background-image: url("./star0.svg");
}
.star{
    background-repeat: no-repeat;
    background-size: cover;
    aspect-ratio: 1/1;
    width: 12px;
}
.products{
    /* display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    align-items:flex-start; */
    margin-top: 10px;
    display: inline-grid;
    gap: 10px 10px;
    width: 100vw;
    box-sizing: border-box;
    /* grid-template-columns: auto auto auto auto; */

}

/* @media (max-width:1024px) {
    .products{
        grid-template-columns: auto auto auto;
    }
} */

@media (max-width:990px) {
    .products{
        grid-template-columns: 50% 50% ;
    }

    /* .product
    {
        width: 350px;
    } */
    
}

@media (max-width:1440px) {
    .products{
        grid-template-columns: auto auto auto auto;
    }
}

@media (max-width:2560px) {
    .products{
        grid-template-columns: 20% 20% 20% 20% 20% ;
    }
}

@media (max-width:1024px) {
    .products{
        grid-template-columns: 33% 33% 33%;
    }
}

.product{
    /* max-width: 400px; */
    /* width: 100%; */
    /* flex-grow: 1; */
    height: 500px;
    background-color: #d696b8;
    margin: 0px;
    /* border: solid #fee5a3; */
    /* box-shadow: 5px 12px 13px 2px rgba(0,0,0,0.21); */
    padding: 10px;
    box-sizing: border-box;
    /* width: 320px; */
    /* width: auto; */
    width: 100%;
    /* max-width: 320px; */

}
.pcontainer{
    display: flex;
    justify-content: center;
}
.ratings{
    display: flex;
}

.img1{
   height: 190px; 
   width:50%;
   background-size: cover;
   background-position: center;
}
.img2{
    height: 190px; 
   width:50%;
   background-size: cover;
   background-position: center;
}
.images{
    display: flex ;
}

body
{
    margin: 0px;
    padding: 0px;
}
.price::before{
 content: "$";
}
.tocart{
    width: 100%;
    background-color: #f7da96;
    border:  solid 1px wheat;
    transition: all 0.3s;
}
.tocart:hover
{
    background-color: #aa9667;
    border: none;
}

.selection{
    background-color: #f7da96;
    border: none;
    padding: 12px;
    border-radius: 12px;
    width: 90px;
}
</style>
</html>