--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.24
-- Dumped by pg_dump version 9.6.24

-- Started on 2025-02-16 22:15:15

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 1 (class 3079 OID 12387)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2189 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 188 (class 1259 OID 32817)
-- Name: biodata; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.biodata (
    id integer NOT NULL,
    user_id integer,
    posisi_dilamar character varying(100),
    nama character varying(255),
    no_ktp character varying(20) NOT NULL,
    tempat_lahir character varying(100),
    tanggal_lahir date,
    jenis_kelamin character varying(10),
    agama character varying(50),
    golongan_darah character varying(5),
    status character varying(20),
    alamat_ktp text,
    alamat_tinggal text,
    email character varying(255),
    no_telp character varying(20),
    kontak_darurat character varying(255),
    skill text,
    bersedia_ditempatkan boolean DEFAULT false,
    penghasilan_diharapkan numeric(10,2),
    created_at timestamp without time zone DEFAULT now()
);


ALTER TABLE public.biodata OWNER TO postgres;

--
-- TOC entry 187 (class 1259 OID 32815)
-- Name: biodata_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.biodata_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.biodata_id_seq OWNER TO postgres;

--
-- TOC entry 2190 (class 0 OID 0)
-- Dependencies: 187
-- Name: biodata_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.biodata_id_seq OWNED BY public.biodata.id;


--
-- TOC entry 194 (class 1259 OID 32864)
-- Name: pekerjaan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pekerjaan (
    id integer NOT NULL,
    biodata_id integer,
    nama_perusahaan character varying(255),
    posisi character varying(100),
    pendapatan numeric(10,2),
    tahun integer
);


ALTER TABLE public.pekerjaan OWNER TO postgres;

--
-- TOC entry 193 (class 1259 OID 32862)
-- Name: pekerjaan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pekerjaan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pekerjaan_id_seq OWNER TO postgres;

--
-- TOC entry 2191 (class 0 OID 0)
-- Dependencies: 193
-- Name: pekerjaan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pekerjaan_id_seq OWNED BY public.pekerjaan.id;


--
-- TOC entry 192 (class 1259 OID 32850)
-- Name: pelatihan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pelatihan (
    id integer NOT NULL,
    biodata_id integer,
    nama_kursus character varying(255),
    sertifikat boolean DEFAULT false,
    tahun integer
);


ALTER TABLE public.pelatihan OWNER TO postgres;

--
-- TOC entry 191 (class 1259 OID 32848)
-- Name: pelatihan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pelatihan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pelatihan_id_seq OWNER TO postgres;

--
-- TOC entry 2192 (class 0 OID 0)
-- Dependencies: 191
-- Name: pelatihan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pelatihan_id_seq OWNED BY public.pelatihan.id;


--
-- TOC entry 190 (class 1259 OID 32837)
-- Name: pendidikan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pendidikan (
    id integer NOT NULL,
    biodata_id integer,
    jenjang character varying(50),
    institusi character varying(255),
    jurusan character varying(100),
    tahun_lulus integer,
    ipk numeric(3,2)
);


ALTER TABLE public.pendidikan OWNER TO postgres;

--
-- TOC entry 189 (class 1259 OID 32835)
-- Name: pendidikan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pendidikan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pendidikan_id_seq OWNER TO postgres;

--
-- TOC entry 2193 (class 0 OID 0)
-- Dependencies: 189
-- Name: pendidikan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pendidikan_id_seq OWNED BY public.pendidikan.id;


--
-- TOC entry 186 (class 1259 OID 32802)
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id integer NOT NULL,
    email character varying(255) NOT NULL,
    password_hash character varying(255) NOT NULL,
    role character varying(20) DEFAULT 'user'::character varying,
    created_at timestamp without time zone DEFAULT now()
);


ALTER TABLE public.users OWNER TO postgres;

--
-- TOC entry 185 (class 1259 OID 32800)
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO postgres;

--
-- TOC entry 2194 (class 0 OID 0)
-- Dependencies: 185
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- TOC entry 2030 (class 2604 OID 32820)
-- Name: biodata id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.biodata ALTER COLUMN id SET DEFAULT nextval('public.biodata_id_seq'::regclass);


--
-- TOC entry 2036 (class 2604 OID 32867)
-- Name: pekerjaan id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pekerjaan ALTER COLUMN id SET DEFAULT nextval('public.pekerjaan_id_seq'::regclass);


--
-- TOC entry 2034 (class 2604 OID 32853)
-- Name: pelatihan id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pelatihan ALTER COLUMN id SET DEFAULT nextval('public.pelatihan_id_seq'::regclass);


--
-- TOC entry 2033 (class 2604 OID 32840)
-- Name: pendidikan id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pendidikan ALTER COLUMN id SET DEFAULT nextval('public.pendidikan_id_seq'::regclass);


--
-- TOC entry 2027 (class 2604 OID 32805)
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- TOC entry 2175 (class 0 OID 32817)
-- Dependencies: 188
-- Data for Name: biodata; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.biodata (id, user_id, posisi_dilamar, nama, no_ktp, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, golongan_darah, status, alamat_ktp, alamat_tinggal, email, no_telp, kontak_darurat, skill, bersedia_ditempatkan, penghasilan_diharapkan, created_at) FROM stdin;
1	6	Programmer handale	Iwan G Tondang	1211021411990001	medan	1999-11-14	Laki-laki	Kristen	O	Menikah	menda	medana	iwan@gmail.com	123123123	234234234	jago ngoding	t	10000000.00	2025-02-15 10:27:11
4	\N	Admin	Lija Oksindi	12345612345	bandung	1898-12-12	Perempuan	Kristen		Belum Menikah	bandung	bandung	lija@gmail.com	098765434567	98765434567	nangis	t	5000000.00	2025-02-16 11:05:30
5	9	admin	fghjk	34567890	dfghjkl	2000-03-21	Laki-laki	Islam	AB	Belum Menikah	dasd	daasdasd	akda@gmail.com	567890-0987	567890-987	jadnaks	t	9000000.00	2025-02-16 11:19:23
\.


