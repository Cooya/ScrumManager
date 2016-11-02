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
	describe('Create a project', function() {
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

		it('When I go to the project creation page', function(done) {
			driver.get('http://localhost/newProjectPage.php');
			driver.findElement(By.tagName('h1')).getText().then(
				(text) => {
					expect(text).to.be.eql('Create a new project');
					done();
				}
			);
		});

		it('It must have a input for each data', function(done) {
			async.forEach(['name', 'link'], checkInputIsHere, done);
		});

		it('Then when I fill form inputs', function(done) {
			async.parallel([
				(stepDone) => fillTextInput('name', 'mocha_project', stepDone),
				(stepDone) => fillTextInput('link', 'mocha_github', stepDone),
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
						expect(text).to.be.eql("The project has been created successfully.");
						done();
					},
					(err) => done(err)
				);
			}, 500);
		});
	});
};