function redirect(link) {
	var currentLink = window.location.href;
	var index = currentLink.lastIndexOf("?");
	var tmp = currentLink.substr(index,currentLink.length);

	link = link.concat(tmp);

	window.location.href = link;
}

function redirectMenu(link, num) {

	window.location.href = link;
}
