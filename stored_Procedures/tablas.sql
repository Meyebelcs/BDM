CREATE DATABASE StockCustom;
USE StockCustom;

CREATE TABLE Estatus (
   idStatus INT(10) UNSIGNED AUTO_INCREMENT,
   Nombre VARCHAR(50) NOT NULL,
   PRIMARY KEY (idStatus)
);

CREATE TABLE Usuario (
   idUsuario INT(10) UNSIGNED AUTO_INCREMENT,
   idStatus INT(10) UNSIGNED NOT NULL,
   Email VARCHAR(255) NOT NULL,
   Username VARCHAR(50) NOT NULL,
   Contraseña VARCHAR(10) NOT NULL,
   Rol VARCHAR(15) NOT NULL,
   Imagen VARCHAR(255), -- almacena la dirección o nombre del archivo
   Nombres VARCHAR(100) NOT NULL,
   Apellidos VARCHAR(100) NOT NULL,
   Fecha_nacimiento DATE NOT NULL,
   Sexo VARCHAR(10) NOT NULL,
   Fecha_registro DATETIME NOT NULL,
   Modo VARCHAR(20) NOT NULL,
   Fecha_modificación DATETIME NOT NULL,
   PRIMARY KEY (idUsuario),
   CONSTRAINT FK_Usuario_idStatus FOREIGN KEY (idStatus) REFERENCES Estatus(idStatus)
);

CREATE TABLE Producto (
   idProducto INT(10) UNSIGNED AUTO_INCREMENT,
   idAdminAutorización INT(10) UNSIGNED,
   idStatus INT(10) UNSIGNED NOT NULL,
   idUsuarioCreador INT(10) UNSIGNED NOT NULL,
   Nombre VARCHAR(255) NOT NULL,
   Descripción TEXT NOT NULL,
   Precio DECIMAL(10, 2) NULL,
   Inventario INT(10) NULL,
   Fecha_publicación DATETIME NOT NULL,
   Fecha_actualizacion DATETIME NOT NULL,
   Tipo VARCHAR(50) NOT NULL,
   PRIMARY KEY (idProducto),
   CONSTRAINT FK_Producto_AdminUsuario FOREIGN KEY (idAdminAutorización) REFERENCES Usuario(idUsuario),
   CONSTRAINT FK_Producto_Estatus FOREIGN KEY (idStatus) REFERENCES Estatus(idStatus),
   CONSTRAINT FK_Producto_Usuario FOREIGN KEY (idUsuarioCreador) REFERENCES Usuario(idUsuario)
);

CREATE TABLE PromedioCalificacion (
   idPromedioCalificacion INT(10) UNSIGNED AUTO_INCREMENT,
   idProducto INT(10) UNSIGNED,
   promedio INT(10) NULL,
   PRIMARY KEY (idPromedioCalificacion),
   CONSTRAINT FK_PromedioCalificacion_idProducto FOREIGN KEY (idProducto) REFERENCES Producto(idProducto)
);


CREATE TABLE Material_Inventario (
   idMaterial INT(10) UNSIGNED AUTO_INCREMENT,
   idProducto INT(10) UNSIGNED NOT NULL,
   idStatus INT(10) UNSIGNED NOT NULL,
   Fecha_creacion DATETIME NOT NULL,
   Nombre VARCHAR(100) NOT NULL,
   Cantidad INT(10) NOT NULL,
   PRIMARY KEY (idMaterial),
   CONSTRAINT FK_MaterialInventario_Producto FOREIGN KEY (idProducto) REFERENCES Producto(idProducto),
   CONSTRAINT FK_MaterialInventario_Estatus FOREIGN KEY (idStatus) REFERENCES Estatus(idStatus)
);

CREATE TABLE Lista (
   idLista INT(10) UNSIGNED AUTO_INCREMENT,
   idStatus INT(10) UNSIGNED NOT NULL,
   idUsuarioCreador INT(10) UNSIGNED NOT NULL,
   Nombre VARCHAR(255) NOT NULL,
   Descripción TEXT NOT NULL,
   Imagen VARCHAR(255) NOT NULL,
   Fecha_creacion DATETIME NOT NULL,
   Modo VARCHAR(50) NOT NULL,
   PRIMARY KEY (idLista),
   CONSTRAINT FK_Lista_UsuarioCreador FOREIGN KEY (idUsuarioCreador) REFERENCES Usuario(idUsuario),
   CONSTRAINT FK_Lista_Estatus FOREIGN KEY (idStatus) REFERENCES Estatus(idStatus)
);

