<?php

/*
***************************************************
*** Online Examination System                   ***
***---------------------------------------------***
*** License: GNU General Public License V.3     ***
*** Author: Manjunath Baddi                     ***
*** Title:  Test Completion Acknowledgement     ***
***************************************************
*/

error_reporting(0);
session_start();
include_once 'oesdb.php';
if(!isset($_SESSION['stdname'])) {
    $_GLOBALS['message']="Session Timeout.Click here to <a href=\"index.php\">Re-LogIn</a>";
}
else if(isset($_REQUEST['logout']))
{
    //Log out and redirect login page
    unset($_SESSION['stdname']);
    header('Location: index.php');

}
else if(isset($_REQUEST['dashboard'])){
    //redirect to dashboard
   
     header('Location: stdwelcome.php');

}
if(isset($_SESSION['starttime']))
{
    executeQuery("update studenttest set status='over',endtime=(select CURRENT_TIMESTAMP) where testid=".$_SESSION['testid']." and stdid=".$_SESSION['stdid'].";");
    unset($_SESSION['starttime']);
    unset($_SESSION['endtime']);
    unset($_SESSION['tqn']);
    unset($_SESSION['qn']);
    unset($_SESSION['duration']);
    
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title>BBOExam-Test Acknowledgement</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" type="text/css" href="oes.css"/>
    <script type="text/javascript" src="validate.js" ></script>
    </head>
  <body >
       <?php

        if($_GLOBALS['message']) {
            echo "<div class=\"message\">".$_GLOBALS['message']."</div>";
        }
        ?>
      <div id="container">
      <div class="header">
                <img style="margin:10px 2px 2px 10px;float:left;" height="85" width="85" src="images/logo.gif" alt="OES"/><h3 class="headtext"> &nbsp;Batubara Online Examination</h3>
                <h4 style="color:#ffffff;text-align:center;margin:0 0 5px 5px;"><i>...because Examination Matters</i></h4>
            </div>
           <form id="editprofile" action="editprofile.php" method="post">
          <div class="menubar">
               <ul id="menu">
                        <?php if(isset($_SESSION['stdname'])) {
                         // Navigations
                         ?>
                        <li><input type="submit" value="LogOut" name="logout" class="subbtn" title="Log Out"/></li>
                        <li><input type="submit" value="DashBoard" name="dashboard" class="subbtn" title="Dash Board"/></li>
                       <?php
                        $result=executeQuery("select city from student where stdid='".$_SESSION['stdid']."';");
                        if(mysql_num_rows($result)==0) {
                           header('Location: stdwelcome.php');
                        }
                        {
                        $r=mysql_fetch_array($result);
                        ?>
                       <h3 style="text-align:left;color:#ffffff;">Nama : <?php echo htmlspecialchars_decode($_SESSION['stdname'],ENT_QUOTES); ?></h3>
                       <h3 style="text-align:left;color:#ffffff;">Role : <?php echo htmlspecialchars_decode($r['city'],ENT_QUOTES); ?></h3>
                       <?php
                        }
                       ?>

               </ul>
          </div>
      <div class="page">
          <h3 style="color:#0000cc;text-align:center;">Your answers are Successfully Submitted. To view the Results <b><a href="viewresult.php">Click Here</a></b> </h3>
          <?php
                        }
          ?>
      </div>

           </form>
     <div id="footer">
          <p style="font-size:70%;color:#ffffff;"> Modified By-<b>team BBO</b><br/> </p><p>Released under the GNU General Public License v.3</p>
      </div>
      </div>
  </body>
</html>

