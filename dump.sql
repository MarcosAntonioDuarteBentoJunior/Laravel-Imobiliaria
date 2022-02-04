-- -----------------------------------------------------
-- Table `u225134551_imobiliaria`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u225134551_imobiliaria`.`categories` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `u225134551_imobiliaria`.`usages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u225134551_imobiliaria`.`usages` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `u225134551_imobiliaria`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u225134551_imobiliaria`.`users` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `role` ENUM('user', 'admin') NOT NULL DEFAULT 'user',
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `password` VARCHAR(255) NOT NULL,
  `remember_token` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `users_email_unique` (`email` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `u225134551_imobiliaria`.`realties`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u225134551_imobiliaria`.`realties` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  `rooms` SMALLINT NOT NULL,
  `bedrooms` SMALLINT NOT NULL,
  `bathrooms` SMALLINT NOT NULL,
  `parking` SMALLINT NULL DEFAULT '0',
  `area` DECIMAL(12,2) NOT NULL,
  `value` DECIMAL(12,2) NOT NULL,
  `description` TEXT NOT NULL,
  `rented` TINYINT(1) NOT NULL DEFAULT '0',
  `sold` TINYINT(1) NOT NULL DEFAULT '0',
  `reserved` TINYINT(1) NOT NULL DEFAULT '0',
  `user_id` BIGINT UNSIGNED NOT NULL,
  `usage_id` INT UNSIGNED NOT NULL,
  `category_id` INT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `realties_user_id_foreign` (`user_id` ASC) VISIBLE,
  INDEX `realties_usage_id_foreign` (`usage_id` ASC) VISIBLE,
  INDEX `realties_category_id_foreign` (`category_id` ASC) VISIBLE,
  CONSTRAINT `realties_category_id_foreign`
    FOREIGN KEY (`category_id`)
    REFERENCES `u225134551_imobiliaria`.`categories` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `realties_usage_id_foreign`
    FOREIGN KEY (`usage_id`)
    REFERENCES `u225134551_imobiliaria`.`usages` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `realties_user_id_foreign`
    FOREIGN KEY (`user_id`)
    REFERENCES `u225134551_imobiliaria`.`users` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `u225134551_imobiliaria`.`adresses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u225134551_imobiliaria`.`adresses` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `street` VARCHAR(255) NOT NULL,
  `number` VARCHAR(255) NULL DEFAULT 's/n',
  `district` VARCHAR(255) NOT NULL,
  `city` VARCHAR(255) NOT NULL,
  `realty_id` INT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `adresses_realty_id_foreign` (`realty_id` ASC) VISIBLE,
  CONSTRAINT `adresses_realty_id_foreign`
    FOREIGN KEY (`realty_id`)
    REFERENCES `u225134551_imobiliaria`.`realties` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `u225134551_imobiliaria`.`failed_jobs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u225134551_imobiliaria`.`failed_jobs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(255) NOT NULL,
  `connection` TEXT NOT NULL,
  `queue` TEXT NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `exception` LONGTEXT NOT NULL,
  `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `failed_jobs_uuid_unique` (`uuid` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `u225134551_imobiliaria`.`migrations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u225134551_imobiliaria`.`migrations` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255) NOT NULL,
  `batch` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `u225134551_imobiliaria`.`password_resets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u225134551_imobiliaria`.`password_resets` (
  `email` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  INDEX `password_resets_email_index` (`email` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `u225134551_imobiliaria`.`personal_access_tokens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u225134551_imobiliaria`.`personal_access_tokens` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` VARCHAR(255) NOT NULL,
  `tokenable_id` BIGINT UNSIGNED NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `token` VARCHAR(64) NOT NULL,
  `abilities` TEXT NULL DEFAULT NULL,
  `last_used_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `personal_access_tokens_token_unique` (`token` ASC) VISIBLE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type` ASC, `tokenable_id` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `u225134551_imobiliaria`.`realty_photos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `u225134551_imobiliaria`.`realty_photos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `image_path` VARCHAR(255) NOT NULL,
  `realty_id` INT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `realty_photos_realty_id_foreign` (`realty_id` ASC) VISIBLE,
  CONSTRAINT `realty_photos_realty_id_foreign`
    FOREIGN KEY (`realty_id`)
    REFERENCES `u225134551_imobiliaria`.`realties` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;