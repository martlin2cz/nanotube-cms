function doPreview(button) {
	var form = button.form;
	form.target = "_blank";
}

function doSave(button) {
	var form = button.form;
	form.target = "";
}

function toEditor(pane) {
	//FIXME not working
	var sample = "\n" + pane.innerText;
	var editor = document.getElementById('content-textarea');
	editor.value += sample;
}
