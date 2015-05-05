<html>
<head>
<title>Require - Login</title>
   <style type="text/css">
.text {
	color:#FFF;
   font-family: Helvetica, sans-serif;
}
.login {
	font-family: "Lucida Console", Monaco, monospace;
	color:#FFF;
}
   </style>
</head>

<body  bgcolor="#FFFFFF">
<table width="950" border="0" cellspacing="0" cellpadding="0">
<tr>
  <td width="184" height="21"><text class="text"></text></td>
  <td width="816">&nbsp;</td>
</tr>
<tr>
  <td colspan="2"><table width="446" align="left"><tr><td>
    <form action="cilent_security_verify.php" method="post" name="loginform">
      <div align="center"></div>
      <br>
      <table bgcolor="#333333" align="center" width="209" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="205" height="33" class="login">&nbsp;&nbsp;&nbsp;&nbsp;<b>User Name:</b></td>
          </tr>
        <tr>
          <td height="33"><center><input name="username" type="text" size="25" required></center></td>
          </tr>
        <tr>
          <td height="27" class="login">&nbsp;&nbsp;&nbsp;&nbsp;<strong>Password:</strong></td>
          </tr>
        <tr>
          <td height="34"><center><input  name="password" type="password" size="25" autocomplete="off" required></center></td>
          </tr>
        <tr>
          <td height="52"><center><input type="hidden" name="login"  value="login">
  <input type="submit" value="Login"></center></td>
          </tr>
  </table>
  </form>
    <p align="center" class="login" style="color:#000000"><b>You need to login in first <br>
      as a user before 
      confirming purchase.<br>
Please Login or Sign up <a href="sign_up.php">HERE</a></b></p></td></tr></table>
    </td>
</tr>
<tr>
<td colspan="2"><table width="988"><tr>
</table>
<p>&nbsp;</p>

<text class="text"></text>
</body>
</html>