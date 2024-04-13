/*
 Navicat Premium Data Transfer

 Source Server         : MySQL
 Source Server Type    : MySQL
 Source Server Version : 50733
 Source Host           : localhost:3306
 Source Schema         : db_sistema_facturacion

 Target Server Type    : MySQL
 Target Server Version : 50733
 File Encoding         : 65001

 Date: 13/04/2024 15:53:26
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_detalle_factura
-- ----------------------------
DROP TABLE IF EXISTS `tbl_detalle_factura`;
CREATE TABLE `tbl_detalle_factura`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_factura` int(11) NULL DEFAULT NULL,
  `id_producto` int(11) NULL DEFAULT NULL,
  `cantidad` int(11) NULL DEFAULT NULL,
  `subtotal` decimal(8, 2) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_factura`(`id_factura`) USING BTREE,
  INDEX `id_producto`(`id_producto`) USING BTREE,
  CONSTRAINT `tbl_detalle_factura_ibfk_1` FOREIGN KEY (`id_factura`) REFERENCES `tbl_factura` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tbl_detalle_factura_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `tbl_producto` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_detalle_factura
-- ----------------------------
INSERT INTO `tbl_detalle_factura` VALUES (1, 1, 1, 2, 9.00, '2024-04-13 09:05:03', '2024-04-13 09:05:08');
INSERT INTO `tbl_detalle_factura` VALUES (2, 1, 2, 3, 10.50, '2024-04-13 09:07:07', '2024-04-13 09:07:10');
INSERT INTO `tbl_detalle_factura` VALUES (3, 2, 1, 1, 4.50, '2024-04-13 12:54:23', '2024-04-13 12:54:25');
INSERT INTO `tbl_detalle_factura` VALUES (4, 3, 1, 1, 4.50, '2024-04-13 12:56:46', '2024-04-13 12:56:49');
INSERT INTO `tbl_detalle_factura` VALUES (5, 7, 1, 11, 49.50, '2024-04-13 19:03:47', '2024-04-13 19:03:47');

-- ----------------------------
-- Table structure for tbl_factura
-- ----------------------------
DROP TABLE IF EXISTS `tbl_factura`;
CREATE TABLE `tbl_factura`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_factura` date NULL DEFAULT NULL,
  `numero_factura` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_factura
-- ----------------------------
INSERT INTO `tbl_factura` VALUES (1, '2024-04-13', 1, '2024-04-13 15:19:18', '2024-04-13 15:19:14');
INSERT INTO `tbl_factura` VALUES (2, '2024-04-13', 2, '2024-04-13 18:52:18', '2024-04-13 18:52:18');
INSERT INTO `tbl_factura` VALUES (3, '2024-04-13', 3, '2024-04-13 18:55:09', '2024-04-13 18:55:09');
INSERT INTO `tbl_factura` VALUES (7, '2024-04-13', 7, '2024-04-13 19:03:44', '2024-04-13 19:03:44');

-- ----------------------------
-- Table structure for tbl_inventario
-- ----------------------------
DROP TABLE IF EXISTS `tbl_inventario`;
CREATE TABLE `tbl_inventario`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NULL DEFAULT NULL,
  `cantidad` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_producto`(`id_producto`) USING BTREE,
  CONSTRAINT `tbl_inventario_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `tbl_producto` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_inventario
-- ----------------------------
INSERT INTO `tbl_inventario` VALUES (1, 1, 40, '2024-04-13 12:01:15', '2024-04-13 19:03:47');

-- ----------------------------
-- Table structure for tbl_producto
-- ----------------------------
DROP TABLE IF EXISTS `tbl_producto`;
CREATE TABLE `tbl_producto`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `precio` decimal(8, 2) NULL DEFAULT NULL,
  `img` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_producto
-- ----------------------------
INSERT INTO `tbl_producto` VALUES (1, 'prueba', 4.50, 'http://localhost:8080/img/productos/cocacola.jpg', '2024-04-12 11:26:57', '2024-04-12 21:17:08');
INSERT INTO `tbl_producto` VALUES (2, 'coca-cola 1lt', 3.50, 'http://localhost:8080/img/productos/995465242995465242cocacola.jpg', '2024-04-12 20:55:07', '2024-04-12 22:39:54');
INSERT INTO `tbl_producto` VALUES (3, 'aceite de cocina', 2.50, 'http://localhost:8080/img/productos/cocacola.jpg', '2024-04-12 21:02:27', '2024-04-12 21:02:27');
INSERT INTO `tbl_producto` VALUES (5, 'sadasd', 4.00, 'http://localhost:8080/img/productos/138317240cocacola.jpg', '2024-04-12 21:46:47', '2024-04-12 21:46:47');

SET FOREIGN_KEY_CHECKS = 1;
