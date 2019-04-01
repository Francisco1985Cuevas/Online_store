/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     11/02/2019 22:22:51                          */
/*==============================================================*/


drop table if exists AUDITORIAS;

drop table if exists CATEGORIAS;

drop table if exists CATEGORIAS_PRODUCTOS;

drop table if exists CIUDADES;

drop table if exists CONTACTOS;

drop table if exists DEPOSITOS;

drop table if exists DIRECCIONES;

drop table if exists DOCUMENTOS;

drop table if exists EMAILS;

drop table if exists NACIONALIDADES;

drop table if exists PAISES;

drop table if exists PEDIDOS;

drop table if exists PEDIDOS_DETALLE;

drop table if exists PERSONAS;

drop table if exists PRODUCTOS;

drop table if exists PRODUCTOS_X_DEPOSITO;

drop table if exists TIPOS_CONTACTOS;

drop table if exists TIPOS_DIRECCIONES;

drop table if exists TIPOS_DOCUMENTOS;

drop table if exists TIPOS_EMAIL;

drop table if exists TIPOS_PRODUCTOS;

drop table if exists TIPOS_USUARIOS;

drop table if exists USUARIOS;

/*==============================================================*/
/* Table: AUDITORIAS                                            */
/*==============================================================*/
create table AUDITORIAS
(
   AUDITORIA            int not null auto_increment,
   USUARIO              int not null,
   TABLA                varchar(60),
   ID                   int,
   CAMPOS               varchar(100),
   OLD_VALUE            varchar(100),
   NEW_VALUE            varchar(100),
   IP                   varchar(30),
   CREATED              datetime not null,
   primary key (AUDITORIA)
);

/*==============================================================*/
/* Table: CATEGORIAS                                            */
/*==============================================================*/
create table CATEGORIAS
(
   CATEGORIA            int not null auto_increment,
   NOMBRE               varchar(100),
   ABREVIATURA          varchar(3),
   COMENTARIO           varchar(1024),
   CREATED              datetime default CURRENT_TIMESTAMP,
   UPDATED              datetime,
   primary key (CATEGORIA)
);

/*==============================================================*/
/* Table: CATEGORIAS_PRODUCTOS                                  */
/*==============================================================*/
create table CATEGORIAS_PRODUCTOS
(
   CATEGORIA            int not null,
   PRODUCTO             int not null,
   CREATED              datetime default CURRENT_TIMESTAMP,
   UPDATED              datetime,
   primary key (CATEGORIA, PRODUCTO)
);

/*==============================================================*/
/* Table: CIUDADES                                              */
/*==============================================================*/
create table CIUDADES
(
   PAIS                 int not null,
   CIUDAD               int not null auto_increment,
   NOMBRE               varchar(60),
   ABREVIATURA          varchar(3),
   ESTADO               varchar(30),
   CREATED              datetime default CURRENT_TIMESTAMP,
   UPDATED              datetime,
   DELETED              datetime,
   primary key (CIUDAD)
);

/*==============================================================*/
/* Table: CONTACTOS                                             */
/*==============================================================*/
create table CONTACTOS
(
   CONTACTO             int not null auto_increment,
   PERSONA              int not null,
   TIPO_CONTACTO        int,
   NUMERO_CONTACTO      varchar(30),
   COMENTARIO           varchar(1024),
   CREATED              datetime default CURRENT_TIMESTAMP,
   UPDATED              datetime,
   primary key (CONTACTO, PERSONA)
);

/*==============================================================*/
/* Table: DEPOSITOS                                             */
/*==============================================================*/
create table DEPOSITOS
(
   DEPOSITO             int not null auto_increment,
   NOMBRE               varchar(60),
   ESTADO               char(1),
   ABREVIATURA          varchar(3),
   CREATED              datetime default CURRENT_TIMESTAMP,
   UPDATED              datetime,
   primary key (DEPOSITO)
);

/*==============================================================*/
/* Table: DIRECCIONES                                           */
/*==============================================================*/
create table DIRECCIONES
(
   DIRECCION            int not null auto_increment,
   PERSONA              int not null,
   TIPO_DIRECCION       int,
   CIUDAD               int,
   CALLE                varchar(250),
   NUMERO_CASA          varchar(10),
   PISO                 varchar(10),
   DEPARTAMENTO         varchar(20),
   COMENTARIO           varchar(1024),
   CREATED              datetime default CURRENT_TIMESTAMP,
   UPDATED              datetime,
   primary key (DIRECCION, PERSONA)
);

