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
		this.timeout(8000);

		if(!providedDriver) {
			before(function() {
				driver = new webdriver.Builder().forBrowser('chrome').build();
			});

			after(function() {
				driver.quit();
			});
		}
		else {
			driver = providedDriver;
		}

		it('When I go to the login page', function(done) {
			driver.get('http://localhost/loginPage.php').then(
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
			driver.findElement(By.id('submit')).submit().then(
				done,
				(err) => done(err)
			);
		});

		it('I must see a success message', function(done) {
			setTimeout(() => {
				driver.findElement(By.tagName('p')).getText().then(
					(text) => {
						expect(text).to.be.eql("Hi mocha_test ! You are now connected. Click here to browse your list of projects.");
						done();
					},
					(err) => done(err)
				);
			}, 500);
		});
	});
};