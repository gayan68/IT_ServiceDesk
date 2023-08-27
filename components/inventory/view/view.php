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

</div>
<div class="grid_16">
<!-- TABS START -->
    <div id="tabs">
         <div class="container">
            <ul>
<?php                    
														print '<li><a href="index.php?components=inventory&action=show_submit" class="current"><span>Home</span></a></li>';
														print '<li><a href="index.php?components=inventory&action=list_list&filter_type=1&filter_status=1"><span>List</span></a></li>';
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
    <!-- FIRST SORTABLE COLUMN START -->
      <div class="column" id="left" style="height: 400px">
      <!--THIS IS A PORTLET-->
		<div class="portlet">
            <div class="portlet-header"><img src="images/icons/chart_bar.gif" width="16" height="16" alt="Reports" /> Asset Mapping</div>
            <div class="portlet-content">
		<br /><br />
            <!--THIS IS A PLACEHOLDER FOR FLOT - Report & Graphs -->
		<form method="post" action="index.php?components=inventory&action=map_asset"  onsubmit="return validateMapAsset()" > 
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a">
            <tbody>
            <tr><th width="25px" scope="col"></th><th scope="col" style="text-align:center">Employee</th><th width="25px" scope="col"></th><th scope="col" style="text-align:center">Asset</th><th  width="25px" scope="col"></th></tr>
			<tr><td scope="col"></td><td scope="col">
			 <nav><ul><li>
				<a><input type="text" name="employee" id="employee" onkeyup="showHint('list','employee',this.value,'ad_query')" style="width:140px" /></a>
				<ul id="list"></ul> 
			 </li></ul></nav>				
			</td><td scope="col"  style="vertical-align:middle"><input type="submit" value="MAP" style="height:40px" /></td><td scope="col">
			 <nav><ul><li>
				 <a><input type="text" name="assete" id="assete" onkeyup="showHint('list1','assete',this.value,'asset_query')" style="width:140px" /></a>
				 <ul id="list1"></ul>
			 </li></ul></nav>
			</td><td scope="col"></td></tr>
			</tbody>
          </table>
         </form>
            </div>
        </div>      
      <!--THIS IS A PORTLET-->
      </div>
      <!-- FIRST SORTABLE COLUMN END -->
      <!-- SECOND SORTABLE COLUMN START -->
      <div class="column">
 
      <!--THIS IS A PORTLET-->        
        <div class="portlet">
		<div class="portlet-header">Asset Creation</div>

		<div class="portlet-content">
		<br /><br />
<?php
		if($_GET['action']=='show_submit')  include_once  'components/inventory/view/tpl/create_asset.php';
		if($_GET['action']=='edit_asset')  include_once  'components/inventory/view/tpl/edit_asset.php';

?>
		</div>
		</div>
        </div>   
      <!--THIS IS A PORTLET--> 
    <div class="clear"></div>
    <!--THIS IS A WIDE PORTLET-->
   
    
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> Recently Mapped Assets</div>
		<div class="portlet-content nopadding">
        <form action="" method="post">
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
            <thead>
              <tr><th width="25" scope="col"></th><th width="100px" scope="col">Category</th><th width="100px" scope="col">Asset ID</th><th scope="col">User</th><th scope="col">Department</th><th scope="col">Device</th><th scope="col">Serial Number</th><th scope="col">Action</th></tr>
		       <?php
				for($i=0;$i<sizeof($tb_asi_id);$i++){
						print '<tr><td scope="col"></td><td scope="col">'.$tb_ast_name[$i].'</td><td scope="col">'.$tb_ass_id[$i].'</td><td scope="col">'.$tb_emp_name[$i].'</td><td scope="col">'.$tb_dep_name[$i].'</td><td scope="col">'.$tb_ass_name[$i].'</td><td scope="col">'.$tb_ass_sn[$i].'</td><td width="75" scope="col"><a href="#" onclick="assetRemoveMapping('.$tb_asi_id[$i].')"><img src="images/icons/action_delete.gif" /></a></td></tr>';
				}	
				?>
            </thead>
            <tbody>
        
			</tbody>
          </table>
        </form>
		</div>
      </div>
     
<!--  END #PORTLETS -->  
  
   </div>
    <div class="clear"> </div>
<!-- END CONTENT-->    
<?php
                include_once  'template/footer.php';
?>
