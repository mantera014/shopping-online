<html>
<head>
<title>Admin Panel - Login</title>
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

<body  bgcolor="#231f20">
<table width="950" border="0" cellspacing="0" cellpadding="0">
<tr>
  <td width="184" height="21"><text class="text"><img src="../images/warning.png" width="383" height="56"></text></td>
  <td width="816"><hr></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td colspan="2"><table width="446" align="left"><tr><td>
  <form action="security_verify.php" method="post" name="loginform">
  <div align="center"><img src="../images/logo.png" alt="" width="184" height="167" border="0" align="middle" ></div>
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
  <p align="center"><span class="login">.YOU HAVE LOGOUT : PLEASE ENTER USERNAME/PASSWORD TO LOG BACK IN.<br>
.LOGIN ADMIN LEVEL TO PROCEED.</span></p></td></tr></table>
  </td>
</tr>
<tr>
<td colspan="2"><table width="988"><tr>
  <td width="780"><hr></td> 
    <td width="196"><img src="../images/logo-word.png" alt="" width="200" height="48"></td></tr></table></tr>
</table>
<p>&nbsp;</p>

<text class="text"></text>
</body>
</html>