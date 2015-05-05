<html>
<head>
<title>Admin Panel - Login</title>
   <style type="text/css">
.text {
	color: #F00;
	font-family: "Comic Sans MS", cursive;
	font-weight: bold;
	font-style: italic;
	font-size: 36px;
	text-align: center;
}
.login {
	font-family: "Lucida Console", Monaco, monospace;
	color:#FFF;
}
   </style>
</head>

<body  bgcolor="white">
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
  <td width="184" height="21"><text class="text"><center>
  !!Wrong Keyword..!!
  </center></text></td>
</tr>
<tr>
  <td colspan="2"><table width="446" align="center"><tr><td>
    <form action="security_verify.php" method="post" name="loginform">
      <div align="center"></div>
      <br>
      <table width="209" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#333333">
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
    <p align="center" class="login">.LOGIN ERROR : WRONG USERNAME // PASSWORD.<br>
      .LOGIN ADMIN LEVEL TO PROCEED.</p></td></tr></table>
    </td>
</tr>
<tr>
<td colspan="2"><table width="206"><tr>
  <td width="196">&nbsp;</td></tr></table></tr>
</table>
<p>&nbsp;</p>

<text class="text"></text>
</body>
</html>