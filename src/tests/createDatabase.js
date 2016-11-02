var execsql = require('execsql');
var config = {
	host: 'localhost',
	user: 'root',
	password: 'root'
};
var sqlFile = __dirname + '/../db/databaseCreation.sql';

execsql
.config(config)
.execFile(sqlFile, function(err, result) {
	if(err) console.log(err);
	else console.log("The database has been created successfully.");
	execsql.end();
});