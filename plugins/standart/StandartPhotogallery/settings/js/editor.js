function moveTo(link, dir) {

	var dirInput = link.parentNode.childNodes[3];	//kill me!
	dirInput.value = dir;

	var form = dirInput.form;
	form.action = 'actions/change-order.php';
	form.submit();
	
	//doStuff(link);
}
