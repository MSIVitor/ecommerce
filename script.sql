-- SEQUENCE: public.cart_id_seq

-- DROP SEQUENCE IF EXISTS public.cart_id_seq;

CREATE SEQUENCE IF NOT EXISTS public.cart_id_seq
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9223372036854775807
    CACHE 1
    OWNED BY cart.id;

ALTER SEQUENCE public.cart_id_seq
    OWNER TO postgres;

-- SEQUENCE: public.failed_jobs_id_seq

-- DROP SEQUENCE IF EXISTS public.failed_jobs_id_seq;

CREATE SEQUENCE IF NOT EXISTS public.failed_jobs_id_seq
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9223372036854775807
    CACHE 1
    OWNED BY failed_jobs.id;

ALTER SEQUENCE public.failed_jobs_id_seq
    OWNER TO postgres;

-- SEQUENCE: public.migrations_id_seq

-- DROP SEQUENCE IF EXISTS public.migrations_id_seq;

CREATE SEQUENCE IF NOT EXISTS public.migrations_id_seq
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 2147483647
    CACHE 1
    OWNED BY migrations.id;

ALTER SEQUENCE public.migrations_id_seq
    OWNER TO postgres;

-- SEQUENCE: public.personal_access_tokens_id_seq

-- DROP SEQUENCE IF EXISTS public.personal_access_tokens_id_seq;

CREATE SEQUENCE IF NOT EXISTS public.personal_access_tokens_id_seq
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9223372036854775807
    CACHE 1
    OWNED BY personal_access_tokens.id;

ALTER SEQUENCE public.personal_access_tokens_id_seq
    OWNER TO postgres;

-- SEQUENCE: public.products_id_seq

-- DROP SEQUENCE IF EXISTS public.products_id_seq;

CREATE SEQUENCE IF NOT EXISTS public.products_id_seq
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9223372036854775807
    CACHE 1
    OWNED BY products.id;

ALTER SEQUENCE public.products_id_seq
    OWNER TO postgres;

-- SEQUENCE: public.users_id_seq

-- DROP SEQUENCE IF EXISTS public.users_id_seq;

CREATE SEQUENCE IF NOT EXISTS public.users_id_seq
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9223372036854775807
    CACHE 1
    OWNED BY users.id;

ALTER SEQUENCE public.users_id_seq
    OWNER TO postgres;


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


    INSERT INTO public.products (name, description, price, image, pix)
VALUES ('100% Whey Protein Gold Standard (2270g) - Optimum Nutrition', 
        'O 100% Whey Protein Gold Standard 2270g da Optimum Nutrition é um suplemento proteico composto pela mistura do whey protein concentrado, isolado e hidrolisado. Sua composição oferece uma absorção rápida e gradual pela musculatura.',
        80.00,
        'https://images.tcdn.com.br/img/img_prod/1131941/whey_protein_isolado_baunilha_450g_dux_nutrition_661_1_33ac947318374ae7b22ac91d1bd68fe4.jpg',
        20);

INSERT INTO public.products (name, description, price, image, pix)
VALUES ('Horus 150g - Max Titanium Frutas Vermelhas',
        'O Horús foi o primeiro pré-treino brasileiro, lançado após a liberação da ANVISA para o uso de Beta Alanina pela indústria de suplementos. Ele contém ingredientes que irão potencializar o seu treino e melhorar sua performance! Para quem se exercita com intensidade, a fadiga é um dos principais fatores que influenciam o rendimento, por isso desenvolvemos o HÓRUS: com formulação altamente tecnológica e ingredientes de altíssima qualidade, para você ter um treino com muito mais eficiência.',
        82.84,
        'https://lojamaxtitanium.vtexassets.com/arquivos/ids/157427-1200-1200?v=638344607351200000&width=1200&height=1200&aspect=true',
        10);
