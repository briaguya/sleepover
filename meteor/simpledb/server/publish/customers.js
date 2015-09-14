Meteor.publish("customers", function() {
	return Customers.find({}, {});
});

Meteor.publish("customers_empty", function() {
	return Customers.find({_id:null}, {});
});

Meteor.publish("customer", function(customerId) {
	return Customers.find({_id:customerId}, {});
});

