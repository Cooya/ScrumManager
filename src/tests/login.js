var webdriver = require('selenium-webdriver');
var By = webdriver.By;
var until = webdriver.until;
var expect = require('chai').expect;
var async = require('async');
var driver;

function checkInputIsHere(inputName, next) {
	driver.findElement(By.name(inputName)).then(
		() => next(),
		() => next(new Error(inputName + ' not found.'))
	);
}

function fillTextInput(inputName, text, callback) {
	driver.findElement(By.name(inputName)).sendKeys(text).then(
		callback,
		(err) => callback(err)
	);
}

module.exports = function(providedDriver) {
	describe('Log in', function() {
		this.timeout(10000);

		if(!providedDriver) {
			before(function() {
				driver = new webdriver.Builder().forBrowser('chrome').build();
			});

			after(function() {
				driver.quit();
			});
		}
		else
			before(function() {
				driver = providedDriver;
			});

		it('When I go to the login page', function(done) {
			driver.get('http://localhost/login.php').then(
				done,
				(err) => done(err)
			);
		});

		it('It must have a input for each data', function(done) {
			async.forEach(['login', 'password'], checkInputIsHere, done);
		});

		it('Then when I fill form inputs', function(done) {
			async.parallel([
				(stepDone) => fillTextInput('login', 'mocha_test', stepDone),
				(stepDone) => fillTextInput('password', 'mocha_test', stepDone),
			], done);
		});

		it('And I submit form', function(done) {
			driver.sleep(1000);
			driver.findElement(By.id('submit')).submit().then(
				done,
				(err) => done(err)
			);
		});

		it('I must be redirected on the project list page', function(done) {
			driver.sleep(1000);
			driver.getCurrentUrl().then(
				(text) => {
					expect(text).to.be.eql("http://localhost/projectList.php");
					done();
				},
				(err) => done(err)
			);
		});
	});
};