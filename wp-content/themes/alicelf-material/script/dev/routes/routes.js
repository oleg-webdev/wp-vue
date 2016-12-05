var Foo = {
	template: '<div>\
		sfsdfsfs\
		<strong></strong>\
	</div>'
};

var Bar = {
	template: '<div>\
		<div>\
		<ul>\
			<li>List Item </li>\
			<li>List Item </li>\
			<li>List Item </li>\
		</ul>\
		</div>\
	</div>'
};

var routes = [
	{path      : '/', component: Network},
	{path      : '/foo', component: Foo},
	{path      : '/bar', component: Bar},
	{path      : '*', component: Notfound}
];

var router = null;
if ((typeof VueRouter) !== "undefined") {
	router = new VueRouter({
		// mode: 'history',
		routes: routes
	});
}

