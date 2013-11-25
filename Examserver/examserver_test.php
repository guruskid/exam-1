<?php

session_start();

/****

 Copyright (C) <2008> <Shankar Palaniappan>

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA

For details or issues with program
Please contact shankar_p@users.sourceforge.net
               shankar.palaniappan@gmail.com

****/
require_once("examserver_global.php");

// Use $HTTP_SESSION_VARS with PHP 4.0.6 or less
class TestLogic
{
  var $time;
  var $exam_username;
  var $count;
  var $hostname; 

  function TestLogic($name)
  { 

    $this->hostname=$name;
    $this->time = 0;
    $this->exam_username="";
    $header_message = sprintf("Location:http://%s/Examserver/index.php",
        mysql_real_escape_string($this->hostname));

    if (!isset($_SESSION['exam_server_user_name'])) 
    {
      header($header_message);
    }
    else
    {
      $this->exam_username=$_SESSION['exam_server_user_name']; 
    }
    if (isset($_SESSION['exam_time'])) 
    {
      $this->time=$_SESSION['exam_time'];
    }
    else
    {
      $this->time=100;
    }
    //echo "<meta http-equiv=\"refresh\" content=\"$time\">";
    //header("Refresh: $time;");


    if (!isset($_SESSION['count'])) 
    {
      $_SESSION['count'] = 0;
    } 
    else 
    {
      $_SESSION['count']++;
    }

  }

  function connectDB()
  {
    // Connecting, selecting database
    require_once("examserver_con_db.php"); 
  }


  function displayQuestion()
  {
    $this->connectDB();
    // Retrieve the answer and table name from
    // session
    $answer=$_GET['answer1'];
    $table_name=$_GET['table_name']; 
  
    //$qno=$_GET['qno']; 
    echo"$username\n"; 
  
    $question_no="questionNo";
    $qno=$_SESSION[$question_no];

    if (!$qno)
    {
      $qno=1;
  
      // Timer has to be updated
      // once the exam is finished 
  
      $query = sprintf("select * from $table_name");
      // Performing SQL query
      $result = mysql_query($query) or die('Query failed: ' . mysql_error());
      $_SESSION[$exam_server_total_qno]=mysql_num_rows($result);
    }
    // store the user response and the real answer
    // in session 
    if ($qno == $_SESSION[$exam_server_total_qno])
    {
    
      $_SESSION['exam_time']=1000; 
    }
    if ($qno > 1)
    {
      // echo $answer;
      $temp_qno=$qno-1;
      $ansFromUser="ans_from_user".$temp_qno;
      $_SESSION[$ansFromUser]=$answer;
    
      // This loop is used to retreive
      // the previous answer from the
      // session and store it Back
    
      for ($i=1; $i<$qno; $i++)
      {
        $ansFromUser="ans_from_user".$i;
        $ans =$_SESSION[$ansFromUser];
        $_SESSION[$ansFromUser]=$ans;
    
        $real_answer="realanswer$i";
        $realAnswer =$_SESSION[$real_answer];
        $_SESSION[$real_answer]=$realAnswer;
      }
  
    }
  
    // Formulate Query
    // This is the best way to perform a SQL query
    // For more examples, see mysql_real_escape_string()
    
    $query = sprintf("SELECT question,choice1,choice2,choice3,answer FROM %s where qno=%d",
        mysql_real_escape_string($table_name),
        mysql_real_escape_string($qno));
  
    // Performing SQL query
  
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
  
    // Check result
    // This shows the actual query sent to MySQL, and the error. Useful for debugging.
    
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }
    $num_rows = mysql_num_rows($result);
    if ($num_rows == 1)
    {
      // Printing results in HTML
  
      echo "<HTML><head>";
      require_once("examserver_css.php");
      echo "</head><body background=\"img/bkgnd.jpg\">";
      echo "<form name=\"form1\" method=get action="
      ?>
      <?php echo $_SERVER['PHP_SELF']; ?>
      <?php
      echo "><BR><BR><BR><BR><BR><BR><table>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"answer1\" VALUE=\"0\">";
      while ($line = mysql_fetch_assoc($result)) 
      {
        echo "<table bgcolor=Silver align=center><tr>";
        echo "<td>";
        echo $line['question'];
        echo "</td></tr>";
        echo "<tr><td>";
        echo "<input type=radio name=answer value=1 onClick=\"document.form1.answer1.value=this.value\">"; 
        echo $line['choice1'];
        echo "<tr><td>";
        echo "<input type=radio name=answer value=2 onClick=\"document.form1.answer1.value=this.value\" >"; 
        echo $line['choice2'];
        echo "</td></tr>";
        echo "<tr><td>";
        echo "<input type=radio name=answer value=3 onClick=\"document.form1.answer1.value=this.value\">"; 
        echo $line['choice3'];
        echo "</td></tr>";
        echo "<tr><td>";
        echo "<input type=submit value=\"Next\">"; 
        echo "</td></tr>";
        $real_answer="realanswer$qno";
        $_SESSION[$real_answer]=$line['answer'];
  
        // To retreive the next question
        $qno += 1;
        $question_no="questionNo";
        $_SESSION[$question_no]=$qno;
        echo "<input type=hidden name=table_name value =$table_name>";
        echo "</form>";
        echo "</table><BR>";
        require_once("examserver_license.php");
      }
    }
    // Exam is over
    // The result page is here
    else
    {
      $time=1;
      //header("Refresh: $time;");
      echo "<HTML><body bgcolor=Silver>";
      echo "Exam is finished<br>"; 
      $result=0;  
      for ($i=1; $i<$qno; $i++)
      {
        //echo "Answer from user:";
        $ansFromUser="ans_from_user".$i;
        $afu=$_SESSION[$ansFromUser] ;
        //echo "$afu<BR>";
    
        //echo "The Correct Answer is:";
        $real_answer="realanswer$i";
        $ra=$_SESSION[$real_answer] ;
        //echo "$ra<BR>";
        if ($afu == $ra)
        {
          $result++;
        }
      }
      echo "<BR>The score is $result "; 
      $real_qno=$qno-1;
      $pass_per=ceil((($result/$real_qno)*100));
      $loss_per=100-$pass_per;
      echo "out of $real_qno<BR>"; 
      echo "<table><tr><td>Scored</td><td valign=middle>";
      echo "<table><tr><td bgcolor=darkgreen><IMG width=$pass_per height=5></td>";
      echo "<td font size=1>$pass_per%</td></tr></table></td></tr>";
      echo "<tr><td>Loss</td><td valign=middle>";
      echo "<table><tr><td bgcolor=darkred><IMG width=$loss_per height=5></td>";
      echo "<td font size=1>$loss_per%</td></tr></table></td></tr></table>";

      $query = sprintf("update user_marks set %s = %d where name ='%s'",
          mysql_real_escape_string($table_name),
          mysql_real_escape_string($pass_per),
           mysql_real_escape_string($this->exam_username));
  
    // Performing SQL query
      $result = mysql_query($query) or die('Query failed: ' . mysql_error());

      session_unset(void);
      $_SESSION['exam_server_user_name']=$this->exam_username; 
      echo "<table><tr><td><a href=examserver_retest.php>Please click here to continue the test</a></td></tr>"; 

    }
    // Free resultset
    mysql_free_result($result);
    
    // Closing connection
    //mysql_close($link);

  }  
}

//Main starts here

$testLogic = new TestLogic($examserver_hostname);
$testLogic->displayQuestion();

// Main ends here
?> 

