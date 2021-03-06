<?php

/**
 * UsersAdd
 *
 * @package		users
 * @subpackage	add
 *
 * @author 		Tijs Verkoyen <tijs@sumocoders.be>
 * @since		1.0
 */
class UsersAdd extends SiteBaseAction
{
	/**
	 * The form
	 *
	 * @var	SiteForm
	 */
	private $frm;


	/**
	 * Execute the action
	 */
	public function execute()
	{
		// check if admin
		if(!$this->currentUser->isAdmin())
		{
			Site::displayError('Forbidden', 403);
		}

		$this->loadForm();
		$this->validateForm();
		$this->frm->parse($this->tpl);
		$this->display();
	}

	/**
	 * Load the form
	 */
	private function loadForm()
	{
		// create form
		$this->frm = new SiteForm('add');

		// create elements
		$this->frm->addText('email')->setAttributes(array('type' => 'email', 'required' => null));
		$this->frm->addText('name')->setAttributes(array('required' => null));
		$this->frm->addPassword('password')->setAttributes(array('autocomplete' => 'off', 'required' => null));
		$this->frm->addDropdown('type', array('user' => 'user', 'admin' => 'admin'), 'user');
	}

	/**
	 * Validate the form
	 */
	private function validateForm()
	{
		// submitted?
		if($this->frm->isSubmitted())
		{
			// validate required fields
			$this->frm->getField('email')->isEmail(SiteLocale::err('EmailIsInvalid'));
			$this->frm->getField('name')->isFilled(SiteLocale::err('FieldIsRequired'));
			$this->frm->getField('password')->isFilled(SiteLocale::err('FieldIsRequired'));

			// no errors?
			if($this->frm->isCorrect())
			{
				// create new user
				$item = new User();

				// set properties
				$item->setName($this->frm->getField('name')->getValue());
				$item->setEmail($this->frm->getField('email')->getValue());
				$item->setType($this->frm->getField('type')->getValue());
				$item->setSecret(md5(uniqid()));
				$item->setRawPassword($this->frm->getField('password')->getValue());

				// save
				$item->save();

				// redirect
				$this->redirect(
					$this->url->buildUrl(
						'index', null, null,
						array('report' => 'added', 'var' => $item->getName(), 'id' => $item->getId())
					)
				);
			}
		}
	}
}
