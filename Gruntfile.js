module.exports = function (grunt) {
    'use strict';
    grunt.initConfig({

        pkg: grunt.file.readJSON("package.json"),

        less: {
            minify: {
                options: {
                    plugins: [
                        new (require('less-plugin-autoprefix'))({browsers: ["last 2 versions"]}),
                        new (require('less-plugin-clean-css'))({
                            "advanced": true,
                            "compatibility": "ie9"
                        })
                    ]
                },
                files: {
                    'css/main.min.css': ['less/main.less']
                }
            },
            compile: {
                options: {
                    plugins: [
                        new (require('less-plugin-autoprefix'))({browsers: ["last 2 versions"]})
                    ]
                },
                files: {
                    'css/main.css': ['less/main.less']
                }
            }
        },
        watch: {
            less: {
                files: ["less/main.less"],
                tasks: ["less"]
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.registerTask("default", ["watch", "less"]);
};
