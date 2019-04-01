insert into tipos_usuarios(ABREVIATURA, COMENTARIO, CREATED, DESCRIPCION, UPDATED) values('MAN', 'Usuario único con todos los privilegios y acceso a todo movimiento de cada administrador creado.', now(), 'Manager', now());
insert into tipos_usuarios(ABREVIATURA, COMENTARIO, CREATED, DESCRIPCION, UPDATED) values('ADM', 'Usuario con todos los privilegios sobre el SISTEMA y a cargo de toda la gestión y administración del sitio.', now(), 'Administrador', now());
insert into tipos_usuarios(ABREVIATURA, COMENTARIO, CREATED, DESCRIPCION, UPDATED) values('SUP', 'Usuario a cargo de un administrador, puede crear sesiones y gestionar moderadores y usuarios.', now(), 'Supervisor', now());
insert into tipos_usuarios(ABREVIATURA, COMENTARIO, CREATED, DESCRIPCION, UPDATED) values('MOD', 'Usuario a cargo de sus propias salas asignadas con capacidad', now(), 'Moderador', now());
insert into tipos_usuarios(ABREVIATURA, COMENTARIO, CREATED, DESCRIPCION, UPDATED) values('UA', 'Un usuario anónimo en informática es aquel que navega en sitios web (o usa cualquier servicio de la Internet) sin identificarse como usuario registrado. ', now(), 'Usuario anónimo', now());
insert into tipos_usuarios(ABREVIATURA, COMENTARIO, CREATED, DESCRIPCION, UPDATED) values('UBT', 'En el proceso del desarrollo de software, existe un usuario intermedio entre el desarrollador y el usuario final, que se encarga de comprobar que el programa trabaje de la forma prevista. La tarea de los beta testers es reportar errores al programador/desarrollador, y es en gran medida responsable de que el programa llegue al usuario final sin errores.', now(), 'Usuario beta tester', now());
insert into tipos_usuarios(ABREVIATURA, COMENTARIO, CREATED, DESCRIPCION, UPDATED) values('UR', 'Se refiere a aquellas personas o usuarios que para utilizar un servicio online tienen un identificador y una clave que le permite el acceso al sistema.', now(), 'Usuario Registrado', now());


insert into categorias(ABREVIATURA, NOMBRE, CREATED, COMENTARIO, UPDATED) values('AL', 'Arte y Literatura', now(), 'Arte y Literatura', now());
insert into categorias(ABREVIATURA, NOMBRE, CREATED, COMENTARIO, UPDATED) values('DEP', 'Deportes', now(), 'Deportes', now());
insert into categorias(ABREVIATURA, NOMBRE, CREATED, COMENTARIO, UPDATED) values('ENT', 'Entretenimientos', now(), 'Entretenimientos', now());
insert into categorias(ABREVIATURA, NOMBRE, CREATED, COMENTARIO, UPDATED) values('IG', 'Interes General', now(), 'Interés General', now());
insert into categorias(ABREVIATURA, NOMBRE, CREATED, COMENTARIO, UPDATED) values('MUS', 'Músicas', now(), 'Música', now());
insert into categorias(ABREVIATURA, NOMBRE, CREATED, COMENTARIO, UPDATED) values('ORG', 'Categoria de Organizaciones', now(), 'Organizaciones', now());
insert into categorias(ABREVIATURA, NOMBRE, CREATED, COMENTARIO, UPDATED) values('GAS', 'Gastronomia y Recetas de Cocina', now(), 'Gastronomia y Recetas de Cocina', now());
insert into categorias(ABREVIATURA, NOMBRE, CREATED, COMENTARIO, UPDATED) values('CLO', 'Clothing', now(), 'Ropa', now());
insert into categorias(ABREVIATURA, NOMBRE, CREATED, COMENTARIO, UPDATED) values('MEN', 'Men', now(), 'Men', now());
insert into categorias(ABREVIATURA, NOMBRE, CREATED, COMENTARIO, UPDATED) values('TS', 'T-Shirts', now(), 'Playeras', now());
insert into categorias(ABREVIATURA, NOMBRE, CREATED, COMENTARIO, UPDATED) values('HOO', 'Hoodies', now(), 'Sudaderas con capucha', now());
insert into categorias(ABREVIATURA, NOMBRE, CREATED, COMENTARIO, UPDATED) values('WO', 'Women', now(), 'Women', now());
insert into categorias(ABREVIATURA, NOMBRE, CREATED, COMENTARIO, UPDATED) values('INT', 'Internet', now(), 'Internet', now());
insert into categorias(ABREVIATURA, NOMBRE, CREATED, COMENTARIO, UPDATED) values('SEH', 'Self-help', now(), 'Self-help', now());
insert into categorias(ABREVIATURA, NOMBRE, CREATED, COMENTARIO, UPDATED) values('FIC', 'Fiction', now(), 'Fiction', now());
insert into categorias(ABREVIATURA, NOMBRE, CREATED, COMENTARIO, UPDATED) values('GAR', 'Gardening', now(), 'Gardening', now());


