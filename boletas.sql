select id_alumno, nombre, a_paterno, a_materno, curp, id_grupo, grupo, id_materia, materia, promediobt1, num_inasistencias1, promediobt2, num_inasistencias2, promediobt3, num_inasistencias3, promediobt4, num_inasistencias4, promediobt5 , num_inasistencias5
from
(select alumnos.nombre as nombre, alumnos.a_paterno as a_paterno, alumnos.a_materno as a_materno, alumnos.curp as curp, inscripciones.id_grupo as id_grupo, cat_grupos.grupo as grupo, inscripciones.id_materia as id_materia, cat_materias.materia as materia, inscripciones.id_alumno as id_alumno, AVG((inscripciones.examen*0.4)+(inscripciones.tareas*0.2)+(inscripciones.trabajos*0.2)+(inscripciones.asistencias*0.2)+(inscripciones.puntos_extra)) as promediobt1, SUM(inscripciones.numero_inasistencias) as num_inasistencias1
from inscripciones
inner join materia_x_grupos
on materia_x_grupos.id_grupo = inscripciones.id_grupo
and materia_x_grupos.id_materia = inscripciones.id_materia
inner join cat_materias
on cat_materias.id_materia = inscripciones.id_materia
inner join cat_grupos
on cat_grupos.id_grupo = inscripciones.id_grupo
inner join alumnos
on inscripciones.id_alumno = alumnos.id_alumno
where inscripciones.id_grupo = 11 and inscripciones.bimestre_trimestre = 1
group by inscripciones.id_alumno, inscripciones.id_grupo, inscripciones.id_materia, cat_grupos.grupo, cat_materias.materia, alumnos.nombre, alumnos.a_paterno, alumnos.a_materno, alumnos.curp, inscripciones.bimestre_trimestre) as b1
inner join 
(select alumnos.curp as curp2, inscripciones.id_grupo as id_grupo2, inscripciones.id_materia as id_materia2, inscripciones.id_alumno as id_alumno2, AVG((inscripciones.examen*0.4)+(inscripciones.tareas*0.2)+(inscripciones.trabajos*0.2)+(inscripciones.asistencias*0.2)+(inscripciones.puntos_extra)) as promediobt2, SUM(inscripciones.numero_inasistencias) as num_inasistencias2
from inscripciones
inner join materia_x_grupos
on materia_x_grupos.id_grupo = inscripciones.id_grupo
and materia_x_grupos.id_materia = inscripciones.id_materia
inner join cat_materias
on cat_materias.id_materia = inscripciones.id_materia
inner join cat_grupos
on cat_grupos.id_grupo = inscripciones.id_grupo
inner join alumnos
on inscripciones.id_alumno = alumnos.id_alumno
where inscripciones.bimestre_trimestre = 2
group by inscripciones.id_alumno, inscripciones.id_grupo, inscripciones.id_materia, cat_grupos.grupo, cat_materias.materia, alumnos.nombre, alumnos.a_paterno, alumnos.a_materno, alumnos.curp, inscripciones.bimestre_trimestre) as b2
on b1.id_grupo = b2.id_grupo2 and b1.id_materia = b2.id_materia2 and b1.id_alumno = b2.id_alumno2
inner join 
(select alumnos.curp as curp3, inscripciones.id_grupo as id_grupo3, inscripciones.id_materia as id_materia3, inscripciones.id_alumno as id_alumno3, AVG((inscripciones.examen*0.4)+(inscripciones.tareas*0.2)+(inscripciones.trabajos*0.2)+(inscripciones.asistencias*0.2)+(inscripciones.puntos_extra)) as promediobt3, SUM(inscripciones.numero_inasistencias) as num_inasistencias3
from inscripciones
inner join materia_x_grupos
on materia_x_grupos.id_grupo = inscripciones.id_grupo
and materia_x_grupos.id_materia = inscripciones.id_materia
inner join cat_materias
on cat_materias.id_materia = inscripciones.id_materia
inner join cat_grupos
on cat_grupos.id_grupo = inscripciones.id_grupo
inner join alumnos
on inscripciones.id_alumno = alumnos.id_alumno
where inscripciones.bimestre_trimestre = 3
group by inscripciones.id_alumno, inscripciones.id_grupo, inscripciones.id_materia, cat_grupos.grupo, cat_materias.materia, alumnos.nombre, alumnos.a_paterno, alumnos.a_materno, alumnos.curp, inscripciones.bimestre_trimestre) as b3
on b1.id_grupo = b3.id_grupo3 and b1.id_materia = b3.id_materia3 and b1.id_alumno = b3.id_alumno3
inner join 
(select alumnos.curp as curp4, inscripciones.id_grupo as id_grupo4, inscripciones.id_materia as id_materia4, inscripciones.id_alumno as id_alumno4, AVG((inscripciones.examen*0.4)+(inscripciones.tareas*0.2)+(inscripciones.trabajos*0.2)+(inscripciones.asistencias*0.2)+(inscripciones.puntos_extra)) as promediobt4, SUM(inscripciones.numero_inasistencias) as num_inasistencias4
from inscripciones
inner join materia_x_grupos
on materia_x_grupos.id_grupo = inscripciones.id_grupo
and materia_x_grupos.id_materia = inscripciones.id_materia
inner join cat_materias
on cat_materias.id_materia = inscripciones.id_materia
inner join cat_grupos
on cat_grupos.id_grupo = inscripciones.id_grupo
inner join alumnos
on inscripciones.id_alumno = alumnos.id_alumno
where inscripciones.bimestre_trimestre = 4
group by inscripciones.id_alumno, inscripciones.id_grupo, inscripciones.id_materia, cat_grupos.grupo, cat_materias.materia, alumnos.nombre, alumnos.a_paterno, alumnos.a_materno, alumnos.curp, inscripciones.bimestre_trimestre) as b4
on b1.id_grupo = b4.id_grupo4 and b1.id_materia = b4.id_materia4 and b1.id_alumno = b4.id_alumno4
inner join 
(select alumnos.curp as curp5, inscripciones.id_grupo as id_grupo5, inscripciones.id_materia as id_materia5, inscripciones.id_alumno as id_alumno5, AVG((inscripciones.examen*0.4)+(inscripciones.tareas*0.2)+(inscripciones.trabajos*0.2)+(inscripciones.asistencias*0.2)+(inscripciones.puntos_extra)) as promediobt5, SUM(inscripciones.numero_inasistencias) as num_inasistencias5
from inscripciones
inner join materia_x_grupos
on materia_x_grupos.id_grupo = inscripciones.id_grupo
and materia_x_grupos.id_materia = inscripciones.id_materia
inner join cat_materias
on cat_materias.id_materia = inscripciones.id_materia
inner join cat_grupos
on cat_grupos.id_grupo = inscripciones.id_grupo
inner join alumnos
on inscripciones.id_alumno = alumnos.id_alumno
where inscripciones.bimestre_trimestre = 5
group by inscripciones.id_alumno, inscripciones.id_grupo, inscripciones.id_materia, cat_grupos.grupo, cat_materias.materia, alumnos.nombre, alumnos.a_paterno, alumnos.a_materno, alumnos.curp, inscripciones.bimestre_trimestre) as b5
on b1.id_grupo = b5.id_grupo5 and b1.id_materia = b5.id_materia5 and b1.id_alumno = b5.id_alumno5