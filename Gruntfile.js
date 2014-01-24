module.exports = function(grunt) {

  // load all grunt tasks
  require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

  grunt.initConfig({

    // Use Compass and obey the config file.
    compass: {
      dev: {
        options: {
          config: 'config.rb',
          force: true
        }
      }
    },

    // Live Reload our Sass files
    watch: {
      sass: {
        files: ['scss/**/*.scss','components/**/*.scss', 'components/*.scss'],
        tasks: ['compass:dev']
      },
      /* watch and see if our javascript files change, or new packages are installed */
      scripts: {
        files: ['js/dev/*.js'],
        tasks: ['copy:scripts', 'uglify'],
        options: {
          livereload: true
        }
      },
      /* watch our files for change, reload */
      livereload: {
        files: ['*.php', 'style.css', 'assets/images/*', 'assets/js/{main.min.js, plugins.min.js}'],
        options: {
          livereload: true
        }
      }
    },
  
    uglify: {
      options: {
        mangle: false
      },
      my_target: {
        files: {
          'js/functions.ck.js': ['js/dev/functions.js']
        }
      }
    },

    // Confirm we are not writing redundant CSS
    csscss: {
      options: {
        compass: true,
        require: 'config.rb',
        verbose: true
      },
      dist: {
        src: ['style.css']
      }
    },
    
    // Add vendor prefixes to our CSS
    autoprefixer: {

      options: {
        browsers: ['last 2 version', 'ie 8', 'ie 7']
      },

      // just prefix the specified file
      single_file: {
        options: {
          // Target-specific options go here.
        },
        src: 'style.css',
        dest: 'style.css'
      }
    },

    // Compress our CSS, please.
    csso: {
      dist: {
        files: {
          'style.css': ['style.css']
        }
      }
    },
    
    scaffold: {
        component: {
            options: {
                questions: [{
                    name: 'name',
                    type: 'input',
                    message: 'Component name:'
                }],
                template: {
                    "components/ck_skeleton.php": "components/{{name}}/_{{name}}.php",
                    "components/ck_skeleton.scss": "components/{{name}}/_{{name}}.scss"                    
                }
            }
        }
    }
  });

  grunt.registerTask('default', 'watch');
  grunt.registerTask('check', ['autoprefixer', 'uglify']);
  grunt.registerTask('js', ['uglify']);
  grunt.registerTask('scaff', ['scaffold']);

}