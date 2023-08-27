<?php
                include_once  'template/header.php';
?>
<!-- MENU END -->
<script type="text/javascript" >
function showHint(location,destination,str) {
    if (str.length < 3) { 
        document.getElementById(location).innerHTML = '';
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        document.getElementById(location).innerHTML = '';
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var $listarr = xmlhttp.responseText.split(",");
				for($i=0;$i<($listarr.length);$i++){
					var ul = document.getElementById(location);
					var li = document.createElement("li");
					li.appendChild(document.createTextNode($listarr[$i]));
					li.setAttribute("id","li");
					li.setAttribute("onclick","addHint('"+destination+"','"+$listarr[$i]+"')");
					ul.appendChild(li);  
				}      		  
            }
        }
        xmlhttp.open("GET", "index.php?components=settings&action=alluser_query&q=" + str, true);
        xmlhttp.send();
    }
}
</script>

</div>
<!---------Sub Menu----------->
<?php include_once  'components/settings/view/tpl/sub_menu.php';	?>

<!-- CONTENT START -->
    <div class="grid_16" id="content">
    <!--  TITLE START  --> 
    <div class="grid_9">
    <h1 class="user_profile">Check List Control Pannel</h1>
    </div>
    <?php
    	if(isset($_GET['re'])){
    		if($_GET['re']=='true') $color='success'; else $color='error';
    		print '<p class="info" id="'.$color.'" style="margin-right:10px"><span class="info_inner">'.$_GET['message'].'</span></p>';
    	}
    ?>
    <!--  TITLE END  -->    
<?php
		if($_GET['action']=='checklist_general') include_once  'components/settings/view/tpl/checklist_general.php';
		if($_GET['action']=='checklist_user') include_once  'components/settings/view/tpl/checklist_user.php';
?>

   </div>
    <div class="clear"> </div>
<!-- END CONTENT-->    
<?php
                include_once  'template/footer.php';
?>
