(function($){

	Craft.AceEditorFT = Garnish.Base.extend({
		editor: null,
		init: function(id, aceBasePath, settings)
		{
			var app = this;
			
			// Config
			this.id = id;
			this.settings = settings;
			
			// Ace
			ace.config.set("basePath", aceBasePath);
			app.editor = ace.edit(id+"-editor");
			app.editor.setOptions({
				showInvisibles: true,
				showPrintMargin: false,
				displayIndentGuides: true,
				enableEmmet: true,
				enableBasicAutocompletion: true,
				theme: "ace/theme/twilight"
			});
			
			// Mode switch
			app.getSelector("mode").on("change", function() {
				var mode = $(this).val();
				app.editor.session.setMode("ace/mode/"+mode);
				switch(mode) {
				case "html":
				case "coldfusion":
				case "css":
				case "less":
				case "scss":
					app.editor.setOptions({
						useSoftTabs: false,
						tabSize: 4
					});
					break;
				default:
					app.editor.setOptions({
						useSoftTabs: true,
						tabSize: 2
					});
				};
			}).trigger("change");
			
			// Record to hidden field
			app.editor.getSession().on('change', function(){
				var value = app.editor.getSession().getValue();
				app.getSelector("content").val(value);
			});
		},
		getSelector: function(field) {
			return $("#"+this.id+"-"+field);
		}
	});

})(jQuery);