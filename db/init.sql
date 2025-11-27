CREATE TABLE IF NOT EXISTS students (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  meno VARCHAR(100) NOT NULL,
  priezvisko VARCHAR(100) NOT NULL,
  email VARCHAR(255) NOT NULL,
  datum_narodenia DATE NOT NULL,
  program VARCHAR(100) NOT NULL,
  pohlavie ENUM('muz','zena') NOT NULL,
  zaujmy TEXT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uniq_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovak_ci;
