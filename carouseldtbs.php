<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<style>
body {font-family: Segoe Print;}

.kentrikostitloscar{
    padding-top: 25px;
    keimenocarousel-align: center;
    color:#fff
}
.titloicarousel{
    color:#fff;
    padding-bottom: 10px;
    font-size: 45px;
    
}
/* Style the tab */
.carttab-katalogos{
    background:#000 url("/phpclass/images/chalkboard.jpg");
    background-size: cover;
}
.carttab-katalogos::before{
        
    filter:brightness(25%);
}
.tab-katalogos {
  overflow: hidden;
  border-bottom: 2px solid #FFDEB0;
}

/* Style the buttons inside the tab */
.tab-katalogos button {
  background-color: inherit;
  color:white;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab-katalogos button:hover {
  background-color: #ffffff3b;
}

/* Create an active/current tablink class */
.tab-katalogos button.active {
  color:#FFDEB0;
}

/* Style the tab content */
.tabcontentmenu {
  display: none;
  padding: 6px 12px;
  color:#fff;
}





img {
    vertical-align: middle;
}

/* Slideshow container */
.slideshow-container2 {

  position: relative;
  margin: auto;
  padding: 25px;
}

.pisw, .mpros {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

.mpros {
  right: 0;
  border-radius: 3px 0 0 3px;
}

.pisw:hover, .mpros:hover {
  background-color: #ffffff3b;
  color: #FFDEB0;
}

/* Caption keimenocarousel */
.keimenocarousel {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  width: 50%;
  
}

.periexomenakatigorias {
  cursor: pointer;
  background-color: inherit;
  color:white;
  border: none;
  outline: none;
  padding: 20px;
  transition: 0.3s;
  font-size: 17px;
  transition: background-color 0.6s ease;
}

.periexomenakatigorias:hover {
  background-color: #ffffff3b;
}
.periexomenakatigorias.active{
    color:#FFDEB0;
}

.fade2 {
      border-top: 2px solid #ffffff33;
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
  
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease keimenocarousel size */
@media only screen and (max-width: 300px) {
  .pisw, .mpros,.keimenocarousel {font-size: 11px}
}
.clearfix {
  overflow: auto;
}
.carouselimg{
    display: block;
    height: auto;
    max-width: 100%;
    animation-duration: 3s;
    animation-name: slidein;
}
.imsection{
  float: left;
  width: 35%;
  padding: 20px;
}
.row:after {
  content: "";
  display: table;
  clear: both
}
.keimenoperiexomeno {
    float: left;
    width: 60%;
    padding: 20px;
    padding: 80px;
    padding-left: 150px;
}


.fade2{
    display:inline;
}

</style>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coffeeway";
$conn = new mysqli($servername, $username, $password, $dbname);
$conn ->set_charset("utf8");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$buttonnums = array();
?>    
<div class="cartab carttab-katalogos">
    <h1 class="kentrikostitloscar" >ΜΕΝΟΥ</h1>
    <div class="tab tab-katalogos">
<?php
$sql = "SELECT * FROM category";
$result = $conn->query($sql);
$count=0;
if ($result-> num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            array_push($buttonnums,"-1");
            end($buttonnums);
            echo "<button class=\"tablinks\" onclick=\"OpenCoffeeType(event,". $row["id"]."); currentSlide(".$buttonnums[key($buttonnums)].")\"";
            if($count===0)
            {
                echo " id=\"defaultOpen\"";
                $count++;
            }
        echo ">". $row["title"]. " </button>";
    } } else {     }  ?>
</div>
    <?php
    $buttonnums[1]="currentSlide(0)";
    $counter=1;
    $count2=1;
    if ($result-> num_rows > 0) {
        $result -> data_seek(0);
        while($row = $result->fetch_assoc()) {
            echo "<div id=". $row["id"]. " class=\"tabcontent tabcontentmenu\">";
            $sql2 = "SELECT * FROM product WHERE category_id=". $row["id"].";";
            $result2 = $conn->query($sql2);
            if ($result2-> num_rows > 0){
                $count=0;
                while($row2 = $result2->fetch_assoc()) {
                    if ($count===0)
                    {
                        $buttonnums[$count2] = $counter;
                    }
                    echo "<span class=\"dot periexomenakatigorias\"  onclick=\"currentSlide(".$counter.")\">".$row2["title"]."</span>";
                    $counter++;
                }
            $result2 -> data_seek(0);    
            }else{
            }
            $count2++;
        } 
    echo "</div>";
    }
    ?>
</div>
    <?php
    $conn->close();
    ?>
<script>
    function OpenCoffeeType(evt, catName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(catName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        if(n === -1)
        {
            switch(slideIndex){
                case 1:
                    slideIndex = 3;
                    showSlides(slideIndex);
                    break;
                case 4:
                    slideIndex = 6;
                    showSlides(slideIndex);
                    break;
                case 7:
                    slideIndex = 10;
                    showSlides(slideIndex);
                    break;
                default:
                    showSlides(slideIndex += n);
            }
        }
        else if(n === 1)
        {
            switch(slideIndex){
                case 3:
                    slideIndex = 1;
                    showSlides(slideIndex);
                    break;
                case 6:
                    slideIndex = 4;
                    showSlides(slideIndex);
                    break;
                case 10:
                    slideIndex = 7;
                    showSlides(slideIndex);
                    break;
                default:
                    showSlides(slideIndex += n);
            }
        }
    }

    function currentSlide(n) {
        if(n>=0)
        {
            showSlides(slideIndex = n);
        }
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dot = document.getElementsByClassName("dot");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dot.length; i++) {
            dot[i].className = dot[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dot[slideIndex-1].className += " active";
    }
</script>

</body>
</html>