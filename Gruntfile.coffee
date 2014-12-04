module.exports = (grunt) ->
    grunt.initConfig
        bower_concat:
            all:
                dest: "tmp/sectir-input.js"
                exclude:
                    [
                        "jquery"
                        "angular"
                    ]
        bower:
            install:
                options:
                    targetDir: "./bower_components"
        uglify:
            all:
                files:
                    'tmp/sectir-input.min.js': "tmp/sectir-input.js"
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
                src: "tmp/sectir-input.min.js"
                dest: "js/sectir-input/sectir-input.min.js"
        shell:
            migrateDown:
                command: "echo 'yes' | protected/yiic migrate down 10000"
            migrateUp:
                command: "echo 'yes' | protected/yiic migrate up"
            colocarDatos:
                command: "protected/yiic colocardatos"
            crearAdmin:
                command: "protected/yiic crearadmin"
            createAuthRoles:
                command: "protected/yiic usr createAuthItems"
    grunt.loadNpmTasks 'grunt-bower-concat'
    grunt.loadNpmTasks 'grunt-contrib-copy'
    grunt.loadNpmTasks 'grunt-contrib-uglify'
    grunt.loadNpmTasks 'grunt-shell'
    grunt.loadNpmTasks 'grunt-bower-task'
    
    #Tasks
    grunt.registerTask "putdatabase", [
        "shell:migrateDown"
        "shell:migrateUp"
        "shell:crearAdmin"
        "shell:createAuthRoles"
        "shell:colocarDatos"
    ]
    grunt.registerTask "install", "bower:install"
    grunt.registerTask "default", [
        "bower_concat:all", "uglify:all" , "copy:main"
    ]
    grunt.registerTask "all", ["install", "default"]
