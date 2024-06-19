BEGIN;


CREATE TABLE IF NOT EXISTS public.cart
(
    id integer NOT NULL DEFAULT nextval('cart_id_seq'::regclass),
    user_id integer NOT NULL,
    quantity integer,
    price numeric,
    product_id integer,
    updated_at date,
    created_at date,
    CONSTRAINT cart_pkey PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
);

CREATE TABLE IF NOT EXISTS public.failed_jobs
(
    id bigint NOT NULL DEFAULT nextval('failed_jobs_id_seq'::regclass),
    uuid character varying(255) COLLATE pg_catalog."default" NOT NULL,
    connection text COLLATE pg_catalog."default" NOT NULL,
    queue text COLLATE pg_catalog."default" NOT NULL,
    payload text COLLATE pg_catalog."default" NOT NULL,
    exception text COLLATE pg_catalog."default" NOT NULL,
    failed_at timestamp(0) without time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT failed_jobs_pkey PRIMARY KEY (id),
    CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid)
)
WITH (
    OIDS = FALSE
);

CREATE TABLE IF NOT EXISTS public.migrations
(
    id integer NOT NULL DEFAULT nextval('migrations_id_seq'::regclass),
    migration character varying(255) COLLATE pg_catalog."default" NOT NULL,
    batch integer NOT NULL,
    CONSTRAINT migrations_pkey PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
);

CREATE TABLE IF NOT EXISTS public.password_resets
(
    email character varying(255) COLLATE pg_catalog."default" NOT NULL,
    token character varying(255) COLLATE pg_catalog."default" NOT NULL,
    created_at timestamp(0) without time zone,
    CONSTRAINT password_resets_pkey PRIMARY KEY (email)
)
WITH (
    OIDS = FALSE
);

CREATE TABLE IF NOT EXISTS public.personal_access_tokens
(
    id bigint NOT NULL DEFAULT nextval('personal_access_tokens_id_seq'::regclass),
    tokenable_type character varying(255) COLLATE pg_catalog."default" NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) COLLATE pg_catalog."default" NOT NULL,
    token character varying(64) COLLATE pg_catalog."default" NOT NULL,
    abilities text COLLATE pg_catalog."default",
    last_used_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id),
    CONSTRAINT personal_access_tokens_token_unique UNIQUE (token)
)
WITH (
    OIDS = FALSE
);

CREATE TABLE IF NOT EXISTS public.products
(
    id bigint NOT NULL DEFAULT nextval('products_id_seq'::regclass),
    name character varying(255) COLLATE pg_catalog."default" NOT NULL,
    description text COLLATE pg_catalog."default" NOT NULL,
    price numeric(8, 2) NOT NULL,
    stock integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    category integer,
    image text COLLATE pg_catalog."default",
    pix numeric,
    CONSTRAINT products_pkey PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
);

COMMENT ON COLUMN public.products.category
    IS '1 - whey protein
2 - pre-treino
3 - vitamina
4 - pasta de amendoim
5 - barra de proteina';

COMMENT ON COLUMN public.products.pix
    IS 'desconto pelo pagamento por pix';

CREATE TABLE IF NOT EXISTS public.users
(
    id bigint NOT NULL DEFAULT nextval('users_id_seq'::regclass),
    name character varying(255) COLLATE pg_catalog."default" NOT NULL,
    email character varying(255) COLLATE pg_catalog."default" NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) COLLATE pg_catalog."default" NOT NULL,
    remember_token character varying(100) COLLATE pg_catalog."default",
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT users_pkey PRIMARY KEY (id),
    CONSTRAINT users_email_unique UNIQUE (email)
)
WITH (
    OIDS = FALSE
);
END;