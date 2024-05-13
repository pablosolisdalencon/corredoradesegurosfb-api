SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tasks
-- ----------------------------
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `tasks_users_fk` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tasks
-- ----------------------------
INSERT INTO `tasks` (`id`, `name`, `status`, `userId`) VALUES (1, 'Go to cinema', 1, 8);
INSERT INTO `tasks` (`id`, `name`, `status`, `userId`) VALUES (2, 'Buy shoes', 0, 8);
INSERT INTO `tasks` (`id`, `name`, `status`, `userId`) VALUES (3, 'Go to shopping', 0, 8);
INSERT INTO `tasks` (`id`, `name`, `status`, `userId`) VALUES (4, 'Pay the credit card ;-)', 1, 8);
INSERT INTO `tasks` (`id`, `name`, `status`, `userId`) VALUES (5, 'Do math homework...', 0, 8);
INSERT INTO `tasks` (`id`, `name`, `status`, `userId`) VALUES (6, 'Just Testing...', 1, 1);


-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL UNIQUE,
  `password` varchar(128),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` (`name`, `email`, `password`) VALUES ('Juan', 'juanmartin@mail.com', 'd5f4da62059760b35de35f8fbd8efb43eee26ac741ef8c6e51782a13ac7d50e927b653160c591616a9dc8a452c877a6b80c00aecba14504756a65f88439fcd1e');
INSERT INTO `users` (`name`, `email`, `password`) VALUES ('James', 'jbond@yahoo.net', 'd5f4da62059760b35de35f8fbd8efb43eee26ac741ef8c6e51782a13ac7d50e927b653160c591616a9dc8a452c877a6b80c00aecba14504756a65f88439fcd1e');
INSERT INTO `users` (`name`, `email`, `password`) VALUES ('Lionel', 'mess10@gmail.gol', 'd5f4da62059760b35de35f8fbd8efb43eee26ac741ef8c6e51782a13ac7d50e927b653160c591616a9dc8a452c877a6b80c00aecba14504756a65f88439fcd1e');
INSERT INTO `users` (`name`, `email`, `password`) VALUES ('Carlos', 'bianchini@hotmail.com.ar', 'd5f4da62059760b35de35f8fbd8efb43eee26ac741ef8c6e51782a13ac7d50e927b653160c591616a9dc8a452c877a6b80c00aecba14504756a65f88439fcd1e');
INSERT INTO `users` (`name`, `email`, `password`) VALUES ('Diego', 'diego1010@gmail.com', 'd5f4da62059760b35de35f8fbd8efb43eee26ac741ef8c6e51782a13ac7d50e927b653160c591616a9dc8a452c877a6b80c00aecba14504756a65f88439fcd1e');
INSERT INTO `users` (`name`, `email`, `password`) VALUES ('One User', 'one@user.com', 'd5f4da62059760b35de35f8fbd8efb43eee26ac741ef8c6e51782a13ac7d50e927b653160c591616a9dc8a452c877a6b80c00aecba14504756a65f88439fcd1e');
INSERT INTO `users` (`name`, `email`, `password`) VALUES ('Diegol', 'diego@gol.com.ar', 'd5f4da62059760b35de35f8fbd8efb43eee26ac741ef8c6e51782a13ac7d50e927b653160c591616a9dc8a452c877a6b80c00aecba14504756a65f88439fcd1e');
INSERT INTO `users` (`name`, `email`, `password`) VALUES ('Test User', 'test@user.com', '$2y$10$S9.JvxDbDhESUZvZWmpyleWB4YTHEaCJ5nevlXMHNso8J4X4/Sgeq');

-- ----------------------------
-- Table structure for notes
-- ----------------------------
DROP TABLE IF EXISTS `notes`;
CREATE TABLE `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of notes
-- ----------------------------
INSERT INTO `notes` (`id`, `name`, `description`) VALUES ('1', 'My Note 1', 'My first online note');
INSERT INTO `notes` (`id`, `name`, `description`) VALUES ('2', 'Chinese Proverb', 'Those who say it can not be done, should not interrupt those doing it.');
INSERT INTO `notes` (`id`, `name`, `description`) VALUES ('3', 'Long Note 3', 'This is a very large note, or maybe not...');
INSERT INTO `notes` (`id`, `name`, `description`) VALUES ('4', 'Napoleon Hill', 'Whatever the mind of man can conceive and believe, it can achieve.');
INSERT INTO `notes` (`id`, `name`, `description`) VALUES ('5', 'Note 5', 'A Random Note');

INSERT INTO `notes`
    (`name`, `description`)
VALUES
    ('Brian Tracy', 'Develop an attitude of gratitude, and give thanks for everything that happens to you, knowing that every step forward is a step toward achieving something bigger and better than your current situation.'),
    ('Zig Ziglar', 'Your attitude, not your aptitude, will determine your altitude.'),
    ('William James', 'The greatest discovery of my generation is that a human being can alter his life by altering his attitudes.'),
    ('Og Mandino', 'Take the attitude of a student, never be too big to ask questions, never know too much to learn something new.'),
    ('Earl Nightingale', 'Our attitude towards others determines their attitude towards us.'),
    ('Norman Vincent Peale', 'Watch your manner of speech if you wish to develop a peaceful state of mind. Start each day by affirming peaceful, contented and happy attitudes and your days will tend to be pleasant and successful.'),
    ('W. Clement Stone', 'There is little difference in people, but that little difference makes a big difference. The little difference is attitude. The big difference is whether it is positive or negative.'),
    ('Dale Carnegie', 'Happiness does not depend on any external conditions, it is governed by our mental attitude.'),
    ('Walt Disney', 'If you can dream it, you can do it.'),
    ('William Shakespeare', 'Our doubts are traitors and make us lose the good we oft might win by fearing to attempt.'),
    ('Albert Einstein', 'A person who never made a mistake never tried anything new.');



