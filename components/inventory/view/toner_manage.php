<?php
                include_once  'template/header.php';
?>
<!-- MENU END -->

</div>
<div class="grid_16">
<!-- TABS START -->
    <div id="tabs">
         <div class="container">
            <ul>
<?php                    
														print '<li><a href="index.php?components=inventory&action=show_submit"><span>Home</span></a></li>';
														print '<li><a href="index.php?components=inventory&action=list_list&filter_type=1&filter_status=1"><span>List</span></a></li>';
                      									print '<li><a href="index.php?components=inventory&action=one_asset" ><span>Asset Details</span></a></li>';
                      									print '<li><a href="index.php?components=inventory&action=toner_manage" class="current" ><span>Toner Manage</span></a></li>';
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
            <div class="portlet-header"><img src="images/icons/chart_bar.gif" width="16" height="16" alt="Reports" /> Add Toner Types</div>
            <div class="portlet-content">
		<br /><br />
            <!--THIS IS A PLACEHOLDER FOR FLOT - Report & Graphs -->
<?php
		if($_GET['action']=='toner_manage')  include_once  'components/inventory/view/tpl/add_toner_name.php';
		if($_GET['action']=='show_edit_toner_name')  include_once  'components/inventory/view/tpl/edit_toner_name.php';
?>
            </div>
        </div>      
      <!--THIS IS A PORTLET-->
      </div>
      <!-- FIRST SORTABLE COLUMN END -->
      <!-- SECOND SORTABLE COLUMN START -->
      <div class="column">
 
      <!--THIS IS A PORTLET-->        
        <div class="portlet">
		<div class="portlet-header">Add Toners to Inventory</div>

		<div class="portlet-content">
		<br /><br />
		<form method="post" action="index.php?components=inventory&action=add_toner_inventory"  onsubmit="return addTonerInventory()" > 
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a">
            <tbody>
				<tr><td width="150px"></td><td>Purchased Invoice No</td><td width="50px"></td><td width="350px"><input type="text" id="po_no" name="po_no" /></td><td></td></tr>
				<tr><td width="150px"></td><td width="250px">Toner Name</td><td width="50px"></td><td width="350px">
				<select name="toner_id" id="toner_id">
					<option value="">-SELECT-</option>
					<?php for($i=0;$i<sizeof($toner_id);$i++){
						print '<option value="'.$toner_id[$i].'">'.$toner_name[$i].'</option>';
					} ?>
				</select>
				</td><td width="50px"></td></tr>
				<tr><td width="150px"></td><td>Toner Qty</td><td width="50px"></td><td width="350px"><input type="text" name="toner_qty" id="toner_qty" /></td><td></td></tr>
				<tr><td width="150px"></td><td>Purchased Unit Price</td><td width="50px"></td><td width="350px"><input type="text" name="purchased_price" id="purchased_price" /></td><td></td></tr>
				<tr><td width="300px"></td><td colspan="3" align="center"><br /><input type="submit" value="Add to Inventory" style="height:30px; width:130px;" /></td><td width="300px"></td></tr>
	        </tbody>
          </table>
          </form>
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
              <tr><th width="25" scope="col"></th><th width="100px" scope="col">Name of the Toner</th><th scope="col">Action</th></tr>
		       <?php
				for($i=0;$i<sizeof($toner_id);$i++){
						print '<tr><td scope="col"></td><td scope="col">'.$toner_name[$i].'</td><td width="75" scope="col"><a href="index.php?components=inventory&action=show_edit_toner_name&id='.$toner_id[$i].'"><img src="images/icons/edit.gif" /></a>&nbsp;&nbsp;&nbsp;<a href="#" onclick="deleteTonerName('.$toner_id[$i].')"><img src="images/icons/action_delete.gif" /></a></td></tr>';
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
