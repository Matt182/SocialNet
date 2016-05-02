<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('make empty login form submit action');
$I->amOnPage('/');
$I->dontSeeElement('.error');
$I->see('email');
$I->see('password');
$I->click('login');
$I->seeElement('.error');
$I->see('Please enter data');
