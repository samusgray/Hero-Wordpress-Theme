'use strict';

var grunt = require('grunt');

/*
  ======== A Handy Little Nodeunit Reference ========
  https://github.com/caolan/nodeunit

  Test methods:
    test.expect(numAssertions)
    test.done()
  Test assertions:
    test.ok(value, [message])
    test.equal(actual, expected, [message])
    test.notEqual(actual, expected, [message])
    test.deepEqual(actual, expected, [message])
    test.notDeepEqual(actual, expected, [message])
    test.strictEqual(actual, expected, [message])
    test.notStrictEqual(actual, expected, [message])
    test.throws(block, [error], [message])
    test.doesNotThrow(block, [error], [message])
    test.ifError(value)
*/

exports.scaffold = {
    setUp: function(done) {
        // setup here if necessary
        done();
    },
    simple: function(test) {
        test.expect(1);

        var actual = grunt.file.read('tmp/My.js');
        var expected = grunt.file.read('test/expected/My.js');
        test.equal(actual, expected, 'test');

        test.done();
    },
    folders: function(test) {
        test.expect(4);

        var actual = grunt.file.read('tmp/My.js');
        var expected = grunt.file.read('test/expected/My.js');

        test.equal(actual, expected, 'test fodlers My');

        actual = grunt.file.read('tmp/folderA/a.js');
        expected = grunt.file.read('test/expected/folderA/a.js');

        test.equal(actual, expected, 'test fodlers A');

        actual = grunt.file.read('tmp/folderA/My.js');
        expected = grunt.file.read('test/expected/folderA/My.js');

        test.equal(actual, expected, 'test fodlers A - My');

        actual = grunt.file.read('tmp/folderB/b.js');
        expected = grunt.file.read('test/expected/folderB/b.js');

        test.equal(actual, expected, 'test fodlers B');

        test.done();
    }
};
