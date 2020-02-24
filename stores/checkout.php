<?php

$amount=$_GET['total'];
$invoice=$_GET['invoice'];

?><p>&nbsp;</p>
<form action="savep.php" method="POST">
	<input type="hidden" name="amount" value="<?php echo $amount; ?>">
	<input type="hidden" name="invoice" value="<?php echo $invoice; ?>">
	<input type="text" name="invoice_no" placeholder="Enter invoice number" style="width: 100%;" required/></br>&nbsp;
	<button class="btn btn-success" style="width: 100%;">save</button>
</form>