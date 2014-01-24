/*
 * grunt-scaffold
 * https://github.com/crudo/grunt-scaffold
 *
 * Copyright (c) crudo <crudo@crudo.cz>
 * Licensed under the MIT license.
 */

'use strict';

module.exports = function(grunt) {

    grunt.registerMultiTask('scaffold', 'Scaffold what you want.', function() {

        var inquirer = require('inquirer'),
            mustache = require('mustache'),
            wrench = require('wrench'),
            path = require('path'),
            fs = require('fs'),

            _ = grunt.util._,

            options = this.options();

        var _process = function(result) {
            var template = options.template || {};

            if (options.filter && _.isFunction(options.filter)) {
                result = options.filter(result);
            }

            Object.keys(template).forEach(function(key){
                var dist = mustache.render(template[key], result),
                    distDir = path.dirname(dist);

                if (fs.statSync(key).isFile()) {
                    wrench.mkdirSyncRecursive(distDir);

                    fs.writeFileSync(
                        dist,
                        mustache.render(
                            fs.readFileSync(key, 'utf-8'),
                            result
                        )
                    );

                } else {
                    wrench.mkdirSyncRecursive(distDir);
                    wrench.copyDirSyncRecursive(key, dist);
                    wrench.readdirSyncRecursive(dist).forEach(function(file){
                        file = path.join(dist, file);

                        fs.writeFileSync(
                            mustache.render(file, result),
                            mustache.render(
                                fs.readFileSync(file, 'utf-8'),
                                result
                            ),
                            'utf-8'
                        );
                    });
                }
            });
        };

        var questions = options.questions;

        if (questions) {
            var done = this.async();
            inquirer.prompt(questions, function(result) {
                _process(result);
                done();
            });
        }else{
            _process({});
        }

    });
};
