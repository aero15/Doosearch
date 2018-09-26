<?php 

include("res/php/core.php"); 

use Account\Account;

if(isset($_SESSION['user_name']))
    header("Location: index.php");
if(!isset($_POST['action']))
    include('res/php/login/forms.php');
else
{
    $status;
    
    switch($_POST['action'])
    {
        case 'login':
        {
            if(isset($_POST['login']) && isset($_POST['password']))
                $status = Account::login($_POST['login'], $_POST['password']);
            
            break;
        }
        case 'register':
        {
            if(isset($_POST['email']) && isset($_POST['login']) && 
               isset($_POST['password_1']) && isset($_POST['password_2']))
            {
                $status = Account::register($_POST['email'],$_POST['login'],
                                            $_POST['password_1'],$_POST['password_2']);
            }
            break;
        }
        default:
            echo 'Error';
    }
    
    include('res/php/login/forms.php');
}
