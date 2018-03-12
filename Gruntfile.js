module.exports = function( grunt ) {

	'use strict';
	var banner = '/**\n * <%= pkg.homepage %>\n * Copyright (c) <%= grunt.template.today("yyyy") %>\n * This file is generated automatically. Do not edit.\n */\n';
	// Project configuration
	grunt.initConfig( {

		pkg: grunt.file.readJSON( 'package.json' ),

		wp_readme_to_markdown: {
			your_target: {
				files: {
					'README.md': 'readme.txt'
				}
			},
		},

                makepot: {
			target: {
				options: {
					domainPath: '/languages',
					mainFile: '',
					potFilename: 'fr_CA.pot',
					exclude: ['library/plugins/tgmpa/class-tgm-plugin-activation.php'],
					potHeaders: {
                                            'Last-Translator': '\n',
                                            'Language-Team': '\n',
                                            'x-poedit-keywordslist': true,
                                            'language': 'fr_CA',
                                            'plural-forms': 'nplurals=2; plural=(n != 1);',
                                            'x-poedit-country': 'Canada',
                                            'x-poedit-sourcecharset': 'UTF-8',
                                            'x-poedit-basepath': '../',
                                            'x-poedit-searchpath-0': '.',
                                            'x-poedit-bookmarks': '',
                                            'x-textdomain-support': 'yes'
					},
					type: 'wp-theme',
					updateTimestamp: true,
                                        updatePoFiles: false  /* bug msgmerge, utiliser outils catalogue poedit. */
				}
			}
		},
	} );

	grunt.loadNpmTasks( 'grunt-wp-i18n' );
	grunt.loadNpmTasks( 'grunt-wp-readme-to-markdown' );
	grunt.registerTask( 'i18n', ['makepot'] );
	grunt.registerTask( 'readme', ['wp_readme_to_markdown'] );

	grunt.util.linefeed = '\n';
};
