module.exports = function(grunt) {

  // load all grunt tasks
  require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

  grunt.initConfig({

    compass: {
      dev: {
        options: {
          config: 'config.rb',
          force: true
        }
      }
    },

    watch: {
      sass: {
        files: ['scss/**/*.scss'],
        tasks: ['compass:dev']
      },
      /* watch and see if our javascript files change, or new packages are installed */
      // js: {
      //   files: ['assets/js/main.js', 'components/**/*.js'],
      //   tasks: ['uglify']
      // },
      /* watch our files for change, reload */
      livereload: {
        files: ['*.php', 'style.css', 'assets/images/*', 'assets/js/{main.min.js, plugins.min.js}'],
        options: {
          livereload: true
        }
      }
    },
  
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
  
  autoprefixer: {

    options: {
      // Task-specific options go here.
    },

    // just prefix the specified file
    single_file: {
      options: {
        // Target-specific options go here.
      },
      src: 'style.css',
      dest: 'style.css'
    }
  }
  
  });

  grunt.registerTask('default', 'watch');
  grunt.registerTask('check', ['autoprefixer', 'csscss']);

}