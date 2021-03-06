<?php
 

/**
 * Class ColocarDatosCommand
 * @author Me
 */
class ColocarDatosCommand extends CConsoleCommand
{
    public function run($args)
    {
        $usersSQL = "SELECT id FROM {{users}} WHERE username = :name";
        $builder = new CDbCommandBuilder(Yii::app()->db->schema);
        $idCommand = $builder->createSqlCommand($usersSQL,array(
            'name' => 'admin'
        ));
        list($idUser) = array_values($idCommand->queryRow()); //NOTE Importante
        $command = $builder->createMultipleInsertCommand("{{Tipoencuesta}}",array(
            array(
                'enunciado' => "Guión de entrevista para universidades, institutos tecnológicos, escuelas técnicas",
                'identificador' => 'tipoencuesta_uni',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => "Guión de entrevista para institutos, centros, grupos, laboratorios, otros",
                'identificador' => 'tipoencuesta_otros',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
        ));
        $command->execute();
        $command = $builder->createMultipleInsertCommand("{{Pregunta}}",array(
            //IMPORTANTE Grupo 1 de INSTRUMENTO IUTET
            array(
                'enunciado' => 'Nombre del entrevistado',
                'identificador' => 'preg_datos_nom_entr',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => false,
            ),
            array(
                'enunciado' => 'Universidades, institutos tecnológicos, escuelas técnicas',
                'identificador' => 'preg_datos_universidad_pertenece',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'select',
                'compuesta' => false,
            ),
            array(
                'enunciado' => 'Otra universidad',
                'identificador' => 'preg_datos_universidad_perten_otro',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => false,
            ),
            array(
                'enunciado' => 'Año de fundación',
                'identificador' => 'preg_datos_ano_fundacion',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'number',
                'compuesta' => false,
            ),
            array(
                'enunciado' => 'Ubicación',
                'identificador' => 'preg_datos_universidad_ubicacion',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => false,
            ),
            array(
                'enunciado' => 'Municipio',
                'identificador' => 'preg_datos_municipio',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'select',
                'compuesta' => false,
            ),
            array(
                'enunciado' => 'Caracter',
                'identificador' => 'preg_datos_caracterpub',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'select',
                'compuesta' => false,
            ),
            array(
                'enunciado' => 'Tipo de Instituto',
                'identificador' => 'preg_datos_tipoinst',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'select',
                'compuesta' => false,
            ),
            //FIN DE GRUPO 1
            //@note
            //Areas de experiencia del grupo
            array(
                'enunciado' => 'Areas de experiencia',
                'identificador' => 'preg_areas_exp_comp',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'compuesta',
                'compuesta' => true,
            ),
            array(
                'enunciado' => 'Areas de experiencia del instituto centro o laboratorio',
                'identificador' => 'preg_areas_exp_subq',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'subq',
                'compuesta' => true,
            ),
            array(
                'enunciado' => 'X',
                'identificador' => 'preg_areas_exp_sino',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'checkbox',
                'compuesta' => true,
            ),
            //COMIENZO DE GRUPO 2
            array(
                'enunciado' => 'Número de nucleos y sedes',
                'identificador' => 'preg_sedenucleo_compuesta',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'compuesta',
                'compuesta' => true,
            ),
            array(
                'enunciado' => 'Sede / Núcleo',
                'identificador' => 'preg_sedenucleo',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => true,
            ),
            array(
                'enunciado' => 'Ubicación',
                'identificador' => 'preg_sedenucleo_ubicacion',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => true,
            ),
            //FIN DE GRUPO 2
            //COMIENZO DE GRUPO 3 
            array(
                'enunciado' => 'Actividades de ciencia, tecnología e innovación que se desarrollan en  las universidades, institutos tecnológicos, escuelas técnicas, según el artículo 27 de la LOCTI',
                'identificador' => 'preg_actividadesciencia_compuest',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'compuesta',
                'compuesta' => true,
            ),
            array(
                'enunciado' => 'Actividades de ciencia, tecnología e innovación',
                'identificador' => 'preg_actividadesciencia_subq',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'subq',
                'compuesta' => true,
            ),
            array(
                'enunciado' => 'Si/No',
                'identificador' => 'preg_actividadesciencia_sino',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'checkbox',
                'compuesta' => true,
            ),
            array(
                'enunciado' => '¿Cuales?',
                'identificador' => 'preg_actividadesciencia_cuales',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'tag-input',
                'compuesta' => true,
            ), 
            // FIN DE GRUPO 3
            //COMIENZO DE GRUPO 3 
            array(
                'enunciado' => 'Revistas arbitradas',
                'identificador' => 'preg_revotro_comp',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'compuesta',
                'compuesta' => true,
            ),
            array(
                'enunciado' => 'Area de especialización',
                'identificador' => 'preg_revotro_area',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'subq',
                'compuesta' => true,
            ),
            array(
                'enunciado' => 'Nombre de la revista',
                'identificador' => 'preg_revotro_nombre',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => true,
            ),
            array(
                'enunciado' => 'Tipo de revista',
                'identificador' => 'preg_revotro_tipo',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'select',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Distribución',
                'identificador' => 'preg_revotro_dist',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'select',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Periodicidad',
                'identificador' => 'preg_revotro_peri',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'select',
                'compuesta' => true,
            ), 
            // FIN DE GRUPO 3
            //COMIENZO DE GRUPO de servicios 
            array(
                'enunciado' => 'Servicios Científicos, Tecnológicos e Innovación y de Información que presta el instituto, centro, laboratorio, otro',
                'identificador' => 'preg_servcient_comp',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'compuesta',
                'compuesta' => true,
            ),
            array(
                'enunciado' => 'Tipo de servicio',
                'identificador' => 'preg_servcient_subq',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'subq',
                'compuesta' => true,
            ),
            array(
                'enunciado' => 'Si/No',
                'identificador' => 'preg_servcient_sino',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'checkbox',
                'compuesta' => true,
            ),
            array(
                'enunciado' => 'Mencione el tipo de servicio',
                'identificador' => 'preg_servcient_cuales',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => true,
            ), 
            // FIN DE GRUPO de servicios
            // COMIENZO DE GRUPO 4
            array(
                'enunciado' => 'Talento Humano en Ciencia, Tecnología e Innovación de la universidad/institutos tecnológicos/escuelas técnicas/otros',
                'identificador' => 'preg_talentohumano_compuesta',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'compuesta',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Nombre',
                'identificador' => 'preg_talentohumano_nombre',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Edad',
                'identificador' => 'preg_talentohumano_edad',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'number',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Sexo',
                'identificador' => 'preg_talentohumano_sexo',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'select',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Nivel Académico',
                'identificador' => 'preg_talentohumano_nivelac',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'select',
                'compuesta' => true,
            ),
            array(
                'enunciado' => 'Universidad en que cursó estudios',
                'identificador' => 'preg_talentohumano_uni_compuesta',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'compuesta',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Nacional pública',
                'identificador' => 'preg_talentohumano_nacionalpub',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'checkbox',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Nacional privada',
                'identificador' => 'preg_talentohumano_nacionalpri',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'checkbox',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Internacional',
                'identificador' => 'preg_talentohumano_internacional',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'checkbox',
                'compuesta' => true,
            ),        
            array(
                'enunciado' => 'Fuente de financiamiento de estudios',
                'identificador' => 'preg_talentohumano_fuentefin',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'select',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Categoría PEII',
                'identificador' => 'preg_talentohumano_categoriapeii',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'compuesta',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Investigador',
                'identificador' => 'preg_talentohumano_pei_inv',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'checkbox',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Innovador',
                'identificador' => 'preg_talentohumano_pei_inn',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'checkbox',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Area de Experiencia',
                'identificador' => 'preg_talentohumano_exp_area',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'select',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Linea de investigación',
                'identificador' => 'preg_talentohumano_linea_inv',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'select',
                'compuesta' => true,
            ),
            //Fin del grupo  4
            //Comienzo del grupo de productos resultantes 
            array(
                'enunciado' => 'Total de productos resultantes',
                'identificador' => 'preg_productos_compuesta',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'compuesta',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Productos',
                'identificador' => 'preg_productos_prod',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'subq',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Número',
                'identificador' => 'preg_productos_numero',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'ano',
                'compuesta' => true,
            ), 
            //Fin del grupo de productos resultantes 
            //Comienzo del grupo 5
            array(
                'enunciado' => 'Numero de egresados de programas de doctorado en los últimos 12 años',
                'identificador' => 'preg_doctorado_compuesta',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'compuesta',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Programas de doctorado existentes',
                'identificador' => 'preg_doctorado_existente',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'No',
                'identificador' => 'preg_doctorado_numero',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'ano',
                'compuesta' => true,
            ), 
            //Fin del grupo 5
            //Comienzo del grupo 6
            array(
                'enunciado' => 'Numero de egresados de programas de maestria en los últimos 12 años',
                'identificador' => 'preg_maestria_compuesta',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'compuesta',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Programas de maestria existentes',
                'identificador' => 'preg_maestria_existente',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'No',
                'identificador' => 'preg_maestria_numero',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'ano',
                'compuesta' => true,
            ), 
            //Fin del grupo 6
            //Comienzo del grupo 7
            array(
                'enunciado' => 'Numero de egresados de programas de especialidades en los últimos 12 años',
                'identificador' => 'preg_especialidades_compuesta',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'compuesta',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Programas de especialidades existentes',
                'identificador' => 'preg_especialidades_existente',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'No',
                'identificador' => 'preg_especialidades_numero',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'ano',
                'compuesta' => true,
            ), 
            //Fin del grupo 7
            //Comienzo del grupo 8
            array(
                'enunciado' => 'Numero de egresados de programas de pregrado en los últimos 12 años',
                'identificador' => 'preg_pregrado_compuesta',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'compuesta',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Programas de pregrado existentes',
                'identificador' => 'preg_pregrado_existente',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'No',
                'identificador' => 'preg_pregrado_numero',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'ano',
                'compuesta' => true,
            ), 
            //Fin del grupo 8
            //Comienzo del grupo 9
            array(
                'enunciado' => 'Proyectos aprobados y financiados en la universidad/institutos tecnológicos/escuelas técnicas/otros en los últimos 12 años por entes de financiamiento',
                'identificador' => 'preg_proyectosaprob_comp',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'compuesta',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Proyectos aprobados y financiados',
                'identificador' => 'preg_proyectosaprob_subq',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'subq',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Número de proyectos aprobados',
                'identificador' => 'preg_proyectosaprob_num',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'ano',
                'compuesta' => true,
            ), 
            //Fin del grupo 9
            //Comienzo del grupo de beneficiarios 
            array(
                'enunciado' => 'Beneficiarios de proyectos de ciencia y tecnología',
                'identificador' => 'preg_benef_comp',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'compuesta',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Tipos de beneficiarios',
                'identificador' => 'preg_benef_subq',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'subq',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Total de beneficiarios',
                'identificador' => 'preg_benef_num',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'ano',
                'compuesta' => true,
            ),
            //Fin del grupo 9
            //Comienzo del grupo 10
            array(
                'enunciado' => 'Recursos aprobados y financiados en la universidad/institutos tecnológicos/escuelas técnicas/otros en los últimos 12 años por entes de financiamiento',
                'identificador' => 'preg_recursosaprob_comp',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'compuesta',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Recursos aprobados y financiados',
                'identificador' => 'preg_recursosaprob_subq',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'subq',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Número de recursos aprobados',
                'identificador' => 'preg_recursosaprob_num',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'ano',
                'compuesta' => true,
            ), 
            //Fin del grupo 10
            //Comienzo del grupo 11
            array(
                'enunciado' => 'Proyectos aprobados por área y financiados en la universidad/institutos tecnológicos/escuelas técnicas/otros en los últimos 12 años por entes de financiamiento',
                'identificador' => 'preg_proyectosaprob_area_comp',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'compuesta',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Area de concentración',
                'identificador' => 'preg_proyectosaprob_area_subq',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'subq',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Número de proyectos aprobados por área',
                'identificador' => 'preg_proyectosaprob_area_num',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'ano',
                'compuesta' => true,
            ), 
            //Fin del grupo 11
            //Comienzo del grupo 12
            array(
                'enunciado' => 'Recursos aprobados y financiados por área en la universidad/institutos tecnológicos/escuelas técnicas/otros en los últimos 12 años por entes de financiamiento',
                'identificador' => 'preg_recursosaprob_area_comp',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'compuesta',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Area de concentración',
                'identificador' => 'preg_recursosaprob_area_subq',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'subq',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Recursos aprobados',
                'identificador' => 'preg_recursosaprob_area_num',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'ano',
                'compuesta' => true,
            ), 
            //Fin del grupo 12
            //Comienzo del grupo 13
            array(
                'enunciado' => 'Producción Tecnológica (Patentes) en la universidad/institutos tecnológicos/escuelas técnicas/otros en los últimos 12 años por área de especialización',
                'identificador' => 'preg_patentes_area_comp',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'compuesta',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Area de especialización',
                'identificador' => 'preg_patentes_area_subq',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'subq',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Total de producción tecnológica (Patentes)',
                'identificador' => 'preg_patentes_area_num',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'ano',
                'compuesta' => true,
            ), 
            //Fin del grupo 13
            //Comienzo del grupo 14
            array(
                'enunciado' => 'Mencione patentes',
                'identificador' => 'preg_patentes_mencionar_pat',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'tag-input',
                'compuesta' => false,
            ), 
            // Fin del grupo 14
            //Comienzo del grupo 15
            array(
                'enunciado' => 'Revistas arbitradas e indexadas y número de publicaciones por área de especialización que tienen  la universidad/institutos tecnológicos/escuelas técnicas/otros en los últimos 12',
                'identificador' => 'preg_revistas_area_comp',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'compuesta',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Area de especialización',
                'identificador' => 'preg_revistas_area_subq',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'subq',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Revista',
                'identificador' => 'preg_revistas_area_revista',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Total de publicaciones',
                'identificador' => 'preg_revistas_area_num',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'ano',
                'compuesta' => true,
            ), 
            //Fin del grupo 15
            //Comienzo del grupo 16
            array(
                'enunciado' => 'Líneas de Investigación existentes en la universidad/institutos tecnológicos/escuelas técnicas/otros ',
                'identificador' => 'preg_lineas_inv_comp',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'compuesta',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Líneas de Investigación',
                'identificador' => 'preg_lineas_inv_lineasinv',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'select',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Ejes Temáticos',
                'identificador' => 'preg_lineas_inv_ejestematico',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'select',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Programa de Postgrado de adscripción',
                'identificador' => 'preg_lineas_inv_programapost',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => true,
            ), 
            //Fin del grupo 16
            //Comienzo del grupo 17
            array(
                'enunciado' => 'Actores participantes en la ejecución de proyectos de ciencia y tecnología generados en la universidad/institutos tecnológicos/escuelas técnicas/otros',
                'identificador' => 'preg_actores_fin_comp',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'compuesta',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Actores participantes en la ejecución de proyectos',
                'identificador' => 'preg_actores_fin_actorespart',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Actores de financiamiento en la ejecución de proyectos',
                'identificador' => 'preg_actores_fin_actoresfin',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => true,
            ), 
            // Fin del grupo 17
            //Comienzo del grupo 18
            array(
                'enunciado' => 'Pertenecen a alguna Red Temáticas de cooperación',
                'identificador' => 'preg_red_tem_pert',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'select',
                'compuesta' => false,
            ), 
            array(
                'enunciado' => 'Mencione',
                'identificador' => 'preg_red_tem_mencione',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => false,
            ), 
            //Fin del grupo 18
            //Comienzo del grupo 19
            array(
                'enunciado' => 'Cuál es la problemática que se presenta en la universidad/institutos tecnológicos/escuelas técnicas/otros?',
                'identificador' => 'preg_problematica_comp',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'compuesta',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Problema',
                'identificador' => 'preg_problematica_subq',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'subq',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'X',
                'identificador' => 'preg_problematica_sino',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => false,
            ), 
            // Fin del grupo 19
            // Comienzo del grupo 20
            array(
                'enunciado' => 'Infraestructura en ciencia, tecnología e innovación existente',
                'identificador' => 'preg_infraestructura_comp',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'compuesta',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Infraestructura',
                'identificador' => 'preg_infraestructura_subq',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'subq',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Se encuentra Activa',
                'identificador' => 'preg_infraestructura_activa',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'checkbox',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Condiciones de espacios',
                'identificador' => 'preg_infraestructura_espacios',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'select',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Equipamiento',
                'identificador' => 'preg_infraestructura_equipamiento',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'select',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Uso de la infraestructura',
                'identificador' => 'preg_infraestructura_usoinf_comp',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'compuesta',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Docencia',
                'identificador' => 'preg_infraestructura_usodoc',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => true,
            ), 
            array(
                'enunciado' => 'Investigacion',
                'identificador' => 'preg_infraestructura_usoinv',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => true,
            ),
            //Fin del grupo 20
            //Comienzo del grupo 21
            array(
                'enunciado' => '¿Actualmente tiene servicio de internet?',
                'identificador' => 'preg_internet_servint',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'select',
                'compuesta' => false,
            ),
            array(
                'enunciado' => 'Proveedor de internet',
                'identificador' => 'preg_internet_proveedorint',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'select',
                'compuesta' => false,
            ),
            array(
                'enunciado' => 'Tipo de proveedor',
                'identificador' => 'preg_internet_tipo',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'select',
                'compuesta' => false,
            ),
            array(
                'enunciado' => '¿Cual proveedor?',
                'identificador' => 'preg_internet_cualprov',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'select',
                'compuesta' => false,
            ),
            array(
                'enunciado' => '¿Nivel de satisfacción del servicio?',
                'identificador' => 'preg_internet_usoinv',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'select',
                'compuesta' => false,
            ),
            // Fin del grupo 21
            // Comienzo grupo 22 
            array(
                'enunciado' => '¿Cuenta su Organización con un Comité de Ética qué evalúe, controle y conozca  los protocolos de investigación, experimentación y resultados que son presentados al público?',
                'identificador' => 'preg_comiteetica_evalue',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'select',
                'compuesta' => false,
            ),
            array(
                'enunciado' => '¿Cual comité?',
                'identificador' => 'preg_comiteetica_cual',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => false,
            ),
            // Fin del grupo 22
            // Comienzo del grupo 23
            array(
                'enunciado' =>'¿Cómo está compuesto? (para cada integrante, por favor señalar: Identificación, profesión, cargo, correo).?\n Nota: Si usted no tiene comité de Ética deje en blanco',
                'identificador' => 'preg_comiteetica2_composicion_co',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'compuesta',
                'compuesta' => true,
            ),
            array(
                'enunciado' => 'Identificación',
                'identificador' => 'preg_comiteetica2_ident',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => true,
            ),
            array(
                'enunciado' => 'Profesión',
                'identificador' => 'preg_comiteetica2_profesion',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => true,
            ),
            array(
                'enunciado' => 'Cargo',
                'identificador' => 'preg_comiteetica2_cargo',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => true,
            ),
            array(
                'enunciado' => 'Correo',
                'identificador' => 'preg_comiteetica2_correo',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => true,
            ),
            // Fin del grupo 23
            // Comienzo del grupo 24 
            array(
                'enunciado' => '¿En qué fecha y a través de qué resolución (administrativa, legal) fue creado?',
                'identificador' => 'preg_comiteetica3_fecha',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => false,
            ),
            array(
                'enunciado' => '¿Dispone de actas de las reuniones que realiza?',
                'identificador' => 'preg_comiteetica3_reuniones',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => false,
            ),
            array(
                'enunciado' => '¿Cuántos trabajos científicos han evaluado en los últimos cinco años?',
                'identificador' => 'preg_comiteetica3_trabev',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'number',
                'compuesta' => false,
            ),
            array(
                'enunciado' => 'Mencione titulos por favor',
                'identificador' => 'preg_comiteetica3_titulosmenc',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'tag-input',
                'compuesta' => false,
            ),
            array(
                'enunciado' => '¿Cuáles han sido las principales dificultades que ha encontrado en su funcionamiento?',
                'identificador' => 'preg_comiteetica3_principalesdif',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => false,
            ),
            array(
                'enunciado' => 'Si no dispone de un Comité de Ética, ¿de qué forma se evalúa y/o controla las investigaciones, proyectos?',
                'identificador' => 'preg_comiteetica3_formaev',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'text',
                'compuesta' => false,
            ),
            array(
                'enunciado' => '¿Tiene conocimiento y vínculos con otras entidades que evalúen éticamente investigaciones científicas (Universidades, Comités de Ética autónomos, instituciones públicas y/o privadas de financiamiento de proyectos, etc.)?.',
                'identificador' => 'preg_comiteetica3_tieneconent',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'select',
                'compuesta' => false,
            ),
            array(
                'enunciado' => '¿Cual?',
                'identificador' => 'preg_comiteetica3_cuales_ent',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
                'tipo' => 'tag-input',
                'compuesta' => false,
            ),
            
        ));
        $command->execute();
        /**
         * Fin de preguntas
         */
        $command = $builder->createMultipleInsertCommand("{{Grupo}}",array(
            array(
                'enunciado' => 'Identificación',
                'identificador' => 'datos',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Núcleos y sedes',
                'identificador' => 'sedenucleo',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Actividades de ciencia y tecnología desarrolladas',
                'identificador' => 'actividadesciencia',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Talento Humano',
                'identificador' => 'talentohumano',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Problemática',
                'identificador' => 'problematica',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Areas de experiencia',
                'identificador' => 'areas_exp',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Programas de doctorado',
                'identificador' => 'doctorado',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Programas de maestría',
                'identificador' => 'maestria',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Programas de especialidades',
                'identificador' => 'especialidades',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ), 
            array(
                'enunciado' => 'Productos',
                'identificador' => 'productos',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ), 
            array(
                'enunciado' => 'Programas de pregrado',
                'identificador' => 'pregrado',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Proyectos aprobados',
                'identificador' => 'proyectosaprob',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Beneficios',
                'identificador' => 'benef',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Servicios Cientificos',
                'identificador' => 'servcient',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),

            array(
                'enunciado' => 'Recursos aprobados en la universidad',
                'identificador' => 'recursosaprob',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Proyectos aprobados por area',
                'identificador' =>'proyectosaprob_area',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Recursos aprobados por area',
                'identificador' => 'recursosaprob_area',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Patentes aprobadas',
                'identificador' => 'patentes',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Lista de patentes',
                'identificador' => 'patentes2',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Revistas arbitradas e indexadas',
                'identificador' => 'revistas',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Revistas (Otros)',
                'identificador' => 'revotro',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Lineas de investigación',
                'identificador' => 'lineas_inv',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Actores participantes en la ejecución de proyectos',
                'identificador' => 'actores',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Redes temáticas',
                'identificador' => 'red_tem',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Infraestructura',
                'identificador' => 'infraestructura',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Uso de internet',
                'identificador' => 'internet',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Comité de ética',
                'identificador' => 'comiteetica',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Comité de ética',
                'identificador' => 'comiteetica2',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Comité de ética',
                'identificador' => 'comiteetica3',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
        ));
        $command->execute();

        $command = $builder->createMultipleInsertCommand("{{Grupocomp}}",array(
            array(
                'enunciado' => 'Núcleos y sedes',
                'identificador' => 'sedenucleo',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Talento Humano',
                'identificador' => 'talentohumano',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Actividades de ciencia',
                'identificador' => 'actividadesciencia',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Revistas arbitradas',
                'identificador' => 'revistas',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Revistas arbitradas',
                'identificador' => 'revotro',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Programas de doctorado',
                'identificador' => 'doctorado',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Productos',
                'identificador' => 'productos',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            
            array(
                'enunciado' => 'Areas de experiencia',
                'identificador' => 'areas_exp',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Servicios cientificos',
                'identificador' => 'servcient',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Beneficiarios',
                'identificador' => 'benef',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Problemática',
                'identificador' => 'problematica',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Programas de maestría',
                'identificador' => 'maestria',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Programas de especialidades',
                'identificador' => 'especialidades',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Programas de pregrado',
                'identificador' => 'pregrado',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Proyectos aprobados para la universidad',
                'identificador' => 'proyectosaprob',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Recursos aprobados por la universidad',
                'identificador' => 'recursosaprob',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Proyectos aprobados para la universidad por area',
                'identificador' => 'proyectosaprob_area',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Recursos aprobados por la universidad',
                'identificador' => 'recursosaprob_area',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Patentes aprobadas',
                'identificador' => 'patentes',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Lineas de investigación',
                'identificador' => 'lineas_inv',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Actores de financiamiento',
                'identificador' => 'actores_fin',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Redes temáticas',
                'identificador' => 'red_tem',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Infraestructura',
                'identificador' => 'infraestructura',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Comité de Ética',
                'identificador' => 'comiteetica2',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),

        ));
        $command->execute();
        // Comenzamos a insertar pregunta grupo
        $sqlPreguntaGrupo = "INSERT INTO {{PreguntaGrupo}} (pregunta_id, grupo_id, peso) (SELECT p.id AS pregunta_id, g.id AS grupo_id, :peso AS peso FROM {{Pregunta}} p JOIN {{Grupo}} g ON g.identificador=:grupoid WHERE p.identificador =:preguntaid)";
        $commandPreguntaGrupo = Yii::app()->db->createCommand($sqlPreguntaGrupo);
        //TODO Pasar lo de los parametros a las consultas
        //NOTE: Todos los arrays están ordenados por peso.
        $arrayPreguntaGrupo = array(
            'datos' => array(
                'preg_datos_nom_entr',
                'preg_datos_universidad_pertenece',
                'preg_datos_ano_fundacion',
                'preg_datos_universidad_ubicacion',
                'preg_datos_municipio',
                'preg_datos_caracterpub',
                'preg_datos_tipoinst'
            ),
            'areas_exp' => array( 
                'preg_areas_exp_comp',
                'preg_areas_exp_subq',
                'preg_areas_exp_sino',
            ),
            'sedenucleo' => array(
                'preg_sedenucleo_compuesta',
                'preg_sedenucleo',
                'preg_sedenucleo_ubicacion',
            ),
            'actividadesciencia' => array(
                'preg_actividadesciencia_compuest',
                'preg_actividadesciencia_subq',
                'preg_actividadesciencia_sino',
                'preg_actividadesciencia_cuales',
            ),
            'productos' => array(
                'preg_productos_compuesta',
                'preg_productos_prod',
                'preg_productos_numero'
            ),
            'talentohumano' => array(
                'preg_talentohumano_compuesta',
                'preg_talentohumano_nombre',
                'preg_talentohumano_edad',
                'preg_talentohumano_sexo',
                'preg_talentohumano_nivelac',
                'preg_talentohumano_uni_compuesta',
                'preg_talentohumano_nacionalpub',
                'preg_talentohumano_nacionalpri',
                'preg_talentohumano_internacional',
                'preg_talentohumano_fuentefin',
                'preg_talentohumano_categoriapeii',
                'preg_talentohumano_pei_inv',
                'preg_talentohumano_pei_inn',
                'preg_talentohumano_exp_area',
                'preg_talentohumano_linea_inv',
            ),
            'doctorado' => array(
                'preg_doctorado_compuesta',
                'preg_doctorado_existente',
                'preg_doctorado_numero',
            ),
            'maestria' => array(
                'preg_maestria_compuesta',
                'preg_maestria_existente',
                'preg_maestria_numero',
            ),
            'especialidades' => array(
                'preg_especialidades_compuesta',
                'preg_especialidades_existente',
                'preg_especialidades_numero',
            ),
            'pregrado' => array(
                'preg_pregrado_compuesta',
                'preg_pregrado_existente',
                'preg_pregrado_numero',
            ),
            'proyectosaprob' => array(
                'preg_proyectosaprob_comp',
                'preg_proyectosaprob_subq',
                'preg_proyectosaprob_num',
            ),
            'benef' => array(
                'preg_benef_comp',
                'preg_benef_subq',
                'preg_benef_num',
            ),
            'problematica' => array(
                'preg_problematica_comp',
                'preg_problematica_subq',
                'preg_problematica_sino',
            ),
            'servcient' => array(
                'preg_servcient_comp',
                'preg_servcient_subq',
                'preg_servcient_sino',
                'preg_servcient_cuales'
            ),
            'recursosaprob' => array(
                'preg_recursosaprob_comp',
                'preg_recursosaprob_subq',
                'preg_recursosaprob_num',
            ),
            'proyectosaprob_area' => array(
                'preg_proyectosaprob_area_comp',
                'preg_proyectosaprob_area_subq',
                'preg_proyectosaprob_area_num',
            ),
            'patentes' => array(
                'preg_patentes_area_comp',
                'preg_patentes_area_subq',
                'preg_patentes_area_num',
            ),
            'patentes2' => array(
                'preg_patentes_mencionar_pat',
            ),
            'recursosaprob_area' => array(
                'preg_recursosaprob_area_comp',
                'preg_recursosaprob_area_subq',
                'preg_recursosaprob_area_num',
            ),
            'revistas' => array(
                'preg_revistas_area_comp',
                'preg_revistas_area_subq',
                'preg_revistas_area_revista',
                'preg_revistas_area_num',
            ),
            'revotro' => array(
                'preg_revotro_comp',
                'preg_revotro_area',
                'preg_revotro_nombre',
                'preg_revotro_tipo',
                'preg_revotro_dist',
                'preg_revotro_peri',
            ),
            'lineas_inv' => array(
                'preg_lineas_inv_comp',
                'preg_lineas_inv_lineasinv',
                'preg_lineas_inv_ejestematico',
                'preg_lineas_inv_programapost',
            ),
            'actores' => array(
                'preg_actores_fin_comp',
                'preg_actores_fin_actorespart',
                'preg_actores_fin_actoresfin',
            ),
            'red_tem' => array(
                'preg_red_tem_pert',
                'preg_red_tem_mencione',
            ),
            'problematica' => array(
                'preg_problematica_comp',
                'preg_problematica_subq',
                'preg_problematica_sino',
            ),
            'infraestructura' => array(
                'preg_infraestructura_comp',
                'preg_infraestructura_subq',
                'preg_infraestructura_activa',
                'preg_infraestructura_espacios',
                'preg_infraestructura_equipamient',
                'preg_infraestructura_usoinf_comp',
                'preg_infraestructura_usodoc',
                'preg_infraestructura_usoinv',
            ),
            'internet' => array(
                'preg_internet_servint',
                'preg_internet_proveedorint',
                'preg_internet_tipo',
                'preg_internet_cualprov',
                'preg_internet_usoinv',
            ),
            'comiteetica' => array(
                'preg_comiteetica_evalue',
                'preg_comiteetica_cual',
            ),
            'comiteetica2' => array(
                'preg_comiteetica2_composicion_co',
                'preg_comiteetica2_ident',
                'preg_comiteetica2_profesion',
                'preg_comiteetica2_cargo',
                'preg_comiteetica2_correo',
            ),
            'comiteetica3' => array(
                'preg_comiteetica3_fecha',
                'preg_comiteetica3_reuniones',
                'preg_comiteetica3_trabev',
                'preg_comiteetica3_titulosmenc',
                'preg_comiteetica3_principalesdif',
                'preg_comiteetica3_formaev',
                'preg_comiteetica3_tieneconent',
                'preg_comiteetica3_cuales_ent',
            ),
        );

        foreach ($arrayPreguntaGrupo as $idGrupo=>$grupoPreguntas) {
            foreach ($grupoPreguntas as $i=>$pregunta) {  
                $commandPreguntaGrupo->bindValue(':grupoid',$idGrupo);
                $commandPreguntaGrupo->bindValue(':preguntaid',$pregunta);
                $commandPreguntaGrupo->bindValue(':peso',$i);
                echo "Comando con pregunta ($idGrupo,$pregunta) y peso $i ejecutado\n";
                $commandPreguntaGrupo->execute();
            }
        }
        //Comenzamos con Grupotipoencuesta 
        $sqlEncuestaGrupo = "INSERT INTO {{TipoencuestaGrupo}} (tipoencuesta_id, grupo_id, peso) (SELECT t.id AS tipoencuesta_id, g.id AS grupo_id, :peso AS peso FROM {{Tipoencuesta}} t JOIN {{Grupo}} g ON g.identificador=:grupoid WHERE t.identificador =:tipoencuestaid)";
        $arrayEncuestaGrupo = array(
            'tipoencuesta_uni' => array(
                'datos',
                'sedenucleo',
                'actividadesciencia',
                'talentohumano',
                'doctorado',
                'maestria',
                'especialidades',
                'pregrado',
                'proyectosaprob',
                'recursosaprob',
                'proyectosaprob_area',
                'recursosaprob_area',
                'patentes',
                'patentes2',
                'revistas',
                'lineas_inv',
                'actores',
                'red_tem',
                'problematica',
                'infraestructura',
                'internet',
                'comiteetica',
                'comiteetica2',
                'comiteetica3',
            ),
            'tipoencuesta_otros' => array(
                'datos',
                'areas_exp',
                'actividadesciencia',
                'benef',
                'talentohumano',
                'proyectosaprob',
                'recursosaprob',
                'proyectosaprob_area',
                'recursosaprob_area',
                'servcient',
                'productos',
                'patentes',
                'patentes2',
                'revotro',
                'lineas_inv',
                'actores',
                'red_tem',
                'problematica',
                'infraestructura',
                'internet',
                'comiteetica',
                'comiteetica2',
                'comiteetica3',
            ),
        );
        $commandTipoEncuestaGrupo = Yii::app()->db->createCommand($sqlEncuestaGrupo);
        foreach ($arrayEncuestaGrupo as $idEncuesta=>$grupos) {
            foreach ($grupos as $i=>$grupo) {  
                $commandTipoEncuestaGrupo->bindValue(':grupoid',$grupo);
                $commandTipoEncuestaGrupo->bindValue(':tipoencuestaid',$idEncuesta);
                $commandTipoEncuestaGrupo->bindValue(':peso',$i);
                echo "Comando con Grupo ($idEncuesta,$grupo) y peso $i ejecutado\n";
                $commandTipoEncuestaGrupo->execute();
            }
        }
        $commandOpcs = $builder->createMultipleInsertCommand("{{Opcioncomp}}",array(
            // Del grupo 3
            array(
                'enunciado' => 'Proyectos de innovación relacionados con actividades que involucren la obtención de nuevos conocimientos o tecnologías para el país, en las áreas prioritarias establecidas por la autoridad nacional con competencia en materia de ciencia, tecnología, innovación y sus aplicaciones',
                'identificador' => 'actividadesciencia_proyinn',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Incubación de proyectos de producción nacionales con base tecnológica, en las áreas prioritarias establecidas por la autoridad nacional con competencia en materias de ciencia, tecnología, innovación y sus aplicaciones',
                'identificador' => 'actividadesciencia_incub',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Desarrollo fondos nacionales de garantía o de capital de riesgo para proyectos de innovación, investigación o escalamiento, en las áreas prioritarias establecidas por la autoridad nacional con competencia en materia de ciencia, tecnología, innovación y sus aplicaciones',
                'identificador' => 'actividadesciencia_des_fondos',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Creación de unidades o espacios para la investigación, el desarrollo tecnológico y la innovación sin fines delucro, conforme a los lineamientos establecidos en el Plan Nacional de Ciencia, Tecnología e Innovación',
                'identificador' => 'actividadesciencia_creacionuni',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Creación de bases y sistemas de información de libre acceso que contribuyan al fortalecimiento de las actividades de ciencia, la tecnología, la innovación y sus aplicaciones, sin fines de lucro, en las áreas prioritarias establecidos por la autoridad nacional',
                'identificador' => 'actividadesciencia_creacionbases',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Promoción y divulgación de actividades de ciencia, tecnología, innovación, sin fines comerciales',
                'identificador' => 'actividadesciencia_promocion_div',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Consolidación de redes de cooperación productivas científicas, tecnológicas y de innovación a nivel nacional e internacional en las áreas prioritarias establecidas por la autoridad nacional',
                'identificador' => 'actividadesciencia_consol_redes',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Organización y financiamiento de cursos y eventos de formación en ciencia, tecnología e innovación sin fines comerciales en el país',
                'identificador' => 'actividadesciencia_orgcursos',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Creación y fortalecimiento de espacios donde se genere formación de talento humano',
                'identificador' => 'actividadesciencia_fortespacios',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Creación de programas de fomento a la investigación, el escalamiento o la innovación',
                'identificador' => 'actividadesciencia_fomento',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Otras',
                'identificador' => 'actividadesciencia_otras',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            // Ministerios y privados
            array(
                'enunciado' => 'CDCHT',
                'identificador' => 'organizacion_cdcht',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'MppCTI-Fonacit',
                'identificador' => 'organizacion_mppcti',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Privados',
                'identificador' => 'organizacion_privados',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Internacionales',
                'identificador' => 'organizacion_internac',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Fondo para investigación',
                'identificador' => 'organizacion_fondo',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Otro',
                'identificador' => 'organizacion_otro',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            //Area de concentración
            array(
                'enunciado' => 'Alimentos',
                'identificador' => 'area_alimentos',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Agrícola',
                'identificador' => 'area_agricola',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Informática',
                'identificador' => 'area_informatica',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Ambiente',
                'identificador' => 'area_ambiente',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Energía Alternativa',
                'identificador' => 'area_energiaalt',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Biología y Salud',
                'identificador' => 'area_biologiasal',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Ciencias de la Tierra',
                'identificador' => 'area_cienciastierra',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Física Química y Matemática',
                'identificador' => 'area_fisicaquimicamat',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Ciencias Económicas y Sociales',
                'identificador' => 'area_ciencias_ec_soc',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Artes',
                'identificador' => 'area_artes',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Educación',
                'identificador' => 'area_educacion',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Desarrollo',
                'identificador' => 'area_desarrollo',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Humanidades',
                'identificador' => 'area_humanidades',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Otros ¿Cuál?',
                'identificador' => 'area_otros',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            //Problematica
            array(
                'enunciado' => 'Escaso financiamiento',
                'identificador' => 'problematica_fin',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Poca participación de sus integrantes',
                'identificador' => 'problematica_pocapart',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Deficiente infraestructura',
                'identificador' => 'problematica_definf',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Dispersión de recursos',
                'identificador' => 'problematica_recursos',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Falta de articulación con otros actores',
                'identificador' => 'problematica_actores',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Insuficiencia de recursos bibliográficos y/o tecnológicos',
                'identificador' => 'problematica_recursosbib',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Recurso humano insuficiente',
                'identificador' => 'problematica_rrhh',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Otros',
                'identificador' => 'problematica_otros',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            // Beneficiarios
            array(
                'enunciado' => 'Asociación o Gremio de la Producción',
                'identificador' => 'benef_asocgremio',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Centro de investigación',
                'identificador' => 'benef_centroinv',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Centro de investigación privado',
                'identificador' => 'benef_centroinv_priv',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Comunidades',
                'identificador' => 'benef_comunidades',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Mujeres',
                'identificador' => 'benef_mujeres',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Jóvenes',
                'identificador' => 'benef_jovenes',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Hombres',
                'identificador' => 'benef_hombres',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Niños',
                'identificador' => 'benef_ninos',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Consejos comunales',
                'identificador' => 'benef_consejoscom',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Empresa privada',
                'identificador' => 'benef_emppriv',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Empresa pública',
                'identificador' => 'benef_emppub',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Entes gubernamentales',
                'identificador' => 'benef_entes',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Instituto de Investigación Público',
                'identificador' => 'benef_investig_pub',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Universidad Pública',
                'identificador' => 'benef_univpublica',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Recuperación de ambientes naturales',
                'identificador' => 'benef_recupeambientes',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Otros ¿Cual?',
                'identificador' => 'benef_otros',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            // Productos resultantes
            
            array(
                'enunciado' => 'Publicaciones',
                'identificador' => 'productos_pub',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Libros',
                'identificador' => 'productos_lib',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Literatura gris (Informes, papers)',
                'identificador' => 'productos_papers',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Capítulo de Memoria',
                'identificador' => 'productos_capmem',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Capítulo de libro',
                'identificador' => 'productos_caplib',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Tesis',
                'identificador' => 'productos_tesis',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Trabajos de ascensos',
                'identificador' => 'productos_trabasc',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Productos Tecnológicos',
                'identificador' => 'productos_tecno',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Procesos o Técnicas',
                'identificador' => 'productos_proctec',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Composición y arreglos musicales',
                'identificador' => 'productos_comparr',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Obras de arte',
                'identificador' => 'productos_obrasarte',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Videos',
                'identificador' => 'productos_videos',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Conferencias, charlas, talleres',
                'identificador' => 'productos_conf',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Organización de eventos',
                'identificador' => 'productos_orgeventos',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Base de datos',
                'identificador' => 'productos_basedatos',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Sistemas de información',
                'identificador' => 'productos_sisinf',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Software',
                'identificador' => 'productos_software',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Desarrollo de materiales didácticos',
                'identificador' => 'productos_matdid',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Prototipo industrial',
                'identificador' => 'productos_prot',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Otros',
                'identificador' => 'productos_otros',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),

            //Servicios cientificos
            array(
                'enunciado' => 'Asesorías, consultorías y asistencias técnicas',
                'identificador' => 'servcient_asesorias',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Diagnósticos, estudios de factibilidad y viabilidad',
                'identificador' => 'servcient_diagnost',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Servicios de museos de ciencia y tecnología, y otras colecciones',
                'identificador' => 'servcient_servmus',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Transferencias de tecnología',
                'identificador' => 'servcient_transf',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Levantamiento, observaciones, inventarios en actividades de ciencia y tecnología',
                'identificador' => 'servcient_levant',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Recolección de información (Censos encuestas y estudios de mercado)',
                'identificador' => 'servcient_recol',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Traducción y edición de libros en ciencia y tecnología',
                'identificador' => 'servcient_traducc',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Servicios de bibliotecas, archivos, centros de información y documentación',
                'identificador' => 'servcient_biblioteca',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Actividades de difusión y divulgación',
                'identificador' => 'servcient_difusi',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Ensayos, normalización, metrología y control de calidad',
                'identificador' => 'servcient_ensayos',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Localización y busqueda de recursos petroleros y minero',
                'identificador' => 'servcient_locali',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Analisis de laboratorio',
                'identificador' => 'servcient_laboratorio',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Producción, alimentos vacunas',
                'identificador' => 'servcient_prod',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            // Infraestructura 
            array(
                'enunciado' => 'Laboratorios de informática',
                'identificador' => 'infraestructura_inform',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Laboratorios de análisis',
                'identificador' => 'infraestructura_analisis',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Bibliotecas',
                'identificador' => 'infraestructura_bibl',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Salas de conferencias',
                'identificador' => 'infraestructura_conf',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Salones de reuniones',
                'identificador' => 'infraestructura_reuniones',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Salas de estudio',
                'identificador' => 'infraestructura_estudio',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Centros de investigación',
                'identificador' => 'infraestructura_investig',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Aulas de Clase',
                'identificador' => 'infraestructura_aulas',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Mobiliario (mesas, sillas, estanterías, pizarras, carteleras, otros)',
                'identificador' => 'infraestructura_mobil',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Equipos (computación, divulgación, trabajo, otros)',
                'identificador' => 'infraestructura_equipos',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
        ));
        $commandOpcs->execute();

        $arrayGrupocomp = array(
            'sedenucleo' => array(
            ),
            'talentohumano' => array(
            ),
            'doctorado' => array(
            ),
            'maestria' => array(
            ),
            'especialidades' => array(
            ),
            'pregrado' => array(
            ),
            'proyectosaprob' => array(
                'organizacion_cdcht',
                'organizacion_mppcti',
                'organizacion_privados',
                'organizacion_internac',
                'organizacion_fondo',
                'organizacion_otro',
            ),
            'recursosaprob' => array(
                'organizacion_cdcht',
                'organizacion_mppcti',
                'organizacion_privados',
                'organizacion_internac',
                'organizacion_fondo',
                'organizacion_otro',
            ),
            'areas_exp' => array(
                'area_alimentos',
                'area_agricola',
                'area_ambiente',
                'area_energiaalt',
                'area_biologiasal',
                'area_cienciastierra',
                'area_fisicaquimicamat',
                'area_ciencias_ec_soc',
                'area_artes',
                'area_educacion',
                'area_desarrollo',
                'area_humanidades',
                'area_otros'
            ),
            'proyectosaprob_area' => array(
                'area_alimentos',
                'area_agricola',
                'area_ambiente',
                'area_energiaalt',
                'area_biologiasal',
                'area_cienciastierra',
                'area_fisicaquimicamat',
                'area_ciencias_ec_soc',
                'area_artes',
                'area_educacion',
                'area_desarrollo',
                'area_humanidades',
                'area_otros'
            ),
            'recursosaprob_area' => array(
                'area_alimentos',
                'area_agricola',
                'area_ambiente',
                'area_energiaalt',
                'area_biologiasal',
                'area_cienciastierra',
                'area_fisicaquimicamat',
                'area_ciencias_ec_soc',
                'area_artes',
                'area_educacion',
                'area_desarrollo',
                'area_humanidades',
                'area_otros'
            ),
            'patentes' => array(
                'area_alimentos',
                'area_agricola',
                'area_ambiente',
                'area_energiaalt',
                'area_biologiasal',
                'area_cienciastierra',
                'area_fisicaquimicamat',
                'area_ciencias_ec_soc',
                'area_artes',
                'area_educacion',
                'area_desarrollo',
                'area_humanidades',
                'area_otros'
            ),
            'lineas_inv' => array(
            ),
            'actores_fin' => array(
            ),
            'red_tem' => array(
            ),
            'infraestructura' => array(
                'infraestructura_inform',
                'infraestructura_analisis',
                'infraestructura_bibl',
                'infraestructura_conf',
                'infraestructura_reuniones',
                'infraestructura_investig',
                'infraestructura_aulas',
                'infraestructura_mobil',
                'infraestructura_equipos',
            ),
            'comiteetica2' => array(
            ),
            'actividadesciencia' => array(
                'actividadesciencia_proyinn',
                'actividadesciencia_incub',
                'actividadesciencia_des_fondos',
                'actividadesciencia_creacionuni',
                'actividadesciencia_creacionbases',
                'actividadesciencia_promocion_div',
                'actividadesciencia_consol_redes',
                'actividadesciencia_orgcursos',
                'actividadesciencia_fortespacios',
                'actividadesciencia_fomento',
                'actividadesciencia_otras',
            ),
            'revistas' => array(
                'area_alimentos',
                'area_agricola',
                'area_ambiente',
                'area_energiaalt',
                'area_biologiasal',
                'area_cienciastierra',
                'area_fisicaquimicamat',
                'area_ciencias_ec_soc',
                'area_artes',
                'area_educacion',
                'area_desarrollo',
                'area_humanidades',
                'area_otros'
            ),
            'revotro' => array(
                'area_alimentos',
                'area_agricola',
                'area_ambiente',
                'area_energiaalt',
                'area_biologiasal',
                'area_cienciastierra',
                'area_fisicaquimicamat',
                'area_ciencias_ec_soc',
                'area_artes',
                'area_educacion',
                'area_desarrollo',
                'area_humanidades',
                'area_otros'
            ),
            'servcient' => array(
                'servcient_asesorias',
                'servcient_diagnost',
                'servcient_servmus',
                'servcient_transf',
                'servcient_levant',
                'servcient_recol',
                'servcient_traducc',
                'servcient_biblioteca',
                'servcient_difusi',
                'servcient_ensayos',
                'servcient_locali',
                'servcient_laboratorio',
                'servcient_prod',
            ),
            'problematica' => array(
                'problematica_fin',
                'problematica_pocapart',
                'problematica_definf',
                'problematica_recursos',
                'problematica_actores',
                'problematica_recursosbib',
                'problematica_rrhh',
                'problematica_otros',
            ),
            'benef' => array(
                'benef_asocgremio',
                'benef_centroinv',
                'benef_centroinv_priv',
                'benef_comunidades',
                'benef_mujeres',
                'benef_jovenes',
                'benef_hombres',
                'benef_ninos',
                'benef_consejoscom',
                'benef_emppriv',
                'benef_emppub',
                'benef_entes',
                'benef_investig_pub',
                'benef_univpublica',
                'benef_recupeambientes',
                'benef_otros',
            ),
            'productos' => array(
                'productos_pub',
                'productos_lib',
                'productos_papers',
                'productos_capmem',
                'productos_caplib',
                'productos_tesis',
                'productos_trabasc',
                'productos_tecno',
                'productos_proctec',
                'productos_comparr',
                'productos_obrasarte',
                'productos_videos',
                'productos_conf',
                'productos_orgeventos',
                'productos_basedatos',
                'productos_sisinf',
                'productos_software',
                'productos_matdid',
                'productos_prot',
                'productos_otros',
            ),
        );
        $sqlGrupocompOpcion = "INSERT INTO {{GrupocompOpcioncomp}} (grupocomp_id, opcioncomp_id, peso) (SELECT g.id AS grupocomp_id, o.id AS opcioncomp_id, :peso AS peso FROM {{Opcioncomp}} o JOIN {{Grupocomp}} g ON g.identificador=:grupoid WHERE o.identificador =:opcionid)";
        $commandPreguntaGrupo = Yii::app()->db->createCommand($sqlGrupocompOpcion);
        foreach ($arrayGrupocomp as $idGrupo=>$grupoOpciones) {
            foreach ($grupoOpciones as $i=>$opcion) {  
                $commandPreguntaGrupo->bindValue(':grupoid',$idGrupo);
                $commandPreguntaGrupo->bindValue(':opcionid',$opcion);
                $commandPreguntaGrupo->bindValue(':peso',$i);
                echo "Comando con opcion ($idGrupo,$opcion) y peso $i ejecutado\n";
                var_dump($commandPreguntaGrupo->execute());
            }
        }
        $commandOpcs2 = $builder->createMultipleInsertCommand("{{Opcion}}",array(
            array(
                'enunciado' => 'Instituto Experimental "Jóse Witremundo Torrealba"',
                'identificador' => 'instituto_jwt',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Centro Regional de Investigaciones Humanística Económicas y Social. (CRIHES) (NURR-CARMONA)',
                'identificador' => 'centro_crihes',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Centro de Investigaciones para el Desarrollo Integral Sustentable (CIDIS)',
                'identificador' => 'centro_cidis',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Centro de Investigaciones Literarias y Lingüísticas Mario Briceño Iragorry (CILL)',
                'identificador' => 'centro_cill',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Centro para la Agricultura Tropical  Alternativa y el Desarrollo Integral. (CATADI)',
                'identificador' => 'centro_catadi',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Centro para la Formación y Actualización Docente (CEFAD)',
                'identificador' => 'centro_cefad',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Centro de Desarrollo Local (CILARR-CEDEULA)',
                'identificador' => 'centro_cilarr',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Centro de Ecología Boconó',
                'identificador' => 'centro_bocono',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            /**
             * <!Fin centros!>
             */
            array(
                'enunciado' => 'Laboratorio de Biología de Lutzomya "Pablo Anduze" (NURR-CARMONA)',
                'identificador' => 'lab_pabloanduze',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Laboratorio de Investigación Arte y Poética (NURR-CARMONA)',
                'identificador' => 'lab_arte_poetica',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Laboratorio de Fitopatología y Control Biológico "Dr. Carlos Díaz Polanco" (NURR-CARMONA)',
                'identificador' => 'lab_carlospolanco',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Laboratorio de Investigación Educativa "Don Simón Rodríguez" (NURR-CARMONA)',
                'identificador' => 'lab_simonrodriguez',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Laboratorio de Investigación en "Ecología y Epidemiología de Leishmaniasis Visceral" (NURR-VILLA)',
                'identificador' => 'lab_leishmaniasis',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Laboratorio de Ecología de Parásitos (NURR-VILLA)',
                'identificador' => 'lab_parasitos',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Laboratorio de Investigación de Fisiología e Inmunología (NURR-VILLA)',
                'identificador' => 'lab_fisiologia_inmuno',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Laboratorio de Productos Lácteos',
                'identificador' => 'lab_prod_lact',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Laboratorio de Investigación en Planificación Física Agrícola (NURR-VILLA)',
                'identificador' => 'lab_plan_fisica_ag',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Laboratorio de Investigación de Fisiología de Postcosecha (NURR-CARMONA)',
                'identificador' => 'lab_postcosecha',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Laboratorio de Suelos. (NURR-VILLA)',
                'identificador' => 'lab_suelos',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Laboratorio de Química Ambiental (LAQUIAM) (NURR-VILLA)',
                'identificador' => 'lab_laquiam',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Laboratorio de Comunicaciones para la Investigación Postgrado y Extensión.(LABCOM) (NURR-

CARMONA)',
                'identificador' => 'lab_labcom',//NOTE Laboratorio aquí
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            /**
             * <Fin laboratorios>
             */
            
            array(
                'enunciado' => 'Grupo de Investigación de Suelos y Aguas. (GISA) (NURR-CARMONA)',
                'identificador' => 'grupo_invsuelosaguas',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Grupo de Investigación en Geografía y Ciencias de la Tierra (GEOCIENCIAS) (NURR-CARMONA)',
                'identificador' => 'grupo_geociencias',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Grupo de Investigación en Lenguas Extranjeras. (GILE) (NURR-VILLA)',
                'identificador' => 'grupo_gile',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Grupo de Investigación Educativa Integración Escuela-Comunidad. (GIEEC) (NURR-CARMONA)',
                'identificador' => 'grupo_gieec',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Grupo de Investigación en Producción Animal. (GIPA) (NURR-VILLA)',
                'identificador' => 'grupo_gipa',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Grupo de Investigación de las Ciencias Contables y Administrativas (GICCA) (NURR-CARMONA)',
                'identificador' => 'grupo_gicca',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Grupo de Investigación Científica y la Enseñanza de la Física (GRINCEF) (NURR-VILLA)',
                'identificador' => 'grupo_grincef',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Grupo de Investigación  en Productos Naturales (GIPRONA) (NURR-VILLA)',
                'identificador' => 'grupo_giprona',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            /**
             * Fin de grupos de investigación
             */
            array(
                'enunciado' => 'Unidad de Producción Integral. (UPI)',
                'identificador' => 'unidadtec_upi',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Unidad Experimental de Producción Animal. (UEPA)',
                'identificador' => 'unidadtec_uepa',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Museo de Arte Popular "Salvador Valero" (NURR-CARMONA)',
                'identificador' => 'unidadtec_salvadorva',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            /**
             * Universidades
             */ 
            array(
                'enunciado' => 'Universidad Bolivariana de Venezuela',
                'identificador' => 'uni_ubv',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Universidad Nacional Abierta',
                'identificador' => 'uni_una',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Universidad Nacional Experimental Simón Rodríguez',
                'identificador' => 'uni_unesr',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Universidad Pedagógica Experimental Libertador',
                'identificador' => 'uni_upel',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Universidad Nacional Experimental Rafael María Baralt (UNERMB)',
                'identificador' => 'uni_unermb',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Universidad Nacional Experimental Politécnica de la Fuerza Armada Nacional',
                'identificador' => 'uni_unefa',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Otro',
                'identificador' => 'uni_otro',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            //NOTE Finalizados institutos
            /**
            //NOTE Finalizados institutos
            /**
             * Municipios
             */
            array(
                'enunciado' => 'Municipio Andres Bello (Santa Isabel)',
                'identificador' => 'muni_andresbello',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Municipio Boconó (Boconó)',
                'identificador' => 'muni_bocono',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Municipio Bolívar (Sabana Grande)',
                'identificador' => 'muni_bolivar',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Municipio Candelaria (Chejendé)',
                'identificador' => 'muni_candelaria',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Municipio Carache (Carache)',
                'identificador' => 'muni_carache',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Municipio Escuque (Escuque)',
                'identificador' => 'muni_escuque',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Municipio José Felipe Márquez Cañizalez (El Paradero)',
                'identificador' => 'muni_jfmc',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Municipio Juan Vicente Campos Elías (Campo Elías)',
                'identificador' => 'muni_campoelias',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Municipio La Ceiba (Santa Apolonia)',
                'identificador' => 'muni_laceiba',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Municipio Miranda (El Dividive)',
                'identificador' => 'muni_miranda',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Municipio Monte Carmelo (Monte Carmelo)',
                'identificador' => 'muni_montecarmelo',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Municipio Motatán (Motatán)',
                'identificador' => 'muni_motatan',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Municipio Pampán (Pampán)',
                'identificador' => 'muni_pampan',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Municipio Pampanito (Pampanito)',
                'identificador' => 'muni_pampanito',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Municipio Rafael Rangel (Betijoque)',
                'identificador' => 'muni_rafaelrangel',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Municipio San Rafael de Carvajal (Carvajal)',
                'identificador' => 'muni_carvajal',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Municipio Sucre (Sabana de Mendoza)',
                'identificador' => 'muni_sucre',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Municipio Trujillo (Trujillo)',
                'identificador' => 'muni_trujillo',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Municipio Urdaneta (La Quebrada)',
                'identificador' => 'muni_urdaneta',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Municipio Valera (Valera)',
                'identificador' => 'muni_valera',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            /**
             * Fin municipios
             */
            /**
             * Caracter de una universidad
             */
            array(
                'enunciado' => 'Público',
                'identificador' => 'caracter_publico',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Privado',
                'identificador' => 'caracter_privado',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            /**
             * Fin de caracter
             */
            /**
             * Tipo de instituto
             */
            array(
                'enunciado' => 'Universidad',
                'identificador' => 'tipoinst_uni',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Instituto',
                'identificador' => 'tipoinst_inst',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Centro',
                'identificador' => 'tipoinst_centro',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Grupo',
                'identificador' => 'tipoinst_grupo',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Laboratorio',
                'identificador' => 'tipoinst_lab',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Otro',
                'identificador' => 'tipoinst_otro',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            /**
             * Fin de tipo de instituo
             */
            /**
             * Nivel académico
             */
            array(
                'enunciado' => 'Doctor',
                'identificador' => 'nivelac_doctor',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Magister',
                'identificador' => 'nivelac_magister',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Especialista',
                'identificador' => 'nivelac_especialista',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Licenciado, Economista o Ingeniero',
                'identificador' => 'nivelac_lic',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Tecnico superior (TSU)',
                'identificador' => 'nivelac_tsu',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Bachiller',
                'identificador' => 'nivelac_bachiller',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            /**
             * Fin nivel académico
             */
            /**
             * Sexo
             */
            array(
                'enunciado' => 'Masculino',
                'identificador' => 'sexo_masculino',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Femenino',
                'identificador' => 'sexo_femenino',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            /**
             * Fin sexo
             */
            /* Tipo de revista
             */
            array(
                'enunciado' => 'Arbitrada',
                'identificador' => 'revotro_arbitrada',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Indexada',
                'identificador' => 'revotro_indexada',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Arbitrada e Indexada',
                'identificador' => 'revotro_ambos',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            /*
             * Distribución de la revista
             */
            array(
                'enunciado' => 'Físico',
                'identificador' => 'revotro_fisico',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Online',
                'identificador' => 'revotro_online',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Físico y Online',
                'identificador' => 'revotro_ambos_online',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            /*
             * Periodicidad
             */
            array(
                'enunciado' => 'Mensual',
                'identificador' => 'revotro_mensual',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Trimestral',
                'identificador' => 'revotro_trimestral',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Semestral',
                'identificador' => 'revotro_semestral',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Anual',
                'identificador' => 'revotro_anual',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            /*
             * Fuente financiamiento
             * TODO Colocar fuentes reales
             */
            array(
                'enunciado' => 'Fuente de financiamiento 1',
                'identificador' => 'fuentefin_1',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Fuente de financiamiento 2',
                'identificador' => 'fuentefin_2',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Fuente de financiamiento 3',
                'identificador' => 'fuentefin_3',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            /**
             * Fin fuente
             */   
            /**
             * Area de experiencia
             *
             */        
            array(
                'enunciado' => 'Area de experiencia 1',
                'identificador' => 'areaexp_1',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Area de experiencia 2',
                'identificador' => 'areaexp_2',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Area de experiencia 3',
                'identificador' => 'areaexp_3',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Area de experiencia 4',
                'identificador' => 'areaexp_4',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            /**
             * Fin area experiencia
             */
            /**
             * Linea de investigación
             */
            array(
                'enunciado' => 'Lineas de investigación 1',
                'identificador' => 'lineainv_1',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Lineas de investigación 2',
                'identificador' => 'lineainv_2',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Lineas de investigación 3',
                'identificador' => 'lineainv_3',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            /**
             * Fin linea
             */
            /**
             * Ejes temáticos
             */ 
            array(
                'enunciado' => 'Eje temático 1',
                'identificador' => 'ejetem_1',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Eje temático 2',
                'identificador' => 'ejetem_2',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Eje temático 3',
                'identificador' => 'ejetem_3',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            /**
             * Fin ejes temáticos
             */
            /**
             * Booleanos
             */
            array(
                'enunciado' => 'Sí',
                'identificador' => 'bool_si',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'No',
                'identificador' => 'bool_no',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            /**
             * Redes temáticas
             */
            array(
                'enunciado' => 'Ninguna',
                'identificador' => 'redtem_ninguna',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Nacional',
                'identificador' => 'redtem_nacional',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Regional',
                'identificador' => 'redtem_regional',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Internacional',
                'identificador' => 'redtem_internacional',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Local',
                'identificador' => 'redtem_local',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            /**
             * Fin redes temáticas
             */
            /**
             * Nivel de satisfacción
             */
            array(
                'enunciado' => 'Excelente',
                'identificador' => 'satisfaccion_excelente',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Buena',
                'identificador' => 'satisfaccion_buena',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Regular',
                'identificador' => 'satisfaccion_regular',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Deficiente',
                'identificador' => 'satisfaccion_deficiente',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            /**
             * Tipo de conexión de internet
             */
            array(
                'enunciado' => 'Banda ancha',
                'identificador' => 'tipointernet_bandaancha',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Satelital',
                'identificador' => 'tipointernet_satelital',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Fibra óptica',
                'identificador' => 'tipointernet_fibraoptica',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
            array(
                'enunciado' => 'Cable',
                'identificador' => 'tipointernet_cable',
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
                'user_id' => $idUser,
            ),
        ));
        $commandOpcs2->execute();
        $sqlPreguntaOpcion = "INSERT INTO {{PreguntaOpc}} (pregunta_id,opcion_id, peso) (SELECT p.id AS pregunta_id, o.id AS opcion_id, :peso AS peso FROM {{Opcion}} o JOIN {{Pregunta}} p ON p.identificador=:preguntaid WHERE o.identificador =:opcionid)";
        $commandPreguntaGrupo = Yii::app()->db->createCommand($sqlPreguntaOpcion);
        $PreguntaOpcArray = array(
            'preg_datos_universidad_pertenece' => array(
                'instituto_jwt', 
                'centro_crihes',
                'centro_cidis',
                'centro_cill',
                'centro_catadi',
                'centro_cefad',
                'centro_cilarr',
                'centro_bocono',
                'lab_pabloanduze',
                'lab_arte_poetica',
                'lab_carlospolanco',
                'lab_simonrodriguez',
                'lab_leishmaniasis',
                'lab_parasitos',
                'lab_fisiologia_inmuno',
                'lab_prod_lact',
                'lab_plan_fisica_ag',
                'lab_postcosecha',
                'lab_suelos',
                'lab_laquiam',
                'lab_labcom',//NOTE Laboratorio aquí
                'grupo_invsuelosaguas',
                'grupo_geociencias',
                'grupo_gile',
                'grupo_gieec',
                'grupo_gipa',
                'grupo_gicca',
                'grupo_grincef',
                'grupo_giprona',
                'unidadtec_upi',
                'unidadtec_uepa',
                'unidadtec_salvadorva',
                'uni_ubv',
                'uni_una',
                'uni_unesr',
                'uni_upel',
                'uni_unermb',
                'uni_unefa',
                'uni_otro',
            ),
            'preg_datos_municipio' => array( 
                'muni_andresbello',
                'muni_bocono',
                'muni_bolivar',
                'muni_candelaria',
                'muni_carache',
                'muni_escuque',
                'muni_jfmc',
                'muni_campoelias',
                'muni_laceiba',
                'muni_miranda',
                'muni_montecarmelo',
                'muni_motatan',
                'muni_pampan',
                'muni_pampanito',
                'muni_rafaelrangel',
                'muni_carvajal',
                'muni_sucre',
                'muni_trujillo',
                'muni_urdaneta',
                'muni_valera',
            ),
            'preg_datos_caracterpub' => array( 
                'caracter_publico',
                'caracter_privado',
            ),
            'preg_datos_tipoinst' => array(
                'tipoinst_uni',
                'tipoinst_inst',
                'tipoinst_centro',
                'tipoinst_grupo',
                'tipoinst_lab',
                'tipoinst_otro',
            ),
            'preg_revotro_tipo' => array(
                'revotro_arbitrada',
                'revotro_indexada',
                'revotro_ambos',
            ),
            'preg_revotro_dist' => array(
                'revotro_fisico',
                'revotro_online',
                'revotro_ambos_online',
            ),
            'preg_revotro_peri' => array(
                'revotro_mensual',
                'revotro_trimestral',
                'revotro_semestral',
                'revotro_anual',
            ),
            'preg_talentohumano_sexo' => array(
                'sexo_masculino',
                'sexo_femenino',
            ),
            'preg_talentohumano_nivelac' => array(
                'nivelac_doctor',
                'nivelac_magister',
                'nivelac_especialista',
                'nivelac_lic',
                'nivelac_tsu',
                'nivelac_bachiller',
            ),
            'preg_talentohumano_fuentefin' => array(
                'fuentefin_1',
                'fuentefin_2',
                'fuentefin_3',
            ),
            'preg_talentohumano_exp_area' => array(
                'areaexp_1',
                'areaexp_2',
                'areaexp_3',
                'areaexp_4',
            ),
            'preg_talentohumano_linea_inv' => array(
                
                'lineainv_1',
                'lineainv_2',
                'lineainv_3',
            ),
            'preg_lineas_inv_lineasinv' => array(
                'lineainv_1',
                'lineainv_2',
                'lineainv_3',
            ),
            'preg_lineas_inv_ejestematico' => array( 
                'ejetem_1',
                'ejetem_2',
                'ejetem_3',
            ),
            'preg_red_tem_pert' => array( 
                'redtem_ninguna',
                'redtem_nacional',
                'redtem_regional',
                'redtem_local',
                'redtem_internacional',
            ),
            'preg_infraestructura_espacios' => array(
                'satisfaccion_excelente',
                'satisfaccion_buena',
                'satisfaccion_regular',
                'satisfaccion_deficiente',
            ),
            'preg_infraestructura_equipamient' => array(
                'satisfaccion_excelente',
                'satisfaccion_buena',
                'satisfaccion_regular',
                'satisfaccion_deficiente',
            ),
            'preg_infraestructura_usoinf_comp' => array(
                'satisfaccion_excelente',
                'satisfaccion_buena',
                'satisfaccion_regular',
                'satisfaccion_deficiente',
            ),
            'preg_internet_servint' => array(
                'bool_si',
                'bool_no',
            ),
            //Proveedor
            'preg_internet_cualprov' => array( 
                'tipointernet_bandaancha',
                'tipointernet_satelital',
                'tipointernet_fibraoptica',
                'tipointernet_cable',
            ),
            'preg_internet_tipo' => array( 
                'caracter_publico',
                'caracter_privado',
            ),
            //TODO Pondremos mientras lo mismo de tipo de conexiones
            'preg_internet_proveedorint' => array(
                'tipointernet_bandaancha',
                'tipointernet_satelital',
                'tipointernet_fibraoptica',
                'tipointernet_cable',
            ),
            'preg_internet_usoinv' => array(
                'satisfaccion_excelente',
                'satisfaccion_buena',
                'satisfaccion_regular',
                'satisfaccion_deficiente',
            ),
            'preg_comiteetica_evalue' => array(
                'bool_si',
                'bool_no',
            ),
            'preg_comiteetica3_tieneconent' => array(
                'bool_si',
                'bool_no',
            ),
        ); 
        foreach ($PreguntaOpcArray as $idPregunta=>$preguntaOpciones) {
            foreach ($preguntaOpciones as $i=>$opcion) {  
                $commandPreguntaGrupo->bindValue(':preguntaid',$idPregunta);
                $commandPreguntaGrupo->bindValue(':opcionid',$opcion);
                $commandPreguntaGrupo->bindValue(':peso',$i);
                echo "Comando asignando opcion a pregunta ($idPregunta,$opcion) y peso $i ejecutado\n";
                var_dump($commandPreguntaGrupo->execute());
            }
        }
        $arrayComp = array(
            /**
             * Sede nucleo
             */
            'sedenucleo' => array(
                array(
                    'preguntaid' => 'preg_sedenucleo_compuesta',
                    'lft' => 1,
                    'rgt' => 6,
                ),
                array(
                    'preguntaid' => 'preg_sedenucleo',
                    'lft' => 2,
                    'rgt' => 3,
                ),
                array(
                    'preguntaid' => 'preg_sedenucleo_ubicacion',
                    'lft' => 4,
                    'rgt' => 5,
                ),
            ),
            /**
             * Sede nucleo
             */
            'areas_exp' => array(
                array(
                    'preguntaid' => 'preg_areas_exp_comp',
                    'lft' => 1,
                    'rgt' => 6,
                ),
                array(
                    'preguntaid' => 'preg_areas_exp_subq',
                    'lft' => 2,
                    'rgt' => 3,
                ),
                array(
                    'preguntaid' => 'preg_areas_exp_sino',
                    'lft' => 4,
                    'rgt' => 5,
                ),
            ),
            /**
             * actividades ciencia
             *
             */
            'actividadesciencia' => array(
                array(
                    'preguntaid' => 'preg_actividadesciencia_compuest',
                    'lft' => 1,
                    'rgt' => 8,
                ),
                
                array(
                    'preguntaid' => 'preg_actividadesciencia_subq',
                    'lft' => 2,
                    'rgt' => 3,
                ),
                array(
                    'preguntaid' => 'preg_actividadesciencia_sino',
                    'lft' => 4,
                    'rgt' => 5,
                ),
                array(
                    'preguntaid' => 'preg_actividadesciencia_cuales',
                    'lft' => 6,
                    'rgt' => 7,
                ),
            ),
            /**
             * Talento humano
             */
            'talentohumano' => array( 
                array(
                    'preguntaid' => 'preg_talentohumano_compuesta',
                    'lft' => 1,
                    'rgt' => 30,
                ),
                array(
                    'preguntaid' => 'preg_talentohumano_nombre',
                    'lft' => 2,
                    'rgt' => 3,
                ),
                array(
                    'preguntaid' => 'preg_talentohumano_edad',
                    'lft' => 4,
                    'rgt' => 5,
                ),
                array(
                    'preguntaid' => 'preg_talentohumano_sexo',
                    'lft' => 6,
                    'rgt' => 7,
                ),
                array(
                    'preguntaid' => 'preg_talentohumano_nivelac',
                    'lft' => 8,
                    'rgt' => 9,
                ),
                array(
                    'preguntaid' => 'preg_talentohumano_uni_compuesta',
                    'lft' => 10,
                    'rgt' => 17,
                ),
                array(
                    'preguntaid' => 'preg_talentohumano_nacionalpub',
                    'lft' => 11,
                    'rgt' => 12,
                ),
                array(
                    'preguntaid' => 'preg_talentohumano_nacionalpri',
                    'lft' => 13,
                    'rgt' => 14,
                ),
                array(
                    'preguntaid' => 'preg_talentohumano_internacional',
                    'lft' => 15,
                    'rgt' => 16,
                ),
                array(
                    'preguntaid' => 'preg_talentohumano_fuentefin',
                    'lft' => 18,
                    'rgt' => 19,
                ),
                array(
                    'preguntaid' => 'preg_talentohumano_categoriapeii',
                    'lft' => 20,
                    'rgt' => 25,
                ),
                array(
                    'preguntaid' => 'preg_talentohumano_pei_inv',
                    'lft' => 21,
                    'rgt' => 22,
                ),
                array(
                    'preguntaid' => 'preg_talentohumano_pei_inn',
                    'lft' => 23,
                    'rgt' => 24,
                ),
                array(
                    'preguntaid' => 'preg_talentohumano_exp_area',
                    'lft' => 26,
                    'rgt' => 27,
                ),
                array(
                    'preguntaid' => 'preg_talentohumano_linea_inv',
                    'lft' => 28,
                    'rgt' => 29,
                ),
            ),
            /**
             * Doctorado
             */
            'doctorado' => array(
                array(
                    'preguntaid' => 'preg_doctorado_compuesta',
                    'lft' => 1,
                    'rgt' => 6,
                ),
                array(
                    'preguntaid' => 'preg_doctorado_existente',
                    'lft' => 2,
                    'rgt' => 3,
                ),
                array(
                    'preguntaid' => 'preg_doctorado_numero',
                    'lft' => 4,
                    'rgt' => 5,
                ),
            ),
            /**
             * Maestria
             * 
             **/
            'maestria' => array(
                array(
                    'preguntaid' => 'preg_maestria_compuesta',
                    'lft' => 1,
                    'rgt' => 6,
                ),
                array(
                    'preguntaid' => 'preg_maestria_existente',
                    'lft' => 2,
                    'rgt' => 3,
                ),
                array(
                    'preguntaid' => 'preg_maestria_numero',
                    'lft' => 4,
                    'rgt' => 5,
                ),

            ),
            /**
             * Especialidades
             */
            'especialidades' => array(
                array(
                    'preguntaid' => 'preg_especialidades_compuesta',
                    'lft' => 1,
                    'rgt' => 6,
                ),
                array(
                    'preguntaid' => 'preg_especialidades_existente',
                    'lft' => 2,
                    'rgt' => 3,
                ),
                array(
                    'preguntaid' => 'preg_especialidades_numero',
                    'lft' => 4,
                    'rgt' => 5,
                ),
            ),
            /**
             * Pregrado
             */
            'pregrado' => array(
                array(
                    'preguntaid' => 'preg_pregrado_compuesta',
                    'lft' => 1,
                    'rgt' => 6,
                ),
                array(
                    'preguntaid' => 'preg_pregrado_existente',
                    'lft' => 2,
                    'rgt' => 3,
                ),
                array(
                    'preguntaid' => 'preg_pregrado_numero',
                    'lft' => 4,
                    'rgt' => 5,
                ),

            ),
            /**
             * Beneficiarios 
             */
            'benef' => array(
                array(
                    'preguntaid' => 'preg_benef_comp',
                    'lft' => 1,
                    'rgt' => 6,
                ),
                array(
                    'preguntaid' => 'preg_benef_subq',
                    'lft' => 2,
                    'rgt' => 3,
                ),
                array(
                    'preguntaid' => 'preg_benef_num',
                    'lft' => 4,
                    'rgt' => 5,
                ),
            ),
            /**
             * Beneficiarios 
             */
            'problematica' => array(
                array(
                    'preguntaid' => 'preg_problematica_comp',
                    'lft' => 1,
                    'rgt' => 6,
                ),
                array(
                    'preguntaid' => 'preg_problematica_subq',
                    'lft' => 2,
                    'rgt' => 3,
                ),
                array(
                    'preguntaid' => 'preg_problematica_sino',
                    'lft' => 4,
                    'rgt' => 5,
                ),
            ),
            /**
             * Servicios cientificos 
             */
            'servcient' => array(
                array(
                    'preguntaid' => 'preg_servcient_comp',
                    'lft' => 1,
                    'rgt' => 8,
                ),
                array(
                    'preguntaid' => 'preg_servcient_subq',
                    'lft' => 2,
                    'rgt' => 3,
                ),
                array(
                    'preguntaid' => 'preg_servcient_sino',
                    'lft' => 4,
                    'rgt' => 5,
                ),
                array(
                    'preguntaid' => 'preg_servcient_cuales',
                    'lft' => 6,
                    'rgt' => 7,
                ),
            ),
            /**
             * Proyectos aprobados
             */
            'proyectosaprob' => array(
                array(
                    'preguntaid' => 'preg_proyectosaprob_comp',
                    'lft' => 1,
                    'rgt' => 6,
                ),
                array(
                    'preguntaid' => 'preg_proyectosaprob_subq',
                    'lft' => 2,
                    'rgt' => 3,
                ),
                array(
                    'preguntaid' => 'preg_proyectosaprob_num',
                    'lft' => 4,
                    'rgt' => 5,
                ),
            ),
            /**
             * Recursos aprobados
             */
            'recursosaprob' => array(
                array(
                    'preguntaid' => 'preg_recursosaprob_comp',
                    'lft' => 1,
                    'rgt' => 6,
                ),
                array(
                    'preguntaid' => 'preg_recursosaprob_subq',
                    'lft' => 2,
                    'rgt' => 3,
                ),
                array(
                    'preguntaid' => 'preg_recursosaprob_num',
                    'lft' => 4,
                    'rgt' => 5,
                ),
            ),
            /**
             * Proyectos aprobados por area
             */
            'proyectosaprob_area' => array(
                array(
                    'preguntaid' => 'preg_proyectosaprob_area_comp',
                    'lft' => 1,
                    'rgt' => 6,
                ),
                array(
                    'preguntaid' => 'preg_proyectosaprob_area_subq',
                    'lft' => 2,
                    'rgt' => 3,
                ),
                array(
                    'preguntaid' => 'preg_proyectosaprob_area_num',
                    'lft' => 4,
                    'rgt' => 5,
                ),
            ),
            /**
             * Recursos aprobados por area
             */
            'recursosaprob_area' => array(
                array(
                    'preguntaid' => 'preg_recursosaprob_area_comp',
                    'lft' => 1,
                    'rgt' => 6,
                ),
                array(
                    'preguntaid' => 'preg_recursosaprob_area_subq',
                    'lft' => 2,
                    'rgt' => 3,
                ),
                array(
                    'preguntaid' => 'preg_recursosaprob_area_num',
                    'lft' => 4,
                    'rgt' => 5,
                ),
            ),
            /**
             * Patentes
             */
            'patentes' => array(
                array(
                    'preguntaid' => 'preg_patentes_area_comp',
                    'lft' => 1,
                    'rgt' => 6,
                ),
                array(
                    'preguntaid' => 'preg_patentes_area_subq',
                    'lft' => 2,
                    'rgt' => 3,
                ),
                array(
                    'preguntaid' => 'preg_patentes_area_num',
                    'lft' => 4,
                    'rgt' => 5,
                ),
            ),
            /**
             * productos
             */
            'productos' => array(
                array(
                    'preguntaid' => 'preg_productos_compuesta',
                    'lft' => 1,
                    'rgt' => 6,
                ),
                array(
                    'preguntaid' => 'preg_productos_prod',
                    'lft' => 2,
                    'rgt' => 3,
                ),
                array(
                    'preguntaid' => 'preg_productos_numero',
                    'lft' => 4,
                    'rgt' => 5,
                ),
            ),
            /**
             * Revistas
             */
            'revistas' => array(
                array(
                    'preguntaid' => 'preg_revistas_area_comp',
                    'lft' => 1,
                    'rgt' => 8,
                ),
                array(
                    'preguntaid' => 'preg_revistas_area_subq',
                    'lft' => 2,
                    'rgt' => 3,
                ),
                array(
                    'preguntaid' => 'preg_revistas_area_revista',
                    'lft' => 4,
                    'rgt' => 5,
                ),
                array(
                    'preguntaid' => 'preg_revistas_area_num',
                    'lft' => 6,
                    'rgt' => 7,
                ),
            ),
            /**
             * Lineas de investigación
             */
            'lineas_inv' => array(
                array(
                    'preguntaid' => 'preg_lineas_inv_comp',
                    'lft' => 1,
                    'rgt' => 8,
                ),
                array(
                    'preguntaid' => 'preg_lineas_inv_lineasinv',
                    'lft' => 2,
                    'rgt' => 3,
                ),
                array(
                    'preguntaid' => 'preg_lineas_inv_ejestematico',
                    'lft' => 4,
                    'rgt' => 5,
                ),
                array(
                    'preguntaid' => 'preg_lineas_inv_programapost',
                    'lft' => 6,
                    'rgt' => 7,
                ),
            ),
            /**
             * Actores de financiamiento
             */
            'actores_fin' => array(
                array(
                    'preguntaid' => 'preg_actores_fin_comp',
                    'lft' => 1,
                    'rgt' => 6,
                ),
                array(
                    'preguntaid' => 'preg_actores_fin_actorespart',
                    'lft' => 2,
                    'rgt' => 3,
                ),
                array(
                    'preguntaid' => 'preg_actores_fin_actoresfin',
                    'lft' => 4,
                    'rgt' => 5,
                ),
            ),
            /**
             * Infraestructura
             */
            'infraestructura' => array(
                array(
                    'preguntaid' => 'preg_infraestructura_comp',
                    'lft' => 1,
                    'rgt' => 16,
                ),
                array(
                    'preguntaid' => 'preg_infraestructura_subq',
                    'lft' => 2,
                    'rgt' => 3,
                ),
                array(
                    'preguntaid' => 'preg_infraestructura_activa',
                    'lft' => 4,
                    'rgt' => 5,
                ),
                array(
                    'preguntaid' => 'preg_infraestructura_espacios',
                    'lft' => 6,
                    'rgt' => 7,
                ),
                array(
                    'preguntaid' => 'preg_infraestructura_equipamient',
                    'lft' => 8,
                    'rgt' => 9,
                ),
                array(
                    'preguntaid' => 'preg_infraestructura_usoinf_comp',
                    'lft' => 10,
                    'rgt' => 15,
                ),
                array(
                    'preguntaid' => 'preg_infraestructura_usodoc',
                    'lft' => 11,
                    'rgt' => 12,
                ),
                array(
                    'preguntaid' => 'preg_infraestructura_usoinv',
                    'lft' => 13,
                    'rgt' => 14,
                ),
            ),
            /**
             * Comite de ética2
             */
            'comiteetica2' => array(
                array(
                    'preguntaid' => 'preg_comiteetica2_composicion_co',
                    'lft' => 1,
                    'rgt' => 10,
                ),
                array(
                    'preguntaid' => 'preg_comiteetica2_ident',
                    'lft' => 2,
                    'rgt' => 3,
                ),
                array(
                    'preguntaid' => 'preg_comiteetica2_profesion',
                    'lft' => 4,
                    'rgt' => 5,
                ),
                array(
                    'preguntaid' => 'preg_comiteetica2_cargo',
                    'lft' => 6,
                    'rgt' => 7,
                ),
                array(
                    'preguntaid' => 'preg_comiteetica2_correo',
                    'lft' => 8,
                    'rgt' => 9,
                ),
            ),
            /**
             *  Revistas (Otros)
             */
            'revotro' => array(
                array(
                    'preguntaid' => 'preg_revotro_comp',
                    'lft' => 1,
                    'rgt' => 12,
                ),
                array(
                    'preguntaid' => 'preg_revotro_area',
                    'lft' => 2,
                    'rgt' => 3,
                ),
                array(
                    'preguntaid' => 'preg_revotro_nombre',
                    'lft' => 4,
                    'rgt' => 5,
                ),
                array(
                    'preguntaid' => 'preg_revotro_tipo',
                    'lft' => 6,
                    'rgt' => 7,
                ),
                array(
                    'preguntaid' => 'preg_revotro_peri',
                    'lft' => 8,
                    'rgt' => 9,
                ),
                array(
                    'preguntaid' => 'preg_revotro_dist',
                    'lft' => 10,
                    'rgt' => 11,
                ),
            ),
            
        );
        $sql = "INSERT INTO {{Preguntacompuesta}} (lft, rgt, pregunta_id, grupocomp_id) SELECT :lft AS lft, :rgt AS rgt, p.id AS pregunta_id, g.id AS grupocomp_id FROM {{Pregunta}} p JOIN {{Grupocomp}} g ON g.identificador=:grupoid WHERE p.identificador=:idpregunta";

        $commandPreguntaComp = Yii::app()->db->createCommand($sql);
        foreach ($arrayComp as $grupoId=>$val){
            foreach ($val as $pregunta) { 
                $commandPreguntaComp->bindValue(":lft",$pregunta['lft']);
                $commandPreguntaComp->bindValue(":rgt",$pregunta['rgt']);
                $commandPreguntaComp->bindValue(":idpregunta",$pregunta['preguntaid']);
                $commandPreguntaComp->bindValue(":grupoid",$grupoId);
                echo "Ejecutando comando con preguntaid " . $pregunta['preguntaid']
                    . "grupoid" . $grupoId . " lft=" . $pregunta['lft'] . " rgt=" . $pregunta['rgt'] .".\n";
                var_dump($commandPreguntaComp->execute());
            }
        }

        //Insertamos preguntas requeridas
        //TODO poner preguntas que faltan
        $sqlPreguntasRequeridas = <<<EOF
INSERT INTO {{Requerimientos}} (pregunta_id, tipo_requerimiento, tipoencuesta_id) (SELECT p.id AS pregunta_id, :tiporequerimiento AS tipo_requerimiento, t.id FROM {{Pregunta}} p INNER JOIN {{Tipoencuesta}} t ON t.identificador = :tipoencuesta_id WHERE p.identificador = :pregunta_id)
EOF;
        $identificadorRequeridas = array(
            'preg_datos_nom_entr',
            'preg_datos_universidad_pertenece',
            'preg_datos_ano_fundacion',
            'preg_datos_universidad_ubicacion',
            'preg_datos_municipio',
            'preg_datos_caracterpub',
            'preg_datos_tipoinst',
        );
        $commandRequeridas = Yii::app()->db->createCommand($sqlPreguntasRequeridas);
        foreach ($identificadorRequeridas as $v) {
            echo "Ejecutando comando requeridas para $v\n";
            $commandRequeridas->execute(array(
                ':pregunta_id' => $v,
                ':tiporequerimiento' => 'requerida',
                ':tipoencuesta_id' => 'tipoencuesta_uni',//TODO poner otros tipos de encuesta
            ));
        }
        
    }

}
