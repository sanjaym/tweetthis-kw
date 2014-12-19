(function() {
	tinymce.PluginManager.add('tweetthis', function( editor, url ) {
		var sh_tag = 'tweetthis';

		//define the Command for execution
		editor.addCommand('tweetthis_output', function(ui, v) {
				shortcode_str = '['+ sh_tag + ' alt="" hashtag="" url="" ]'+editor.selection.getContent()+'[/'+sh_tag+']';
				editor.insertContent(shortcode_str);
		});

		//add button
		editor.addButton('tweetthis', {
			icon: 'icon dashicons-twitter',
			tooltip: 'TweetThis!',
			onclick: function() {
				editor.execCommand('tweetthis_output');
			}
		});
	});
})();