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
                src: "tmp/sectir-input.js"
                dest: "js/sectir-input/sectir-input.js"
        shell:
            deleteAssets:
                command: "rm assets/* -rf"
            migrateDown:
                command: "echo 'yes' | protected/yiic migrate down 10000"
            migrateUp:
                command: "echo 'yes' | protected/yiic migrate up"
            colocarDatos:
                command: "protected/yiic colocardatos"
            crearEncuesta:
                command: "protected/yiic crearencuesta"
            crearAdmin:
                command: "protected/yiic crearadmin"
            createAuthRoles:
                command: "protected/yiic usr createAuthItems"
            createCtags:
                command: "ctags-patched -f tags -R --fields=+dfnaitmS --languages=php"
        confirm:
            putdatabase:
                options:
                    question: '''
                    ADVERTENCIA: ESTE COMANDO BORRARÁ EL CONTENIDO
                    QUE ESTÁ ACTUALMENTE EN LA BASE DE DATOS
                    ¿DESEA CONTINUAR? (Escriba "Si" para confirmar)
                    '''
                    continue: (answer) ->
                        answer.toLowerCase() is "si"
    grunt.loadNpmTasks 'grunt-bower-concat'
    grunt.loadNpmTasks 'grunt-contrib-copy'
    grunt.loadNpmTasks 'grunt-contrib-uglify'
    grunt.loadNpmTasks 'grunt-shell'
    grunt.loadNpmTasks 'grunt-confirm'
    grunt.loadNpmTasks 'grunt-bower-task'
    
    #Tasks
    grunt.registerTask "putdatabase", [
        "confirm:putdatabase"
        "shell:migrateDown"
        "shell:migrateUp"
        "shell:crearAdmin"
        "shell:createAuthRoles"
        "shell:colocarDatos"
        "shell:crearEncuesta"
    ]
    grunt.registerTask "assets", "shell:deleteAssets"
    grunt.registerTask "ctags", "shell:createCtags"
    grunt.registerTask "install", "bower:install"
    grunt.registerTask "default", [
        "assets", "bower_concat:all", "uglify:all" , "copy:main"
    ]
    grunt.registerTask "all", ["install", "default"]
