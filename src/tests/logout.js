var webdriver = require('selenium-webdriver');
var By = webdriver.By;
var until = webdriver.until;
var expect = require('chai').expect;
var async = require('async');
var driver;

module.exports = function(providedDriver) {
	describe('Log out', function() {
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

		it('When I go to the logout page', function(done) {
			driver.get('http://localhost/logout.php').then(
				done,
				(err) => done(err)
			);
		});

		it('I must see the logout message', function(done) {
			driver.findElement(By.css('body')).getText().then(
				(text) => {
					expect(text).to.be.eql('You have been logged out, click here to return to home page.');
					done();
				}
			);
		});

		it('Then when I go back to the home page', function(done) {
			driver.get('http://localhost/logout.php');
			driver.findElement(By.css('a')).click().then(
				done,
				(err) => done(err)
			);
		});

		it('I must see the login button', function(done) {
			setTimeout(() => {
				driver.findElement(By.css('a')).getText().then(
					(text) => {
						expect(text).to.be.eql("Login");
						done();
					},
					(err) => done(err)
				);
			}, 500);
		});
	});
};