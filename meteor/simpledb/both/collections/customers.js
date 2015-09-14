this.Customers = new Mongo.Collection("customers");

this.Customers.userCanInsert = function(userId, doc) {
	return true;
}

this.Customers.userCanUpdate = function(userId, doc) {
	return true;
}

this.Customers.userCanRemove = function(userId, doc) {
	return true;
}
