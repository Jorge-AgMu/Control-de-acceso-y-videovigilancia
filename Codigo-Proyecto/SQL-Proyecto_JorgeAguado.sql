CREATE TABLE `empleados` (
  `uid` int(25) AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `apellido1` varchar(50) NOT NULL,
  `apellido2` varchar(50) NOT NULL,
  `id_rol` int(1) NOT NULL,
	PRIMARY KEY (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `empleados` (`uid`, `nombre`, `usuario`, `password`, `apellido1`, `apellido2`, `id_rol`) VALUES
(1, 'Jorge', 'a', '$2y$10$WJ5vd8d4t46nQ40kEiHTr.OZJSURNzMRg9g9CJoDpCLXXIevHpQwO', 'Aguado', 'Muñoz', 1),
(null, 'b', 'b', '$2y$10$5xab8.Wqxtrv2b895Zt4m.SzOngTzaXx.IGpJlVPBmQfIOZH2qtLW', 'b', 'b', 2),
(null, 'c', 'c', '$2y$10$uLI/NVrK4zTJLOogCzsOte3eO2/rpKKO62o6N5p4ArOhlBckOP89S', 'c', 'c', 1),
(null, 'd', 'd', '$2y$10$hv7BB2ygoHPzgin8Dh8T6.yzv35dMXLfIySGmRF5YdeRdKEfJBs66', 'd', 'd', 3);

-- --------------------------------------------------------


CREATE TABLE `registro` (
  `id` int(255) AUTO_INCREMENT,
  `PIR_01` varchar(50) NOT NULL,
  `PIR_02` varchar(50) NOT NULL,
  `PIR_03` varchar(50) NOT NULL,
  `PIR_04` varchar(50) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------


CREATE TABLE `roles` (
  `id_rol` int(1) NOT NULL,
  `nombre` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
	PRIMARY KEY (id_rol)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `roles` (`id_rol`, `nombre`, `descripcion`) VALUES
(1, 'Administrador', 'Rol con permisos para administrar el sistema'),
(2, 'Vigilante', 'Rol con permisos para monitorear el sistema'),
(3, 'Administrador', 'Rol con permisos para entrar al muro personal');

-- --------------------------------------------------------


CREATE TABLE `sensores` (
  `id` varchar(255) NOT NULL,
  `PIR_01` varchar(30) NOT NULL,
  `PIR_02` varchar(30) NOT NULL,
  `PIR_03` varchar(30) NOT NULL,
  `PIR_04` varchar(30) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `sensores` (`id`, `PIR_01`, `PIR_02`, `PIR_03`, `PIR_04`, `time`, `date`) VALUES
('esp32_01', 'Sin movimiento', 'Sin movimiento', 'Sin movimiento', 'Sin movimiento', NOW(), NOW());

-- --------------------------------------------------------

CREATE TABLE `tareas` (
  `id_tarea` int(30) AUTO_INCREMENT,
  `id_tipo` int(3) NOT NULL,
  `uid` int(25) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha_inicio` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_fin` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	PRIMARY KEY (id_tarea)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `tareas` (`id_tarea`, `id_tipo`, `uid`, `descripcion`, `fecha_inicio`, `fecha_fin`) VALUES
(2, 1, 1, 'Cambio de componentes del automata A5', '2023-06-09 03:00:00', '2023-06-09 11:00:00'),
(3, 1, 1, 'Cambio de componentes del automata A9', '2023-06-09 03:00:00', '2023-06-09 11:00:00'),
(4, 1, 1, 'Cambio de componentes del automata B2', '2023-06-09 03:00:00', '2023-06-09 11:00:00'),
(5, 2, 1, 'Asistir a los operarios de la linea 3', '2023-06-09 03:00:00', '2023-06-09 11:00:00'),
(6, 2, 1, 'Asistir a los operarios de la linea 2', '2023-06-09 03:00:00', '2023-06-09 11:00:00'),
(7, 1, 2, 'Cambio de componentes del automata H3', '2023-06-09 03:00:00', '2023-06-09 11:00:00'),
(8, 1, 2, 'Cambio de componentes del automata H7', '2023-06-09 03:00:00', '2023-06-09 11:00:00'),
(9, 2, 1, 'Asistir a los operarios de la linea 5', '2023-06-09 03:00:00', '2023-06-09 11:00:00'),
(10, 2, 1, 'Asistir a los operarios de la linea 7', '2023-06-09 03:00:00', '2023-06-09 11:00:00'),
(11, 2, 1, 'Asistir a los operarios de la linea 15', '2023-06-09 03:00:00', '2023-06-09 11:00:00'),
(12, 2, 1, 'Asistir a los operarios de la linea 13', '2023-06-09 03:00:00', '2023-06-09 11:00:00');

-- --------------------------------------------------------



CREATE TABLE `tipos_tareas` (
  `id_tipo` int(3) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
	PRIMARY KEY (id_tipo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `tipos_tareas` (`id_tipo`, `nombre`, `descripcion`) VALUES
(1, 'Reparación', 'Areglar o sustituir piezas o equipos con defectos'),
(2, 'Asistir', 'Auxiliar a un operario o automata ha realizar su trabajo'),
(3, 'Auditar', 'Vigilar la red para evitar ciber ataques');

