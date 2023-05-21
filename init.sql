CREATE TABLE IF NOT EXISTS public.users (
	id uuid NOT NULL DEFAULT gen_random_uuid(),
	"tg_id" varchar(50) NOT NULL,
	"first_name" varchar(100) NOT NULL,
	"last_name" varchar(100) NOT NULL,
	"username" varchar(200) NOT NULL,
	"is_bot" boolean DEFAULT FALSE,
	"language_code" varchar(3) DEFAULT 'en',
	"created_at" timestamp NOT NULL DEFAULT NOW(),
	CONSTRAINT user_pkey PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS public.auth_logs (
	id uuid NOT NULL DEFAULT gen_random_uuid(),
	"user_id" uuid NOT NULL,
	"action" varchar(10) NOT NULL,
	"created_at" timestamp NOT NULL DEFAULT NOW(),
	CONSTRAINT auth_log_pkey PRIMARY KEY (id),
	CONSTRAINT auth_log_user_fk FOREIGN KEY (user_id) REFERENCES users(id)
);

