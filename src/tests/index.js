var webdriver = require('selenium-webdriver');
var driver;

describe('ScrumManager E2E tests', function() {
	this.timeout(8000);

	after(function() {
		driver.close();
	});

	driver = new webdriver.Builder().forBrowser('chrome').build();
	require('./registration.js')(driver);
	require('./logout.js')(driver);
	require('./login.js')(driver);
	require('./createProject.js')(driver, 1);
	require('./createProject.js')(driver, 2);
	require('./createProject.js')(driver, 3);
	require('./listProjects.js')(driver);
});