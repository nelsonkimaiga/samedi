<?php
session_start();

$_SESSION['page']['home_url'] = '../../';


$item_code = '111111';



include('../bin/item.template.php');
include('../bin/registryItem.modal.php');
include('../../templates/footer-nav.php');
?>