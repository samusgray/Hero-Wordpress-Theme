module.exports = function(grunt) {

  // load all grunt tasks
  require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

  grunt.initConfig({

    sass: {
      dist: {
        options: {
          style: 'expanded',
          require: 'susy'
        },        
        files: {
          'style.css' : 'scss/style.scss'
        }
      }
    },
    watch: {
      css: {
        files: ['scss/**/*.scss','components/**/*.scss', 'components/*.scss'],
        tasks: 'sass',
      },
      /* watch and see if our javascript files change, or new packages are installed */
      scripts: {
        files: ['js/dev/*.js'],
        tasks: ['uglify'],
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

    copy: {
      scripts: {
        files: [{
          expand: true,
          cwd: 'js/dev',
          src: ['**'],
          dest: 'js'
        }]
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
  grunt.registerTask('scaff', 'scaffold');
  grunt.registerTask('js', 'uglify');
  grunt.registerTask('build', ['autoprefixer', 'copy:scripts', 'uglify']);
}