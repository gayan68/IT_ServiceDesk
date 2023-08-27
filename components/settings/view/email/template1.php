<?php

$message ='<html>
<div style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: medium; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);" tabindex="-1">
</div>
<div style="font-size: 13px; direction: ltr; margin: 5px 15px 0px 0px; padding-bottom: 5px; position: relative; color: rgb(34, 34, 34); font-family: arial, sans-serif; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">
	<div style="overflow: hidden;">
		<div>
			<div style="border: 1px solid rgb(223, 223, 223); color: rgb(104, 104, 104); font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 13px; line-height: normal; font-family: Arial;">
				<div style="padding: 20px; background-color: rgb(255, 255, 255);">
					<table cellpadding="0" cellspacing="0">
						<tr>
							<td style="font-family: arial, sans-serif; margin: 0px; padding-right: 15px; vertical-align: top;">
							<a href="http://'.$server_url.'/index.php" style="color: rgb(17, 85, 204);" target="_blank">
							<img height="75" src="http://'.$server_url.'/images/logo.jpg" style="border: 1px solid rgb(204, 204, 204);"></a></td>
							<td style="font-family: Arial; margin: 0px; width: 578px; vertical-align: top; color: rgb(104, 104, 104); font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 16px; line-height: normal;">
							'.$appname.'<div style="width: 578px; color: rgb(51, 51, 51); font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 13px; line-height: normal; font-family: Arial; vertical-align: top; padding-top: 10px;">
								'.$modulename.' Alert.<br /> <strong>'.$heading.'</strong></div>
							<div style="margin-top: 10px;">
								<a dir="ltr" href="http://'.$server_url.'/index.php?components='.$module.'&action='.$action2.'&id='.$id.'" style="color: rgb(17, 85, 204); visibility: visible;">
								<div aria-haspopup="true" guidedhelpid="circlepicker_button" role="button" style="position: relative; display: inline-block; border-radius: 2px; cursor: default; font-size: 11px; font-weight: bold; text-align: center; white-space: nowrap; margin: 0px; height: 27px; line-height: 27px; min-width: 0px; outline: 0px; padding: 0px 8px; -webkit-box-shadow: none; box-shadow: none; border: 1px solid rgba(0, 0, 0, 0.0980392); color: rgb(68, 68, 68); text-shadow: rgba(0, 0, 0, 0.0980392) 0px 1px; text-transform: none; overflow: hidden; text-overflow: ellipsis; word-wrap: normal; visibility: visible; -webkit-user-select: none; max-width: 117px; background-image: -webkit-linear-gradient(top, rgb(245, 245, 245), rgb(241, 241, 241)); background-color: rgb(245, 245, 245);" tabindex="0" title="">
									<span dir="ltr">Respond Now</span></div>
								</a></div>
							</td>
						</tr>
					</table>
					<div style="border-top-style: solid; border-top-width: 1px; border-top-color: rgb(221, 221, 221); margin-top: 20px;">
						<div style="padding-top: 20px;">'.$titlebody.'</div><br />
							<table style="color: rgb(104, 104, 104); font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 13px; line-height: normal; font-family: Arial;"">
							'.$body.'
							</table>
					</div>
				</div>
				<div style="border-top-style: solid; border-top-width: 1px; border-top-color: rgb(223, 223, 223); padding: 0px 20px; background-color: rgb(245, 245, 245);">
					<table cellpadding="0" cellspacing="0" style="height: 50px;">
						<tr>
							<td style="font-family: Arial; margin: 0px; vertical-align: middle; width: 660px; color: rgb(99, 99, 99); font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 11px; line-height: 13.1999998092651px;">
							<a href="http://'.$server_url.'/index.php?components=settings&action=disable_emailalert&authid='.$authid.'" style="color: rgb(51, 102, 204); text-decoration: none;" target="_blank">
							Unsubscribe</a><span>&nbsp;</span> email alerts 
							from '.$modulename.'.<br>WAppCloud.com , web application solutions 
							for everyone<br></td>
							<td style="font-family: arial, sans-serif; margin: 0px; padding: 0px;">
							&nbsp;</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</html>';
?>
