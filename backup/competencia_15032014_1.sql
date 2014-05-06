--
-- PostgreSQL database dump
--

-- Dumped from database version 9.1.12
-- Dumped by pg_dump version 9.1.12
-- Started on 2014-03-15 18:41:56 VET

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 186 (class 3079 OID 11720)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2108 (class 0 OID 0)
-- Dependencies: 186
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- TOC entry 198 (class 1255 OID 24648)
-- Dependencies: 6 571
-- Name: actualizar_categoria(integer, character varying, integer, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION actualizar_categoria(pid integer, pnombre character varying, pedad_min integer, pedad_max integer) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
begin
UPDATE categoria SET nombre= pnombre , edad_min=pedad_min, edad_max=pedad_max WHERE id_categoria = pid ;
if found then
return true;
else
return false;
end if;
end;$$;


ALTER FUNCTION public.actualizar_categoria(pid integer, pnombre character varying, pedad_min integer, pedad_max integer) OWNER TO postgres;

--
-- TOC entry 199 (class 1255 OID 24649)
-- Dependencies: 6 571
-- Name: agregar_tiempobp(integer, integer, integer, numeric); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION agregar_tiempobp(pid_inscripcion integer, psalida integer, pvuelta integer, ptiempo numeric) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
BEGIN
CASE WHEN ptiempo= 0 THEN 
INSERT INTO ranking(id_inscripcion,salida,vuelta, tiempo) VALUES (pid_inscripcion,psalida,pvuelta,null);
RETURN true;
else 
INSERT INTO ranking(id_inscripcion,salida,vuelta, tiempo) VALUES (pid_inscripcion,psalida,pvuelta,ptiempo);
return true;	
END CASE;

END;

$$;


ALTER FUNCTION public.agregar_tiempobp(pid_inscripcion integer, psalida integer, pvuelta integer, ptiempo numeric) OWNER TO postgres;

--
-- TOC entry 200 (class 1255 OID 24650)
-- Dependencies: 571 6
-- Name: ejemplo(integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION ejemplo(numero integer) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
DECLARE 
cont integer;
BEGIN
cont:=1;
FOR cont IN cont..numero LOOP
	
	raise notice '%',cont;
	
	END LOOP;
	
END;

$$;


ALTER FUNCTION public.ejemplo(numero integer) OWNER TO postgres;

--
-- TOC entry 201 (class 1255 OID 24651)
-- Dependencies: 6 571
-- Name: eliminar_categoria(integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION eliminar_categoria(pid integer) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
begin
DELETE FROM categoria WHERE id_categoria = pid;
if found then
return true;
else
return false;
end if;
end;$$;


ALTER FUNCTION public.eliminar_categoria(pid integer) OWNER TO postgres;

--
-- TOC entry 202 (class 1255 OID 24652)
-- Dependencies: 6 571
-- Name: insertar_categoria(character varying, integer, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION insertar_categoria(pnombre character varying, pedad_min integer, pedad_max integer) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
begin
INSERT INTO categoria (nombre,edad_min,edad_max) VALUES (pnombre,pedad_min,pedad_max);
if found then
return true;
else
return false;
end if;
end;$$;


ALTER FUNCTION public.insertar_categoria(pnombre character varying, pedad_min integer, pedad_max integer) OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 161 (class 1259 OID 24653)
-- Dependencies: 1911 6
-- Name: categoria; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE categoria (
    id_categoria integer NOT NULL,
    nombre character varying(20) NOT NULL,
    edad_min smallint NOT NULL,
    edad_max smallint NOT NULL,
    CONSTRAINT val_nomb_vacio CHECK ((char_length(btrim((nombre)::text)) <> 0))
);


ALTER TABLE public.categoria OWNER TO postgres;

--
-- TOC entry 162 (class 1259 OID 24657)
-- Dependencies: 161 6
-- Name: categoria_id_categoria_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE categoria_id_categoria_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.categoria_id_categoria_seq OWNER TO postgres;

--
-- TOC entry 2109 (class 0 OID 0)
-- Dependencies: 162
-- Name: categoria_id_categoria_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE categoria_id_categoria_seq OWNED BY categoria.id_categoria;


--
-- TOC entry 163 (class 1259 OID 24659)
-- Dependencies: 6
-- Name: competencia; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE competencia (
    id_competencia integer NOT NULL,
    fecha date NOT NULL,
    id_modo_competencia integer NOT NULL,
    id_categoria integer NOT NULL,
    monto_inscripcion real NOT NULL,
    porc_casa smallint NOT NULL,
    porc_premio smallint NOT NULL,
    becerros smallint,
    vueltas smallint NOT NULL,
    sts character varying(5) NOT NULL
);


ALTER TABLE public.competencia OWNER TO postgres;

--
-- TOC entry 164 (class 1259 OID 24662)
-- Dependencies: 6 163
-- Name: competencia_id_competencia_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE competencia_id_competencia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.competencia_id_competencia_seq OWNER TO postgres;

--
-- TOC entry 2110 (class 0 OID 0)
-- Dependencies: 164
-- Name: competencia_id_competencia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE competencia_id_competencia_seq OWNED BY competencia.id_competencia;


--
-- TOC entry 165 (class 1259 OID 24664)
-- Dependencies: 1914 6
-- Name: competidor; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE competidor (
    id_competidor integer NOT NULL,
    cedula integer NOT NULL,
    nombre character varying(15) NOT NULL,
    fecha_nac date,
    edad smallint,
    CONSTRAINT val_nomb_vacio CHECK ((char_length(btrim((nombre)::text)) <> 0))
);


ALTER TABLE public.competidor OWNER TO postgres;

--
-- TOC entry 166 (class 1259 OID 24668)
-- Dependencies: 165 6
-- Name: competidor_id_competidor_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE competidor_id_competidor_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.competidor_id_competidor_seq OWNER TO postgres;

--
-- TOC entry 2111 (class 0 OID 0)
-- Dependencies: 166
-- Name: competidor_id_competidor_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE competidor_id_competidor_seq OWNED BY competidor.id_competidor;


--
-- TOC entry 167 (class 1259 OID 24670)
-- Dependencies: 6
-- Name: inscripcion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE inscripcion (
    id_inscripcion integer NOT NULL,
    id_competencia integer NOT NULL,
    id_equipo integer,
    cedula integer
);


ALTER TABLE public.inscripcion OWNER TO postgres;

--
-- TOC entry 168 (class 1259 OID 24673)
-- Dependencies: 2076 6
-- Name: competidores_aleatorios; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW competidores_aleatorios AS
    SELECT insc.id_inscripcion, comp.nombre, insc.id_competencia FROM inscripcion insc, competidor comp WHERE (insc.cedula = comp.cedula) ORDER BY random();


ALTER TABLE public.competidores_aleatorios OWNER TO postgres;

--
-- TOC entry 169 (class 1259 OID 24677)
-- Dependencies: 1917 6
-- Name: equipo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE equipo (
    id_equipo integer NOT NULL,
    nombre character varying(20) NOT NULL,
    CONSTRAINT val_nomb_vacio CHECK ((char_length(btrim((nombre)::text)) <> 0))
);


ALTER TABLE public.equipo OWNER TO postgres;

--
-- TOC entry 170 (class 1259 OID 24681)
-- Dependencies: 6 169
-- Name: equipo_id_equipo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE equipo_id_equipo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.equipo_id_equipo_seq OWNER TO postgres;

--
-- TOC entry 2112 (class 0 OID 0)
-- Dependencies: 170
-- Name: equipo_id_equipo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE equipo_id_equipo_seq OWNED BY equipo.id_equipo;


--
-- TOC entry 171 (class 1259 OID 24683)
-- Dependencies: 2077 6
-- Name: equipos_aleatorios; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW equipos_aleatorios AS
    SELECT insc.id_inscripcion, equip.nombre, insc.id_competencia FROM inscripcion insc, equipo equip WHERE (insc.id_equipo = equip.id_equipo) ORDER BY random();


ALTER TABLE public.equipos_aleatorios OWNER TO postgres;

--
-- TOC entry 172 (class 1259 OID 24687)
-- Dependencies: 6 167
-- Name: inscripcion_id_inscripcion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE inscripcion_id_inscripcion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.inscripcion_id_inscripcion_seq OWNER TO postgres;

--
-- TOC entry 2113 (class 0 OID 0)
-- Dependencies: 172
-- Name: inscripcion_id_inscripcion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE inscripcion_id_inscripcion_seq OWNED BY inscripcion.id_inscripcion;


--
-- TOC entry 173 (class 1259 OID 24689)
-- Dependencies: 6
-- Name: integrantes_equipo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE integrantes_equipo (
    id_int_equip integer NOT NULL,
    id_equipo integer NOT NULL,
    id_competidor integer NOT NULL
);


ALTER TABLE public.integrantes_equipo OWNER TO postgres;

--
-- TOC entry 174 (class 1259 OID 24692)
-- Dependencies: 173 6
-- Name: integrantes_equipo_id_int_equip_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE integrantes_equipo_id_int_equip_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.integrantes_equipo_id_int_equip_seq OWNER TO postgres;

--
-- TOC entry 2114 (class 0 OID 0)
-- Dependencies: 174
-- Name: integrantes_equipo_id_int_equip_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE integrantes_equipo_id_int_equip_seq OWNED BY integrantes_equipo.id_int_equip;


--
-- TOC entry 175 (class 1259 OID 24694)
-- Dependencies: 1920 1921 6
-- Name: modo_competencia; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE modo_competencia (
    id_modo_competencia integer NOT NULL,
    nombre character varying(20) NOT NULL,
    modalidad character varying(15) NOT NULL,
    CONSTRAINT val_modalidad CHECK ((((modalidad)::text = 'individual'::text) OR ((modalidad)::text = 'grupo'::text))),
    CONSTRAINT val_nomb_vacio CHECK ((char_length(btrim((nombre)::text)) <> 0))
);


ALTER TABLE public.modo_competencia OWNER TO postgres;

--
-- TOC entry 176 (class 1259 OID 24699)
-- Dependencies: 6 175
-- Name: modo_competencia_id_modo_competencia_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE modo_competencia_id_modo_competencia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.modo_competencia_id_modo_competencia_seq OWNER TO postgres;

--
-- TOC entry 2115 (class 0 OID 0)
-- Dependencies: 176
-- Name: modo_competencia_id_modo_competencia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE modo_competencia_id_modo_competencia_seq OWNED BY modo_competencia.id_modo_competencia;


--
-- TOC entry 177 (class 1259 OID 24701)
-- Dependencies: 2078 6
-- Name: mostrar_competencia; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW mostrar_competencia AS
    SELECT comp.id_competencia, (((((mc.nombre)::text || '/'::text) || (cat.nombre)::text) || '/'::text) || (mc.modalidad)::text) AS nombre, comp.fecha, mc.modalidad FROM competencia comp, modo_competencia mc, categoria cat WHERE (((comp.id_modo_competencia = mc.id_modo_competencia) AND (comp.id_categoria = cat.id_categoria)) AND ((comp.sts)::text = 'VAL'::text));


ALTER TABLE public.mostrar_competencia OWNER TO postgres;

--
-- TOC entry 178 (class 1259 OID 24705)
-- Dependencies: 1922 1923 6
-- Name: ranking; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ranking (
    id_ranking integer NOT NULL,
    id_inscripcion integer NOT NULL,
    vuelta smallint NOT NULL,
    salida smallint NOT NULL,
    tiempo numeric(5,3) DEFAULT NULL::numeric,
    becerro smallint,
    falla smallint DEFAULT 0
);


ALTER TABLE public.ranking OWNER TO postgres;

--
-- TOC entry 179 (class 1259 OID 24710)
-- Dependencies: 2079 6
-- Name: ranking_barriles_poste; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW ranking_barriles_poste AS
    SELECT comp.nombre, COALESCE((rank.tiempo)::text, 'N/T'::text) AS tiempo, insc.id_competencia FROM inscripcion insc, competidor comp, (SELECT DISTINCT ON (ranking.id_inscripcion) ranking.id_inscripcion, ranking.tiempo FROM ranking ORDER BY ranking.id_inscripcion, ranking.tiempo) rank WHERE ((rank.id_inscripcion = insc.id_inscripcion) AND (insc.cedula = comp.cedula)) ORDER BY rank.tiempo;


ALTER TABLE public.ranking_barriles_poste OWNER TO postgres;

--
-- TOC entry 180 (class 1259 OID 24714)
-- Dependencies: 2080 6
-- Name: primera_division; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW primera_division AS
    SELECT ranking_barriles_poste.nombre, ranking_barriles_poste.tiempo, ranking_barriles_poste.id_competencia FROM ranking_barriles_poste WHERE (((replace(ranking_barriles_poste.tiempo, 'N/T'::text, '99.999'::text))::numeric >= (SELECT min((replace(ranking_barriles_poste_1.tiempo, 'N/T'::text, '99.999'::text))::numeric) AS min FROM ranking_barriles_poste ranking_barriles_poste_1)) AND ((replace(ranking_barriles_poste.tiempo, 'N/T'::text, '99.999'::text))::numeric <= ((SELECT min((replace(ranking_barriles_poste_1.tiempo, 'N/T'::text, '99.999'::text))::numeric) AS min FROM ranking_barriles_poste ranking_barriles_poste_1) + (1)::numeric)));


ALTER TABLE public.primera_division OWNER TO postgres;

--
-- TOC entry 181 (class 1259 OID 24718)
-- Dependencies: 2081 6
-- Name: ranking_encierro; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW ranking_encierro AS
    SELECT equip.nombre, rank.id_inscripcion, sum(rank.tiempo) AS tiempo, sum(rank.becerro) AS becerro, rank.falla, insc.id_competencia FROM ranking rank, inscripcion insc, equipo equip WHERE ((rank.id_inscripcion = insc.id_inscripcion) AND (insc.id_equipo = equip.id_equipo)) GROUP BY equip.nombre, rank.id_inscripcion, rank.falla, insc.id_competencia ORDER BY rank.falla, sum(rank.becerro) DESC, sum(rank.tiempo);


ALTER TABLE public.ranking_encierro OWNER TO postgres;

--
-- TOC entry 182 (class 1259 OID 24722)
-- Dependencies: 6 178
-- Name: ranking_id_ranking_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ranking_id_ranking_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ranking_id_ranking_seq OWNER TO postgres;

--
-- TOC entry 2116 (class 0 OID 0)
-- Dependencies: 182
-- Name: ranking_id_ranking_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ranking_id_ranking_seq OWNED BY ranking.id_ranking;


--
-- TOC entry 183 (class 1259 OID 24724)
-- Dependencies: 2082 6
-- Name: segunda_division; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW segunda_division AS
    SELECT ranking_barriles_poste.nombre, ranking_barriles_poste.tiempo, ranking_barriles_poste.id_competencia FROM ranking_barriles_poste WHERE (((replace(ranking_barriles_poste.tiempo, 'N/T'::text, '99.999'::text))::numeric >= ((SELECT min((replace(ranking_barriles_poste_1.tiempo, 'N/T'::text, '99.999'::text))::numeric) AS min FROM ranking_barriles_poste ranking_barriles_poste_1) + 1.001)) AND ((replace(ranking_barriles_poste.tiempo, 'N/T'::text, '99.999'::text))::numeric <= ((SELECT min((replace(ranking_barriles_poste_1.tiempo, 'N/T'::text, '99.999'::text))::numeric) AS min FROM ranking_barriles_poste ranking_barriles_poste_1) + 2.001)));


ALTER TABLE public.segunda_division OWNER TO postgres;

--
-- TOC entry 184 (class 1259 OID 24728)
-- Dependencies: 2083 6
-- Name: tercera_division; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW tercera_division AS
    SELECT ranking_barriles_poste.nombre, ranking_barriles_poste.tiempo, ranking_barriles_poste.id_competencia FROM ranking_barriles_poste WHERE (((replace(ranking_barriles_poste.tiempo, 'N/T'::text, '99.999'::text))::numeric >= ((SELECT min((replace(ranking_barriles_poste_1.tiempo, 'N/T'::text, '99.999'::text))::numeric) AS min FROM ranking_barriles_poste ranking_barriles_poste_1) + 2.002)) AND ((replace(ranking_barriles_poste.tiempo, 'N/T'::text, '99.999'::text))::numeric <= ((SELECT min((replace(ranking_barriles_poste_1.tiempo, 'N/T'::text, '99.999'::text))::numeric) AS min FROM ranking_barriles_poste ranking_barriles_poste_1) + 3.002)));


ALTER TABLE public.tercera_division OWNER TO postgres;

--
-- TOC entry 185 (class 1259 OID 24732)
-- Dependencies: 2084 6
-- Name: ver_categoria; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW ver_categoria AS
    SELECT categoria.nombre, categoria.edad_min, categoria.edad_max, categoria.id_categoria FROM categoria ORDER BY categoria.nombre;


ALTER TABLE public.ver_categoria OWNER TO postgres;

--
-- TOC entry 1910 (class 2604 OID 24736)
-- Dependencies: 162 161
-- Name: id_categoria; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY categoria ALTER COLUMN id_categoria SET DEFAULT nextval('categoria_id_categoria_seq'::regclass);


--
-- TOC entry 1912 (class 2604 OID 24737)
-- Dependencies: 164 163
-- Name: id_competencia; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY competencia ALTER COLUMN id_competencia SET DEFAULT nextval('competencia_id_competencia_seq'::regclass);


--
-- TOC entry 1913 (class 2604 OID 24738)
-- Dependencies: 166 165
-- Name: id_competidor; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY competidor ALTER COLUMN id_competidor SET DEFAULT nextval('competidor_id_competidor_seq'::regclass);


--
-- TOC entry 1916 (class 2604 OID 24739)
-- Dependencies: 170 169
-- Name: id_equipo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY equipo ALTER COLUMN id_equipo SET DEFAULT nextval('equipo_id_equipo_seq'::regclass);


--
-- TOC entry 1915 (class 2604 OID 24740)
-- Dependencies: 172 167
-- Name: id_inscripcion; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inscripcion ALTER COLUMN id_inscripcion SET DEFAULT nextval('inscripcion_id_inscripcion_seq'::regclass);


--
-- TOC entry 1918 (class 2604 OID 24741)
-- Dependencies: 174 173
-- Name: id_int_equip; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY integrantes_equipo ALTER COLUMN id_int_equip SET DEFAULT nextval('integrantes_equipo_id_int_equip_seq'::regclass);


--
-- TOC entry 1919 (class 2604 OID 24742)
-- Dependencies: 176 175
-- Name: id_modo_competencia; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY modo_competencia ALTER COLUMN id_modo_competencia SET DEFAULT nextval('modo_competencia_id_modo_competencia_seq'::regclass);


--
-- TOC entry 1924 (class 2604 OID 24743)
-- Dependencies: 182 178
-- Name: id_ranking; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ranking ALTER COLUMN id_ranking SET DEFAULT nextval('ranking_id_ranking_seq'::regclass);


--
-- TOC entry 2085 (class 0 OID 24653)
-- Dependencies: 161 2101
-- Data for Name: categoria; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO categoria VALUES (15, 'Infantil', 8, 12);
INSERT INTO categoria VALUES (16, 'pedro', 9, 15);


--
-- TOC entry 2117 (class 0 OID 0)
-- Dependencies: 162
-- Name: categoria_id_categoria_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('categoria_id_categoria_seq', 17, true);


--
-- TOC entry 2087 (class 0 OID 24659)
-- Dependencies: 163 2101
-- Data for Name: competencia; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO competencia VALUES (1, '2014-01-19', 4, 15, 89, 20, 80, NULL, 2, 'VAL');
INSERT INTO competencia VALUES (5, '2014-01-19', 5, 15, 120, 50, 50, NULL, 3, 'VAL');


--
-- TOC entry 2118 (class 0 OID 0)
-- Dependencies: 164
-- Name: competencia_id_competencia_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('competencia_id_competencia_seq', 5, true);


--
-- TOC entry 2089 (class 0 OID 24664)
-- Dependencies: 165 2101
-- Data for Name: competidor; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO competidor VALUES (1, 18828200, 'Anthony', NULL, 8);
INSERT INTO competidor VALUES (2, 18828201, 'maria', NULL, 11);
INSERT INTO competidor VALUES (3, 18828202, 'pedro', NULL, 10);
INSERT INTO competidor VALUES (4, 18828203, 'Jose', NULL, 9);
INSERT INTO competidor VALUES (5, 18828204, 'gabriel', NULL, 8);
INSERT INTO competidor VALUES (6, 18828205, 'alejandro', NULL, 12);
INSERT INTO competidor VALUES (7, 18828206, 'manuel', NULL, 9);
INSERT INTO competidor VALUES (8, 18828207, 'felipe', NULL, 9);
INSERT INTO competidor VALUES (9, 18828208, 'andres', NULL, 10);
INSERT INTO competidor VALUES (37, 18621606, 'Javier Urbano', NULL, 26);


--
-- TOC entry 2119 (class 0 OID 0)
-- Dependencies: 166
-- Name: competidor_id_competidor_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('competidor_id_competidor_seq', 37, true);


--
-- TOC entry 2092 (class 0 OID 24677)
-- Dependencies: 169 2101
-- Data for Name: equipo; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO equipo VALUES (1, 'venezuela');
INSERT INTO equipo VALUES (2, 'brasil');
INSERT INTO equipo VALUES (3, 'bolivia');
INSERT INTO equipo VALUES (4, 'francia');


--
-- TOC entry 2120 (class 0 OID 0)
-- Dependencies: 170
-- Name: equipo_id_equipo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('equipo_id_equipo_seq', 1, false);


--
-- TOC entry 2091 (class 0 OID 24670)
-- Dependencies: 167 2101
-- Data for Name: inscripcion; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO inscripcion VALUES (2, 1, NULL, 18828201);
INSERT INTO inscripcion VALUES (3, 1, NULL, 18828202);
INSERT INTO inscripcion VALUES (4, 1, NULL, 18828203);
INSERT INTO inscripcion VALUES (5, 1, NULL, 18828204);
INSERT INTO inscripcion VALUES (6, 1, NULL, 18828205);
INSERT INTO inscripcion VALUES (7, 1, NULL, 18828206);
INSERT INTO inscripcion VALUES (8, 1, NULL, 18828207);
INSERT INTO inscripcion VALUES (9, 1, NULL, 18828208);
INSERT INTO inscripcion VALUES (10, 5, 1, NULL);
INSERT INTO inscripcion VALUES (11, 5, 2, NULL);
INSERT INTO inscripcion VALUES (12, 5, 3, NULL);
INSERT INTO inscripcion VALUES (13, 5, 4, NULL);
INSERT INTO inscripcion VALUES (1, 1, NULL, 18828200);


--
-- TOC entry 2121 (class 0 OID 0)
-- Dependencies: 172
-- Name: inscripcion_id_inscripcion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('inscripcion_id_inscripcion_seq', 14, true);


--
-- TOC entry 2095 (class 0 OID 24689)
-- Dependencies: 173 2101
-- Data for Name: integrantes_equipo; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO integrantes_equipo VALUES (1, 1, 1);
INSERT INTO integrantes_equipo VALUES (3, 1, 2);
INSERT INTO integrantes_equipo VALUES (13, 1, 37);


--
-- TOC entry 2122 (class 0 OID 0)
-- Dependencies: 174
-- Name: integrantes_equipo_id_int_equip_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('integrantes_equipo_id_int_equip_seq', 13, true);


--
-- TOC entry 2097 (class 0 OID 24694)
-- Dependencies: 175 2101
-- Data for Name: modo_competencia; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO modo_competencia VALUES (4, 'Barriles', 'individual');
INSERT INTO modo_competencia VALUES (5, 'encierro', 'grupo');


--
-- TOC entry 2123 (class 0 OID 0)
-- Dependencies: 176
-- Name: modo_competencia_id_modo_competencia_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('modo_competencia_id_modo_competencia_seq', 5, true);


--
-- TOC entry 2099 (class 0 OID 24705)
-- Dependencies: 178 2101
-- Data for Name: ranking; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2124 (class 0 OID 0)
-- Dependencies: 182
-- Name: ranking_id_ranking_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ranking_id_ranking_seq', 146, true);


--
-- TOC entry 1926 (class 2606 OID 24745)
-- Dependencies: 161 161 161 2102
-- Name: pk_categoria; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY categoria
    ADD CONSTRAINT pk_categoria PRIMARY KEY (id_categoria, nombre);


--
-- TOC entry 1934 (class 2606 OID 24747)
-- Dependencies: 163 163 2102
-- Name: pk_comp; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY competencia
    ADD CONSTRAINT pk_comp PRIMARY KEY (id_competencia);


--
-- TOC entry 1936 (class 2606 OID 24749)
-- Dependencies: 165 165 165 2102
-- Name: pk_competidor; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY competidor
    ADD CONSTRAINT pk_competidor PRIMARY KEY (id_competidor, cedula);


--
-- TOC entry 1950 (class 2606 OID 24751)
-- Dependencies: 169 169 169 2102
-- Name: pk_equipo; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY equipo
    ADD CONSTRAINT pk_equipo PRIMARY KEY (id_equipo, nombre);


--
-- TOC entry 1942 (class 2606 OID 24753)
-- Dependencies: 167 167 2102
-- Name: pk_inscripcion; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY inscripcion
    ADD CONSTRAINT pk_inscripcion PRIMARY KEY (id_inscripcion);


--
-- TOC entry 1957 (class 2606 OID 24824)
-- Dependencies: 173 173 2102
-- Name: pk_integrante_equipo; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY integrantes_equipo
    ADD CONSTRAINT pk_integrante_equipo PRIMARY KEY (id_int_equip);


--
-- TOC entry 1961 (class 2606 OID 24755)
-- Dependencies: 175 175 175 2102
-- Name: pk_modo_competencia; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY modo_competencia
    ADD CONSTRAINT pk_modo_competencia PRIMARY KEY (id_modo_competencia, nombre);


--
-- TOC entry 1967 (class 2606 OID 24757)
-- Dependencies: 178 178 2102
-- Name: pk_ranking; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ranking
    ADD CONSTRAINT pk_ranking PRIMARY KEY (id_ranking);


--
-- TOC entry 1928 (class 2606 OID 24759)
-- Dependencies: 161 161 2102
-- Name: uk_categoria; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY categoria
    ADD CONSTRAINT uk_categoria UNIQUE (nombre);


--
-- TOC entry 1938 (class 2606 OID 24761)
-- Dependencies: 165 165 2102
-- Name: uk_competidor; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY competidor
    ADD CONSTRAINT uk_competidor UNIQUE (cedula);


--
-- TOC entry 1952 (class 2606 OID 24763)
-- Dependencies: 169 169 2102
-- Name: uk_equipo; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY equipo
    ADD CONSTRAINT uk_equipo UNIQUE (nombre);


--
-- TOC entry 1930 (class 2606 OID 24765)
-- Dependencies: 161 161 2102
-- Name: uk_id_cat; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY categoria
    ADD CONSTRAINT uk_id_cat UNIQUE (id_categoria);


--
-- TOC entry 1940 (class 2606 OID 24767)
-- Dependencies: 165 165 2102
-- Name: uk_id_comp; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY competidor
    ADD CONSTRAINT uk_id_comp UNIQUE (id_competidor);


--
-- TOC entry 1954 (class 2606 OID 24769)
-- Dependencies: 169 169 2102
-- Name: uk_id_equip; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY equipo
    ADD CONSTRAINT uk_id_equip UNIQUE (id_equipo);


--
-- TOC entry 1944 (class 2606 OID 24771)
-- Dependencies: 167 167 2102
-- Name: uk_id_insc; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY inscripcion
    ADD CONSTRAINT uk_id_insc UNIQUE (id_inscripcion);


--
-- TOC entry 1963 (class 2606 OID 24773)
-- Dependencies: 175 175 2102
-- Name: uk_id_mod; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY modo_competencia
    ADD CONSTRAINT uk_id_mod UNIQUE (id_modo_competencia);


--
-- TOC entry 1946 (class 2606 OID 24775)
-- Dependencies: 167 167 167 2102
-- Name: uk_insc_comp; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY inscripcion
    ADD CONSTRAINT uk_insc_comp UNIQUE (cedula, id_competencia);


--
-- TOC entry 1948 (class 2606 OID 24777)
-- Dependencies: 167 167 167 2102
-- Name: uk_insc_equip; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY inscripcion
    ADD CONSTRAINT uk_insc_equip UNIQUE (id_equipo, id_competencia);


--
-- TOC entry 1965 (class 2606 OID 24781)
-- Dependencies: 175 175 2102
-- Name: uk_modo_competencia; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY modo_competencia
    ADD CONSTRAINT uk_modo_competencia UNIQUE (nombre);


--
-- TOC entry 1959 (class 2606 OID 24822)
-- Dependencies: 173 173 173 2102
-- Name: uk_ps_equipo; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY integrantes_equipo
    ADD CONSTRAINT uk_ps_equipo UNIQUE (id_equipo, id_competidor);


--
-- TOC entry 1931 (class 1259 OID 24782)
-- Dependencies: 163 2102
-- Name: fki_cat_comp; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_cat_comp ON competencia USING btree (id_categoria);


--
-- TOC entry 1955 (class 1259 OID 24783)
-- Dependencies: 173 2102
-- Name: fki_equip_int; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_equip_int ON integrantes_equipo USING btree (id_equipo);


--
-- TOC entry 1932 (class 1259 OID 24784)
-- Dependencies: 163 2102
-- Name: fki_mod_comp; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX fki_mod_comp ON competencia USING btree (id_modo_competencia);


--
-- TOC entry 1968 (class 2606 OID 24785)
-- Dependencies: 163 161 1929 2102
-- Name: fk_cat_comp; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY competencia
    ADD CONSTRAINT fk_cat_comp FOREIGN KEY (id_categoria) REFERENCES categoria(id_categoria);


--
-- TOC entry 1972 (class 2606 OID 24790)
-- Dependencies: 165 173 1939 2102
-- Name: fk_comp_int; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY integrantes_equipo
    ADD CONSTRAINT fk_comp_int FOREIGN KEY (id_competidor) REFERENCES competidor(id_competidor);


--
-- TOC entry 1970 (class 2606 OID 24795)
-- Dependencies: 167 169 1953 2102
-- Name: fk_equip_insc; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inscripcion
    ADD CONSTRAINT fk_equip_insc FOREIGN KEY (id_equipo) REFERENCES equipo(id_equipo) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 1973 (class 2606 OID 24800)
-- Dependencies: 1953 173 169 2102
-- Name: fk_equip_int; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY integrantes_equipo
    ADD CONSTRAINT fk_equip_int FOREIGN KEY (id_equipo) REFERENCES equipo(id_equipo);


--
-- TOC entry 1971 (class 2606 OID 24805)
-- Dependencies: 167 165 1937 2102
-- Name: fk_insc_comp; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inscripcion
    ADD CONSTRAINT fk_insc_comp FOREIGN KEY (cedula) REFERENCES competidor(cedula) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 1974 (class 2606 OID 24810)
-- Dependencies: 178 167 1941 2102
-- Name: fk_insc_rank; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ranking
    ADD CONSTRAINT fk_insc_rank FOREIGN KEY (id_inscripcion) REFERENCES inscripcion(id_inscripcion) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 1969 (class 2606 OID 24815)
-- Dependencies: 175 163 1962 2102
-- Name: fk_mod_comp; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY competencia
    ADD CONSTRAINT fk_mod_comp FOREIGN KEY (id_modo_competencia) REFERENCES modo_competencia(id_modo_competencia);


--
-- TOC entry 2107 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2014-03-15 18:41:57 VET

--
-- PostgreSQL database dump complete
--

