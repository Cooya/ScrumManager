var webdriver = require('selenium-webdriver');
var By = webdriver.By;
var until = webdriver.until;
var expect = require('chai').expect;
var async = require('async');
var driver;

function checkProjectName(project, next) {
	var css = 'table > tbody > tr:nth-child(' + (project.pos + 1) + ') > td:nth-child(1)';
	driver.findElement(By.css(css)).getText().then(
		(text) => {
			expect(text).to.be.eql(project.projectName);
			next();
		},
		() => {
			next(new Error('Project "' + project.projectName + '" not found into the projects list.'));
		}
	);
}

function checkProjectLink(project, next) {
	var css = 'table > tbody > tr:nth-child(' + (project.pos + 1) + ') > td:nth-child(6)';
	driver.findElement(By.css(css)).getText().then(
		(text) => {
			expect(text).to.be.eql(project.repositoryLink);
			next();
		},
		() => {
			next(new Error('Project link"' + project.repositoryLink + '" not found into the projects list.'));
		}
	);
}

module.exports = function(providedDriver) {
	describe('List projects', function() {
		this.timeout(4000);

		before(function() {
			if(!providedDriver || ! providedDriver.projects) {
				console.err("Projects must be created before being listed.");
				return;
			}
			else {
				driver = providedDriver;
				var i = 1;
				providedDriver.projects.forEach(function(elt) {
					elt.pos = i++;
				});
			}
		});

		it('When I go to the projects list page', function(done) {
			driver.get('http://localhost/projectList.php');
			driver.findElement(By.css('h1')).getText().then(
				(text) => {
					expect(text).to.be.eql('Projects List');
					done();
				}
			);
		});

		it('It must have an array cell containing the name of each created project', function(done) {
			async.forEach(providedDriver.projects, checkProjectName, done);
		});

		it('It must have an array cell containing the repository link of each created project', function(done) {
			async.forEach(providedDriver.projects, checkProjectLink, done);
		});
	});
};