module.exports = (grunt) ->
    grunt.initConfig
        bower_concat:
            all:
                dest: "tmp/bower.js"
                exclude:
                    [
                        "jquery"
                        "angular"
                    ]
        uglify:
            all:
                files:
                    'tmp/bower.min.js': "tmp/bower.js"
                options:
                    mangle:
                        except:
                            [
                                "jQuery"
                                "angular"
                                "TreeModel"
                            ]
                    dead_code: true

        copy:
            main:
                src: "tmp/bower.min.js"
                dest: "js/bower.min.js"
    grunt.loadNpmTasks 'grunt-bower-concat'
    grunt.loadNpmTasks 'grunt-contrib-copy'
    grunt.loadNpmTasks 'grunt-contrib-uglify'

    grunt.registerTask "default", ["bower_concat:all", "uglify:all" , "copy:main"]