insert into paises(ABREVIATURA, NACIONALIDAD, CREATED, NOMBRE, UPDATED) values('PAR', 'Paraguaya', now(), 'Paraguay', now());
insert into paises(ABREVIATURA, NACIONALIDAD, CREATED, NOMBRE, UPDATED) values('URU', 'Uruguaya', now(), 'Uruguay', now());
insert into paises(ABREVIATURA, NACIONALIDAD, CREATED, NOMBRE, UPDATED) values('ARG', 'Argentina', now(), 'Argentina', now());
insert into paises(ABREVIATURA, NACIONALIDAD, CREATED, NOMBRE, UPDATED) values('BOL', 'Boliviana', now(), 'Bolivia', now());
insert into paises(ABREVIATURA, NACIONALIDAD, CREATED, NOMBRE, UPDATED) values('BR', 'Brasileña', now(), 'Brasil', now());
insert into paises(ABREVIATURA, NACIONALIDAD, CREATED, NOMBRE, UPDATED) values('CH', 'Chilena', now(), 'Chile', now());
insert into paises(ABREVIATURA, NACIONALIDAD, CREATED, NOMBRE, UPDATED) values('COL', 'Colombiana', now(), 'Colombia', now());
insert into paises(ABREVIATURA, NACIONALIDAD, CREATED, NOMBRE, UPDATED) values('EU', 'EstadoUnidense', now(), 'Estados Unidos', now());



insert into ciudades(ABREVIATURA, PAIS, CREATED, NOMBRE, UPDATED) values('ASU', 'Paraguay, Asuncion', now(), 'Asuncion', now());
insert into ciudades(ABREVIATURA, PAIS, CREATED, NOMBRE, UPDATED) values('FDO', 'Paraguay, Fernando de la Mora', now(), 'Fernando de la Mora', now());
insert into ciudades(ABREVIATURA, PAIS, CREATED, NOMBRE, UPDATED) values('LAM', 'Paraguay, Lambare', now(), 'Lambare', now());
insert into ciudades(ABREVIATURA, PAIS, CREATED, NOMBRE, UPDATED) values('DES', 'Ciudad por Default', now(), 'Desconocida', now());


insert into personas(NOMBRES, FECHA_NACIMIENTO, SEXO, CREATED, UPDATED) values('Persona1', now(), 'f', now(), now());


insert into usuarios(PERSONA, TIPO_USUARIO, NOMBRE, CREATED, UPDATED) values('1', '1', 'Usuario1', now(), now());


insert into productos(NOMBRE, PRECIO, CREATED, UPDATED) values('Grifo para Lavatorio de Mesa Pico Alto Trio.', '200000', now(), now());
insert into productos(NOMBRE, PRECIO, CREATED, UPDATED) values('Mezclador para Lavatorio de Mesa Pico Alto Trio.', '250000', now(), now());
insert into productos(NOMBRE, PRECIO, CREATED, UPDATED) values('Mezclador para Tina y Ducha Trio', '185000', now(), now());


insert into productos(NOMBRE, PRECIO, COMENTARIO, CREATED, UPDATED) values('PHP and MySQL Web Development', '50000', 'PHP & MySQL Web Development teaches the reader to develop dynamic, secure e-commerce web sites. You will learn to integrate and implement these technologies by following real-world examples and working sample projects.', now(), now());
insert into productos(NOMBRE, PRECIO, COMENTARIO, CREATED, UPDATED) values('Sams Teach Yourself PHP4 in 24 Hours', '70000', 'Consisting of 24 one-hour lessons, Sams Teach Yourself PHP4 in 24 Hours is divided into five sections that guide you through the language from the basics to the advanced functions.', now(), now());
insert into productos(NOMBRE, PRECIO, COMENTARIO, CREATED, UPDATED) values('PHP Developer\'s Cookbook', '100000', 'Provides a complete, solutions-oriented guide to the challenges most often faced by PHP developers\r\nWritten specifically for experienced Web developers, the book offers real-world solutions to real-world needs\r\n', now(), now());



insert into categorias_productos(CATEGORIA, PRODUCTO, CREATED, UPDATED) values('17', '4', now(), now());
insert into categorias_productos(CATEGORIA, PRODUCTO, CREATED, UPDATED) values('17', '5', now(), now());
insert into categorias_productos(CATEGORIA, PRODUCTO, CREATED, UPDATED) values('17', '6', now(), now());

