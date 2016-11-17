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

function getUSRowIndexIntoTable(id, done, next) {
	driver.findElements(By.css('table > tbody > tr > td:nth-child(1)')).then(
		(array) => {
			array.forEach(function(elt, index) {
				elt.getText().then(
					(text) => {
						if(text == id)
							next(index);
						else if(index + 1 == array.length)
							done(new Error('User story with id = ' + id + ' not found into the table.'));
					},
					(err) => done(err)
				);
			});
		},
		(err) => done(err)
	);
}

function checkUSRow(US, index, done) {
	driver.findElements(By.css('table > tbody > tr > td:nth-child(' + (index + 1) + ') > tr')).then(
		(array) => {
			array.forEach(function(elt, index) {
				elt.getText.then(
					(text) => {
						expect(text).to.be.eql(US[index]);
						if(index + 1 == array.length) done();
					}
				),
				(err) => done(err);
			});
		},
		(err) => done(err)
	);
}

module.exports = function(providedDriver, i) {
	i = i ? i : 1;
	var US = ['100' + i, 'user story description', i, 10, 5, 'Modify'];
	var projectName;

	describe('Create a user story', function() {
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

		it('When I click on the US creation button', function(done) {
			driver.findElement(By.id('createUS')).click().then(
				done,
				(err) => done(err)
			);
		});

		it('I must see a form containing an input for each US data', function(done) {
			driver.findElement(By.id('createDialog')).then(
				null,
				(err) => done(err)
			);
			async.forEach(['id', 'description', 'sprint', 'cost', 'priority'], checkInputIsHere, done);
		});

		it('Then when I fill form inputs', function(done) {
			async.parallel([
				(stepDone) => fillTextInput('id', US[0], stepDone),
				(stepDone) => fillTextInput('description', US[1], stepDone),
				(stepDone) => fillTextInput('sprint', US[2], stepDone),
				(stepDone) => fillTextInput('cost', US[3], stepDone),
				(stepDone) => fillTextInput('priority', US[4], stepDone)
			], done);
		});

		it('And I submit form', function(done) {
			driver.findElement(By.css('#createDialog > form')).submit().then(
				done,
				(err) => done(err)
			);
		});

		it('I must not see a failure message', function(done) {
			driver.findElement(By.id('message')).getText().then(
				(text) => {
					expect(text).to.be.eql('');
					done();
				},
				(err) => done(err)
			);
		});

		it('And I must see my new US into the table', function(done) {
			getUSRowIndexIntoTable(US[0], done, function(index) {
				checkUSRow(US, index, done);
			});
		});
	});
};