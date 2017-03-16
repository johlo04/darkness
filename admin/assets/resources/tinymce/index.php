<!doctype html>
<html>
<head></head>
<script src="tinymce/tinymce.min.js"></script>
<body>

	<textarea id="textarea1">
	  <p style="text-align: center;">
		<img title="TinyMCE Logo" src="//www.tinymce.com/images/glyph-tinymce@2x.png" alt="TinyMCE Logo" width="110" height="97" />
	  </p>

	  <h1 style="text-align: center;">Welcome to the TinyMCE editor demo!</h1>

	  <p>
		Please try out the features provided in this basic example.<br>
		Note that any <strong>MoxieManager</strong> file and image management functionality in this example is part of our commercial offering – the demo is to show the integration.
	  </p>

	  <h2>Got questions or need help?</h2>

	  <ul>
		<li>Our <a href="http://www.tinymce.com/docs/">documentation</a> is a great resource for learning how to configure TinyMCE.</li>
		<li>Have a specific question? Visit the <a href="http://community.tinymce.com/forum/">Community Forum</a>.</li>
		<li>We also offer enterprise grade support as part of <a href="www.tinymce.com/pricing">TinyMCE Enterprise</a>.</li>
	  </ul>

	  <h2>A simple table to play with</h2>

	  <table style="text-align: center;">
		<thead>
		  <tr>
			<th>Product</th>
			<th>Cost</th>
			<th>Really?</th>
		  </tr>
		</thead>
		<tbody>
		  <tr>
			<td>TinyMCE</td>
			<td>Free</td>
			<td>YES!</td>
		  </tr>
		  <tr>
			<td>Plupload</td>
			<td>Free</td>
			<td>YES!</td>
		  </tr>
		</tbody>
	  </table>

	  <h2>Found a bug?</h2>

	  <p>
		If you think you have found a bug please create an issue on the <a href="https://github.com/tinymce/tinymce/issues">GitHub repo</a> to report it to the developers.
	  </p>

	  <h2>Finally ...</h2>

	  <p>
		Don't forget to check out our other product <a href="http://www.plupload.com" target="_blank">Plupload</a>, your ultimate upload solution featuring HTML5 upload support.
	  </p>
	  <p>
		Thanks for supporting TinyMCE! We hope it helps you and your users create great content.<br>All the best from the TinyMCE team.
	  </p>
	</textarea>
	<textarea id="textarea2">TEST ONLY</textarea>
</body>

	<script>
		tinymce.init({
		selector: "textarea",theme: "modern",width: 700,height: 300,
		plugins: [
		"advlist autolink link image lists charmap print preview hr pagebreak",
		"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
		"table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
		],
		toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
		toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
		image_advtab: true ,
		external_filemanager_path:"/tinymce/filemanager/", //change this
		filemanager_title:"Responsive Filemanager" ,
		external_plugins: { "filemanager" : "/tinymce/filemanager/plugin.min.js"}, //change this
		remove_script_host: false,
		relative_urls: false,
		
		content_css: [
		'//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css', //dont use this
		'//www.tinymce.com/css/codepen.min.css'
		]
		});	
	</script>

</html>

