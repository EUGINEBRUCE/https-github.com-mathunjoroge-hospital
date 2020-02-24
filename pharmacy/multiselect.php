<!DOCTYPE html>
<html>
<head>
	<title>
		select example
	</title>
	 <link href="../multiselect/css/multiselect.css" media="screen" rel="stylesheet" type="text/css">
</head>
<body>
	<select id='keep-order' multiple='multiple'>
  <option value='elem_1'>elem 1</option>
  <option value='elem_2'>elem 2</option>
  <option value='elem_3'>elem 3</option>
  <option value='elem_4'>elem 4</option>
  ...
  <option value='elem_100'>elem 100</option>
</select>

<script type="text/javascript">
	$('#keep-order').multiSelect({ keepOrder: true });
</script>
<script src="../multiselect/js/jquery.multi-select.js" type="text/javascript"></script>
</body>
</html>