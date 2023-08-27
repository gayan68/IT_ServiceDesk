<?php
                include_once  'template/header.php';
?>
<!-- MENU END -->
<script type="text/javascript" >
function showHint(location,destination,str,func) {
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
        xmlhttp.open("GET", "index.php?components=inventory&action="+func+"&q=" + str, true);
        xmlhttp.send();
    }
}
</script>

<script type="text/javascript">
// Using jQuery.

$(document).ready(function() {

  $('.submit_on_enter').keydown(function(event) {
    // enter has keyCode = 13, change it if you want to use another button
    if (event.keyCode == 13) {
      this.form.submit();
      return false;
    }
  });

});</script>
</div>
<div class="grid_16">
<!-- TABS START -->
    <div id="tabs">
         <div class="container">
            <ul>
<?php                    
														print '<li><a href="index.php?components=inventory&action=show_submit"><span>Home</span></a></li>';
														print '<li><a href="index.php?components=inventory&action=list_list&filter_type=1&filter_status=1"  class="current"><span>List</span></a></li>';
                      									print '<li><a href="index.php?components=inventory&action=one_asset" ><span>Asset Details</span></a></li>';
                      									print '<li><a href="index.php?components=inventory&action=toner_manage" ><span>Toner Manage</span></a></li>';
                      									print '<li><a href="index.php?components=inventory&action=toner_usage" ><span>Toner Usage</span></a></li>';
                     									print '<li><a href="index.php?components=inventory&action=toner_report" ><span>Toner Report</span></a></li>';

 ?>
           </ul>
        </div>
    </div>
<!-- TABS END -->   
</div>
<!-- CONTENT START -->
    <div class="grid_16" id="content">
    <!--  TITLE START  --> 
    <div class="grid_9">
    <h1 class="inventory">Inventory Management System</h1>
    </div>
    <?php
    	if(isset($_GET['re'])){
    		if($_GET['re']=='true') $color='success'; else $color='error';
    		print '<p class="info" id="'.$color.'" style="margin-right:10px"><span class="info_inner">'.$_GET['message'].'</span></p>';
    	}
    ?>
    <!--  TITLE END  -->    
    <!-- #PORTLETS START -->
    <div id="portlets">
    <div class="clear"></div>
    <!--THIS IS A WIDE PORTLET-->
<br />
  
  <form action="index.php?components=inventory&action=list_list" method="post" >
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="List Of Assets" /> List Of Assets 
        	<span style=" padding-left:500px;">Filter 
        		<select name="filter_type" onchange="this.form.submit()">
              	<option value="">-ALL-</option>
        		<?php for($i=0;$i<sizeof($type_id);$i++){
        			if($filter_type==$type_id[$i]) $select='selected="selected"'; else $select='';
        			print '<option value="'.$type_id[$i].'" '.$select.'>'.$type_name[$i].'</option>';
        		 } ?>
        		</select>
        	</span>
        </div>
		<div class="portlet-content nopadding">
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
            <thead>
              <tr><th width="25" scope="col" style="color:green"></th><th width="100px" scope="col">Asset ID</th><th scope="col">User</th><th scope="col">Location</th><th scope="col">Device</th><th scope="col">Serial Number</th><th scope="col">Status</th></tr>
              <tr><th width="25" scope="col" style="color:green"></th><th width="100px" scope="col">
              <input type="text" name="filter_assid" style="width:50px" placeholder="Search." value="<?php print $filter_assid; ?>" /></th><th scope="col">
              <input type="text" name="filter_emp" style="width:150px" placeholder="Search." value="<?php print $filter_emp; ?>" /></th><th scope="col">
              	<select name="filter_location" onchange="this.form.submit()">
              	<option value="">-ALL-</option>
              <?php for($i=0;$i<sizeof($ass_location_id);$i++){
        			if($filter_location==$ass_location_id[$i]) $select='selected="selected"'; else $select='';
              	print '<option value="'.$ass_location_id[$i].'" '.$select.'>'.$ass_location_name[$i].'</option>';
              } ?>
              	</select>
              </th><th scope="col"><input type="text" name="filter_device" style="width:120px" placeholder="Search." value="<?php print $filter_device; ?>"/></th><th scope="col">
              <input type="text" name="filter_sn" style="width:80px" placeholder="Search." value="<?php print $filter_sn; ?>" /></th><th scope="col">
              	<select name="filter_status" onchange="this.form.submit()">
              	<option value="">-ALL-</option>
              <?php for($i=0;$i<sizeof($ast_id);$i++){
        			if($filter_status==$ast_id[$i]) $select='selected="selected"'; else $select='';
              	print '<option value="'.$ast_id[$i].'" '.$select.'>'.$ast_status[$i].'</option>';
              } ?>
              </th></tr>
		       <?php
				for($i=0;$i<sizeof($tb_ass_id);$i++){
					if($tb_emp_st[$i]==0) $color2='silver'; else $color2=$color1[$i];
						print '<tr><td scope="col" style="color:'.$color1[$i].'"></td><td scope="col"><a href="index.php?components=inventory&action=one_asset&id='.$tb_ass_id[$i].'">'.$tb_asset_id[$i].'</a></td><td scope="col" ><a href="index.php?components=inventory&action=one_asset&id='.$tb_ass_id[$i].'" style="color:'.$color2.'" title="'.$tb_emp_rdate[$i].'">'.$tb_emp_name[$i].'</a></td><td scope="col" style="color:'.$color1[$i].'">'.$tb_location[$i].'</td><td scope="col" style="color:'.$color1[$i].'"><a href="index.php?components=inventory&action=edit_asset&id='.$tb_ass_id[$i].'" style="color:'.$color1[$i].'" >'.$tb_ass_name[$i].'</a></td><td scope="col" style="color:'.$color1[$i].'">'.$tb_ass_sn[$i].'</td><td scope="col" style="color:'.$color1[$i].'">'.$st1[$i].'</td></tr>';
				}	
				?>
            </thead>
            <tbody>
        
			</tbody>
          </table>
		</div>
      </div>
      </div>
      <input type="submit" style="visibility: hidden;" />
   </form>
        <?php print '<table align="center" width="100%"><tr><td align="center"><input type="button" value="Export To Excel" style="width:140px; height:50px; background-color:#229922; color:white" onclick="window.location = '."'"."index.php?components=inventory&action=download_list&filter_type=$filter_type&filter_location=$filter_location&filter_status=$filter_status&filter_assid=$filter_assid&filter_device=$filter_device&filter_sn=$filter_sn&filter_emp=$filter_emp'".'" /> </td></tr></table>'; ?>
      <div class="column" id="left" style="height: 30px"> </div>
      <div class="column">  </div>
    <div class="clear"></div>
   </div>
    <div class="clear"> </div>
<!-- END CONTENT-->    
<?php
                include_once  'template/footer.php';
?>
