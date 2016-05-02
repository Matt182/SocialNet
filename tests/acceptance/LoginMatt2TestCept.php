<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('make matt2 login form submit action');
$I->amOnPage('/');
$I->dontSeeElement('.error');
$I->see('email');
$I->see('password');
$I->fillField('email', 'matt2@mail.ru');
$I->fillField('password', 'matt2');
$I->click('login');
$I->dontSeeElement('.error');
$I->see('online');
$I->see('matt2');
$I->click('#logout');
