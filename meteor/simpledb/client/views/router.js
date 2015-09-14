Router.configure({
	templateNameConverter: "upperCamelCase",
	routeControllerNameConverter: "upperCamelCase",
	layoutTemplate: "layout",
	notFoundTemplate: "notFound",
	loadingTemplate: "loading"
});

var freeRoutes = [
	"home",
	"customers",
	"customers.insert",
	"customers.details",
	"customers.edit"
];

Router.onBeforeAction(function() {
	// loading indicator here
	if(!this.ready()) {
		$("body").addClass("wait");
	} else {
		$("body").removeClass("wait");
		this.next();
	}
});

Router.map(function () {

	this.route("home", {path: "/", controller: "HomeController"});
	this.route("customers", {path: "/customers", controller: "CustomersController"});
	this.route("customers.insert", {path: "/customers/insert", controller: "CustomersInsertController"});
	this.route("customers.details", {path: "/customers/details/:customerId", controller: "CustomersDetailsController"});
	this.route("customers.edit", {path: "/customers/edit/:customerId", controller: "CustomersEditController"});
});
