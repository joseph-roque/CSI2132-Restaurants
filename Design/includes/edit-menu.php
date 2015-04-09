<?php
echo '
<button onclick="redirectMenu(';
	echo "'review-item.php?id=$itemid'";
	echo ')"  name = "edit-item" method  = "post"  type="edit-item" class="btn" style="padding-bottom:5px;padding-top:5px">
	<span class=" glyphicon glyphicon-edit"></span>
</button>';
?>
<button  onclick = "redirect('review-item.php')" name = "edit-item" method  = "post"  type="edit-item" class="btn" style="padding-bottom:5px;padding-top:5px">
	<span class=" glyphicon glyphicon-pencil"></span>
</button>