CREATE TABLE Categoria (
   idCategoria INT(10) UNSIGNED AUTO_INCREMENT,
   idUsuarioCreador INT(10) UNSIGNED NOT NULL,
   idStatus INT(10) UNSIGNED NOT NULL,
   Nombre VARCHAR(255) NOT NULL,
   Descripcion TEXT NOT NULL,
   Fecha_creacion DATETIME NOT NULL,
   PRIMARY KEY (idCategoria),
   CONSTRAINT FK_Categoria_UsuarioCreador FOREIGN KEY (idUsuarioCreador) REFERENCES Usuario(idUsuario),
   CONSTRAINT FK_Categoria_Estatus FOREIGN KEY (idStatus) REFERENCES Estatus(idStatus)
);

CREATE TABLE ProductoEnLista (
   idProductoEnLista INT(10) UNSIGNED AUTO_INCREMENT,
   idProducto INT(10) UNSIGNED NOT NULL,
   idUsuarioCreador INT(10) UNSIGNED NOT NULL,
   idLista INT(10) UNSIGNED NOT NULL,
   PRIMARY KEY (idProductoEnLista),
   CONSTRAINT FK_ProductoEnLista_Producto FOREIGN KEY (idProducto) REFERENCES Producto(idProducto),
   CONSTRAINT FK_ProductoEnLista_UsuarioCreador FOREIGN KEY (idUsuarioCreador) REFERENCES Usuario(idUsuario),
   CONSTRAINT FK_ProductoEnLista_Lista FOREIGN KEY (idLista) REFERENCES Lista(idLista)
);

CREATE TABLE ProductosConCategoria (
   idProductosConCategoria INT(10) UNSIGNED AUTO_INCREMENT,
   idCategoria INT(10) UNSIGNED NOT NULL,
   idProducto INT(10) UNSIGNED NOT NULL,
   idStatus INT(10) UNSIGNED NOT NULL,
   PRIMARY KEY (idProductosConCategoria),
   CONSTRAINT FK_ProductosConCategoria_Categoria FOREIGN KEY (idCategoria) REFERENCES Categoria(idCategoria),
   CONSTRAINT FK_ProductosConCategoria_Producto FOREIGN KEY (idProducto) REFERENCES Producto(idProducto),
   CONSTRAINT FK_ProductosConCategoria_Estatus FOREIGN KEY (idStatus) REFERENCES Estatus(idStatus)
);

CREATE TABLE Comentario (
   idComentario INT(10) UNSIGNED AUTO_INCREMENT,
   idProducto INT(10) UNSIGNED NOT NULL,
   idUsuarioCreador INT(10) UNSIGNED NOT NULL,
   idStatus INT(10) UNSIGNED NOT NULL,
   Calificacion INT NOT NULL,
   Fecha_publicacion DATETIME NOT NULL,
   Comentario TEXT NOT NULL,
   PRIMARY KEY (idComentario),
   CONSTRAINT FK_Comentario_Producto FOREIGN KEY (idProducto) REFERENCES Producto(idProducto),
   CONSTRAINT FK_Comentario_UsuarioCreador FOREIGN KEY (idUsuarioCreador) REFERENCES Usuario(idUsuario),
   CONSTRAINT FK_Comentario_Estatus FOREIGN KEY (idStatus) REFERENCES Estatus(idStatus)
);

