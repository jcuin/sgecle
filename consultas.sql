select materia_x_grupos.id_materia
from materia_x_grupos
left join inscripciones
on materia_x_grupos.id_grupo = inscripciones.id_grupo 
and materia_x_grupos.id_materia = inscripciones.id_materia
where materia_x_grupos.id_grupo = 5 and inscripciones.id_alumno is null