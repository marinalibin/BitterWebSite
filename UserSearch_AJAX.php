<?php
session_start();
include_once ('connect.php');
include_once ('User.php');
User::GetUserScreenName($_GET["to"]);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

