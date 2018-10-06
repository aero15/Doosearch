<?php 

use Gui\Window;

$last_connections = getLastConnections(3);
$lang->setSection('my_account');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <?php $lang->setSection('my_account'); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <link rel="stylesheet" href="res/css/account.css" />
        <link rel="stylesheet" href="res/css/windows.css" />
        <title><?= $_CORE['app_name'] .' > '. $lang->getKey('my_account'); ?></title>
        <script src="res/js/windows.js"></script>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <?php $lang->setSection('my_account'); ?>
        <script>setCurrentPage('#accountPage');</script>
		
		<div class="presentation" style="background-image: url(res/img/login.png);">
			<h1><?= $lang->getKey('my_account'); ?></h1>
		</div>
		
		<div class="page">
            <h1><?= $lang->getKey('my_account'); ?></h1>
            <?php if(isset($error)) { ?>
            <p class="info red"><?= $error ?></p>
            <?php } ?>
            <table id="ident">
                <tr>
                    <td colspan="3"><img src="res/img/profile.png" /></td>
                </tr>
                <tr>
                    <th><?= $lang->getKey('login'); ?></th>
                    <td><?= $_SESSION['user_name'] ?></td>
                    <td><button onclick="openWindow('#loginEditor')"><?= $lang->getKey('edit'); ?></button></td>
                </tr>
                <tr>
                    <th><?= $lang->getKey('email'); ?></th>
                    <td><?= $email ?></td>
                    <td><button onclick="openWindow('#emailEditor')"><?= $lang->getKey('edit'); ?></button></td>
                </tr>
                <tr>
                    <th><?= $lang->getKey('password'); ?></th>
                    <td>********</td>
                    <td><button onclick="openWindow('#passwordEditor')"><?= $lang->getKey('edit'); ?></button></td>
                </tr>
                <tr>
                    <th><?= $lang->getKey('account_type'); ?></th>
                    <td><?= $type ?></td>
                    <td><button class="disabled"><?= $lang->getKey('edit'); ?></button></td>
                </tr>
            </table>
            
            <h1><?= $lang->getKey('last_connections'); ?></h1>
            <?php
            if(sizeof($last_connections) > 0)
            {
            ?>
            
            <table id="listConnections">
                <tr>
                    <th>#</th>
                    <th><?= $lang->getKey('date'); ?></th>
                    <th><?= $lang->getKey('time'); ?></th>
                    <th><?= $lang->getKey('ip'); ?></th>
                    <th><?= $lang->getKey('user_agent'); ?></th>
                </tr>
                
                <?php
                $th = 0;
                foreach($last_connections as $connexion)
                {
                    $th++;
                ?>
                
                <tr>
                    <th><?= $th ?></th>
                    <td><?= $connexion['date'] ?></td>
                    <td><?= $connexion['time'] ?></td>
                    <td><?= $connexion['ip'] ?></td>
                    <td><?= $connexion['user_agent'] ?></td>
                </tr>
                
                <?php } ?>
            </table>
                
            <a href="?action=details-connections"><button><?= $lang->getKey('see_more'); ?></button></a>
            <?php
            }
            else
            {
                ?><p class="info"><?= $lang->getKey('no_data_to_display'); ?></p><?php
            }
            ?>
		</div>
        
        
        
        
        <?php ob_start(); ?>
        <form method="post">
            <input type="hidden" name="action" value="change_login">
            <table>
                <tr>
                    <th><?= $lang->getKey('current_login'); ?></th>
                    <td><input type="text" value="<?= $_SESSION['user_name'] ?>" disabled class="disabled"></td>
                </tr>
                <tr>
                    <th><?= $lang->getKey('new_login'); ?></th>
                    <td><input type="text" name="new_login" value="<?= $_SESSION['user_name'] ?>"></td>
                </tr>
                <tr>
                    <th></th>
                    <td><input type="submit" value="<?= $lang->getKey('submit'); ?>"></td>
                </tr>
            </table>
        </form>
        <?php
        $loginEditor = new Window($lang->getKey('edit_login'), 'loginEditor', ob_get_clean());
        $loginEditor->toHtml();
        
        
        ob_start(); ?>
        <form method="post">
            <input type="hidden" name="action" value="change_email">
            <table>
                <tr>
                    <th><?= $lang->getKey('current_email') ?></th>
                    <td><input type="mail" value="<?= $email ?>" disabled class="disabled"></td>
                </tr>
                <tr>
                    <th><?= $lang->getKey('new_email') ?></th>
                    <td><input type="mail" name="new_email"></td>
                </tr>
                <tr>
                    <th></th>
                    <td><input type="submit" value="<?= $lang->getKey('submit') ?>"></td>
                </tr>
            </table>
        </form>
        <?php
        $emailEditor = new Window($lang->getKey('change_email'), 'emailEditor', ob_get_clean());
        $emailEditor->toHtml();
        
        
        ob_start(); ?>
        <form method="post">
            <input type="hidden" name="action" value="change_password">
            <table>
                <tr>
                    <th><?= $lang->getKey('current_password') ?></th>
                    <td><input type="password" name="old_password"></td>
                </tr>
                <tr>
                    <th><?= $lang->getKey('new_password') ?></th>
                    <td><input type="password" name="new_password1"></td>
                </tr>
                <tr>
                    <th><?= $lang->getKey('new_password_2') ?></th>
                    <td><input type="password" name="new_password2"></td>
                </tr>
                <tr>
                    <th></th>
                    <td><input type="submit" value="<?= $lang->getKey('submit') ?>"></td>
                </tr>
            </table>
        </form>
        <?php
        $passwordEditor = new Window($lang->getKey('change_password'), 'passwordEditor', ob_get_clean());
        $passwordEditor->toHtml();
        ?>
    </body>
</html>