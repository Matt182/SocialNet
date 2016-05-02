<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('make wrong login form submit action');
$I->amOnPage('/');
$I->dontSeeElement('.error');
$I->see('email');
$I->see('password');
$I->fillField('email', 'matt@mail.ru');
$I->fillField('password', 'qwe');
$I->click('login');
$I->seeElement('.error');
$I->see('Wrong password or login');
