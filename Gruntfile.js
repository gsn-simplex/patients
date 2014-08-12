module.exports = function(grunt) {
	grunt.initConfig({
		compass: {
			options: {
				basePath: 'app/webroot',
				relativeAssets: true,
				sassDir: 'sass',
				cssDir: 'css',
				imagesDir: 'img',
				javascriptsDir: 'js',
				fontsDir: 'fonts'
			},
			dev: {
				options: {
					debugInfo: false,
					outputStyle: 'expanded'
				}
			},
			production: {
				options: {
					debugInfo: false,
					outputStyle: 'compressed'
				}
			}
		},
		watch: {
			style: {
				files: 'app/webroot/sass/**/*.scss',
				tasks: ['compass:dev'],
				options: {
					livereload: true
				}
		    },
		    templates: {
		    	files: 'app/View/**/*.ctp',
				options: {
					livereload: true
				}	
		    },
		    controllers: {
		    	files: 'app/Controller/**/*.php',
				options: {
					livereload: true
				}	
		    }
		}
	});

	// Load the plugin that provides the "uglify" task.
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-compass');

	// Default task(s).
	grunt.registerTask('default', ['compass']);
	grunt.registerTask('compile', ['compass:production']);

};
