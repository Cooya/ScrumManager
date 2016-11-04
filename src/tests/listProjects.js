var webdriver = require('selenium-webdriver');
var By = webdriver.By;
var until = webdriver.until;
var expect = require('chai').expect;
var async = require('async');
var driver;

module.exports = function(providedDriver) {
	describe('List projects', function() {
		this.timeout(4000);

		if(!providedDriver || ! providedDriver.projectFields) {
			console.err("Projects must be created before being listed.");
			return;
		}
		else {
			driver = providedDriver;
		}

		it('When I go to the projects list page', function(done) {
			driver.get('http://localhost/projectListPage.php');
			driver.findElement(By.tagName('h1')).getText().then(
				(text) => {
					expect(text).to.be.eql('Projects List');
					done();
				}
			);
		});

		it('It must have a array row for each created project', function(done) {
			done();
		});
	});
};