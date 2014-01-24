/*
* grunt-scaffold
* https://github.com/crudo/grunt-scaffold
*
* Copyright (c) crudo <crudo@crudo.cz>
* Licensed under the MIT license.
*/

'use strict';

module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({
        jshint: {
            all: [
            'Gruntfile.js',
            'tasks/*.js',
            '<%= nodeunit.tests %>',
            ],
            options: {
                jshintrc: '.jshintrc',
            },
        },

        // Before generating any new files, remove any previously-created files.
        clean: {
            tests: ['tmp'],
        },

        copy: {
            main: {
                files: [
                    {expand: true, cwd: "test", src: ['**'], dest: 'tmp'}
                ]
            }
        },

        // Configuration to be run (and then tested).
        scaffold: {
            simple: {
                options: {
                    template: {
                        "tmp/fixtures/test.js": "tmp/{{name}}.js"
                    },
                    filter: function (result) {
                        result.name = "My";
                        return result;
                    }
                }
            },
            folders: {
                options: {
                    template: {
                        "tmp/fixtures/test.js": "tmp/{{name}}.js",
                        "tmp/fixtures/folderA": "tmp/folderA",
                        "tmp/fixtures/folderB": "tmp/folderB"
                    },
                    filter: function (result) {
                        result.name = "My";
                        result.priority = "High";
                        result.severity = "Low";
                        return result;
                    }
                }
            }
        },

        // Unit tests.
        nodeunit: {
            tests: ['test/*_test.js'],
        }
    });

    // Actually load this plugin's task(s).
    grunt.loadTasks('tasks');

    // These plugins provide necessary tasks.
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-nodeunit');
    grunt.loadNpmTasks('grunt-contrib-copy');

    // Whenever the "test" task is run, first clean the "tmp" dir, then run this
    // plugin's task(s), then test the result.
    grunt.registerTask('test', ['clean', 'copy', 'scaffold', 'nodeunit']);

    // By default, lint and run all tests.
    grunt.registerTask('default', ['jshint', 'test']);
};
