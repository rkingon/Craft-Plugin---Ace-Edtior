<?php

namespace Craft;

class AceEditorFieldType extends BaseFieldType
{
	public function getName()
	{
		return Craft::t('Ace Editor');
	}
	
	public function defineContentAttribute()
	{
		return array(AttributeType::Mixed);
	}
	
	protected function defineSettings()
	{
		return array(
			'mode' => AttributeType::String,
			'theme' => AttributeType::String
		);
	}
	
	public function getSettingsHtml()
	{
		return craft()->templates->render('aceeditor/_fieldtype/settings', array(
			'settings' => $this->getSettings()
		));
	}

	public function getInputHtml($name, $value)
	{
		// Settings
		$settings = $this->getSettings();
		$aceBasePath = UrlHelper::getResourceUrl('aceeditor/vendor/ace/');
		$inputId = craft()->templates->formatInputId($name);
		
		// Data
		$data = include(CRAFT_PLUGINS_PATH . 'aceeditor/data/AceEditorData.php');
		
		// Resources
		craft()->templates->includeCssResource('aceeditor/stylesheets/editor.css');
		craft()->templates->includeJsFile('https://cloud9ide.github.io/emmet-core/emmet.js');
		craft()->templates->includeJsResource('aceeditor/vendor/ace/ace.js');
		craft()->templates->includeJsResource('aceeditor/vendor/ace/theme-twilight.js');
		craft()->templates->includeJsResource('aceeditor/vendor/ace/ext-emmet.js');
		craft()->templates->includeJsResource('aceeditor/vendor/ace/ext-language_tools.js');
		craft()->templates->includeJsResource('aceeditor/javascripts/editor.js');
		craft()->templates->includeJs('new Craft.AceEditorFT("'.craft()->templates->namespaceInputId($inputId).'","'.$aceBasePath.'",'.JsonHelper::encode($settings).');');
		
		// Template
		return craft()->templates->render('aceeditor/_fieldtype/index', array(
			"name" => $name,
			"id" => $inputId,
			"value" => $value,
			"settings" => $settings,
			"modes" => $data['modes']
		));
	}
	
	public function prepValueFromPost($value)
	{
		return $value;
	}
	
	public function prepValue($value)
	{
		return $value;
	}
}