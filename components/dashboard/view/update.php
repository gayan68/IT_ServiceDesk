<?php
                include_once  'template/header.php';
?>
</div>
<script type="text/javascript" >
function showHint() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            	var output = xmlhttp.responseText;
//            	window.alert(output);
				if(output.length>2)
					window.location = 'index.php?components=dashboard&action=home&re=true&message='+output;
            }
        }
        xmlhttp.open("GET", "index.php?components=dashboard&action=updateAjax&up_uid=<?php print $_GET['up_uid']; ?>" , true);
        xmlhttp.send();
}
</script>

<div class="grid_16">
  
</div>

<!-- CONTENT START -->
    <div class="grid_16" id="content">
    <!--  TITLE START  --> 
    <div class="grid_9">
    <h1 class="dashboard">Dashboard</h1>
    </div>
    <div class="clear">
    </div>
    <!--  TITLE END  -->    
    <!-- #PORTLETS START -->
    <div id="portlets">
    <!-- FIRST SORTABLE COLUMN START -->
      <div class="column" id="left" style="height: 320px">
      <!--THIS IS A PORTLET-->
      </div>
      <!-- FIRST SORTABLE COLUMN END -->
      <!-- SECOND SORTABLE COLUMN START -->
      <div class="column">
      <!--THIS IS A PORTLET-->        
      <!--THIS IS A PORTLET-->        


<style>
#circularG{
position:relative;
width:128px;
height:128px;
left:-80px;
}

.circularG{
position:absolute;
background-color:#6E7AFF;
width:29px;
height:29px;
-moz-border-radius:19px;
-moz-animation-name:bounce_circularG;
-moz-animation-duration:1.2s;
-moz-animation-iteration-count:infinite;
-moz-animation-direction:linear;
-webkit-border-radius:19px;
-webkit-animation-name:bounce_circularG;
-webkit-animation-duration:1.2s;
-webkit-animation-iteration-count:infinite;
-webkit-animation-direction:linear;
-ms-border-radius:19px;
-ms-animation-name:bounce_circularG;
-ms-animation-duration:1.2s;
-ms-animation-iteration-count:infinite;
-ms-animation-direction:linear;
-o-border-radius:19px;
-o-animation-name:bounce_circularG;
-o-animation-duration:1.2s;
-o-animation-iteration-count:infinite;
-o-animation-direction:linear;
border-radius:19px;
animation-name:bounce_circularG;
animation-duration:1.2s;
animation-iteration-count:infinite;
animation-direction:linear;
}

#circularG_1{
left:0;
top:50px;
-moz-animation-delay:1.5s;
-webkit-animation-delay:1.5s;
-ms-animation-delay:1.5s;
-o-animation-delay:1.5s;
animation-delay:1.5s;
}

#circularG_2{
left:14px;
top:14px;
-moz-animation-delay:1.35s;
-webkit-animation-delay:1.35s;
-ms-animation-delay:1.35s;
-o-animation-delay:1.35s;
animation-delay:1.35s;
}

#circularG_3{
top:0;
left:50px;
-moz-animation-delay:1.2s;
-webkit-animation-delay:1.2s;
-ms-animation-delay:1.2s;
-o-animation-delay:1.2s;
animation-delay:1.2s;
}

#circularG_4{
right:14px;
top:14px;
-moz-animation-delay:1.05s;
-webkit-animation-delay:1.05s;
-ms-animation-delay:1.05s;
-o-animation-delay:1.05s;
animation-delay:1.05s;
}

#circularG_5{
right:0;
top:50px;
-moz-animation-delay:0.9s;
-webkit-animation-delay:0.9s;
-ms-animation-delay:0.9s;
-o-animation-delay:0.9s;
animation-delay:0.9s;
}

#circularG_6{
right:14px;
bottom:14px;
-moz-animation-delay:0.75s;
-webkit-animation-delay:0.75s;
-ms-animation-delay:0.75s;
-o-animation-delay:0.75s;
animation-delay:0.75s;
}

#circularG_7{
left:50px;
bottom:0;
-moz-animation-delay:0.6s;
-webkit-animation-delay:0.6s;
-ms-animation-delay:0.6s;
-o-animation-delay:0.6s;
animation-delay:0.6s;
}

#circularG_8{
left:14px;
bottom:14px;
-moz-animation-delay:0.45s;
-webkit-animation-delay:0.45s;
-ms-animation-delay:0.45s;
-o-animation-delay:0.45s;
animation-delay:0.45s;
}

@-moz-keyframes bounce_circularG{
0%{
-moz-transform:scale(1)}

100%{
-moz-transform:scale(.3)}

}

@-webkit-keyframes bounce_circularG{
0%{
-webkit-transform:scale(1)}

100%{
-webkit-transform:scale(.3)}

}

@-ms-keyframes bounce_circularG{
0%{
-ms-transform:scale(1)}

100%{
-ms-transform:scale(.3)}

}

@-o-keyframes bounce_circularG{
0%{
-o-transform:scale(1)}

100%{
-o-transform:scale(.3)}

}

@keyframes bounce_circularG{
0%{
transform:scale(1)}

100%{
transform:scale(.3)}

}

</style>
<div id="circularG">
<div id="circularG_1" class="circularG">
</div>
<div id="circularG_2" class="circularG">
</div>
<div id="circularG_3" class="circularG">
</div>
<div id="circularG_4" class="circularG">
</div>
<div id="circularG_5" class="circularG">
</div>
<div id="circularG_6" class="circularG">
</div>
<div id="circularG_7" class="circularG">
</div> 
<div id="circularG_8" class="circularG">
</div> 
<!--  END #PORTLETS -->  
   </div><br /><br />
   <h1 style="position:relative; left:-220px;">Please Wait Till the Update Completes</h1>
<script type="text/javascript">
setTimeout(function(){
   showHint();
}, 2000);
</script>

   </div>
   </div>
    <div class="clear"> </div>
<?php
                include_once  'template/footer.php';
?>