/*==============================================================*/
/* Table: DOCUMENTOS                                            */
/*==============================================================*/
create table DOCUMENTOS
(
   NUMERO               varchar(30) not null,
   PERSONA              int not null,
   TIPO_DOCUMENTO       int not null,
   CREATED              datetime default CURRENT_TIMESTAMP,
   UPDATED              datetime,
   primary key (NUMERO, PERSONA, TIPO_DOCUMENTO)
);

/*==============================================================*/
/* Table: EMAILS                                                */
/*==============================================================*/
create table EMAILS
(
   EMAIL                int not null auto_increment,
   PERSONA              int not null,
   TIPO_EMAIL           int,
   DESCRIPCION          varchar(250),
   OBSERVACIONES        varchar(1024),
   CREATED              datetime default CURRENT_TIMESTAMP,
   UPDATED              datetime,
   primary key (EMAIL, PERSONA)
);

/*==============================================================*/
/* Table: NACIONALIDADES                                        */
/*==============================================================*/
create table NACIONALIDADES
(
   PERSONA              int not null,
   PAIS                 int not null,
   CREATED              datetime default CURRENT_TIMESTAMP,
   UPDATED              datetime,
   primary key (PERSONA, PAIS)
);

/*==============================================================*/
/* Table: PAISES                                                */
/*==============================================================*/
create table PAISES
(
   PAIS                 int not null auto_increment,
   NOMBRE               varchar(60) not null,
   NACIONALIDAD         varchar(60),
   ABREVIATURA          varchar(3),
   ESTADO               varchar(30),
   CREATED              datetime default CURRENT_TIMESTAMP,
   UPDATED              datetime,
   DELETED              datetime,
   primary key (PAIS)
);

/*==============================================================*/
/* Table: PEDIDOS                                               */
/*==============================================================*/
create table PEDIDOS
(
   PEDIDO               int not null auto_increment,
   USUARIO              int,
   FECHA_PEDIDO         datetime,
   CONDICION_VENTA      char(1),
   TOTAL_MONTO          float(19,2),
   TOTAL_IVA            float(19,2),
   CREATED              datetime default CURRENT_TIMESTAMP,
   UPDATED              datetime,
   primary key (PEDIDO)
);

/*==============================================================*/
/* Table: PEDIDOS_DETALLE                                       */
/*==============================================================*/
create table PEDIDOS_DETALLE
(
   PEDIDO               int not null,
   ITEM                 int not null,
   PRODUCTO             int,
   DEPOSITO             int,
   CANTIDAD             int,
   DESCRIPCION          varchar(50),
   TOTAL_MONTO_PRODUCTO float(19,2),
   TOTAL_MONTO_IVA      float(19,2),
   CREATED              datetime default CURRENT_TIMESTAMP,
   UPDATED              datetime,
   primary key (PEDIDO, ITEM)
);

/*==============================================================*/
/* Table: PERSONAS                                              */
/*==============================================================*/
create table PERSONAS
(
   PERSONA              int not null auto_increment,
   NOMBRES              varchar(100),
   APELLIDOS            varchar(60),
   FECHA_NACIMIENTO     date,
   SEXO                 char(1),
   FOTO                 varchar(250),
   CREATED              datetime default CURRENT_TIMESTAMP,
   UPDATED              datetime,
   primary key (PERSONA)
);

/*==============================================================*/
/* Table: PRODUCTOS                                             */
/*==============================================================*/
create table PRODUCTOS
(
   PRODUCTO             int not null auto_increment,
   NOMBRE               varchar(60),
   PRECIO               float(19,2),
   ABREVIATURA          varchar(3),
   COMENTARIO           varchar(1024),
   FOTO                 varchar(250),
   TIPO_PRODUCTO        int,
   CREATED              datetime default CURRENT_TIMESTAMP,
   UPDATED              datetime default CURRENT_TIMESTAMP,
   primary key (PRODUCTO)
);

