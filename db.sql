BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "migrations" (
	"id"	integer NOT NULL,
	"migration"	varchar NOT NULL,
	"batch"	integer NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "roles" (
	"id"	integer NOT NULL,
	"name"	varchar NOT NULL,
	"guard_name"	varchar NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "permissions" (
	"id"	integer NOT NULL,
	"name"	varchar NOT NULL,
	"guard_name"	varchar NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "role_has_permissions" (
	"permission_id"	integer NOT NULL,
	"role_id"	integer NOT NULL,
	PRIMARY KEY("permission_id","role_id"),
	FOREIGN KEY("role_id") REFERENCES "roles"("id") on delete cascade,
	FOREIGN KEY("permission_id") REFERENCES "permissions"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "model_has_roles" (
	"role_id"	integer NOT NULL,
	"model_id"	integer NOT NULL,
	"model_type"	varchar NOT NULL,
	PRIMARY KEY("role_id","model_id","model_type"),
	FOREIGN KEY("role_id") REFERENCES "roles"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "model_has_permissions" (
	"permission_id"	integer NOT NULL,
	"model_id"	integer NOT NULL,
	"model_type"	varchar NOT NULL,
	PRIMARY KEY("permission_id","model_id","model_type"),
	FOREIGN KEY("permission_id") REFERENCES "permissions"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "users" (
	"id"	integer NOT NULL,
	"name"	varchar NOT NULL,
	"username"	varchar,
	"phone"	varchar,
	"email"	varchar NOT NULL,
	"email_verified_at"	datetime,
	"password"	varchar NOT NULL,
	"remember_token"	varchar,
	"created_at"	datetime,
	"updated_at"	datetime,
	"role"	varchar NOT NULL DEFAULT 'client' CHECK("role" IN ('admin', 'merchant', 'client', 'storekeeper', 'courier', 'super_admin')),
	"created_by"	integer,
	"interests"	text,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "failed_jobs" (
	"id"	integer NOT NULL,
	"uuid"	varchar NOT NULL,
	"connection"	text NOT NULL,
	"queue"	text NOT NULL,
	"payload"	text NOT NULL,
	"exception"	text NOT NULL,
	"failed_at"	datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "personal_access_tokens" (
	"id"	integer NOT NULL,
	"tokenable_type"	varchar NOT NULL,
	"tokenable_id"	integer NOT NULL,
	"name"	varchar NOT NULL,
	"token"	varchar NOT NULL,
	"abilities"	text,
	"last_used_at"	datetime,
	"expires_at"	datetime,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "addresses" (
	"id"	integer NOT NULL,
	"country"	varchar NOT NULL,
	"town"	varchar NOT NULL,
	"quarter"	varchar NOT NULL,
	"latitude"	numeric NOT NULL,
	"longitude"	numeric NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime,
	"fees"	integer NOT NULL DEFAULT '1000',
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "clients" (
	"id"	integer NOT NULL,
	"user_id"	integer NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("user_id") REFERENCES "users"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "carts" (
	"id"	integer NOT NULL,
	"client_id"	integer NOT NULL,
	"products"	text NOT NULL,
	"total_price"	float NOT NULL DEFAULT '0',
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("client_id") REFERENCES "clients"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "orders" (
	"id"	integer NOT NULL,
	"sender_name"	varchar NOT NULL,
	"sender_phone"	varchar NOT NULL,
	"sender_town"	varchar NOT NULL,
	"sender_quarter"	varchar NOT NULL,
	"receiver_name"	varchar NOT NULL,
	"receiver_phone"	varchar NOT NULL,
	"receiver_town"	varchar NOT NULL,
	"receiver_quarter"	varchar NOT NULL,
	"product_info"	varchar NOT NULL,
	"category"	varchar NOT NULL,
	"price"	numeric NOT NULL,
	"payment"	varchar NOT NULL,
	"status"	varchar NOT NULL DEFAULT 'Pending',
	"sender_address_id"	integer,
	"receiver_address_id"	integer,
	"created_at"	datetime,
	"updated_at"	datetime,
	"merchant_id"	integer,
	"client_id"	integer,
	"payment_number"	varchar,
	"verification_code"	varchar,
	"courier_longitude"	numeric,
	"courier_latitude"	numeric,
	"courier_address_name"	varchar,
	"courier_id"	integer,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("sender_address_id") REFERENCES "addresses"("id") on delete cascade,
	FOREIGN KEY("receiver_address_id") REFERENCES "addresses"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "reviews" (
	"id"	integer NOT NULL,
	"order_id"	integer NOT NULL,
	"rating"	integer NOT NULL,
	"comment"	text,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("order_id") REFERENCES "orders"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "refunds" (
	"id"	integer NOT NULL,
	"order_id"	integer NOT NULL,
	"reason"	text NOT NULL,
	"approved"	tinyint(1) NOT NULL DEFAULT '0',
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("order_id") REFERENCES "orders"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "notifications" (
	"id"	integer NOT NULL,
	"sender_id"	integer NOT NULL,
	"receiver_id"	integer NOT NULL,
	"message"	text NOT NULL,
	"status"	varchar NOT NULL DEFAULT 'unread' CHECK("status" IN ('unread', 'read')),
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("receiver_id") REFERENCES "users"("id") on delete cascade,
	FOREIGN KEY("sender_id") REFERENCES "users"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "kycs" (
	"id"	integer NOT NULL,
	"user_id"	integer NOT NULL,
	"family_member_name"	varchar NOT NULL,
	"family_member_phone"	varchar NOT NULL,
	"relation"	varchar NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("user_id") REFERENCES "users"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "documents" (
	"id"	integer NOT NULL,
	"kyc_id"	integer NOT NULL,
	"path"	varchar NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("kyc_id") REFERENCES "kycs"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "couriers" (
	"id"	integer NOT NULL,
	"id_number"	varchar NOT NULL,
	"name"	varchar NOT NULL,
	"vehicle_brand"	varchar NOT NULL,
	"vehicle_registration_number"	varchar NOT NULL,
	"vehicle_color"	varchar NOT NULL,
	"availability"	varchar NOT NULL,
	"city"	varchar NOT NULL,
	"neighborhood"	varchar NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime,
	"user_id"	integer NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "storekeepers" (
	"id"	integer NOT NULL,
	"id_number"	varchar NOT NULL,
	"name"	varchar NOT NULL,
	"availability"	varchar NOT NULL,
	"city"	varchar NOT NULL,
	"neighborhood"	varchar NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime,
	"user_id"	integer NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "categories" (
	"id"	integer NOT NULL,
	"name"	varchar NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "products" (
	"id"	integer NOT NULL,
	"user_id"	integer NOT NULL,
	"category_id"	integer NOT NULL,
	"name"	varchar NOT NULL,
	"description"	text,
	"price"	numeric NOT NULL,
	"stock"	integer NOT NULL DEFAULT '0',
	"created_at"	datetime,
	"updated_at"	datetime,
	"merchant_id"	integer NOT NULL,
	"storefront_id"	integer,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("category_id") REFERENCES "categories"("id") on delete cascade,
	FOREIGN KEY("user_id") REFERENCES "users"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "product_images" (
	"id"	integer NOT NULL,
	"product_id"	integer NOT NULL,
	"image_path"	varchar NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("product_id") REFERENCES "products"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "merchants" (
	"id"	integer NOT NULL,
	"user_id"	integer NOT NULL,
	"name"	varchar NOT NULL,
	"phone"	varchar NOT NULL,
	"address"	varchar,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("user_id") REFERENCES "users"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "order_product" (
	"id"	integer NOT NULL,
	"order_id"	integer NOT NULL,
	"product_id"	integer NOT NULL,
	"quantity"	integer NOT NULL DEFAULT '1',
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("product_id") REFERENCES "products"("id") on delete cascade,
	FOREIGN KEY("order_id") REFERENCES "orders"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "images" (
	"id"	integer NOT NULL,
	"user_id"	integer NOT NULL,
	"image_path"	varchar NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("user_id") REFERENCES "users"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "wallets" (
	"id"	integer NOT NULL,
	"user_id"	integer NOT NULL,
	"balance"	numeric NOT NULL DEFAULT '0',
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("user_id") REFERENCES "users"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "storefronts" (
	"id"	integer NOT NULL,
	"merchant_id"	integer NOT NULL,
	"name"	varchar NOT NULL,
	"category"	varchar NOT NULL,
	"status"	varchar NOT NULL DEFAULT 'active',
	"premium_access"	integer NOT NULL DEFAULT '0',
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("merchant_id") REFERENCES "merchants"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "deliveries" (
	"id"	integer NOT NULL,
	"courier_id"	integer NOT NULL,
	"client_id"	integer NOT NULL,
	"merchant_id"	integer NOT NULL,
	"order_id"	integer NOT NULL,
	"start_time"	datetime,
	"end_time"	datetime,
	"status"	varchar NOT NULL DEFAULT 'Pending' CHECK("status" IN ('Pending', 'Delivered', 'Cancelled')),
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("client_id") REFERENCES "clients"("id") on delete cascade,
	FOREIGN KEY("courier_id") REFERENCES "couriers"("id") on delete cascade,
	FOREIGN KEY("merchant_id") REFERENCES "merchants"("id") on delete cascade,
	FOREIGN KEY("order_id") REFERENCES "orders"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "courier_locations" (
	"id"	integer NOT NULL,
	"courier_id"	integer NOT NULL,
	"latitude"	numeric NOT NULL,
	"longitude"	numeric NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("courier_id") REFERENCES "couriers"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "user_sessions" (
	"id"	integer NOT NULL,
	"user_id"	integer NOT NULL,
	"login_at"	datetime NOT NULL,
	"logout_at"	datetime,
	"duration"	integer NOT NULL DEFAULT '0',
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("user_id") REFERENCES "users"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "courier_addresses" (
	"id"	integer NOT NULL,
	"courier_id"	integer NOT NULL,
	"longitude"	numeric,
	"latitude"	numeric,
	"address_name"	varchar,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("courier_id") REFERENCES "couriers"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "colors" (
	"id"	integer NOT NULL,
	"name"	varchar NOT NULL,
	"hex_code"	varchar NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT)
);
INSERT INTO "migrations" ("id","migration","batch") VALUES (1,'2000_09_20_092613_create_permission_tables',1),
 (2,'2018_08_29_144823_create_user',1),
 (3,'2019_08_19_000000_create_failed_jobs_table',1),
 (4,'2019_12_14_000001_create_personal_access_tokens_table',1),
 (5,'2023_10_08_072111_create_addresses_table',1),
 (6,'2024_08_21_084230_create_clients_table',1),
 (7,'2024_08_21_084331_create_carts_table',1),
 (8,'2024_08_21_084530_create_orders_table',1),
 (9,'2024_08_21_084620_create_reviews_table',1),
 (10,'2024_08_21_084653_create_refunds_table',1),
 (11,'2024_08_21_085900_create_notifications_table',1),
 (12,'2024_08_22_080008_jb',1),
 (13,'2024_09_21_091710_create_kycs_table',1),
 (14,'2024_09_21_091815_create_documents_table',1),
 (15,'2024_09_21_093727_create_couriers_table',1),
 (16,'2024_09_21_093734_create_storekeepers_table',1),
 (17,'2024_10_01_084000_create_categories_table',1),
 (18,'2024_10_01_084054_create_products_table',1),
 (19,'2024_10_01_084706_create_product_images_table',1),
 (20,'2024_10_04_102133_add_merchant_id_to_orders_table',1),
 (21,'2024_10_04_102640_add_client_id_to_orders_table',1),
 (22,'2024_10_04_114841_add_payment_number_to_orders_table',1),
 (23,'2024_10_04_165143_create_merchants_table',1),
 (24,'2024_10_04_171316_add_role_to_users_table',1),
 (25,'2024_10_04_182424_add_merchant_id_to_products_table',1),
 (26,'2024_10_04_191706_create_order_product_table',1),
 (27,'2024_10_05_134845_add_column_user_id',1),
 (28,'2024_10_05_140325_add_column_user_id',1),
 (29,'2024_10_07_075730_create_images_table',1),
 (30,'2024_10_07_095954_create_wallets_table',1),
 (31,'2024_10_08_072526_add_fees_to_addresses_table',1),
 (32,'2024_10_08_081534_create_storefronts_table',1),
 (33,'2024_10_08_084012_add_storefront_id_to_products_table',1),
 (34,'2024_10_11_084355_create_deliveries_table',1),
 (35,'2024_10_11_185547_create_courier_locations_table',1),
 (36,'2024_10_15_212931_add_verification_code_to_orders_table',1),
 (37,'2024_10_18_184240_create_user_sessions_table',1),
 (38,'2024_10_19_102141_add_courier_location_to_orders_table',1),
 (39,'2024_10_19_103225_create_courier_addresses_table',1),
 (40,'2024_10_19_123119_add_courier_id_to_orders_table',1),
 (41,'2025_04_13_131755_add_created_by_to_users_table',1),
 (42,'2025_06_09_103104_colors',1),
 (43,'2025_07_05_085203_add_interests_to_users_table',2);
INSERT INTO "roles" ("id","name","guard_name","created_at","updated_at") VALUES (1,'Super Admin','web','2025-07-02 11:29:29','2025-07-02 11:29:29'),
 (2,'Admin','web','2025-07-02 11:29:29','2025-07-02 11:29:29'),
 (3,'Storekeeper','web','2025-07-02 11:29:29','2025-07-02 11:29:29'),
 (4,'Courier','web','2025-07-02 11:29:29','2025-07-02 11:29:29'),
 (5,'Client','web','2025-07-02 11:29:29','2025-07-02 11:29:29'),
 (6,'Merchant Client','web','2025-07-02 11:29:29','2025-07-02 11:29:29');
INSERT INTO "permissions" ("id","name","guard_name","created_at","updated_at") VALUES (1,'manage users','web','2025-07-02 11:29:30','2025-07-02 11:29:30'),
 (2,'manage orders','web','2025-07-02 11:29:30','2025-07-02 11:29:30'),
 (3,'manage deliveries','web','2025-07-02 11:29:30','2025-07-02 11:29:30'),
 (4,'manage products','web','2025-07-02 11:29:30','2025-07-02 11:29:30'),
 (5,'view reports','web','2025-07-02 11:29:30','2025-07-02 11:29:30'),
 (6,'manage inventory','web','2025-07-02 11:29:30','2025-07-02 11:29:30'),
 (7,'handle deliveries','web','2025-07-02 11:29:30','2025-07-02 11:29:30'),
 (8,'place orders','web','2025-07-02 11:29:30','2025-07-02 11:29:30'),
 (9,'manage counters','web','2025-07-02 11:29:30','2025-07-02 11:29:30');
INSERT INTO "role_has_permissions" ("permission_id","role_id") VALUES (1,1),
 (2,1),
 (3,1),
 (4,1),
 (5,1),
 (6,1),
 (7,1),
 (8,1),
 (9,1),
 (1,2),
 (2,2),
 (3,2),
 (5,2),
 (4,3),
 (6,3),
 (7,3),
 (7,4),
 (8,5),
 (9,6),
 (8,6);
INSERT INTO "model_has_roles" ("role_id","model_id","model_type") VALUES (1,2,'App\Models\User'),
 (5,3,'App\Models\User'),
 (6,3,'App\Models\User'),
 (5,4,'App\Models\User'),
 (2,5,'App\Models\User'),
 (4,6,'App\Models\User'),
 (5,7,'App\Models\User'),
 (5,10,'App\Models\User'),
 (5,11,'App\Models\User');
INSERT INTO "users" ("id","name","username","phone","email","email_verified_at","password","remember_token","created_at","updated_at","role","created_by","interests") VALUES (1,'Yan',NULL,'00000000000','yan@gmail.com',NULL,'$2y$12$TG.j0rGP9WZOzxTxJwCCbeBp8rLI/9aDeA6PIbBI7xoBF2rskDhUu',NULL,'2025-07-02 11:29:01','2025-07-02 11:29:01','client',NULL,NULL),
 (2,'Super Admin','superadmin','123456789','superadmin@example.com',NULL,'$2y$12$BfSMFi75K.5Bs3aMEskbwOsodsnkZrzx24JHlPLZVjpM8lubF5oge',NULL,'2025-07-02 11:29:30','2025-07-02 11:29:30','super_admin',NULL,NULL),
 (3,'marcel',NULL,'00000000000','marcel@gmail.com',NULL,'$2y$12$d6L6ggHYqid7IADb/6hXjO3DWrQzRA7DYPMvnsTjGpOWYJqhpvwOy',NULL,'2025-07-02 11:32:50','2025-07-02 11:32:50','client',NULL,NULL),
 (4,'alyzee1',NULL,'00000000000','alyzee@gmail.com',NULL,'$2y$12$ez4XpKU3LO1Qu1JYuHaJb.ks0CEYIdNJkT614FjxXCMU6Nb2LOWMC',NULL,'2025-07-02 11:46:27','2025-07-04 16:48:39','client',NULL,NULL),
 (5,'Dieudonné Yanava',NULL,'00000000000','yanava@gmail.com',NULL,'$2y$12$AuV7xZRs/pPaBxsrqE8b6u0FIaShvqX2XT1gKghPIvAiXMFxWl6ia',NULL,'2025-07-02 11:51:39','2025-07-02 11:51:39','client',NULL,NULL),
 (6,'borel',NULL,NULL,'borel@gmail.com',NULL,'$2y$12$A5WTMzZSN.5n1QCkpDlYZep9KTi4j391.3SbwdudnG6nQ31AFw/CC',NULL,'2025-07-02 11:55:00','2025-07-02 11:55:00','courier',NULL,NULL),
 (7,'test1',NULL,'00000000000','test1@gmail.com',NULL,'$2y$12$iAD2JLPwJYiONB.HZOH1HOf8GRg9CTLlssUMK7BgDc73QmGMmBLR.',NULL,'2025-07-05 09:10:34','2025-07-05 09:10:34','client',NULL,NULL),
 (8,'test2',NULL,'00000000000','test2@gmail.com',NULL,'$2y$12$K4bhlOSm47dykS66QpI/MuWal6lVz1.xYAP2Dc72KQJTo1QTo3Jhu',NULL,'2025-07-05 09:29:17','2025-07-05 09:29:17','client',NULL,NULL),
 (9,'test3',NULL,'00000000000','test3@gmail.com',NULL,'$2y$12$S4J6TugQwqFvuOSrerN7VuCnaI7QDjXg2Dx2/1y6uc3n/pcdV6p.i',NULL,'2025-07-05 09:31:38','2025-07-05 09:31:38','client',NULL,NULL),
 (10,'test4',NULL,'00000000000','test4@gmail.com',NULL,'$2y$12$7MnBykRX91lnd6YQe9ezLuVWVYxKAJOx70P3A7YjJzKtCoRbf1nvO',NULL,'2025-07-05 09:34:36','2025-07-05 09:34:36','client',NULL,NULL),
 (11,'test5',NULL,'00000000000','test5@gmail.com',NULL,'$2y$12$oDtGy3p/nxlIcPY/KjB6EO73c3gXVEXG0Ds4p7Cq9X6zVk2Y8Kv1q',NULL,'2025-07-05 09:45:11','2025-07-05 09:45:11','client',NULL,NULL);
INSERT INTO "addresses" ("id","country","town","quarter","latitude","longitude","created_at","updated_at","fees") VALUES (1,'Cameroon','Yaoundé','Bastos',3.8785,11.5156,NULL,NULL,2000),
 (2,'Cameroon','Yaoundé','Melen',3.8572,11.4857,NULL,NULL,1500),
 (3,'Cameroon','Yaoundé','Etoudi',3.8961,11.5249,NULL,NULL,1500),
 (4,'Cameroon','Yaoundé','Nlongkak',3.8725,11.5142,NULL,NULL,1000),
 (5,'Cameroon','Yaoundé','Ngoa-Ekelle',3.8656,11.5016,NULL,NULL,1500),
 (6,'Cameroon','Yaoundé','Tsinga',3.866,11.5208,NULL,NULL,1500),
 (7,'Cameroon','Yaoundé','Ngousso',3.878,11.5273,NULL,NULL,1500),
 (8,'Cameroon','Yaoundé','Ekounou',3.8375,11.5406,NULL,NULL,2000),
 (9,'Cameroon','Yaoundé','Essos',3.8739,11.5483,NULL,NULL,1000),
 (10,'Cameroon','Yaoundé','Biyem-Assi',3.8295,11.4844,NULL,NULL,1500),
 (11,'Cameroon','Yaoundé','Obili',3.8661,11.4889,NULL,NULL,1500),
 (12,'Cameroon','Yaoundé','Mvog-Mbi',3.8539,11.5167,NULL,NULL,1000),
 (13,'Cameroon','Yaoundé','Damas',3.8496,11.554,NULL,NULL,1500),
 (14,'Cameroon','Yaoundé','Mokolo',3.8576,11.5204,NULL,NULL,1000),
 (15,'Cameroon','Yaoundé','Mvan',3.8167,11.5458,NULL,NULL,2000),
 (16,'Cameroon','Yaoundé','Briqueterie',3.8711,11.5083,NULL,NULL,1000),
 (17,'Cameroon','Yaoundé','Simbok',3.8893,11.4815,NULL,NULL,2000),
 (18,'Cameroon','Yaoundé','Nsam',3.8446,11.5321,NULL,NULL,1500),
 (19,'Cameroon','Yaoundé','Etoa-Meki',3.8782,11.5189,NULL,NULL,1000),
 (20,'Cameroon','Yaoundé','Essomba',3.8742,11.5129,NULL,NULL,1000),
 (21,'Cameroon','Yaoundé','Olembe',3.9243,11.4947,NULL,NULL,2000),
 (22,'Cameroon','Yaoundé','Mimboman',3.8544,11.5702,NULL,NULL,1500),
 (23,'Cameroon','Yaoundé','Nkoabang',3.8744,11.5934,NULL,NULL,2000),
 (24,'Cameroon','Yaoundé','Nkolbisson',3.8567,11.4401,NULL,NULL,2000),
 (25,'Cameroon','Yaoundé','Mfandena',3.8671,11.5174,NULL,NULL,1000),
 (26,'Cameroon','Yaoundé','Awae',3.841,11.551,NULL,NULL,1500),
 (27,'Cameroon','Yaoundé','Carrefour Messassi',3.8728,11.5329,NULL,NULL,1000),
 (28,'Cameroon','Yaoundé','Ahala',3.7967,11.5284,NULL,NULL,2000);
INSERT INTO "clients" ("id","user_id","created_at","updated_at") VALUES (1,1,'2025-07-02 11:29:01','2025-07-02 11:29:01'),
 (2,3,'2025-07-02 11:32:50','2025-07-02 11:32:50'),
 (3,4,'2025-07-02 11:46:27','2025-07-02 11:46:27'),
 (4,7,'2025-07-05 09:10:34','2025-07-05 09:10:34'),
 (5,8,'2025-07-05 09:29:17','2025-07-05 09:29:17'),
 (6,9,'2025-07-05 09:31:38','2025-07-05 09:31:38'),
 (7,10,'2025-07-05 09:34:36','2025-07-05 09:34:36'),
 (8,11,'2025-07-05 09:45:11','2025-07-05 09:45:11');
INSERT INTO "orders" ("id","sender_name","sender_phone","sender_town","sender_quarter","receiver_name","receiver_phone","receiver_town","receiver_quarter","product_info","category","price","payment","status","sender_address_id","receiver_address_id","created_at","updated_at","merchant_id","client_id","payment_number","verification_code","courier_longitude","courier_latitude","courier_address_name","courier_id") VALUES (1,'Dieudonné Yanava','000000','Yaoundé','Etoudi','Dieudonné Yanava','000000000000','Yaoundé','Ngoa-Ekelle','Ecouteur','2',10000,'orange','Success',NULL,NULL,'2025-07-02 11:49:27','2025-07-02 11:59:07',1,4,'1234555555555555555','PjSuNuD',11.5113984,3.8567936,'Rue 3.043, Centre Administratif, Yaoundé III, Yaoundé, Mfoundi, Région du Centre, Cameroun',1);
INSERT INTO "couriers" ("id","id_number","name","vehicle_brand","vehicle_registration_number","vehicle_color","availability","city","neighborhood","created_at","updated_at","user_id") VALUES (1,'AZERTYUIOOOOKJ','borel','Audi','CE 1294 JI','black','12','Yaoundé','etoudi','2025-07-02 11:55:00','2025-07-02 11:55:00',6);
INSERT INTO "categories" ("id","name","created_at","updated_at") VALUES (1,'Electronics',NULL,NULL),
 (2,'Books',NULL,NULL),
 (3,'Clothing',NULL,NULL),
 (4,'Home & Kitchen',NULL,NULL),
 (5,'Sports',NULL,NULL),
 (6,'Toys & Games',NULL,NULL),
 (7,'Health & Beauty',NULL,NULL),
 (8,'Automotive',NULL,NULL),
 (9,'Garden',NULL,NULL),
 (10,'Office Supplies',NULL,NULL),
 (11,'Pet Supplies',NULL,NULL),
 (12,'Jewelry',NULL,NULL),
 (13,'Movies & Music',NULL,NULL),
 (14,'Food & Beverages',NULL,NULL),
 (15,'Travel & Leisure',NULL,NULL),
 (16,'Fitness Equipment',NULL,NULL);
INSERT INTO "products" ("id","user_id","category_id","name","description","price","stock","created_at","updated_at","merchant_id","storefront_id") VALUES (2,3,2,'Ecouteur','Pour suivre sa musique',10000,10,'2025-07-02 11:45:39','2025-07-02 11:45:39',1,1);
INSERT INTO "merchants" ("id","user_id","name","phone","address","created_at","updated_at") VALUES (1,3,'marcel','00000000000',NULL,'2025-07-02 11:38:33','2025-07-02 11:38:33');
INSERT INTO "images" ("id","user_id","image_path","created_at","updated_at") VALUES (1,9,'uploads/profile_images/1751707898_EEUEZ-LOGO.jpg','2025-07-05 09:31:38','2025-07-05 09:31:38'),
 (2,10,'uploads/profile_images/1751708076_EEUEZ-LOGO.jpg','2025-07-05 09:34:36','2025-07-05 09:34:36'),
 (3,11,'uploads/profile_images/1751708711_EEUEZ-LOGO.jpg','2025-07-05 09:45:11','2025-07-05 09:45:11');
INSERT INTO "wallets" ("id","user_id","balance","created_at","updated_at") VALUES (1,1,0,'2025-07-02 11:29:01','2025-07-02 11:29:01'),
 (2,3,99000,'2025-07-02 11:32:50','2025-07-02 11:38:33'),
 (3,4,0,'2025-07-02 11:46:27','2025-07-02 11:46:27'),
 (4,6,0,'2025-07-02 11:55:00','2025-07-02 11:55:00'),
 (5,7,0,'2025-07-05 09:10:34','2025-07-05 09:10:34'),
 (6,10,0,'2025-07-05 09:34:36','2025-07-05 09:34:36'),
 (7,11,0,'2025-07-05 09:45:11','2025-07-05 09:45:11');
INSERT INTO "storefronts" ("id","merchant_id","name","category","status","premium_access","created_at","updated_at") VALUES (1,1,'Itech','Sports','active',0,'2025-07-02 11:39:42','2025-07-02 11:39:42');
INSERT INTO "user_sessions" ("id","user_id","login_at","logout_at","duration","created_at","updated_at") VALUES (1,1,'2025-07-02 11:32:01','2025-07-02 11:32:01',0,'2025-07-02 11:32:01','2025-07-02 11:32:01'),
 (2,3,'2025-07-02 11:33:07','2025-07-02 11:46:04',777,'2025-07-02 11:33:07','2025-07-02 11:46:04'),
 (3,4,'2025-07-02 11:46:40','2025-07-02 11:50:09',209,'2025-07-02 11:46:40','2025-07-02 11:50:09'),
 (4,2,'2025-07-02 11:50:44',NULL,0,'2025-07-02 11:50:44','2025-07-02 11:50:44'),
 (5,5,'2025-07-02 11:51:51','2025-07-02 11:55:16',205,'2025-07-02 11:51:51','2025-07-02 11:55:16'),
 (6,6,'2025-07-02 11:55:28','2025-07-02 11:55:52',24,'2025-07-02 11:55:28','2025-07-02 11:55:52'),
 (7,4,'2025-07-02 11:56:23',NULL,0,'2025-07-02 11:56:23','2025-07-02 11:56:23'),
 (8,6,'2025-07-02 11:58:52',NULL,0,'2025-07-02 11:58:52','2025-07-02 11:58:52'),
 (9,4,'2025-07-02 12:10:52',NULL,0,'2025-07-02 12:10:52','2025-07-02 12:10:52'),
 (10,4,'2025-07-02 12:34:39',NULL,0,'2025-07-02 12:34:39','2025-07-02 12:34:39'),
 (11,4,'2025-07-03 08:36:45',NULL,0,'2025-07-03 08:36:45','2025-07-03 08:36:45'),
 (12,4,'2025-07-03 16:29:58',NULL,0,'2025-07-03 16:29:58','2025-07-03 16:29:58'),
 (13,4,'2025-07-04 08:14:09',NULL,0,'2025-07-04 08:14:09','2025-07-04 08:14:09'),
 (14,4,'2025-07-04 13:02:13',NULL,0,'2025-07-04 13:02:13','2025-07-04 13:02:13'),
 (15,4,'2025-07-04 13:04:02',NULL,0,'2025-07-04 13:04:02','2025-07-04 13:04:02'),
 (16,4,'2025-07-05 07:52:28',NULL,0,'2025-07-05 07:52:28','2025-07-05 07:52:28'),
 (17,7,'2025-07-05 09:10:55',NULL,0,'2025-07-05 09:10:55','2025-07-05 09:10:55'),
 (18,7,'2025-07-05 09:14:46',NULL,0,'2025-07-05 09:14:46','2025-07-05 09:14:46'),
 (19,8,'2025-07-05 09:36:18','2025-07-05 09:36:18',0,'2025-07-05 09:36:18','2025-07-05 09:36:18'),
 (20,9,'2025-07-05 09:36:57','2025-07-05 09:36:57',0,'2025-07-05 09:36:57','2025-07-05 09:36:57'),
 (21,9,'2025-07-05 09:42:31','2025-07-05 09:42:31',0,'2025-07-05 09:42:31','2025-07-05 09:42:31'),
 (22,7,'2025-07-05 09:42:46',NULL,0,'2025-07-05 09:42:46','2025-07-05 09:42:46'),
 (23,7,'2025-07-05 09:43:12',NULL,0,'2025-07-05 09:43:12','2025-07-05 09:43:12'),
 (24,8,'2025-07-05 09:43:29','2025-07-05 09:43:29',0,'2025-07-05 09:43:29','2025-07-05 09:43:29'),
 (25,7,'2025-07-05 09:47:19',NULL,0,'2025-07-05 09:47:19','2025-07-05 09:47:19');
INSERT INTO "courier_addresses" ("id","courier_id","longitude","latitude","address_name","created_at","updated_at") VALUES (1,1,11.5113984,3.8567936,'Rue 3.043, Centre Administratif, Yaoundé III, Yaoundé, Mfoundi, Centre, Cameroon','2025-07-02 11:55:28','2025-07-02 11:55:28'),
 (2,1,11.5113984,3.8567936,'Rue 3.043, Centre Administratif, Yaoundé III, Yaoundé, Mfoundi, Région du Centre, Cameroun','2025-07-02 11:58:52','2025-07-02 11:58:52');
CREATE UNIQUE INDEX IF NOT EXISTS "users_email_unique" ON "users" (
	"email"
);
CREATE UNIQUE INDEX IF NOT EXISTS "failed_jobs_uuid_unique" ON "failed_jobs" (
	"uuid"
);
CREATE INDEX IF NOT EXISTS "personal_access_tokens_tokenable_type_tokenable_id_index" ON "personal_access_tokens" (
	"tokenable_type",
	"tokenable_id"
);
CREATE UNIQUE INDEX IF NOT EXISTS "personal_access_tokens_token_unique" ON "personal_access_tokens" (
	"token"
);
CREATE UNIQUE INDEX IF NOT EXISTS "couriers_id_number_unique" ON "couriers" (
	"id_number"
);
CREATE UNIQUE INDEX IF NOT EXISTS "couriers_vehicle_registration_number_unique" ON "couriers" (
	"vehicle_registration_number"
);
CREATE UNIQUE INDEX IF NOT EXISTS "storekeepers_id_number_unique" ON "storekeepers" (
	"id_number"
);
CREATE UNIQUE INDEX IF NOT EXISTS "categories_name_unique" ON "categories" (
	"name"
);
CREATE UNIQUE INDEX IF NOT EXISTS "colors_name_unique" ON "colors" (
	"name"
);
CREATE UNIQUE INDEX IF NOT EXISTS "colors_hex_code_unique" ON "colors" (
	"hex_code"
);
COMMIT;
