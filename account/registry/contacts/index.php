<?php
function redirectToPage($page){
	header('Location:'.$page);
}
session_start();

if(!isset($_SESSION['account']['status']) || $_SESSION['account']['status']!='logged_in'){
	$_SESSION['err']['login'] = '<div class="controls"><div class="alert">Session Expired. Please log in.</div></div>';
	redirectToPage('../../login/');
}

define('local_url','../../../');

$_SESSION['page']['home_url'] = '../../../';


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Samedi: Registry Contacts</title>
<?php
include($_SESSION['page']['home_url'].'templates/script-tags.php');
?>
<script type="text/javascript" src="<?=local_url?>js/registry.01.js"></script>
</head>

<body>
<?php
	include($_SESSION['page']['home_url'].'templates/top-nav.dev.php');
?>
<!--End top nav-->
<div class="body-content account-page row-fluid" style="margin-top:100px;">
	<div class="span1">&nbsp;</div>
	<div class="span2 leftNavbar-container">
		<?php
			include(local_url.'account/bin/left-navbar.php');
		?>
	</div>
	<div class="large-8 columns">
		<div class="inline-heading">Manage your Registry Contacts</div><br />
		<div>Need help, let's give you a <a href="javascript:void()">quick and informative tour</a>.</div><!--do not remove-->
		<br />		
		
		<div class="row-fluid large-12 columns" style="margin-left:0; border-top:solid 3px #333333"><br />
			<div class="add-contact">
				<form class="form-horizontal">
					<div class="control-group">
						 <h5>Add a new contact</h5>
					</div>
					<div class="control-group">
						  <input type="text" id="inputName" placeholder="Contact Name" />
					 </div>
				    <div class="control-group input-prepend input-append">
					  <span class="add-on">+254</span>
					  	<input class="large-8 columns" id="inputNumber" placeholder="E.g 700111222" type="text">
					  <button class="btn" type="button" onclick="REGISTRY_CONTACTS.verifyContact()">Add Contact</button>
					</div>
					<div class="alert"></div>
				</form>
			</div>
			<hr />
			<?php
				
				$DB_NAME = 'samedico_samedi';
				$DBMS = new user_DBMS($DB_NAME);
				
				$strContacts = '';
				$countContacts = 0;
				try{
					if($DBMS->dbconnection_status){
						$sqlContacts = $DBMS->dataconn->prepare("SELECT registry_contacts FROM account_status WHERE userId=?");
						$sqlContacts->execute(array($_SESSION['account']['refUserId']));
						
						if($sqlContacts->rowCount()>0){
							$row=$sqlContacts->fetch(PDO::FETCH_ASSOC);
							if($row['registry_contacts']!='(empty)'){
								$rowContacts = $row['registry_contacts'];
								$arrContacts = explode('|',$rowContacts);
								$countContacts = count($arrContacts);
								for($i=0; $i<count($arrContacts); $i++){
									$arrSub = explode('*',$arrContacts[$i]);
									if($arrSub[0]!=''){
										$strContacts .= '
										<div class="contact contact-'.$i.' row-fluid">
											<div class="span2 contact-name">
												'.$arrSub[0].'
											</div>
											<div class="span2 contact-number">
												'.$arrSub[1].'
											</div>
											<div class="span1">
												<button type="button" class="close" aria-hidden="true" title="Edit this contact" onclick="REGISTRY_CONTACTS.editContactLoad('.$i.')"><i class=" icon-edit"></i></button>
											</div>
											<div class="span1" style="margin-left:0">
												<button type="button" class="close" aria-hidden="true" title="remove this contact" onclick="REGISTRY_CONTACTS.deleteContact('.$i.')"><i class=" icon-trash"></i></button>
											</div>
											<input type="hidden" value="'.$arrSub[0].'" id="curName_'.$i.'" />
											<input type="hidden" value="'.$arrSub[1].'" id="curPhone_'.$i.'" />
										</div>
										';
									}
								}
							}else{
								$strContacts = '
								<div class="alert alert-info">You have not added any contacts yet.</div>
								';
							}
						}
							
					}else{
						echo("Error");
					}
				}catch(PDOException $e){
					echo($e->getMessage);
				}
					
			
			
			?>
			<div class="contact-list row-fluid" style="font-size:15px">
			<div class="contact-list-alert alert large-12 columns" style="display:none"></div>
			<div class="large-12 columns"><h5><?php echo($countContacts);?> Contact(s)</h5></div>
				<?php
					echo($strContacts);
				?>
			</div>
		</div>
	
		<?php
		echo('<br /><br /><br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		'); //manual top margin
		include($_SESSION['page']['home_url']."templates/footer-account-pages.php");
		?>
	</div>
</div><br /><!--end bodycontent-->


    <div class="modal hide fade">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="number-to-edit"></h3>
		<h3 class="name-to-edit"></h3>
      </div>
      <div class="modal-body">
        <p>
			<form class="form-horizontal">
			<input type="hidden" value="" id="curEdit" />
				<div class="control-group">
					 <h5>New Details</h5>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputName_edit">Contact Name</label>
					<div class="controls">
						  <input type="text" id="inputName_edit" placeholder="Contact Name" />
					 </div>
				 </div>
				<div class="control-group input-prepend input-append">
					<label class="control-label" for="inputName_edit">Contact Name</label>
					<div class="controls">
					  <span class="add-on">+254</span>
						<input id="inputNumber_edit" placeholder="E.g 700111222" type="text">
					</div>
				</div>
				<div class="modal-alert alert" style="display:none"></div>
			</form>
		</p>
      </div>
      <div class="modal-footer">
        <a href="#" data-dismiss="modal" class="btn">Cancel</a>
        <a class="btn btn-primary" onclick="REGISTRY_CONTACTS.validateEditContact()">Save changes</a>
      </div>
    </div>
	
	<div class="footer-container-end">
		<div class="span1" style="width:1%">
			&nbsp;
		</div>
		&copy;&nbsp;&nbsp;Samedi Registry Co.&nbsp;
		<?php echo(date('Y')); ?>
	</div>
</body>
</html>
