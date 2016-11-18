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

function getRowIndexIntoTable(selector, id, done, next) {
	driver.findElements(By.css(selector)).then(
		(array) => {
			array.forEach(function(elt, index) {
				elt.getText().then(
					(text) => {
						if(text == id)
							next(index);
						else if(index + 1 == array.length)
							done(new Error('Row with id = ' + id + ' not found into the table.'));
					},
					(err) => done(err)
				);
			});
		},
		(err) => done(err)
	);
}

function checkRow(selector, row, limit, done) {
	driver.findElements(By.css(selector)).then(
		(array) => {
			array.forEach(function(elt, index) {
				elt.getText().then(
					(text) => {
						if(index < limit)
							expect(text).to.be.eql(row[index]);
						if(index + 1 == array.length) done();
					},
					(err) => done(err)
				);
			});
		},
		(err) => done(err)
	);
}

module.exports = function(providedDriver, i) {
	i = i ? i : 1;
	var task = ['100' + i, 'task description', '', '5', i];
	var projectName;
	var sprintId;

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
					expect(text).to.be.eql('Backlog du projet : ' + projectName);
					done();
				},
				(err) => done(err)
			);
		});

		it('When I attempt to access to the sprint of the first user story', function(done) {
			driver.findElement(By.css('table > tbody > tr:nth-child(2) > td:nth-child(3) > a')).getText().then(
				(text) => {
					sprintId = text;
				},
				(err) => done(err)
			);
			driver.findElement(By.css('table > tbody > tr:nth-child(2) > td:nth-child(3) > a')).click().then(
				done,
				(err) => done(err)
			);
		});

		it('I must be redirected to the sprint details page', function(done) {
			driver.findElement(By.css('h1')).getText().then(
				(text) => {
					expect(text).to.be.eql("Sprint " + sprintId);
					done();
				},
				(err) => done(err)
			);
		});

		it('Then when I click on the button for create a task', function(done) {
			driver.findElement(By.css('button')).click().then(
				done,
				(err) => done(err)
			);
		});

		it('I must see a form containing an input for each task data', function(done) {
			driver.findElement(By.id('createDialog')).then(
				null,
				(err) => done(err)
			);
			async.forEach(['id', 'description', 'developerUsername', 'status', 'duration'], checkInputIsHere, done);
		});

		it('Then when I fill form inputs', function(done) {
			async.parallel([
				(stepDone) => fillTextInput('id', task[0], stepDone),
				(stepDone) => fillTextInput('description', task[1], stepDone),
				(stepDone) => fillTextInput('duration', task[3], stepDone),
				(stepDone) => fillTextInput('status', task[4] - 1, stepDone)
			], done);
		});

		it('And I submit form', function(done) {
			driver.findElement(By.css('#createDialog > form')).submit().then(
				done,
				(err) => done(err)
			);
		});

		it('I must see a success message', function(done) {
			driver.findElement(By.id('message')).getText().then(
				(text) => {
					expect(text).to.be.eql('The task has been created successfully.');
					done();
				},
				(err) => done(err)
			);
		});

		it('And I must see my new task into the table', function(done) {
			getRowIndexIntoTable('table > tbody > tr > td:nth-child(1)', task[0], done, function(index) {
				checkRow('table > tbody > tr:nth-child(' + (index + 1) + ') > td', task, 4, done);
			});
		});
	});
};