

<?php
if(isset($_POST["submit"]))
{
 //echo $_POST["scrip"];
 //echo $_POST["startdate"];
 //echo $_POST["enddate"];

$dbcon = pg_connect("host=localhost dbname=NSEEQ user=postgres password=Password16");
if(!$dbcon){
    die('error');
}

//echo 'Success';
//$jlquery="<script>document.writeln(dquer);</script>";
//$x=$_POST['scrip'];
$x=strtoupper($_POST["scripname"]);    //'APLLTD';
//$y=600;
$y= date("d-m-y", strtotime($_POST["startdate"]));
$z=date("d-m-y",strtotime($_POST["enddate"]));
//$query = "SELECT * FROM mydb WHERE \"Scrip\"='$x';";
//$query = "SELECT * FROM mydb WHERE \"Close\">'$y';";
$query = "SELECT * FROM nse_cm WHERE \"scrip\"='$x' AND \"date\">='$y' AND \"date\"<='$z' order by date desc;";
//$query = "SELECT * FROM mydb;";
$result = pg_query($dbcon,$query);

//echo "<table>";
while($row=pg_fetch_assoc($result)){
        $qdata[]=$row;
//        echo "<tr>";
//        echo "<td align='center' width='200'>" . $row['Id'] . "</td>";
//        echo "<td align='center' width='200'>" . $row['Date'] . "</td>";
//        echo "<td align='center' width='100'>" . $row['Scrip'] . "</td>";
//        echo "<td align='center' width='100'>" . $row['Close'] . "</td>";
//        echo "</tr>";
}
//        echo "</table>";
        //echo gettype($qdata);
   if (empty($qdata)){
       $jdata=json_encode(1);
   } else {    
        $jdata=json_encode($qdata); 
      }   
    //echo $jdata;

}

?>

<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>   
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/en-gb.js"></script>

   
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="logo">
<img src="https://logos-download.com/wp-content/uploads/2016/08/EY_logo_slogan.png" alt="EY Logo" width="220" height="80" right=100px>
<div style="position:absolute;left:1300px;top:25px;"><img src="image.jpg" alt="Tool Name" width="220" height="80" left="1120"></div>
</div>

<p id="demo" style="position:absolute;left:1120px;top:670px;"></p>
<script>
var d = new Date();
document.getElementById("demo").innerHTML = d;
</script>

<div class="inputtag">
    <p align="left">
    <form action="index.php">    
    <b>Ticker:<span>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $x; ?>&nbsp;&nbsp;&nbsp;&nbsp;</span>  </b>
	    <b>Start Date: <span>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $y; ?>&nbsp;&nbsp;&nbsp;&nbsp;</span> </b>
	    <b>End Date:     <span>&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $z; ?>&nbsp;&nbsp;&nbsp;&nbsp;</span></b>
    
    <input type="submit" value="Back" />
    </form>
      
    </p>
</div>
<div class="row"></div>
<div class="container">
<H5 id="table"></H5> 
</div>

<div class="container">
        <canvas id="line-chart" height="400"></canvas>
</div>


<div class="footer">
   Copyright&copy; 2018 | Ernst & Young LLP | FSRM Advisory - Pune, India | All Rights Reserved.
</div>
 

<script>
   
   $jsdata='<?php echo $jdata ?>';
     data=JSON.parse($jsdata);  //Parses the JSON- to access  use $data[0].Scrip 

$.post("daterange.py",
         {
        scripname:'<?php echo $x; ?>',
        startdate:'<?php echo $y; ?>',
        enddate:'<?php echo $z; ?>'
         },
         function(chk, status){
                   
                   callbk(chk);
             },);

function callbk(chk){
  pychk = $(chk).text().trim();
  //alert(pychk);
    if(pychk=='1') 
    {  //document.write(data);
      $.post("getcustomdata.py",
         {
        scripname:'<?php echo $x; ?>',
        startdate:'<?php echo $y; ?>',
        enddate:'<?php echo $z; ?>'
         },
         function(flg, status){
                   
                   callbackfunc(flg);
             },);
function callbackfunc(fls){
      pyflg = $(fls).text().trim();   //takes the return from python
      
      if (pyflg=="1"){
          //alert("here");
          window.location.reload(true);
          }

      else {

          alert("OOPS!! Something went wrong! Check the input data.");
          window.location.href = "index.php";
          }

        }
      }


    document.getElementById("table").innerHTML =`
     <h3>Query has returned ${data.length} records.</h3>
     <table border="1" width=600 class="">
     <th>Date</th>
     <th>Scrip</th>
     <th>Open</th>
     <th>High</th>
     <th>Low</th>
     <th>Close</th>


     ${data.map(function (arr) {
                  return `
                  <tr>
                  <td align='center' width='100'>${arr.date}</td>
                  <td align='center' width='100'>${arr.scrip}</td>
                  <td align='center' width='100'>${arr.open}</td>
                  <td align='center' width='100'>${arr.high}</td>
                  <td align='center' width='100'>${arr.low}</td>
                  <td align='center' width='100'>${arr.close}</td>
                  </tr>
                  `

     }).join('')}
     </table>
     `     

//code for Charts


var dt=[];
     var cls=[];
     for(var i in data){
       dt.push(data[i].date);
       cls.push(data[i].close);
             }
    
new Chart(document.getElementById("line-chart"), {
  type: 'line',
  data: {
    labels: dt, //dates
    datasets: [{ 
        data: cls,//Close price
        label: "Close Price",
        borderColor: "#3e95cd",
        fill: false
      }
    ]
  },
  options: {
    responsive: false,
    maintainAspectRatio: false,
    title: {
      display: true,
      text: 'Technical Chart - Daily'
    }
  }
});


//

}

</script>

</body> 


</html>