--
-- TOC entry 2195 (class 0 OID 0)
-- Dependencies: 187
-- Name: biodata_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.biodata_id_seq', 5, true);


--
-- TOC entry 2181 (class 0 OID 32864)
-- Dependencies: 194
-- Data for Name: pekerjaan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pekerjaan (id, biodata_id, nama_perusahaan, posisi, pendapatan, tahun) FROM stdin;
7	1	edii	programmerr	9800000.00	2024
10	5	acn	it	\N	2023
\.


--
-- TOC entry 2196 (class 0 OID 0)
-- Dependencies: 193
-- Name: pekerjaan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pekerjaan_id_seq', 10, true);


--
-- TOC entry 2179 (class 0 OID 32850)
-- Dependencies: 192
-- Data for Name: pelatihan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pelatihan (id, biodata_id, nama_kursus, sertifikat, tahun) FROM stdin;
7	1	Butkem	t	2021
10	5	ajax	f	2020
\.


--
-- TOC entry 2197 (class 0 OID 0)
-- Dependencies: 191
-- Name: pelatihan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pelatihan_id_seq', 10, true);


--
-- TOC entry 2177 (class 0 OID 32837)
-- Dependencies: 190
-- Data for Name: pendidikan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pendidikan (id, biodata_id, jenjang, institusi, jurusan, tahun_lulus, ipk) FROM stdin;
14	1	D3	universitas sumatera utara	Teknik Informatika	2020	3.46
15	1	S3	Havard University	Informatics Enfineering	2020	4.00
16	1	S1	usu	it	2020	3.30
17	4	S1	ITB	Informatika	2020	3.90
19	5	S1	ITS	IT	2020	3.22
\.


--
-- TOC entry 2198 (class 0 OID 0)
-- Dependencies: 189
-- Name: pendidikan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pendidikan_id_seq', 19, true);


--
-- TOC entry 2173 (class 0 OID 32802)
-- Dependencies: 186
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, email, password_hash, role, created_at) FROM stdin;
5	iwanadmin@gmail.com	$2y$10$1YUSx1Kmdy/dLK0hiUZCFuNIIMVSy2PXCptNq7JVVo.ZyAIXqTOJe	admin	2025-02-15 14:16:01.570809
6	iwanuser@gmail.com	$2y$13$o.yrJTroP41iE.PbTCKbCOlVMUZT/lAvFgQV/tLD.Cc1VRyapNYaq	user	2025-02-15 09:38:12
9	lija@gmail.com	$2y$13$woq82Hd/UiILke3UsMQfiuiaRyoPyP6s0puUJ/58MA5yKrp2L27sG	user	2025-02-16 10:52:00
\.


--
-- TOC entry 2199 (class 0 OID 0)
-- Dependencies: 185
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 9, true);


--
-- TOC entry 2042 (class 2606 OID 32829)
-- Name: biodata biodata_no_ktp_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.biodata
    ADD CONSTRAINT biodata_no_ktp_key UNIQUE (no_ktp);


--
-- TOC entry 2044 (class 2606 OID 32827)
-- Name: biodata biodata_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.biodata
    ADD CONSTRAINT biodata_pkey PRIMARY KEY (id);


--
-- TOC entry 2050 (class 2606 OID 32869)
-- Name: pekerjaan pekerjaan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pekerjaan
    ADD CONSTRAINT pekerjaan_pkey PRIMARY KEY (id);


--
-- TOC entry 2048 (class 2606 OID 32856)
-- Name: pelatihan pelatihan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pelatihan
    ADD CONSTRAINT pelatihan_pkey PRIMARY KEY (id);


--
-- TOC entry 2046 (class 2606 OID 32842)
-- Name: pendidikan pendidikan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pendidikan
    ADD CONSTRAINT pendidikan_pkey PRIMARY KEY (id);


--
-- TOC entry 2038 (class 2606 OID 32814)
-- Name: users users_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_key UNIQUE (email);


--
-- TOC entry 2040 (class 2606 OID 32812)
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- TOC entry 2051 (class 2606 OID 32830)
-- Name: biodata biodata_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.biodata
    ADD CONSTRAINT biodata_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- TOC entry 2054 (class 2606 OID 32870)
-- Name: pekerjaan pekerjaan_biodata_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pekerjaan
    ADD CONSTRAINT pekerjaan_biodata_id_fkey FOREIGN KEY (biodata_id) REFERENCES public.biodata(id) ON DELETE CASCADE;


--
-- TOC entry 2053 (class 2606 OID 32857)
-- Name: pelatihan pelatihan_biodata_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pelatihan
    ADD CONSTRAINT pelatihan_biodata_id_fkey FOREIGN KEY (biodata_id) REFERENCES public.biodata(id) ON DELETE CASCADE;


--
-- TOC entry 2052 (class 2606 OID 32843)
-- Name: pendidikan pendidikan_biodata_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pendidikan
    ADD CONSTRAINT pendidikan_biodata_id_fkey FOREIGN KEY (biodata_id) REFERENCES public.biodata(id) ON DELETE CASCADE;


-- Completed on 2025-02-16 22:15:15

--
-- PostgreSQL database dump complete
--

