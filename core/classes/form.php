<?php

/**
 * This is our extended version of SpoonForm
 *
 * @package		site
 * @subpackage	core
 *
 * @author		Tijs Verkoyen <tijs@sumocoders.be>
 * @since		2.0
 */
class SiteForm extends SpoonForm
{
	/**
	 * Class constructor.
	 *
	 * @param	string $name				Name of the form.
	 * @param	string[optional] $action	The action (URL) whereto the form will be submitted, if not provided it will be generated.
	 * @param	string[optional] $method	The method to use when submitting the form, default is POST.
	 * @param	bool[optional] $useToken	Should we automagically add a form token?
	 */
	public function __construct($name, $action = null, $method = 'post', $useToken = false)
	{
		$action = ($action === null) ? '/' . trim((string) $_SERVER['REQUEST_URI'], '/') : (string) $action;
		parent::__construct($name, $action, $method, $useToken);
	}

	/**
	 * Adds a single button.
	 *
	 * @param string $name				The name of the button.
	 * @param string $value				The text that should appear on the button.
	 * @param string[optional] $type		The type of button.
	 * @param string[optional] $class		The CSS-class for the button.
	 * @return SpoonFormButton
	 */
	public function addButton($name, $value, $type = null, $class = 'inputButton btn')
	{
		$this->add(new SpoonFormButton($name, $value, $type, $class));
		return $this->getField($name);
	}

	/**
	 * Adds a image field.
	 *
	 * @return	SpoonFormImage
	 * @param	string $name					The name.
	 * @param	string[optional] $class			The CSS-class to be used.
	 * @param	string[optional] $classError	The CSS-class to be used when there is an error.
	 */
	public function addImage($name, $class = 'inputFile', $classError = 'inputFileError')
	{
		$this->add(new SiteFormImage($name, $class, $classError));
		return $this->getField($name);
	}

	/**
	 * Generates an example template, based on the elements already added.
	 *
	 * @return string
	 */
	public function getTemplateExample()
	{
		$fields = $this->getFields();
		unset($fields['_utf8']);

		// start form
		$value = "\n";
		$value .= '{form:' . $this->getName() . "}\n";
		$value .= '	<div class="form-horizontal">' . "\n";

		/**
		 * At first all the hidden fields need to be added to this form, since
		 * they're not shown and are best to be put right beneath the start of the form tag.
		 */
		foreach($fields as $object)
		{
			// is a hidden field
			if(($object instanceof SpoonFormHidden) && $object->getName() != 'form')
			{
				$value .= "\t" . '{$hid' . str_replace('[]', '', SpoonFilter::toCamelCase($object->getName())) . "}\n";
			}
		}

		/**
		 * Add all the objects that are NOT hidden fields. Based on the existence of some methods
		 * errors will or will not be shown.
		 */
		foreach($fields as $object)
		{
			// NOT a hidden field
			if(!($object instanceof SpoonFormHidden))
			{
				$name = str_replace('[]', '', SpoonFilter::toCamelCase($object->getName()));

				// buttons
				if($object instanceof SpoonFormButton)
				{
					$value .= '		<div class="control-group">' . "\n";
					$value .= '			<div class="controls">' . "\n";
					$value .= '				{$btn' . $name . '}' . "\n";
					$value .= '			</div>' . "\n";
					$value .= '		</div>' . "\n";
				}

				// single checkboxes
				elseif($object instanceof SpoonFormCheckbox)
				{
					$value .= '		<div class="control-group{option:chk' . $name . 'Error} error{/option:chk' . $name . 'Error}">' . "\n";
					$value .= '			<div class="controls">' . "\n";
					$value .= '				<label for="' . $object->getAttribute('id') . '" class="checkbox">{$chk' . $name . '} ' . $name . '</label> {$chk' . $name . 'Error}' . "\n";
					$value .= '			</div>' . "\n";
					$value .= '		</div>' . "\n";
				}

				// multi checkboxes
				elseif($object instanceof SpoonFormMultiCheckbox)
				{
					$value .= '		<div class="control-group{option:chk' . $name . 'Error} error{/option:chk' . $name . 'Error}">' . "\n";
					$value .= '			<label class="control-label">' . $name . '</label>' . "\n";
					$value .= '			<div class="controls">' . "\n";
					$value .= '				{iteration:' . $object->getName() . '}' . "\n";
					$value .= '					<label for="{$' . $object->getName() . '.id}" class="checkbox">{$' . $object->getName() . '.chk' . $name . '} {$' . $object->getName() . '.label}</label>' . "\n";
					$value .= '				{/iteration:' . $object->getName() . '}' . "\n";
					$value .= '				{$chk' . $name . 'Error}' . "\n";
					$value .= '			</div>' . "\n";
					$value .= '		</div>' . "\n";
				}

				// dropdowns
				elseif($object instanceof SpoonFormDropdown)
				{
					$value .= '		<div class="control-group{option:ddm' . $name . 'Error} error{/option:ddm' . $name . 'Error}">' . "\n";
					$value .= '			<label for="' . $object->getAttribute('id') . '" class="control-label">' . $name;
					if(in_array('required', array_keys($object->getAttributes())));
					{
						$value .= '<abbr title="{$msgRequired}">*</abbr>';
					}
					$value .= '</label>' . "\n";
					$value .= '			<div class="controls">' . "\n";
					$value .= '				{$ddm' . $name . '} {$ddm' . $name . 'Error}' . "\n";
					$value .= '			</div>' . "\n";
					$value .= '		</div>' . "\n";
				}

				// filefields
				elseif($object instanceof SpoonFormFile)
				{
					$value .= '		<div class="control-group{option:file' . $name . 'Error} error{/option:file' . $name . 'Error}">' . "\n";
					$value .= '			<label for="' . $object->getAttribute('id') . '" class="control-label">' . $name;
					if(in_array('required', array_keys($object->getAttributes())));
					{
						$value .= '<abbr title="{$msgRequired}">*</abbr>';
					}
					$value .= '</label>' . "\n";
					$value .= '			<div class="controls">' . "\n";
					$value .= '				{$file' . $name . '} {$file' . $name . 'Error}' . "\n";
					$value .= '			</div>' . "\n";
					$value .= '		</div>' . "\n";
				}

				// radiobuttons
				elseif($object instanceof SpoonFormRadiobutton)
				{
					$value .= '		<div class="control-group{option:rbt' . $name . 'Error} error{/option:rbt' . $name . 'Error}">' . "\n";
					$value .= '			<label class="control-label">' . $name . '</label>' . "\n";
					$value .= '			<div class="controls">' . "\n";
					$value .= '				{iteration:' . $object->getName() . '}' . "\n";
					$value .= '					<label for="{$' . $object->getName() . '.id}">{$' . $object->getName() . '.rbt' . $name . '} {$' . $object->getName() . '.label}</label>' . "\n";
					$value .= '				{/iteration:' . $object->getName() . '}' . "\n";
					$value .= '				{$rbt' . $name . 'Error}' . "\n";
					$value .= '			</div>' . "\n";
					$value .= '		</div>' . "\n";
				}

				// textfields
				elseif(($object instanceof SpoonFormDate) || ($object instanceof SpoonFormPassword) || ($object instanceof SpoonFormTextarea) || ($object instanceof SpoonFormText) || ($object instanceof SpoonFormTime))
				{
					$value .= '		<div class="control-group{option:txt' . $name . 'Error} error{/option:txt' . $name . 'Error}">' . "\n";
					$value .= '			<label for="' . $object->getAttribute('id') . '" class="control-label">' . $name;
					if(in_array('required', array_keys($object->getAttributes())));
					{
						$value .= '<abbr title="{$msgRequired}">*</abbr>';
					}
					$value .= '</label>' . "\n";
					$value .= '			<div class="controls">' . "\n";
					$value .= '				{$txt' . $name . '} {$txt' . $name . 'Error}' . "\n";
					$value .= '			</div>' . "\n";
					$value .= '		</div>' . "\n";
				}
			}
		}

		// close form tag
		$value .= '	</div>' . "\n";
		$value .= '{/form:' . $this->getName() . '}';

		return $value;
	}

