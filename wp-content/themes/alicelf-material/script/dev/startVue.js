var eventHub = new Vue();
var amWoo = AMdefaults.wooOptions;

var isDescendant = function (parent, child) {
	var node = child.parentNode;
	while (node != null) {
		if (node == parent) {
			return true;
		}
		node = node.parentNode;
	}
	return false;
};

var dataToPost = function(action, data) {
	var formData = new FormData();
	formData.append('action', action);
	for (var part in data) {
		var dataItem = data[part];
		formData.append(part, dataItem);
	}

	return formData;
};