-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-04-2022 a las 17:44:43
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `IDEstudiante` int(11) NOT NULL,
  `Nombres` varchar(200) NOT NULL,
  `Apellidopat` varchar(200) NOT NULL,
  `Apellidomat` varchar(200) NOT NULL,
  `GradoSeccion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`IDEstudiante`, `Nombres`, `Apellidopat`, `Apellidomat`, `GradoSeccion`) VALUES
(16, 'Yulber', 'Juica', 'Ayllon', '5 B'),
(17, 'Gabriel', 'Ramos', 'zavala', '3 F'),
(18, 'Milagros', 'Paramo', 'Vargaz', '5 B'),
(19, 'Jaime', 'Juica', 'Medina', '3 F'),
(20, 'Miguel', 'Peralta', 'Ramos', '5 B'),
(21, 'Jose', 'Choque', 'Lazo', '2 D'),
(22, 'Guilleromo', 'Corzo', 'Peralta', '1 D');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `IDLibro` int(11) NOT NULL,
  `Titulo` varchar(255) NOT NULL,
  `Autor` varchar(255) NOT NULL,
  `Autores` varchar(255) NOT NULL,
  `Materia` varchar(255) NOT NULL,
  `Editorial` varchar(255) NOT NULL,
  `LugarEdicion` varchar(255) NOT NULL,
  `FechaEdicion` varchar(25) NOT NULL,
  `Paginas` varchar(1000) NOT NULL,
  `Contenido` text NOT NULL,
  `CodigoDewey` varchar(50) NOT NULL,
  `Tomo` varchar(1000) NOT NULL,
  `NumEjemplares` varchar(255) NOT NULL,
  `Enlace` text NOT NULL,
  `Imagen` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`IDLibro`, `Titulo`, `Autor`, `Autores`, `Materia`, `Editorial`, `LugarEdicion`, `FechaEdicion`, `Paginas`, `Contenido`, `CodigoDewey`, `Tomo`, `NumEjemplares`, `Enlace`, `Imagen`) VALUES
(5, 'Una Vision de la Planimetria', 'Asociacion Fondo de Investigadores y Editores', 'Asociacion Fondo de Investigadores y Editores', 'Geometria', 'Lumbreras', 'Lima-Perú', '2018-06-19', '954', 'El libro realiza una exposición didáctica y con ejemplos aplicativos. Cada capítulo presenta un marco teórico completo y una lectura relacionada con el tema. Además, contiene preguntas resueltas, un test y preguntas propuestas. Este texto es muy recomendado para estudiantes que se preparan para postular a la universidad, abarcando las altas exigencias de prestigiosas universidades del Perú como es la UNI, San Marcos, UNALM, entre otras. Los temas que se abordan se describirán a continuación:', '580', '1', '4', 'https://p302.zlibcdn.com/dtoken/f8f45269fdc7fd725a4625cb38cfc7d3/GEOMETR%C3%8DA_(Lumbreras)_(z-lib.org).pdf', '1650304784_Geometría-Lumbreras.jpg'),
(6, 'La Odisea', 'Homero', 'Varios', 'Literatura Universal', 'Valencia Quintero Javier', 'lima-peru', '10 de abril 2018', '213', 'Odiseo, o Ulises en versión latina, después de vencer con los aqueos de Itaca en la guerra de Troya, sufre innumerables vicisitudes, a veces ayudado para superarlas por unas divinidades, con mediación de la diosa Atenea, y en ocasiones perseguido y agredido por otras de manera implacable, como aconteció con Poseidón.', '580', '2', '', 'https://es.b-ok.lat/book/4762577/4e843e', '1650309804_laodisea.jpg'),
(7, 'La Iliada', 'Homero', '', 'Literatura Universal', 'Edimat Libros', 'lima-peru', '15 de abril 2014', '280', 'For lovers of timeless classics, this series of beautifully packaged and affordably priced editions of world literature encompasses a variety of literary genres, including drama, fiction, poetry, and essays. Los lectores tomarán un gran placer en descubrir los clásicos con estas bellas y económicas ediciones de literatura famosa y universal. Esta selección editorial cuenta con títulos que abarcan todos los géneros literarios, desde teatro, narrativa, poesía y el ensayo.', '580', '2', '4', 'https://es.b-ok.lat/book/961620/4d0e04?dsource=recommend', '1650340260_lailiada.png'),
(8, 'Poesía completa', 'Cesar Vallejo', '', 'Poesía Peruana', 'Lumen', 'lima-peru ', '15 de agosto 2014', '484', 'César Vallejo es, sin lugar a dudas, uno de los poetas en español más importantes de todos los tiempos. Su obra, de gran influencia en la literatura posterior, hizo saltar en pedazos la lírica occidental y sigue siendo ', '580', '2', '4', 'https://es.b-ok.lat/book/876429/f8e67a?dsource=recommend', '1650341029_poesia.jpg'),
(9, 'Maestria', 'Robert Greene', '', 'Autoayuda', 'Oceano', 'lima-peru ', '8 de enero 2016', '408', 'Tomar las riendas de nuestro destino para lograr metas extraordinarias El poder supremo es la maestría Para Robert Greene, el aclamado autor de Las 48 leyes del poder, todos tenemos la posibilidad de desarrollar nuestras facultades e inteligencia para lograr la maestría. Ésta representa el punto más alto del potencial humano y es la fuente de los mayores logros y descubrimientos. Maestría desmiente de manera definitiva muchos mitos sobre el genio, demostrando que cada uno de nosotros, sin importar su sexo, clase social o condición económica, lleva en su interior la semilla para ser un maestro si decide seguir el camino que lleva a la grandeza. La vocación, el aprendizaje y la práctica más rigurosa se unen para impulsarnos hasta alcanzar la cima.', '5778-967G', '1', '', 'https://es.b-ok.lat/book/5466393/351318', '1650341206_maestria.jpg'),
(12, 'Tradiciones Peruanas', 'PALMA RICARDO', 'Ricardo Palma-Mario Vargas Llosa-Ivan Rodriguez Chavez', 'Literatura Peruana', 'Universitaria', 'lima-peru-1a ed.', 'mayo de 2015', '607', 'Tradiciones y articulos historicos. Estas tradiciones fueron recogidas por Palma.', '800', '1 Vol. V', '1', 'https://es.b-ok.lat/book/874847/3c921c', '1650384041_IMG_20220419_105928410.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id` int(11) NOT NULL,
  `Libros` varchar(255) NOT NULL,
  `Estudiantes` varchar(255) NOT NULL,
  `FechaPrestamo` date NOT NULL,
  `FechaDevolucion` date NOT NULL,
  `Descripcion` text NOT NULL,
  `Condicion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id`, `Libros`, `Estudiantes`, `FechaPrestamo`, `FechaDevolucion`, `Descripcion`, `Condicion`) VALUES
(29, 'Una Vision de la Planimetria', 'Luis Rojas Meza', '2022-04-26', '2022-04-27', 'Libro en Buen estado', 'Devuelto'),
(30, 'La Odisea', 'Miguel Peralta Ramos', '2022-04-21', '2022-04-28', 'Libro en Buen estado', 'Devuelto'),
(31, 'La Iliada', 'Jaime Juica Medina', '2022-04-20', '2022-04-28', 'Libro en Buen estado', 'Devuelto'),
(32, 'Maestria', 'Pablo Marcos Ollero', '2022-04-27', '2022-04-28', 'Libro en Buen estado', 'Prestado'),
(33, 'Tradiciones Peruanas', 'Luis Rojas Meza', '2022-04-27', '2022-04-28', 'Libro en Buen estado', 'Devuelto'),
(34, 'Tradiciones Peruanas', 'Jose Choque Lazo', '2022-04-26', '2022-04-27', 'Libro en Buen estado', 'Devuelto'),
(35, 'Poesía completa', 'Jaime Juica Medina', '2022-04-27', '2022-04-27', 'Libro en Buen estado', 'Devuelto');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`IDEstudiante`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`IDLibro`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `IDEstudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `IDLibro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