	/**
	 * Parse this form in the given template.
	 *
	 * @param	SpoonTemplate $template		The template to parse the form in.
	 */
	public function parse(SpoonTemplate $template)
	{
		parent::parse($template);

		if(!$this->isCorrect(true)) {
			$template->assign('formHasError', true);
		}

	}
}

/**
 * This is our extended version of SpoonFormImage
 *
 * @author Tijs Verkoyen <tijs@sumocoders.be>
 */
class SiteFormImage extends SpoonFormImage
{
	/**
	 * Generate thumbnails based on the folders in the path
	 * Use
	 *  - 128x128 as folder name to generate an image that where the width will be 128px and the height will be 128px
	 *  - 128x as folder name to generate an image that where the width will be 128px, the height will be calculated based on the aspect ratio.
	 *  - x128 as folder name to generate an image that where the width will be 128px, the height will be calculated based on the aspect ratio.
	 *
	 * @param string $path
	 * @param string $filename
	 */
	public function generateThumbnails($path, $filename)
	{
		// create folder if needed
		if(!SpoonDirectory::exists($path . '/source')) SpoonDirectory::create($path . '/source');

		// move the source file
		$this->moveFile($path . '/source/' . $filename);

		// generate the thumbnails
		Site::generateThumbnails($path, $path . '/source/' . $filename);
	}

	/**
	 * This function will return the errors. It is extended so we can do image checks automatically.
	 *
	 * @return string
	 */
	public function getErrors()
	{
		// do an image validation
		if($this->isFilled())
		{
			$this->isAllowedExtension(array('jpg', 'jpeg', 'gif', 'png'), SiteLocale::err('JPGGIFAndPNGOnly'));
			$this->isAllowedMimeType(array('image/jpeg', 'image/gif', 'image/png'), SiteLocale::err('JPGGIFAndPNGOnly'));
		}

		return $this->errors;
	}
}