CREATE TABLE Chat (
   idChat INT(10) UNSIGNED AUTO_INCREMENT,
   idUsuarioCliente INT(10) UNSIGNED NOT NULL,
   idUsuarioVendedor INT(10) UNSIGNED NOT NULL,
   idStatus INT(10) UNSIGNED NOT NULL,
   idProducto INT(10) UNSIGNED NOT NULL,
   Fecha_creacion DATETIME NOT NULL,
   PRIMARY KEY (idChat),
   CONSTRAINT FK_Chat_UsuarioCliente FOREIGN KEY (idUsuarioCliente) REFERENCES Usuario(idUsuario),
   CONSTRAINT FK_Chat_UsuarioVendedor FOREIGN KEY (idUsuarioVendedor) REFERENCES Usuario(idUsuario),
   CONSTRAINT FK_Chat_Estatus FOREIGN KEY (idStatus) REFERENCES Estatus(idStatus),
   CONSTRAINT FK_Chat_Producto FOREIGN KEY (idProducto) REFERENCES Producto(idProducto)
);

CREATE TABLE Mensaje (
   idMensaje INT(10) UNSIGNED AUTO_INCREMENT,
   idStatus INT(10) UNSIGNED NOT NULL,
   idChat INT(10) UNSIGNED NOT NULL,
   idUsuarioCreador INT(10) UNSIGNED NOT NULL,
   Mensaje TEXT NOT NULL,
   Fecha_creacion DATETIME NOT NULL,
   PRIMARY KEY (idMensaje),
   CONSTRAINT FK_Mensaje_Estatus FOREIGN KEY (idStatus) REFERENCES Estatus(idStatus),
   CONSTRAINT FK_Mensaje_Chat FOREIGN KEY (idChat) REFERENCES Chat(idChat),
   CONSTRAINT FK_Mensaje_UsuarioCreador FOREIGN KEY (idUsuarioCreador) REFERENCES Usuario(idUsuario)
);

CREATE TABLE Archivo (
   idArchivo INT(10) UNSIGNED AUTO_INCREMENT,
   idProducto INT(10) UNSIGNED NOT NULL,
   idStatus INT(10) UNSIGNED NOT NULL,
   Archivo LONGBLOB  NOT NULL,  -- almacena la dirección o nombre del archivo
   PRIMARY KEY (idArchivo),
   CONSTRAINT FK_Archivo_Producto FOREIGN KEY (idProducto) REFERENCES Producto(idProducto),
   CONSTRAINT FK_Archivo_Estatus FOREIGN KEY (idStatus) REFERENCES Estatus(idStatus)
);

CREATE TABLE Carrito (
   idCarrito INT(10) UNSIGNED AUTO_INCREMENT,
   idUsuarioCliente INT(10) UNSIGNED NOT NULL,
   idProducto INT(10) UNSIGNED NOT NULL,
   idStatus INT(10) UNSIGNED NOT NULL,
   Cantidad INT(10) NOT NULL,
   PrecioUnitario DECIMAL(10, 2) NOT NULL,
   Subtotal DECIMAL(10, 2) NOT NULL,
   Descripcion TEXT NOT NULL,  -- Puede contener una descripción más larga
   Fecha_agregado DATE NOT NULL,
   Tipo VARCHAR(50) NOT NULL,
   PRIMARY KEY (idCarrito),
   CONSTRAINT FK_Carrito_UsuarioCliente FOREIGN KEY (idUsuarioCliente) REFERENCES Usuario(idUsuario),
   CONSTRAINT FK_Carrito_Producto FOREIGN KEY (idProducto) REFERENCES Producto(idProducto),
   CONSTRAINT FK_Carrito_Estatus FOREIGN KEY (idStatus) REFERENCES Estatus(idStatus)
);

CREATE TABLE Material_Carrito (
   idMaterialCarrito INT(10) UNSIGNED AUTO_INCREMENT,
   idCarrito INT(10) UNSIGNED NOT NULL,
   idMaterial INT(10) UNSIGNED NOT NULL,
   idStatus INT(10) UNSIGNED NOT NULL,
   Cantidad INT(10) NOT NULL,
   Fecha_agregado DATE NOT NULL,
   PRIMARY KEY (idMaterialCarrito),
   CONSTRAINT FK_Material_Carrito_Carrito FOREIGN KEY (idCarrito) REFERENCES Carrito(idCarrito),
   CONSTRAINT FK_Material_Carrito_MaterialInventario FOREIGN KEY (idMaterial) REFERENCES Material_Inventario(idMaterial),
   CONSTRAINT FK_Material_Carrito_Estatus FOREIGN KEY (idStatus) REFERENCES Estatus(idStatus)
);


