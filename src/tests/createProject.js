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

module.exports = function(providedDriver, i) {
	var project = {projectName: 'mocha_project', repositoryLink: 'mocha_github', ownerUsername: ''};

	if(i) {
		project.projectName += i;
		project.repositoryLink += i;
	}

	describe('Create a project', function() {
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
			driver = providedDriver;
			if(!providedDriver.projects)
				providedDriver.projects = [];
			providedDriver.projects.push(project);
		}

		it('When I go to the projects list page', function(done) {
			driver.get('http://localhost/projectList.php');
			driver.findElement(By.css('h1')).getText().then(
				(text) => {
					expect(text).to.be.eql('Projects List');
					done();
				}
			);
		});

		it('And I click on the button for create a project', function(done) {
			driver.findElement(By.css('button')).click().then(
				done,
				(err) => done(err)
			);
		});

		it('It must see a form with an input for each data', function(done) {
			async.forEach(Object.keys(project), checkInputIsHere, done);
		});

		it('Then when I fill form inputs', function(done) {
			async.parallel([
				(stepDone) => fillTextInput('projectName', project.projectName, stepDone),
				(stepDone) => fillTextInput('repositoryLink', project.repositoryLink, stepDone),
			], done);
		});

		it('And I submit form', function(done) {
			driver.findElement(By.css('#newProjectDialog > form')).submit().then(
				done,
				(err) => done(err)
			);
		});

		it('I must see a success message', function(done) {
			setTimeout(() => {
				driver.findElement(By.id('message')).getText().then(
					(text) => {
						expect(text).to.be.eql('The project "' + project.projectName + '" has been created successfully.');
						done();
					},
					(err) => done(err)
				);
			}, 500);
		});
	});
};