var webdriver = require('selenium-webdriver');
var driver;

describe('ScrumManager E2E tests', function() {

	after(function() {
		driver.close();
	});

	driver = new webdriver.Builder().forBrowser('chrome').build();
	require('./createAccount.js')(driver);
	require('./logout.js')(driver);
	require('./login.js')(driver);
	require('./createProject.js')(driver);
});