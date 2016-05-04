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
$I->seeInCurrentUrl('/profile/3');
$I->dontSeeElement('.error');
$I->SeeElement('#home');
$I->SeeElement('#friends');
$I->SeeElement('#members');
$I->SeeElement('#logout');
$I->see('online');
$I->see('matt2');

$I->wantTo('look at members page');
$I->click('#members');
$I->seeInCurrentUrl('members');
$I->see('matt');
$I->see('matt2');
$I->see('matt3');
$I->see('matt4');

$I->wantTo('get back to my profile page');
$I->click('#home');

$I->wantTo('look at my friends page');
$I->click('#friends');
$I->seeInCurrentUrl('friends');
$I->see('matt');
$I->see('matt4');
$I->dontSee('matt2');
$I->dontSee('matt3');

$I->wantTo('logout');
$I->click('#logout');
$I->seeInCurrentUrl('login');
