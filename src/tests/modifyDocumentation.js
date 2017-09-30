var webdriver = require('selenium-webdriver');
var By = webdriver.By;
var until = webdriver.until;
var expect = require('chai').expect;
var async = require('async');
var driver;

module.exports = function(providedDriver) {
	describe('Modify project documentation', function() {
		this.timeout(10000);
		var projectName;

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

		it('When I go to the projects list page', function(done) {
			driver.get('http://localhost/projectList.php');
			driver.findElement(By.css('h1')).getText().then(
				(text) => {
					expect(text).to.be.eql('Projects List');
					done();
				},
				(err) => done(err)
			);
		});

		it('It must have an array containing at least one project', function(done) {
			driver.findElement(By.css('table > tbody > tr:nth-child(2) > td:nth-child(1)')).getText().then(
				(text) => {
					projectName = text;
					done();
				},
				(err) => done(err)
			);
		});

		it('When I go to the backlog of the first project', function(done) {
			driver.findElement(By.css('table > tbody:nth-child(1) > tr:nth-child(2) > td > a')).click().then(
				done,
				(err) => done(err)
			);
		});

		it('I must see a button for modify the documentation', function(done) {
			driver.findElement(By.css('body > button:nth-child(6)')).click().then(
				done,
				(err) => done(err)
			);
		});

		it('When I click on it, I must touch down on the backlog project page', function(done) {
			driver.findElement(By.css('h1')).getText().then(
				(text) => {
					expect(text).to.be.eql("Consult and modify documentation of " + projectName);
					done();
				},
				(err) => done(err)
			);
		});

		it('Then when I modify the documentation', function(done) {
			driver.findElement(By.css('textarea')).sendKeys("documentation mocha test").then(
				null,
				(err) => done(err)
			);
			driver.findElement(By.css('input')).click().then(
				done,
				(err) => done(err)
			);
		});

		it('I must see a success message', function(done) {
			driver.sleep(1000);
			driver.findElement(By.id('message')).getText().then(
				(text) => {
					expect(text).to.be.eql("The documentation has been modified successfully.");
					done();
				},
				(err) => done(err)
			);
		});

		it('And see my documentation text into the textarea', function(done) {
			driver.sleep(1000);
			driver.findElement(By.css('textarea')).getText().then(
				(text) => {
					expect(text).to.be.eql("documentation mocha test");
					done();
				},
				(err) => done(err)
			);
		});
	});
};