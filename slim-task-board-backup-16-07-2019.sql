--
-- PostgreSQL database dump
--

-- Dumped from database version 11.4 (Ubuntu 11.4-1.pgdg16.04+1)
-- Dumped by pg_dump version 11.3

-- Started on 2019-07-16 23:11:59

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
-- TOC entry 3861 (class 0 OID 5676922)
-- Dependencies: 196
-- Data for Name: slim_board; Type: TABLE DATA; Schema: public; Owner: wcdgvfyqvpvazx
--

COPY public.slim_board (id, name, description) FROM stdin;
22	Faculdade	faculfdade lvblbalblbl
18	Tarefas de Casa lvalal	Tarefas para fazer em casa.jk hkjh
17	Projeto Alpha	Projeto Alpha
20	Projeto Teste xyzw	Projeto Teste xyzw blalblabal
\.


--
-- TOC entry 3863 (class 0 OID 5677038)
-- Dependencies: 198
-- Data for Name: slim_column; Type: TABLE DATA; Schema: public; Owner: wcdgvfyqvpvazx
--

COPY public.slim_column (id, board_id, name, weight) FROM stdin;
49	22	TODO	1
50	22	In Progress	2
51	22	Done	3
34	17	TODO	1
35	17	In Progress	2
36	17	Done	3
37	18	TODO	1
38	18	In Progress	2
39	18	Done	3
43	20	TODO	1
44	20	In Progress	2
45	20	Done	3
\.


--
-- TOC entry 3865 (class 0 OID 5677124)
-- Dependencies: 200
-- Data for Name: slim_task; Type: TABLE DATA; Schema: public; Owner: wcdgvfyqvpvazx
--

COPY public.slim_task (id, column_id, name, weight, description, assigned_user_id) FROM stdin;
22	34	BLA BLA BLA BLA	1	BLA BLA BLA BLA	8
23	35	Fazer algo	1	bla bla bla bla bla	8
24	36	Fazer algo	1	bla bla bla bla bla	8
25	36	Fazer algo	1	bla bla bla bla bla	8
26	36	Fazer algo	1	bla bla bla bla bla	8
27	35	Fazer algo	1	bla bla bla bla bla	8
28	35	Fazer algo	1	bla bla bla bla bla	8
29	34	Fazer algo	1	bla bla bla bla bla	8
33	38	Fazer algo	1	bla bla bla bla bla	8
36	39	Fazer algo	1	bla bla bla bla bla	8
46	37	Comprar Pão	1	\N	8
47	37	Limpar a Casa	1	\N	8
30	38	Lavar a Loça	1	Rapidamente...	8
34	39	Lavar a Ropua	1	bla bla bla bla bla	8
31	38	Comprar Açucar	1	bla bla bla bla bla	8
35	39	Pagar conta de luz	1	Energia eletrica.	8
49	49	prova	1	jhgjhgj	8
\.


--
-- TOC entry 3866 (class 0 OID 5677193)
-- Dependencies: 201
-- Data for Name: slim_user; Type: TABLE DATA; Schema: public; Owner: wcdgvfyqvpvazx
--

COPY public.slim_user (id, name, email, password) FROM stdin;
8	Leandro	leandro@frekele.org	12345678
9	fulano de tal	fulano@teste.com.br	12345
10	joao da silva	joao@teste.com.br	12345678
\.


--
-- TOC entry 3880 (class 0 OID 0)
-- Dependencies: 197
-- Name: board_id_seq; Type: SEQUENCE SET; Schema: public; Owner: wcdgvfyqvpvazx
--

SELECT pg_catalog.setval('public.board_id_seq', 22, true);


--
-- TOC entry 3881 (class 0 OID 0)
-- Dependencies: 199
-- Name: column_id_seq; Type: SEQUENCE SET; Schema: public; Owner: wcdgvfyqvpvazx
--

SELECT pg_catalog.setval('public.column_id_seq', 51, true);


--
-- TOC entry 3882 (class 0 OID 0)
-- Dependencies: 202
-- Name: task_id_seq; Type: SEQUENCE SET; Schema: public; Owner: wcdgvfyqvpvazx
--

SELECT pg_catalog.setval('public.task_id_seq', 49, true);


--
-- TOC entry 3883 (class 0 OID 0)
-- Dependencies: 203
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: wcdgvfyqvpvazx
--

SELECT pg_catalog.setval('public.user_id_seq', 10, true);


-- Completed on 2019-07-16 23:12:18

--
-- PostgreSQL database dump complete
--

