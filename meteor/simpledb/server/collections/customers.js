Customers.allow({
	insert: function (userId, doc) {
		return Customers.userCanInsert(userId, doc);
	},

	update: function (userId, doc, fields, modifier) {
		return Customers.userCanUpdate(userId, doc);
	},

	remove: function (userId, doc) {
		return Customers.userCanRemove(userId, doc);
	}
});

Customers.before.insert(function(userId, doc) {
	doc.createdAt = new Date();
	doc.createdBy = userId;
	doc.modifiedAt = doc.createdAt;
	doc.modifiedBy = doc.createdBy;

	
	if(!doc.createdBy) doc.createdBy = userId;
});

Customers.before.update(function(userId, doc, fieldNames, modifier, options) {
	modifier.$set = modifier.$set || {};
	modifier.$set.modifiedAt = new Date();
	modifier.$set.modifiedBy = userId;

	
});

Customers.before.remove(function(userId, doc) {
	
});

Customers.after.insert(function(userId, doc) {
	
});

Customers.after.update(function(userId, doc, fieldNames, modifier, options) {
	
});

Customers.after.remove(function(userId, doc) {
	
});
