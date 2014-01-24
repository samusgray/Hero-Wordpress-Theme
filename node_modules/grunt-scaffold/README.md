# grunt-scaffold

>Scaffold what you want.

## Getting Started
This plugin requires Grunt `~0.4.1`.

If you haven't used [Grunt](http://gruntjs.com/) before, be sure to check out the [Getting Started](http://gruntjs.com/getting-started) guide, as it explains how to create a [Gruntfile](http://gruntjs.com/sample-gruntfile) as well as install and use Grunt plugins. Once you're familiar with that process, you may install this plugin with this command:

```shell
npm install grunt-scaffold --save-dev
```

One the plugin has been installed, it may be enabled inside your Gruntfile with this line of JavaScript:

```js
grunt.loadNpmTasks('grunt-scaffold');
```

## The "scaffold" task

### Overview
In your project's Gruntfile, add a section named `scaffold` to the data object passed into `grunt.initConfig()`.

```js
grunt.initConfig({
    scaffold: {
        test: {
            options: {
                questions: [{
                    name: 'name',
                    type: 'input',
                    message: 'Test name:'
                }],
                template: {
                    "skeletons/test.js": "test/{{name}}.js"
                }
            }
        }
    }
})

```

### Options

#### options.questions
Type: `Array`

See [Inquirer.js questions](https://github.com/SBoudrias/Inquirer.js#question) for more info.

#### options.template
Type: `Object`

Map of files to be copied from source to dest.

eg.
```
template: {"skeletons/test.js": "test/{{name}}.js"}
```

When the prompt for name is answered 'Button', then program processes content of the file skeletons/test.js and copy it to test/Button.js.

#### options.filter
Type: `Function`

Function where user ansers can be modified/adjusted. This function receives the hash of all user answers.

eg.
```
filter: function (result) {
    result['capital-name'] = grunt.util._(result.name).capitalize();
    return result;
}
```

## Thx

This plugin is inspired by [grunt-prompt](https://github.com/dylang/grunt-prompt) and [scaffolding](https://github.com/sideroad/scaffolding).

## Contributing
In lieu of a formal styleguide, take care to maintain the existing coding style. Add unit tests for any new or changed functionality. Lint and test your code using [Grunt](http://gruntjs.com/).

## License

[The MIT License](LICENSE.txt)
