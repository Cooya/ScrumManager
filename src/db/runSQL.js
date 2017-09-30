var execsql = require('execsql');
var config = {
	host: 'localhost',
	user: 'root',
	password: 'root'
};
var sqlFile = __dirname + '/' + process.argv[2];

execsql
.config(config)
.execFile(sqlFile, function(err, result) {
	if(err) console.log(err);
	else console.log("SQL script executed successfully.");
	execsql.end();
});