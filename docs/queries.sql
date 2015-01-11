-- Obtención de la suma de proyectos de innovación, estos pueden ser por usuario entre otros
-- NOTE: Notese que podríamos también hacer group por usuario si queremos obtener los proyectos por persona
-- Note: Estos agrupamientos se deben hacer por group by opc.id, ra.user_id
-- Esto resuelve los indicadores del 1 al 11
SELECT COUNT(ra.valor), opc.identificador FROM `sectir_Respuestaabierta` ra
	INNER JOIN `sectir_Opcioncomp` opc ON ra.opcioncomp_id = opc.id
    INNER JOIN `sectir_Pregunta` p ON ra.pregunta_id = p.id
    INNER JOIN (
        SELECT _ra.opcioncomp_id AS id, _ra.user_id, _ra.encuesta_id FROM `sectir_Respuestaabierta` _ra
        	INNER JOIN `sectir_Pregunta` _p ON _ra.pregunta_id = _p.id
        WHERE _ra.valor = 1 AND _p.identificador = "preg_actividadesciencia_sino"
    ) sub ON sub.id = ra.opcioncomp_id AND sub.user_id = ra.user_id AND sub.encuesta_id = ra.encuesta_id
WHERE ra.encuesta_id = 1 AND ra.valor <> "" AND p.identificador = "preg_actividadesciencia_cuales"
GROUP BY opc.id

-- Con esto solucionamos items 12 y 13
SELECT COUNT(ra.valor) FROM `sectir_Respuestaabierta` ra
	INNER JOIN `sectir_Pregunta` p ON ra.pregunta_id = p.id
WHERE ra.valor = "1" AND ra.encuesta_id = 1 AND p.identificador IN ('preg_talentohumano_pei_inv', 'preg_talentohumano_pei_inn')
GROUP BY ra.user_id,p.id

-- Item 14 Solucionado acá
-- NOTE: Aquí usamos opciones, quizás esto serviría para todas las preguntas de tipo opción
SELECT COUNT(ro.opcion_id),ro.user_id, o.identificador,o.enunciado FROM `sectir_Respuestaopc` ro
	INNER JOIN `sectir_Pregunta` p ON ro.pregunta_id = p.id
    INNER JOIN `sectir_Opcion` o ON ro.opcion_id = o.id
WHERE ro.encuesta_id = 1 AND p.identificador = 'preg_talentohumano_nivelac'
GROUP BY ro.user_id, ro.opcion_id

-- Items 15-17 Solucionados aquí
SELECT COUNT(ra.valor), p.identificador, p.user_id FROM `sectir_Respuestaabierta` ra
	INNER JOIN `sectir_Pregunta` p ON ra.pregunta_id = p.id
WHERE ra.valor = "1" AND ra.encuesta_id = 1 AND p.identificador 
    IN ('preg_talentohumano_nacionalpub', 'preg_talentohumano_nacionalpri', 'preg_talentohumano_internacional')
GROUP BY ra.user_id,p.id

-- Item 18 Solucionado
-- NOTE: De cuenta que es igual al item 14
SELECT COUNT(ro.opcion_id),ro.user_id, o.identificador,o.enunciado FROM `sectir_Respuestaopc` ro
	INNER JOIN `sectir_Pregunta` p ON ro.pregunta_id = p.id
    INNER JOIN `sectir_Opcion` o ON ro.opcion_id = o.id
WHERE ro.encuesta_id = 1 AND p.identificador = 'preg_talentohumano_fuentefin'
GROUP BY ro.user_id, ro.opcion_id

-- Items 19-22 Solucionados
SELECT COUNT(ra.valor), p.identificador FROM `sectir_Respuestaabierta` ra
	INNER JOIN `sectir_Pregunta` p ON ra.pregunta_id = p.id
WHERE p.identificador IN 
	('preg_doctorado_existente', 'preg_maestria_existente', 'preg_especialidades_existente', 'preg_pregrado_existente')
AND ra.encuesta_id = 1 AND ra.valor <> ""
GROUP BY ra.user_id, p.id

-- Esto soluciona items 23-26 
-- NOTE Tomar en cuenta el group by
-- NOTE Tendriamos que agrupar por año, user o ambos junto con pregunta_id
-- para evitar que doctorados se mezclen con maestrías y así
SELECT SUM(ra.valor) AS suma, p.identificador FROM `sectir_Respuestaano` ra
	INNER JOIN `sectir_Pregunta` p ON ra.pregunta_id = p.id
WHERE ra.encuesta_id = 1 AND p.identificador IN ('preg_doctorado_numero', 'preg_maestria_numero', 'preg_especialidades_numero', 'preg_pregrado_numero')
GROUP BY ra.pregunta_id
-- Para proyectos aprobados (Item 27)
-- NOTE: Lo mismo para recursos aprobados, y para los demas items (28-31), solo reemplazar identificador
SELECT SUM(ra.valor), ra.ano AS suma, p.identificador FROM `sectir_Respuestaano` ra
	INNER JOIN `sectir_Pregunta` p ON ra.pregunta_id = p.id
WHERE ra.encuesta_id = 1 AND p.identificador IN ('preg_proyectosaprob_num')
GROUP BY ra.pregunta_id,ra.ano

-- Item 32
-- Similar a 19-22
SELECT COUNT(ra.valor), p.identificador FROM `sectir_Respuestaabierta` ra
	INNER JOIN `sectir_Pregunta` p ON ra.pregunta_id = p.id
WHERE p.identificador IN 
	('preg_revistas_area_revista')
AND ra.encuesta_id = 1 AND ra.valor <> ""
GROUP BY ra.user_id, p.id

-- QUery para publicaciones de revistas por area 33
SELECT SUM(ra.valor), opc.identificador FROM `sectir_Respuestaano` ra
	INNER JOIN `sectir_Opcioncomp` opc ON ra.opcioncomp_id = opc.id
    INNER JOIN `sectir_Pregunta` p ON ra.pregunta_id = p.id
    INNER JOIN (
        SELECT _ra.opcioncomp_id AS id, _ra.user_id, _ra.encuesta_id FROM `sectir_Respuestaabierta` _ra
        	INNER JOIN `sectir_Pregunta` _p ON _ra.pregunta_id = _p.id
        WHERE _ra.valor <> "" AND _p.identificador = "preg_revistas_area_revista"
    ) sub ON sub.id = ra.opcioncomp_id AND sub.user_id = ra.user_id AND sub.encuesta_id = ra.encuesta_id
WHERE ra.encuesta_id = 1 AND ra.valor <> "" AND p.identificador = "preg_revistas_area_num"
GROUP BY opc.id, ra.user_id

-- No continúo ya que las demás son parecidas
