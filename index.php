<!DOCTYPE html>
<html>
<!--

Just redirects to one of _sample designs specified bellow

-->
	<head>
		<title>Redirecting ...</title>
	</head>
	<body>
<script>
function rest_of_url() {
	var url = location.href;

	var index_of_ask = url.indexOf('?');
	var index_of_hash = url.indexOf('#');

	if (index_of_ask > -1) {
		return url.substr(index_of_ask);
	} else if (index_of_hash > -1) {
		return url.substr(index_of_hash);
	} else {
		return "";
	}
}

//uncomment required sample design
//be sure you have correctly configured $config->links_format

//var to = "_samples/basic-web/";
var to = "_samples/basic-web-with-sidebar/";
//var to = "_samples/single-paged-web/";
//var to = "_samples/primitive-web/";


var rest = rest_of_url();
location.assign(to + rest);
		</script>
	</body>
</html>
