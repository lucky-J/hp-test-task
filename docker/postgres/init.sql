--
-- PostgreSQL database dump
--

-- Dumped from database version 10.16
-- Dumped by pg_dump version 10.15 (Ubuntu 10.15-0ubuntu0.18.04.1)

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
-- Name: Broker; Type: SCHEMA; Schema: -; Owner: helloprint
--

CREATE SCHEMA "Broker";


ALTER SCHEMA "Broker" OWNER TO helloprint;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: request; Type: TABLE; Schema: Broker; Owner: helloprint
--

CREATE TABLE "Broker".request (
                                  id integer NOT NULL,
                                  message character varying(255) DEFAULT 'Hi'::character varying NOT NULL,
                                  modified_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE "Broker".request OWNER TO helloprint;

--
-- Name: request_id_seq; Type: SEQUENCE; Schema: Broker; Owner: helloprint
--

CREATE SEQUENCE "Broker".request_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Broker".request_id_seq OWNER TO helloprint;

--
-- Name: request_id_seq; Type: SEQUENCE OWNED BY; Schema: Broker; Owner: helloprint
--

ALTER SEQUENCE "Broker".request_id_seq OWNED BY "Broker".request.id;


--
-- Name: request id; Type: DEFAULT; Schema: Broker; Owner: helloprint
--

ALTER TABLE ONLY "Broker".request ALTER COLUMN id SET DEFAULT nextval('"Broker".request_id_seq'::regclass);


--
-- Data for Name: request; Type: TABLE DATA; Schema: Broker; Owner: helloprint
--

COPY "Broker".request (id, message, modified_at) FROM stdin;
\.


--
-- Name: request_id_seq; Type: SEQUENCE SET; Schema: Broker; Owner: helloprint
--

SELECT pg_catalog.setval('"Broker".request_id_seq', 1, false);


--
-- Name: request request_pkey; Type: CONSTRAINT; Schema: Broker; Owner: helloprint
--

ALTER TABLE ONLY "Broker".request
    ADD CONSTRAINT request_pkey PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--

