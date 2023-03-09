-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_saw
CREATE DATABASE IF NOT EXISTS `db_saw` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `db_saw`;

-- Dumping structure for table db_saw.ta_alternatif
CREATE TABLE IF NOT EXISTS `ta_alternatif` (
  `alternatif_id` int(11) NOT NULL AUTO_INCREMENT,
  `alternatif_kode` varchar(5) NOT NULL,
  `alternatif_nama` varchar(100) NOT NULL,
  PRIMARY KEY (`alternatif_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_saw.ta_alternatif: ~5 rows (approximately)
/*!40000 ALTER TABLE `ta_alternatif` DISABLE KEYS */;
INSERT INTO `ta_alternatif` (`alternatif_id`, `alternatif_kode`, `alternatif_nama`) VALUES
	(1, 'A01', 'Student 1'),
	(2, 'A02', 'Student 2'),
	(3, 'A03', 'Student 3'),
	(4, 'A04', 'Student 4'),
	(5, 'A05', 'Student 5');
/*!40000 ALTER TABLE `ta_alternatif` ENABLE KEYS */;

-- Dumping structure for table db_saw.ta_kriteria
CREATE TABLE IF NOT EXISTS `ta_kriteria` (
  `kriteria_id` int(11) NOT NULL AUTO_INCREMENT,
  `kriteria_kode` varchar(5) NOT NULL,
  `kriteria_nama` varchar(100) NOT NULL,
  `kriteria_kategori` enum('benefit','cost') NOT NULL,
  `kriteria_bobot` float NOT NULL,
  PRIMARY KEY (`kriteria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_saw.ta_kriteria: ~5 rows (approximately)
/*!40000 ALTER TABLE `ta_kriteria` DISABLE KEYS */;
INSERT INTO `ta_kriteria` (`kriteria_id`, `kriteria_kode`, `kriteria_nama`, `kriteria_kategori`, `kriteria_bobot`) VALUES
	(1, 'C01', 'Kartu Indonesia Pintar', 'benefit', 0.15),
	(2, 'C02', 'Parents Income', 'cost', 0.2),
	(3, 'C03', 'Parental Dependents', 'benefit', 0.15),
	(4, 'C04', 'Program Keluarga Harapan', 'benefit', 0.15),
	(5, 'C05', 'Kartu Keluarga Sejahtera', 'benefit', 0.15),
	(6, 'C06', 'Orphan Status', 'benefit', 0.2);
/*!40000 ALTER TABLE `ta_kriteria` ENABLE KEYS */;

-- Dumping structure for table db_saw.ta_subkriteria
CREATE TABLE IF NOT EXISTS `ta_subkriteria` (
  `subkriteria_id` int(11) NOT NULL AUTO_INCREMENT,
  `subkriteria_kode` varchar(5) NOT NULL,
  `kriteria_kode` varchar(5) NOT NULL,
  `subkriteria_keterangan` varchar(100) NOT NULL,
  `subkriteria_bobot` float NOT NULL,
  PRIMARY KEY (`subkriteria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_saw.ta_subkriteria: ~17 rows (approximately)
/*!40000 ALTER TABLE `ta_subkriteria` DISABLE KEYS */;
INSERT INTO `ta_subkriteria` (`subkriteria_id`, `subkriteria_kode`, `kriteria_kode`, `subkriteria_keterangan`, `subkriteria_bobot`) VALUES
	(1, 'S01', 'C01', 'Non Recipient', 1),
	(2, 'S02', 'C01', 'Recipient', 2),
	(3, 'S03', 'C02', '<= 500,000 (IDR) ', 1),
	(4, 'S04', 'C02', '500,000 – 999,999 (IDR) ', 2),
	(5, 'S05', 'C02', '1,000,000 – 1,999,999 (IDR)', 3),
	(6, 'S06', 'C02', '2,000,000 – 4,999,999 (IDR) ', 4),
	(7, 'S07', 'C02', '5,000,000 – 20,000,000 (IDR) ', 5),
	(8, 'S08', 'C03', '1 Child ', 1),
	(9, 'S09', 'C03', '2 Child ', 2),
	(10, 'S10', 'C03', '3 Child', 3),
	(11, 'S11', 'C03', '4 Child', 4),
	(12, 'S12', 'C03', '> 4 Child', 5),
	(13, 'S13', 'C04', 'Non Participant', 1),
	(14, 'S14', 'C04', 'Participant', 2),
	(15, 'S15', 'C05', 'Non Holder', 1),
	(16, 'S16', 'C05', 'Holder', 2),
	(17, 'S17', 'C06', 'Non Orphan', 1),
	(18, 'S18', 'C06', 'Orphan', 2);
/*!40000 ALTER TABLE `ta_subkriteria` ENABLE KEYS */;

-- Dumping structure for table db_saw.tb_nilai
CREATE TABLE IF NOT EXISTS `tb_nilai` (
  `nilai_id` int(11) NOT NULL AUTO_INCREMENT,
  `alternatif_kode` varchar(5) NOT NULL,
  `kriteria_kode` varchar(5) NOT NULL,
  `nilai_faktor` double NOT NULL,
  PRIMARY KEY (`nilai_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_saw.tb_nilai: ~26 rows (approximately)
/*!40000 ALTER TABLE `tb_nilai` DISABLE KEYS */;
INSERT INTO `tb_nilai` (`nilai_id`, `alternatif_kode`, `kriteria_kode`, `nilai_faktor`) VALUES
	(1, 'A01', 'C01', 2),
	(2, 'A01', 'C02', 1),
	(3, 'A01', 'C03', 2),
	(4, 'A01', 'C04', 2),
	(5, 'A01', 'C05', 1),
	(6, 'A01', 'C06', 1),
	(7, 'A02', 'C01', 2),
	(8, 'A02', 'C02', 1),
	(9, 'A02', 'C03', 5),
	(10, 'A02', 'C04', 2),
	(11, 'A02', 'C05', 1),
	(12, 'A02', 'C06', 2),
	(13, 'A03', 'C01', 2),
	(14, 'A03', 'C02', 1),
	(15, 'A03', 'C03', 1),
	(16, 'A03', 'C04', 1),
	(17, 'A03', 'C05', 2),
	(18, 'A03', 'C06', 1),
	(19, 'A04', 'C01', 1),
	(20, 'A04', 'C02', 3),
	(21, 'A04', 'C03', 1),
	(22, 'A04', 'C04', 1),
	(23, 'A04', 'C05', 1),
	(24, 'A04', 'C06', 1),
	(25, 'A05', 'C01', 1),
	(26, 'A05', 'C02', 5),
	(27, 'A05', 'C03', 1),
	(28, 'A05', 'C04', 1),
	(29, 'A05', 'C05', 1),
	(30, 'A05', 'C06', 1);
/*!40000 ALTER TABLE `tb_nilai` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
