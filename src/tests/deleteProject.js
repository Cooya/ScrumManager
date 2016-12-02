var webdriver = require('selenium-webdriver');
var By = webdriver.By;
var until = webdriver.until;
var expect = require('chai').expect;
var async = require('async');
var driver;

module.exports = function(providedDriver) {
	describe('Delete one project', function() {
		this.timeout(4000);
		var projectName;

		before(function() {
			if(!providedDriver) {
				console.err("Projects must be created before being deleted.");
				return;
			}
			else
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

		it('When I remove the first project', function(done) {
			driver.findElement(By.css('table > tbody > tr:nth-child(2) > td:nth-child(10) > img')).click().then(
				null,
				(err) => done(err)
			);
			driver.findElement(By.css('div.ui-dialog:nth-child(12) > div:nth-child(3) > div:nth-child(1) > button:nth-child(1)')).click().then(
				done,
				(err) => done(err)
			);
		});

		it('I must see a success message', function(done) {
			setTimeout(() => {
				driver.findElement(By.id('message')).getText().then(
					(text) => {
						expect(text).to.be.eql('The project has been deleted successfully.');
						done();
					},
					(err) => done(err)
				);
			}, 500);
		});

		it('And the project removed from the array', function(done) {
			driver.findElement(By.css('table > tbody > tr:nth-child(2) > td:nth-child(1)')).getText().then(
				(text) => {
					expect(text).to.not.be.eql(projectName);
					done();
				},
				(err) => done(err)
			);
		});
	});
};