/* CREATE TABLE Venta (
   idVenta INT(10) UNSIGNED AUTO_INCREMENT,
   idStatus INT(10) UNSIGNED NOT NULL,
   idUsuarioCliente INT(10) UNSIGNED NOT NULL,
   FechaHr_registro DATETIME NOT NULL,
   Total DECIMAL(10, 2) NOT NULL,
   PRIMARY KEY (idVenta),
   CONSTRAINT FK_Venta_Estatus FOREIGN KEY (idStatus) REFERENCES Estatus(idStatus),
   CONSTRAINT FK_Venta_UsuarioCliente FOREIGN KEY (idUsuarioCliente) REFERENCES Usuario(idUsuario)
); */

CREATE TABLE Venta (
   idVenta INT(10) UNSIGNED AUTO_INCREMENT,
   idUsuarioCliente INT(10) UNSIGNED NOT NULL,
   idProducto INT(10) UNSIGNED NOT NULL,
   idCarrito INT(10) UNSIGNED NOT NULL,
   idStatus INT(10) UNSIGNED NOT NULL,
   FechaHr_registro DATETIME NOT NULL,
   Total DECIMAL(10, 2) NOT NULL,
   Cantidad INT(5) UNSIGNED NOT NULL,
   PRIMARY KEY (idVenta),
   CONSTRAINT FK_DetalleVenta_Producto FOREIGN KEY (idProducto) REFERENCES Producto(idProducto),
   CONSTRAINT FK_DetalleVenta_Carrito FOREIGN KEY (idCarrito) REFERENCES Carrito(idCarrito),
   CONSTRAINT FK_DetalleVenta_Estatus FOREIGN KEY (idStatus) REFERENCES Estatus(idStatus),
   CONSTRAINT FK_Venta_UsuarioCliente FOREIGN KEY (idUsuarioCliente) REFERENCES Usuario(idUsuario)
);

/* CREATE TABLE DetalleVenta (
   idDetalleVenta INT(10) UNSIGNED AUTO_INCREMENT,
   idVenta INT(10) UNSIGNED NOT NULL,
   idProducto INT(10) UNSIGNED NOT NULL,
   idCarrito INT(10) UNSIGNED NOT NULL,
   idStatus INT(10) UNSIGNED NOT NULL,
   PRIMARY KEY (idDetalleVenta),
   CONSTRAINT FK_DetalleVenta_Venta FOREIGN KEY (idVenta) REFERENCES Venta(idVenta),
   CONSTRAINT FK_DetalleVenta_Producto FOREIGN KEY (idProducto) REFERENCES Producto(idProducto),
   CONSTRAINT FK_DetalleVenta_Carrito FOREIGN KEY (idCarrito) REFERENCES Carrito(idCarrito),
   CONSTRAINT FK_DetalleVenta_Estatus FOREIGN KEY (idStatus) REFERENCES Estatus(idStatus)
);
 */
CREATE TABLE TipoPago (
   idTipoPago INT(10) UNSIGNED AUTO_INCREMENT,
   idStatus INT(10) UNSIGNED NOT NULL,
   Nombre VARCHAR(100) NOT NULL,
   PRIMARY KEY (idTipoPago),
   CONSTRAINT FK_TipoPago_Estatus FOREIGN KEY (idStatus) REFERENCES Estatus(idStatus)
);

CREATE TABLE Pago (
   idPago INT(10) UNSIGNED AUTO_INCREMENT,
   idTipoPago INT(10) UNSIGNED NOT NULL,
   idVenta INT(10) UNSIGNED NOT NULL,
   idStatus INT(10) UNSIGNED NOT NULL,
   Monto DECIMAL(10, 2) NOT NULL,
   PRIMARY KEY (idPago),
   CONSTRAINT FK_Pago_TipoPago FOREIGN KEY (idTipoPago) REFERENCES TipoPago(idTipoPago),
   CONSTRAINT FK_Pago_Venta FOREIGN KEY (idVenta) REFERENCES Venta(idVenta),
   CONSTRAINT FK_Pago_Estatus FOREIGN KEY (idStatus) REFERENCES Estatus(idStatus)
);


