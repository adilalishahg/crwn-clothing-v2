<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form name="upload_file" method="post" action="upload_file.php" enctype="multipart/form-data">
<table width="200" border="0">
  <tr>
    <td colspan="2">Upload Transportation Log</td>
  </tr>
  <tr>
    <td><input type="file" name="upload_files[]" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="submit" name="submit" value="Upload File"/>
    <input type="hidden" name="id" value="{$id}"/>
    <input type="hidden" name="reqid" value="{$reqid}"/>
    </td>
    <td>&nbsp;</td>
  </tr>
</table>

</form>
</body>
</html>