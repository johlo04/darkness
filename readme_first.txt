1. Update the ci config and database based on your setting.
2. Update the constant file for uploader plugin.
3. make sure folder for uploading set to 777 or 755
4. Update the script.js for tiny mce
	\assets\js\script.js
		You can update the ff.
		> external_filemanager_path
		> external_plugins
	
5. Update 'upload_dir' in this page:
   \assets\resources\tinymce\filemanager\config\config.php
	   You can update the ff.
	   > upload_dir
	   > current_path
	   > thumbs_base_path
6. on system page use: (for installation only for tinymce bug on image url)
	Data Content Fixer (Tinymce:)
		choose all available [select] table
		on the first input if your using a local url: ex. http://localhost/testSite
		on the second input input the new domain name: ex. http://testSite.com
		