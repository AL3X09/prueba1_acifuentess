PGDMP                         z         	   hotel_dev    15.1 (Debian 15.1-1.pgdg110+1)    15.0                0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    16387 	   hotel_dev    DATABASE     t   CREATE DATABASE hotel_dev WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'en_US.utf8';
    DROP DATABASE hotel_dev;
                postgres    false            ?            1259    16405    acomodacion    TABLE     [   CREATE TABLE public.acomodacion (
    id_acom bigint NOT NULL,
    nombre text NOT NULL
);
    DROP TABLE public.acomodacion;
       public         heap    postgres    false            ?            1259    16404    acomodacion_id_acom_seq    SEQUENCE     ?   CREATE SEQUENCE public.acomodacion_id_acom_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.acomodacion_id_acom_seq;
       public          postgres    false    215                       0    0    acomodacion_id_acom_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.acomodacion_id_acom_seq OWNED BY public.acomodacion.id_acom;
          public          postgres    false    214            {           2604    16408    acomodacion id_acom    DEFAULT     z   ALTER TABLE ONLY public.acomodacion ALTER COLUMN id_acom SET DEFAULT nextval('public.acomodacion_id_acom_seq'::regclass);
 B   ALTER TABLE public.acomodacion ALTER COLUMN id_acom DROP DEFAULT;
       public          postgres    false    214    215    215                      0    16405    acomodacion 
   TABLE DATA           6   COPY public.acomodacion (id_acom, nombre) FROM stdin;
    public          postgres    false    215   ?
                  0    0    acomodacion_id_acom_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.acomodacion_id_acom_seq', 1, true);
          public          postgres    false    214            }           2606    16412    acomodacion acomodacion_pkey 
   CONSTRAINT     _   ALTER TABLE ONLY public.acomodacion
    ADD CONSTRAINT acomodacion_pkey PRIMARY KEY (id_acom);
 F   ALTER TABLE ONLY public.acomodacion DROP CONSTRAINT acomodacion_pkey;
       public            postgres    false    215                  x?3?,N?K???I?????? )d8     