-- ----------------------------
-- Table structure for empresas
-- ----------------------------
DROP TABLE IF EXISTS `empresas`;
CREATE TABLE `empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  `mision` text,
  `vision` text,
  `slogan` text,
  `servicios` text,
  `seguros` text,
  
  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- ----------------------------
-- Records of empresas
-- ----------------------------
INSERT INTO `empresas`
  (`id`, `name`, `description`, `mision`, `vision`, `slogan`, `servicios`, `seguros`) 
  VALUES
   ('1', 'Corredora de seguros FB',
   'FB Seguros es el resultado de la experiencia y pasion.', 
   'nuestra mision es posible!',
   'si tenemos la vision clara...',
   'estemos seguros.',
   'Temos un servicio integral',
   'Todos nuestros seguros cuentan con seguridad adicional...');

-- ----------------------------
-- Table ALIADOS
-- ----------------------------
DROP TABLE IF EXISTS `aliados`;
CREATE TABLE IF NOT EXISTS `aliados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of aliados
-- ----------------------------
INSERT INTO `aliados`
 (`id`, `name`, `description`)
 VALUES 
(1, 'Libery', 'Mega Alianza');

INSERT INTO `aliados`
 (`id`, `name`, `description`)
 VALUES 
(2, 'Orion', 'Super Alianza');


-- ----------------------------
-- Table TIPOSDESEGUROS
-- ----------------------------
DROP TABLE IF EXISTS `tiposdeseguros`;
CREATE TABLE IF NOT EXISTS `tiposdeseguros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `aliado_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `aliados_tiposdeseguros_fk` FOREIGN KEY (`aliado_id`) REFERENCES `aliados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tiposdeseguros
-- ----------------------------
INSERT INTO `tiposdeseguros`
 (`id`, `name`, `description`, `aliado_id`)
 VALUES 
(1, 'Seguros de Auto', 'Diversos seguros para automoviles de todo tipo.', 1);

INSERT INTO `tiposdeseguros`
 (`id`, `name`, `description`, `aliado_id`)
 VALUES 
(2, 'Seguros de Garantía Estatal', 'El exclusivo de Orion.', 2);



-- ----------------------------
-- Table SEGUROS
-- ----------------------------
DROP TABLE IF EXISTS `seguros`;
CREATE TABLE IF NOT EXISTS `seguros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `tipodeseguro_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `tiposdeseguros_seguros_fk` FOREIGN KEY (`tipodeseguro_id`) REFERENCES `tiposdeseguros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of seguros
-- ----------------------------
INSERT INTO `seguros`
 (`id`, `name`, `description`, `tipodeseguro_id`)
 VALUES 
(1, 'Seguros de autos Particulares', 'El seguro para el auto propio.', 1);

-- ----------------------------
-- Table POLIZAS
-- ----------------------------
DROP TABLE IF EXISTS `polizas`;
CREATE TABLE IF NOT EXISTS `polizas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `tipodeseguro_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `tiposdeseguros_polizas_fk` FOREIGN KEY (`tipodeseguro_id`) REFERENCES `tiposdeseguros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- ----------------------------
-- Records of seguros
-- ----------------------------
INSERT INTO `polizas`
 (`id`, `name`, `description`, `tipodeseguro_id`)
 VALUES 
(1, 'Polizas de garantia', 'El espaldarazo a la empresa.', 2);
-- ----------------------------
-- Table COBERTURAS
-- ----------------------------
DROP TABLE IF EXISTS `coberturas`;
CREATE TABLE IF NOT EXISTS `coberturas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `seguro_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `seguros_coberturas_fk` FOREIGN KEY (`seguro_id`) REFERENCES `seguros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of coberturas
-- ----------------------------
INSERT INTO `coberturas`
 (`id`, `name`, `description`, `seguro_id`)
 VALUES 
(1, 'Cobertura Total', 'Se cubren todos los gastos operacionales, reembolsos, reintegraciones etc.', 1);

-- ----------------------------
-- Table COTIZACIONES
-- ----------------------------
DROP TABLE IF EXISTS `cotizaciones`;
CREATE TABLE IF NOT EXISTS `cotizaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seguro_id` int(11),
  `poliza_id` int(11),
  `correo` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `empresa` varchar(100),
  `fono` varchar(100) NOT NULL,
  `fecha` date,
  `mensaje` text,
  PRIMARY KEY (`id`),
  CONSTRAINT `seguros_cotizaciones_fk` FOREIGN KEY (`seguro_id`) REFERENCES `seguros` (`id`),
  CONSTRAINT `polizas_cotizaciones_fk` FOREIGN KEY (`poliza_id`) REFERENCES `polizas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cotizaciones
-- ----------------------------
INSERT INTO `cotizaciones`
 (`id`, `seguro_id`, `poliza_id`, `correo`,`nombre`,`empresa`,`fono`,`fecha`,`mensaje`)
 VALUES 
(1, 1,NULL,'ppe@go.cl','pepe','NA','989787654','12-03-24','Ayudenme, quiero estar asegurado.');


SET FOREIGN_KEY_CHECKS = 1;