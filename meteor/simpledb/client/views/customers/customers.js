var pageSession = new ReactiveDict();

Template.Customers.rendered = function() {
	
};

Template.Customers.events({
	
});

Template.Customers.helpers({
	
});

var CustomersViewItems = function(cursor) {
	if(!cursor) {
		return [];
	}

	var searchString = pageSession.get("CustomersViewSearchString");
	var sortBy = pageSession.get("CustomersViewSortBy");
	var sortAscending = pageSession.get("CustomersViewSortAscending");
	if(typeof(sortAscending) == "undefined") sortAscending = true;

	var raw = cursor.fetch();

	// filter
	var filtered = [];
	if(!searchString || searchString == "") {
		filtered = raw;
	} else {
		searchString = searchString.replace(".", "\\.");
		var regEx = new RegExp(searchString, "i");
		var searchFields = ["name", "phone", "email", "note", "active"];
		filtered = _.filter(raw, function(item) {
			var match = false;
			_.each(searchFields, function(field) {
				var value = (getPropertyValue(field, item) || "") + "";

				match = match || (value && value.match(regEx));
				if(match) {
					return false;
				}
			})
			return match;
		});
	}

	// sort
	if(sortBy) {
		filtered = _.sortBy(filtered, sortBy);

		// descending?
		if(!sortAscending) {
			filtered = filtered.reverse();
		}
	}

	return filtered;
};

var CustomersViewExport = function(cursor, fileType) {
	var data = CustomersViewItems(cursor);
	var exportFields = ["name", "phone", "email", "note", "active"];

	var str = convertArrayOfObjects(data, exportFields, fileType);

	var filename = "export." + fileType;

	downloadLocalResource(str, filename, "application/octet-stream");
}


Template.CustomersView.rendered = function() {
	pageSession.set("CustomersViewStyle", "table");
	
};

Template.CustomersView.events({
	"submit #dataview-controls": function(e, t) {
		return false;
	},

	"click #dataview-search-button": function(e, t) {
		e.preventDefault();
		var form = $(e.currentTarget).parent();
		if(form) {
			var searchInput = form.find("#dataview-search-input");
			if(searchInput) {
				searchInput.focus();
				var searchString = searchInput.val();
				pageSession.set("CustomersViewSearchString", searchString);
			}

		}
		return false;
	},

	"keydown #dataview-search-input": function(e, t) {
		if(e.which === 13)
		{
			e.preventDefault();
			var form = $(e.currentTarget).parent();
			if(form) {
				var searchInput = form.find("#dataview-search-input");
				if(searchInput) {
					var searchString = searchInput.val();
					pageSession.set("CustomersViewSearchString", searchString);
				}

			}
			return false;
		}

		if(e.which === 27)
		{
			e.preventDefault();
			var form = $(e.currentTarget).parent();
			if(form) {
				var searchInput = form.find("#dataview-search-input");
				if(searchInput) {
					searchInput.val("");
					pageSession.set("CustomersViewSearchString", "");
				}

			}
			return false;
		}

		return true;
	},

	"click #dataview-insert-button": function(e, t) {
		e.preventDefault();
		Router.go("customers.insert", {});
	},

	"click #dataview-export-default": function(e, t) {
		e.preventDefault();
		CustomersViewExport(this.customers, "csv");
	},

	"click #dataview-export-csv": function(e, t) {
		e.preventDefault();
		CustomersViewExport(this.customers, "csv");
	},

	"click #dataview-export-tsv": function(e, t) {
		e.preventDefault();
		CustomersViewExport(this.customers, "tsv");
	},

	"click #dataview-export-json": function(e, t) {
		e.preventDefault();
		CustomersViewExport(this.customers, "json");
	}

	
});

Template.CustomersView.helpers({

	

	"isEmpty": function() {
		return !this.customers || this.customers.count() == 0;
	},
	"isNotEmpty": function() {
		return this.customers && this.customers.count() > 0;
	},
	"isNotFound": function() {
		return this.customers && pageSession.get("CustomersViewSearchString") && CustomersViewItems(this.customers).length == 0;
	},
	"searchString": function() {
		return pageSession.get("CustomersViewSearchString");
	},
	"viewAsTable": function() {
		return pageSession.get("CustomersViewStyle") == "table";
	},
	"viewAsList": function() {
		return pageSession.get("CustomersViewStyle") == "list";
	},
	"viewAsGallery": function() {
		return pageSession.get("CustomersViewStyle") == "gallery";
	}

	
});


Template.CustomersViewTable.rendered = function() {
	
};

Template.CustomersViewTable.events({
	"click .th-sortable": function(e, t) {
		e.preventDefault();
		var oldSortBy = pageSession.get("CustomersViewSortBy");
		var newSortBy = $(e.target).attr("data-sort");

		pageSession.set("CustomersViewSortBy", newSortBy);
		if(oldSortBy == newSortBy) {
			var sortAscending = pageSession.get("CustomersViewSortAscending") || false;
			pageSession.set("CustomersViewSortAscending", !sortAscending);
		} else {
			pageSession.set("CustomersViewSortAscending", true);
		}
	}
});

Template.CustomersViewTable.helpers({
	"tableItems": function() {
		return CustomersViewItems(this.customers);
	}
});


Template.CustomersViewTableItems.rendered = function() {
	
};

Template.CustomersViewTableItems.events({
	"click td": function(e, t) {
		e.preventDefault();
		Router.go("customers.details", {customerId: this._id});
		return false;
	},

	"click .inline-checkbox": function(e, t) {
		e.preventDefault();

		if(!this || !this._id) return false;

		var fieldName = $(e.currentTarget).attr("data-field");
		if(!fieldName) return false;

		var values = {};
		values[fieldName] = !this[fieldName];

		Customers.update({ _id: this._id }, { $set: values });

		return false;
	},

	"click #delete-button": function(e, t) {
		e.preventDefault();
		var me = this;
		bootbox.dialog({
			message: "Delete? Are you sure?",
			title: "Delete",
			animate: false,
			buttons: {
				success: {
					label: "Yes",
					className: "btn-success",
					callback: function() {
						Customers.remove({ _id: me._id });
					}
				},
				danger: {
					label: "No",
					className: "btn-default"
				}
			}
		});
		return false;
	},
	"click #edit-button": function(e, t) {
		e.preventDefault();
		Router.go("customers.edit", {customerId: this._id});
		return false;
	}
});

Template.CustomersViewTableItems.helpers({
	"checked": function(value) { return value ? "checked" : "" }
	

	
});
