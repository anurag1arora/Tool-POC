<html>
<head>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <link rel="stylesheet" href="style.css">
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
   
    <form id="frm" method="POST" action="main.php">
        <b>Ticker:     </b> <input type="text" name="scripname" id="scripname" value="APLLTD"></input> 
	    <b>Start Date:    </b><input type="date" name="startdate" id="startdate" value="2018-12-01"> 
	    <b>End Date:     </b> <input type="date" name="enddate" id="enddate" value="2018-12-12"> 
      <input type="submit" value="Submit" id="submit" name="submit" />
      <input type="Reset" onClick="window.location.reload()">

    </form>
</p>
</div>

<div class="container" >
<!-- start sw-rss-feed code --> 
<script type="text/javascript"> 
<!-- 
rssfeed_url = new Array(); 
rssfeed_url[0]="https://economictimes.indiatimes.com/markets/stocks/rssfeeds/2146842.cms";  
rssfeed_frame_width="650"; 
rssfeed_frame_height="400"; 
rssfeed_scroll="on"; 
rssfeed_scroll_step="6"; 
rssfeed_scroll_bar="on"; 
rssfeed_target="_blank"; 
rssfeed_font_size="14"; 
rssfeed_font_face=""; 
rssfeed_border="on"; 
rssfeed_css_url=""; 
rssfeed_title="on"; 
rssfeed_title_name="Business News"; 
rssfeed_title_bgcolor="#F7F7F7"; 
rssfeed_title_color="#000"; 
rssfeed_title_bgimage=""; 
rssfeed_footer="off"; 
rssfeed_footer_name="rss feed"; 
rssfeed_footer_bgcolor="#fff"; 
rssfeed_footer_color="#333"; 
rssfeed_footer_bgimage=""; 
rssfeed_item_title_length="75"; 
rssfeed_item_title_color="#30257E"; 
rssfeed_item_bgcolor="#F7F7F7"; 
rssfeed_item_bgimage=""; 
rssfeed_item_border_bottom="on"; 
rssfeed_item_source_icon="off"; 
rssfeed_item_date="off"; 
rssfeed_item_description="on"; 
rssfeed_item_description_length="120"; 
rssfeed_item_description_color="#000"; 
rssfeed_item_description_link_color="#800080"; 
rssfeed_item_description_tag="off"; 
rssfeed_no_items="0"; 
rssfeed_cache = "84e496f2deddafe0295dccb6e8eff2d8"; 
//--> 
</script> 
<script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script> 
<!-- The link below helps keep this service FREE, and helps other people find the SW widget. Please be cool and keep it! Thanks. --> 

<!-- end sw-rss-feed code -->
</div>

<div class="footer">
   Copyright&copy; 2018 | Ernst & Young LLP | FSRM Advisory - Pune, India | All Rights Reserved.
</div>

</body>
</html>