/*==============================================================*/
/* Table: PRODUCTOS_X_DEPOSITO                                  */
/*==============================================================*/
create table PRODUCTOS_X_DEPOSITO
(
   PRODUCTO             int not null,
   DEPOSITO             int not null,
   CANTIDAD             int,
   CREATED              datetime default CURRENT_TIMESTAMP,
   UPDATED              datetime,
   primary key (PRODUCTO, DEPOSITO)
);

/*==============================================================*/
/* Table: TIPOS_CONTACTOS                                       */
/*==============================================================*/
create table TIPOS_CONTACTOS
(
   TIPO_CONTACTO        int not null auto_increment,
   DESCRIPCION          varchar(60),
   CREATED              datetime default CURRENT_TIMESTAMP,
   UPDATED              datetime,
   primary key (TIPO_CONTACTO)
);

/*==============================================================*/
/* Table: TIPOS_DIRECCIONES                                     */
/*==============================================================*/
create table TIPOS_DIRECCIONES
(
   TIPO_DIRECCION       int not null auto_increment,
   DESCRIPCION          varchar(60),
   CREATED              datetime default CURRENT_TIMESTAMP,
   UPDATED              datetime,
   primary key (TIPO_DIRECCION)
);

/*==============================================================*/
/* Table: TIPOS_DOCUMENTOS                                      */
/*==============================================================*/
create table TIPOS_DOCUMENTOS
(
   TIPO_DOCUMENTO       int not null auto_increment,
   NOMBRE               varchar(60),
   ABREVIATURA          varchar(3),
   CREATED              datetime default CURRENT_TIMESTAMP,
   UPDATED              datetime,
   primary key (TIPO_DOCUMENTO)
);

/*==============================================================*/
/* Table: TIPOS_EMAIL                                           */
/*==============================================================*/
create table TIPOS_EMAIL
(
   TIPO_EMAIL           int not null auto_increment,
   DESCRIPCION          varchar(60),
   CREATED              datetime default CURRENT_TIMESTAMP,
   UPDATED              datetime,
   primary key (TIPO_EMAIL)
);

/*==============================================================*/
/* Table: TIPOS_PRODUCTOS                                       */
/*==============================================================*/
create table TIPOS_PRODUCTOS
(
   TIPO_PRODUCTO        int not null auto_increment,
   DESCRIPCION          varchar(60),
   ABREVIATURA          varchar(3),
   COMENTARIO           varchar(1024),
   CREATED              datetime default CURRENT_TIMESTAMP,
   UPDATED              datetime default CURRENT_TIMESTAMP,
   primary key (TIPO_PRODUCTO)
);

/*==============================================================*/
/* Table: TIPOS_USUARIOS                                        */
/*==============================================================*/
create table TIPOS_USUARIOS
(
   TIPO_USUARIO         int not null auto_increment,
   DESCRIPCION          varchar(60),
   ABREVIATURA          varchar(3),
   COMENTARIO           varchar(1024),
   CREATED              datetime default CURRENT_TIMESTAMP,
   UPDATED              datetime,
   primary key (TIPO_USUARIO)
);

/*==============================================================*/
/* Table: USUARIOS                                              */
/*==============================================================*/
create table USUARIOS
(
   USUARIO              int not null auto_increment,
   PERSONA              int,
   TIPO_USUARIO         int,
   NOMBRE               varchar(50),
   NOMBRE_USUARIO       varchar(50),
   PASSWORD             varchar(30),
   ESTADO               char(1),
   ULTIMA_SESSION       datetime,
   CREATED              datetime default CURRENT_TIMESTAMP,
   UPDATED              datetime,
   primary key (USUARIO)
);

alter table AUDITORIAS add constraint FK_AUDITORIAS_USUARIOS foreign key (USUARIO)
      references USUARIOS (USUARIO) on delete restrict on update cascade;

alter table CATEGORIAS_PRODUCTOS add constraint FK_CATEGORIASPRODUCTOS_CATEGORIA foreign key (CATEGORIA)
      references CATEGORIAS (CATEGORIA) on delete restrict on update restrict;

alter table CATEGORIAS_PRODUCTOS add constraint FK_CATEGORIASPRODUCTOS_PRODUCTO foreign key (PRODUCTO)
      references PRODUCTOS (PRODUCTO) on delete restrict on update restrict;

