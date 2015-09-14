var pageSession = new ReactiveDict();

Template.CustomersInsert.rendered = function() {
	
};

Template.CustomersInsert.events({
	
});

Template.CustomersInsert.helpers({
	
});

Template.CustomersInsertInsertForm.rendered = function() {
	

	pageSession.set("customersInsertInsertFormInfoMessage", "");
	pageSession.set("customersInsertInsertFormErrorMessage", "");

	$(".input-group.date").each(function() {
		var format = $(this).find("input[type='text']").attr("data-format");

		if(format) {
			format = format.toLowerCase();
		}
		else {
			format = "mm/dd/yyyy";
		}

		$(this).datepicker({
			autoclose: true,
			todayHighlight: true,
			todayBtn: true,
			forceParse: false,
			keyboardNavigation: false,
			format: format
		});
	});

	$("input[type='file']").fileinput();
	$("select[data-role='tagsinput']").tagsinput();
	$(".bootstrap-tagsinput").addClass("form-control");
	$("input[autofocus]").focus();
};

Template.CustomersInsertInsertForm.events({
	"submit": function(e, t) {
		e.preventDefault();
		pageSession.set("customersInsertInsertFormInfoMessage", "");
		pageSession.set("customersInsertInsertFormErrorMessage", "");

		var self = this;

		function submitAction(msg) {
			var customersInsertInsertFormMode = "insert";
			if(!t.find("#form-cancel-button")) {
				switch(customersInsertInsertFormMode) {
					case "insert": {
						$(e.target)[0].reset();
					}; break;

					case "update": {
						var message = msg || "Saved.";
						pageSession.set("customersInsertInsertFormInfoMessage", message);
					}; break;
				}
			}

			Router.go("customers", {});
		}

		function errorAction(msg) {
			msg = msg || "";
			var message = msg.message || msg || "Error.";
			pageSession.set("customersInsertInsertFormErrorMessage", message);
		}

		validateForm(
			$(e.target),
			function(fieldName, fieldValue) {

			},
			function(msg) {

			},
			function(values) {
				

				newId = Customers.insert(values, function(e) { if(e) errorAction(e); else submitAction(); });
			}
		);

		return false;
	},
	"click #form-cancel-button": function(e, t) {
		e.preventDefault();

		

		Router.go("customers", {});
	},
	"click #form-close-button": function(e, t) {
		e.preventDefault();

		/*CLOSE_REDIRECT*/
	},
	"click #form-back-button": function(e, t) {
		e.preventDefault();

		/*BACK_REDIRECT*/
	}

	
});

Template.CustomersInsertInsertForm.helpers({
	"infoMessage": function() {
		return pageSession.get("customersInsertInsertFormInfoMessage");
	},
	"errorMessage": function() {
		return pageSession.get("customersInsertInsertFormErrorMessage");
	}
	
});
