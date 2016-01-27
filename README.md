# Ace Editor for Craft CMS


## Installation

To install Icons, follow these steps:

1.  Upload the aceeditor/ folder to your craft/plugins/ folder.
2.  Go to Settings -> Plugins from your Craft control panel and install the Ace Editor plugin.

## Usage

Get the icon object, check it and use:

	{% set icon = entry.yourIconFieldHandle %}
	{% if icon %}
	  {{ icon.icon }}
	{% endif %}
	
Output the full icon tag:

	{{ icon.icon }} = <i class="fa fa-home"></i>
	
Just output the icon class:

	{{ icon.class }} = fa-home
	