alter table CIUDADES add constraint FK_CIUDADES_PAIS foreign key (PAIS)
      references PAISES (PAIS) on delete restrict on update cascade;

alter table CONTACTOS add constraint FK_CONTACTOS_PERSONA foreign key (PERSONA)
      references PERSONAS (PERSONA) on delete restrict on update restrict;

alter table CONTACTOS add constraint FK_CONTACTOS_TIPOCONTACTO foreign key (TIPO_CONTACTO)
      references TIPOS_CONTACTOS (TIPO_CONTACTO) on delete restrict on update restrict;

alter table DIRECCIONES add constraint FK_DIRECCIONES_PERSONA foreign key (PERSONA)
      references PERSONAS (PERSONA) on delete restrict on update restrict;

alter table DIRECCIONES add constraint FK_DIRECCIONES_TIPODIRECCION foreign key (TIPO_DIRECCION)
      references TIPOS_DIRECCIONES (TIPO_DIRECCION) on delete restrict on update restrict;

alter table DIRECCIONES add constraint FK_DIRECCIONES_CIUDAD foreign key (CIUDAD)
      references CIUDADES (CIUDAD) on delete restrict on update restrict;

alter table DOCUMENTOS add constraint FK_DOCUMENTOS_PERSONA foreign key (PERSONA)
      references PERSONAS (PERSONA) on delete restrict on update restrict;

alter table DOCUMENTOS add constraint FK_DOCUMENTOS_TIPODOCUMENTO foreign key (TIPO_DOCUMENTO)
      references TIPOS_DOCUMENTOS (TIPO_DOCUMENTO) on delete restrict on update restrict;

alter table EMAILS add constraint FK_EMAILS_TIPOEMAIL foreign key (TIPO_EMAIL)
      references TIPOS_EMAIL (TIPO_EMAIL) on delete restrict on update restrict;

alter table EMAILS add constraint FK_EMAILS_PERSONA foreign key (PERSONA)
      references PERSONAS (PERSONA) on delete restrict on update restrict;

alter table NACIONALIDADES add constraint FK_NACIONALIDADES_PAIS foreign key (PAIS)
      references PAISES (PAIS) on delete restrict on update restrict;

alter table NACIONALIDADES add constraint FK_NACIONALIDADES_PERSONA foreign key (PERSONA)
      references PERSONAS (PERSONA) on delete restrict on update restrict;

alter table PEDIDOS add constraint FK_PEDIDOS_USUARIO foreign key (USUARIO)
      references USUARIOS (USUARIO) on delete restrict on update restrict;

alter table PEDIDOS_DETALLE add constraint FK_PEDIDOSDETALLE_PEDIDO foreign key (PEDIDO)
      references PEDIDOS (PEDIDO) on delete restrict on update restrict;

alter table PEDIDOS_DETALLE add constraint FK_PEDIDOSDETALLE_PRODUCTODEPOSITO foreign key (PRODUCTO, DEPOSITO)
      references PRODUCTOS_X_DEPOSITO (PRODUCTO, DEPOSITO) on delete restrict on update restrict;

alter table PRODUCTOS add constraint FK_PRODUCTOS_TIPOPRODUCTO foreign key (TIPO_PRODUCTO)
      references TIPOS_PRODUCTOS (TIPO_PRODUCTO) on delete restrict on update restrict;

alter table PRODUCTOS_X_DEPOSITO add constraint FK_PRODUCTOSDEPOSITO_DEPOSITO foreign key (DEPOSITO)
      references DEPOSITOS (DEPOSITO) on delete restrict on update restrict;

alter table PRODUCTOS_X_DEPOSITO add constraint FK_PRODUCTOSDEPOSITO_PRODUCTO foreign key (PRODUCTO)
      references PRODUCTOS (PRODUCTO) on delete restrict on update restrict;

alter table USUARIOS add constraint FK_USUARIOS_TIPOUSUARIO foreign key (TIPO_USUARIO)
      references TIPOS_USUARIOS (TIPO_USUARIO) on delete restrict on update restrict;

alter table USUARIOS add constraint FK_USUARIOS_PERSONA foreign key (PERSONA)
      references PERSONAS (PERSONA) on delete restrict on update restrict;

