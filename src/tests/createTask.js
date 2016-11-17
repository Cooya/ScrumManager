var webdriver = require('selenium-webdriver');
var By = webdriver.By;
var until = webdriver.until;
var expect = require('chai').expect;
var async = require('async');
var driver;

module.exports = function(providedDriver, i) {
	i = i ? i : 1;
	var task = ['100' + i, 'task description', 100, i, 5];
	var projectName;

	describe('Create a task', function() {
		this.timeout(4000);

		if(!providedDriver) {
			before(function() {
				driver = new webdriver.Builder().forBrowser('chrome').build();
			});

			after(function() {
				driver.quit();
			});
		}
		else {
			before(function() {
				driver = providedDriver;
			});
		}

		it('When I go to the projects list and I click on the first project', function(done) {
			var css = 'table > tbody > tr:nth-child(2) > td:nth-child(1) > a';
			driver.get('http://localhost/projectList.php');
			driver.findElement(By.css(css)).getText().then(
				(text) => projectName = text,
				(err) => done(err)
			);
			driver.findElement(By.css(css)).click().then(
				done,
				(err) => done(err)
			);
		});

		it('I must touch down on the backlog project page', function(done) {
			driver.findElement(By.css('h2')).getText().then(
				(text) => {
					expect(text).to.be.eql('Backlog du projet ' + projectName);
					done();
				},
				(err) => done(err)
			);
		});

		it('When I attempt to access to the sprint of the first user story', function(done) {
			driver.findElement(By.css('table > tbody > tr:nth-child(2) > td:nth-child(3) > a')).click().then(
				done,
				(err) => done(err)
			);
		});

		it('', function(done) {
			
		});
	});
};