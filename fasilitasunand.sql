PGDMP                         {            fasilitasunand    14.1    14.1 
    o           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            p           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            q           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            r           1262    22832    fasilitasunand    DATABASE     n   CREATE DATABASE fasilitasunand WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'English_Indonesia.1252';
    DROP DATABASE fasilitasunand;
                postgres    false                        3079    22833    postgis 	   EXTENSION     ;   CREATE EXTENSION IF NOT EXISTS postgis WITH SCHEMA public;
    DROP EXTENSION postgis;
                   false            s           0    0    EXTENSION postgis    COMMENT     g   COMMENT ON EXTENSION postgis IS 'PostGIS geometry, geography, and raster spatial types and functions';
                        false    2            �            1259    23876    data    TABLE     �   CREATE TABLE public.data (
    id character varying(4) NOT NULL,
    the_geom public.geometry,
    nama character varying(50),
    alamat character varying(100),
    deskripsi character varying(2000),
    gambar character varying(30)
);
    DROP TABLE public.data;
       public         heap    postgres    false    2    2    2    2    2    2    2    2            l          0    23876    data 
   TABLE DATA           M   COPY public.data (id, the_geom, nama, alamat, deskripsi, gambar) FROM stdin;
    public          postgres    false    215   }	       �          0    23145    spatial_ref_sys 
   TABLE DATA           X   COPY public.spatial_ref_sys (srid, auth_name, auth_srid, srtext, proj4text) FROM stdin;
    public          postgres    false    211   �       �           2606    23888    data data_pk 
   CONSTRAINT     J   ALTER TABLE ONLY public.data
    ADD CONSTRAINT data_pk PRIMARY KEY (id);
 6   ALTER TABLE ONLY public.data DROP CONSTRAINT data_pk;
       public            postgres    false    215            l     x���[s�Fǟ���{��m�m�4ʹn����� !����a�đ�`��������wn�0�O�ә]�"�SRr��$ñq�Z�Y B��ҥ���G�����RXE�����/��m>�n�;��]sF���\�G��f����=�W(o2��<OߢM]n��t����3���� ������o�'w���������'ɴza���a.)W�'�)O�%J�hUD{�_�������{t���j<�f�ۂ�c>�Pt`R`�	�.��щi��
ڀ����b�Tʀo��t�-q�D�����Q�I���U�dz_/RtT�Ig�:i�`�c��cS��Go���\s�3�m��>�*���0��\�ù�S:z:�1U��i�J`Bc�O��iTL,hd`RHIM�L��zj#Us�璣�Z>�/�:���OVEi���٨���ݰz�l!��)���\o�<��-j�.�6��;�s�m�S�(����"��%X�Phv�BTbK������H�Q�D0���dc�V�}�<��Q�+5�Z;p0uؔ`]����_����0�rþA��S[��_�� �H m ܠLm�J�-<t�qe�)*C0����գ�-g�������t�T
�0:�Ʊ:R? v	CBkVȘ` @��q)#�'9�k�?/Tu�5mu߼{����վA|�~��)<�L���~J�]E�Y̤��鹰R�m��0ϋ{�$���Y���D<���<SPݢ���X&L$/�_���t���o� S���0"4�I��Tm�2!��S'�&�TΑNm
�p�d
%�x-'.��� ���d
����\[�%\��*�b���OPv����æ��f�WC)�K�"��W���wA&K�l�T`9d���"�:�fm��AΠ|�����2}m�K�YL,{�o�-$�u���`E��J��й�c|��R׌h�/�������X*^����&��a�{|b���x�]]e������^�)H�hH>y�R'$A!��+Q*�1�4u/��ƿԿފ����*�8����^[�.X؝�u�/ļ�p�O�1���e�sF%9ռ�_$�|$f��C`�������U:���# �6��a�(���o��E�����s��[�q�;tv�<_?�'ط�W <�~�nv��}��@���짼������������G���;����\W�,�(G�>#�6>2�ݔi���v��V����v��e����z�w��a,IK��p�m�B-�������鸸�      �      x������ � �     