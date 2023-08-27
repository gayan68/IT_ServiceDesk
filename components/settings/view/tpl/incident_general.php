    <!-- #PORTLETS START -->
    <div id="portlets">
    <!-- FIRST SORTABLE COLUMN START -->
      <div class="column" id="left" style="height: 10px">
      </div>
      <!-- FIRST SORTABLE COLUMN END -->
      <!-- SECOND SORTABLE COLUMN START -->
      <div class="column">
    </div>
	<!--  SECOND SORTABLE COLUMN END -->
    <div class="clear"></div>
<?php 
$namecategory='';
$nameform='New Category';
$action='incident_addcategory';

if(isset($_GET['sub'])) if($_GET['sub']=='edit_category'){ 
			$nameform='Edit Category'; 
			$action='incident_editcategory&id='.$_GET['id'];
			for($i=0;$i<sizeof($name1);$i++)
				if($id1[$i]==$_GET['id']) $namecategory=$name1[$i];
}?>

    <!--THIS IS A WIDE PORTLET-->
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16"/>Incident Category</div>
		<div class="portlet-content nopadding">
		<br />
        <form action="index.php?components=settings&action=<?php print $action; ?>" method="post" onsubmit="return validateCategory()"  >
          <table width="100%" cellpadding="0" cellspacing="0" >
				<tr><td width="10%"></td><td width="40%">
					<table>
					<tr><td style="vertical-align:middle"><?php print $nameform; ?></td><td width="20px"></td>
					<td style="vertical-align:middle">
	            
					<nav>
					    <ul>
					        <li>
					            <a><input type="text" name="category" id="category" value="<?php print $namecategory; ?>"/></a>
					            <ul id="list2">
					            </ul>
					        </li>
					    </ul>
					</nav> 
					</td><td width="30px"></td><td>
					<input type="submit"  style="width:50px; height:50px; background-color:inherit; border:none;  background-image:url('images/icons/arrow01.png'); cursor:pointer;"  value="" />
					</td></tr>
					<!--<tr><td colspan="5"><p>Suggestions: <span id="txtHint"></span></p></td></tr>-->
					</table>
				</td><td width="40%" style="vertical-align:top;">
				<!-- ---------------List Admin permited Domain Accounts ------------------------>
					<table id="box-table-b">
					<?php  for($i=0;$i<sizeof($id1);$i++){
								print '<tr><td width="50px"></td><td width="150px">'.$name1[$i].'</td><td width="10px"></td><td width="130px"><a href="index.php?components=settings&action=incident_general&sub=edit_category&id='.$id1[$i].'" ><img title="Edit" src="images/icons/edit.gif" /></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="incDeletecategory('."'".$id1[$i]."'".')" title="Remove User from Checklist" ><img src="images/icons/action_delete.gif" /></a></td></tr>';
							} ?>
					</table>
				</td></tr>
          </table>
        </form>
        
		</div>
      </div>
<!--  END #PORTLETS -->  
