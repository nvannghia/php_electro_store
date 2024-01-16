PGDMP  3                    {            electro    15.3    16.0 *    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    16469    electro    DATABASE     s   CREATE DATABASE electro WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'en_US.UTF-8';
    DROP DATABASE electro;
             
   postgresql    false            �            1259    16471    category    TABLE     |   CREATE TABLE public.category (
    id integer NOT NULL,
    name text NOT NULL,
    parent_id integer DEFAULT 0 NOT NULL
);
    DROP TABLE public.category;
       public         heap 
   postgresql    false            �           0    0    TABLE category    ACL     1   GRANT SELECT ON TABLE public.category TO PUBLIC;
          public       
   postgresql    false    215            �            1259    16470    category_id_seq    SEQUENCE     �   ALTER TABLE public.category ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.category_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public       
   postgresql    false    215            �            1259    16712    order_detail    TABLE     �   CREATE TABLE public.order_detail (
    id integer NOT NULL,
    order_id integer NOT NULL,
    product_id integer NOT NULL,
    quantity integer NOT NULL,
    unit_price double precision NOT NULL
);
     DROP TABLE public.order_detail;
       public         heap 
   postgresql    false            �            1259    16711    order_detail_id_seq    SEQUENCE     �   ALTER TABLE public.order_detail ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.order_detail_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public       
   postgresql    false    225            �            1259    16699    orders    TABLE     M  CREATE TABLE public.orders (
    id integer NOT NULL,
    amount double precision NOT NULL,
    created_at timestamp with time zone NOT NULL,
    user_id integer NOT NULL,
    full_name text NOT NULL,
    phone_number text NOT NULL,
    email text NOT NULL,
    addr text NOT NULL,
    note text,
    payment_method text NOT NULL
);
    DROP TABLE public.orders;
       public         heap 
   postgresql    false            �            1259    16698    orders_id_seq    SEQUENCE     �   ALTER TABLE public.orders ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.orders_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public       
   postgresql    false    223            �            1259    16495    product    TABLE     �   CREATE TABLE public.product (
    id integer NOT NULL,
    name text NOT NULL,
    price double precision NOT NULL,
    image text NOT NULL,
    category_id integer NOT NULL,
    promotion_price double precision,
    description text
);
    DROP TABLE public.product;
       public         heap 
   postgresql    false            �           0    0    TABLE product    ACL     0   GRANT SELECT ON TABLE public.product TO PUBLIC;
          public       
   postgresql    false    219            �            1259    16494    product_id_seq    SEQUENCE     �   ALTER TABLE public.product ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.product_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public       
   postgresql    false    219            �            1259    16484    slider    TABLE     �   CREATE TABLE public.slider (
    id integer NOT NULL,
    image character(100) NOT NULL,
    active integer DEFAULT 1,
    caption character(50)
);
    DROP TABLE public.slider;
       public         heap 
   postgresql    false            �           0    0    TABLE slider    ACL     /   GRANT SELECT ON TABLE public.slider TO PUBLIC;
          public       
   postgresql    false    217            �            1259    16483    slider_id_seq    SEQUENCE     �   ALTER TABLE public.slider ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.slider_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public       
   postgresql    false    217            �            1259    16511    users    TABLE     �   CREATE TABLE public.users (
    id integer NOT NULL,
    email text NOT NULL,
    password text NOT NULL,
    display_name text NOT NULL,
    avatar text NOT NULL,
    role text NOT NULL
);
    DROP TABLE public.users;
       public         heap 
   postgresql    false            �           0    0    TABLE users    ACL     .   GRANT SELECT ON TABLE public.users TO PUBLIC;
          public       
   postgresql    false    220            �            1259    16524    user_id_seq    SEQUENCE     �   ALTER TABLE public.users ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public       
   postgresql    false    220            �          0    16471    category 
   TABLE DATA           7   COPY public.category (id, name, parent_id) FROM stdin;
    public       
   postgresql    false    215   G.       �          0    16712    order_detail 
   TABLE DATA           V   COPY public.order_detail (id, order_id, product_id, quantity, unit_price) FROM stdin;
    public       
   postgresql    false    225   �.       �          0    16699    orders 
   TABLE DATA           }   COPY public.orders (id, amount, created_at, user_id, full_name, phone_number, email, addr, note, payment_method) FROM stdin;
    public       
   postgresql    false    223   ;/       �          0    16495    product 
   TABLE DATA           d   COPY public.product (id, name, price, image, category_id, promotion_price, description) FROM stdin;
    public       
   postgresql    false    219   �0       �          0    16484    slider 
   TABLE DATA           <   COPY public.slider (id, image, active, caption) FROM stdin;
    public       
   postgresql    false    217   �:       �          0    16511    users 
   TABLE DATA           P   COPY public.users (id, email, password, display_name, avatar, role) FROM stdin;
    public       
   postgresql    false    220   #;       �           0    0    category_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.category_id_seq', 30, true);
          public       
   postgresql    false    214            �           0    0    order_detail_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.order_detail_id_seq', 12, true);
          public       
   postgresql    false    224            �           0    0    orders_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.orders_id_seq', 6, true);
          public       
   postgresql    false    222            �           0    0    product_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.product_id_seq', 21, true);
          public       
   postgresql    false    218            �           0    0    slider_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.slider_id_seq', 3, true);
          public       
   postgresql    false    216            �           0    0    user_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.user_id_seq', 14, true);
          public       
   postgresql    false    221            D           2606    16475    category category_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.category
    ADD CONSTRAINT category_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.category DROP CONSTRAINT category_pkey;
       public         
   postgresql    false    215            N           2606    16716    order_detail order_detail_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.order_detail
    ADD CONSTRAINT order_detail_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.order_detail DROP CONSTRAINT order_detail_pkey;
       public         
   postgresql    false    225            L           2606    16705    orders orders_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.orders DROP CONSTRAINT orders_pkey;
       public         
   postgresql    false    223            H           2606    16507    product product_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.product DROP CONSTRAINT product_pkey;
       public         
   postgresql    false    219            F           2606    16489    slider slider_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.slider
    ADD CONSTRAINT slider_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.slider DROP CONSTRAINT slider_pkey;
       public         
   postgresql    false    217            J           2606    16517    users user_pkey 
   CONSTRAINT     M   ALTER TABLE ONLY public.users
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);
 9   ALTER TABLE ONLY public.users DROP CONSTRAINT user_pkey;
       public         
   postgresql    false    220            Q           2606    16717 '   order_detail order_detail_order_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.order_detail
    ADD CONSTRAINT order_detail_order_id_fkey FOREIGN KEY (order_id) REFERENCES public.orders(id);
 Q   ALTER TABLE ONLY public.order_detail DROP CONSTRAINT order_detail_order_id_fkey;
       public       
   postgresql    false    4172    225    223            R           2606    16722 )   order_detail order_detail_product_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.order_detail
    ADD CONSTRAINT order_detail_product_id_fkey FOREIGN KEY (product_id) REFERENCES public.product(id);
 S   ALTER TABLE ONLY public.order_detail DROP CONSTRAINT order_detail_product_id_fkey;
       public       
   postgresql    false    219    4168    225            P           2606    16706    orders orders_user_id_fkey    FK CONSTRAINT     y   ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(id);
 D   ALTER TABLE ONLY public.orders DROP CONSTRAINT orders_user_id_fkey;
       public       
   postgresql    false    220    223    4170            O           2606    16501    product pk_category    FK CONSTRAINT     �   ALTER TABLE ONLY public.product
    ADD CONSTRAINT pk_category FOREIGN KEY (category_id) REFERENCES public.category(id) NOT VALID;
 =   ALTER TABLE ONLY public.product DROP CONSTRAINT pk_category;
       public       
   postgresql    false    219    4164    215            �   �   x�3�<21����<�����rp��(�g&*�<ܽ4/(gΙ{xa�B��y�&\nޱw�NV�;��ʔ�"��p�B�2S.CCN��DÀ3(?)�D!���$���@S�8�L�Z�������� �>c      �   P   x�]ͱ� �����d�9�i�T|NprRT�ǁ� .� :�t
��4��W¾Ġ<��������rM�����u��      �   K  x���?K1��ܧx;{�$��:I;�łR�A(�=�`/W���Y��	N��KEA�K{c��#��\�X��wx��{�7D$�Qc�(��&�v ���lؘP��Ñ�/..4�XL�^D=/��������n��&�̟zP���%i����i'v|D�0��ux������CՅs���������s���T�~V.L~�D��!�@�����!�zރD��]	=)�<S��8sD���_��z&�hXT6��7��)�pe+
ߣdeB�Tj&�����Z�P7�Ԅ~��ԊN�;�������g��%�f}�JU�w�Y�����8_��{      �   
  x��Xmo�F�L�����Yԛ�~�c;�]����+(�����%+�"(���"��c���咴8DBP�����,)��Uq�P
�/�3�<���M�åc��/%���"��\)����Љ
VϏm.�pT�|o��wؖ�2�̎�=ߴ��JV�U��e��X2��I?t��зcK.�|�����/�f�Z�����C3ʴ�v}6�ä;���R�`��-��&�&�G��=ǃ�l��`�GL0����/��!LL���l�>�ކ�ֻ��&?��N��~l����[�+I&`W�>*�U�y��l��iA	�~�5��	�x6�N�EW=N�L��&�A��ڳ���=��s�l�e̺.|�̚����
l�Vuq��h<�<�l�NpL���;^��_�N��w{z�3n*,u����9�!N(������ٺbwׯm^��V��D�ܨ�ʂhw�Á�^�tz�a�du;����5�Z�msz4b����p�����/�^f��,W9�#��5�?f�����1���D�ͷ��Qx�g����m\i�Csɺ���;|�R����l�_����!$j0,u7��G��AH dӧ[���&8 B��KF���\�(�]7���
&��a��VOHt"�8I� G.���m:a��8+��d%Ȯ?���OY�3�T�l���₰�l����R�lW���CIa�k�R&�����|~�w89Ͳ�4�@g�}�ɛ�CݭS���(S7Y4ڃ$Qh�U8���/��`�K�0�+�]L)��|_�'J�&[]k1���ip1��$1U�����s��F�ë� A���H��s$r
bs��F�!_`%`@([��C��f��f�9R����j�TԶ̀�>��k[�޺����֭J�
TL�������"R���ڝb�?<��5�Ե�Bp�W&/��-gV���(�WĘ���JRt�����zw�Q��s�1�O��
?�����Ѕڌf6�� V���H������fHh1���p�r���ͫk4��C����N��5����iPh��hT��"U/ ڶ��%�^+�+�Q��ʥ҇����� �a\�}�^9��\D�O�`5�F��]a;�t�p��yP�	����z&$�J3tHhp^<��
y�ԇ�c�RO>�=*��)$?�(�1H�6��N$�����"��LtS��"�j�6;H�y������Q�2��,�<��5}a�in��K˭�a������5y���7��\����}o��Z�Ŏ�}鲬i�*�cڌ��)U P�D
�)� s5w+��-?6B��NYY*覤|da����zC
�G��i|�Ry%���a+y��5
����A5�ܗ�α �|ꑾl�O����f���ϧ(��������?��d��t!��U���Q*^6���"�?�w�\�X�=��`o������"{��PG��>�O�a��!q@�J=+9Y9Et �H5��y\Df�`	����vF�'���g�L���ql�~˕3�� ��@�VƈU�{���0�*���=�vM+�=�Sk\*�F�ÂXH�]��;�G~q_��H����4E�t,��c=3Vdt��sD��7~��?M��	2�GW%z��2�۩�z���8OiiO%�)i!K�-3%M?Q���j�6	T�� ����B@�Z��/|��*��.�rTj�Ң`��o�}�FV� �� i9 �ʂ`��[�z9���e(��/��6��3�,����K5�L�0�^�j��D2Ɠ�T��CU���6�����ģ����	��`����d��� �S�M���k
Hdd�I�Ȥ��8U]H֜x	ߡ4�؁:�r,�-1�*�S�fv��(e��RYV��4-Һ�)���Ԉ��bd�oa�J�byd���a�O8��0A��ʿM!�����;H�#þ;J�#�<(b�xԴ&�󽮷�Z��
}����[u��/�1+�ڂ���`��h���Ca��i�^9ۤ_l�4���]�g�)�x=s�a���3��N]Wv�H]r.N�?zl��t)��5�"4�]���6S�>b��#�+Q�i�A�a\v}]ϟ�����dhJ�$��k�2���]z
�����P�����A�-+ںɻ �|�Vw��Y�~����P�,���[>��ۑU���?��{�0�H�z��.0v�2���$�:�|H�[2tL/��r���8y���m5K�k*"��c�֜nq�l�$"p�ꀦ�Kr���|���ϊ�dR���|́��I�Y�	�-��pR��)_)����Hs�򁺟��fN���[$
��`G�����N��VC(I�����F�mmo4o|����}K�\��Zu��HD#�o�x4�Q�*���N�ʿ�����*:O�x#���Nb�����}u;�g/���sAAC��#�'��X�v"n#�\wL���/H?{��su�x����ﻚp��~�U��w���N��B4�4�2�F��� ��L%��҅PIע̅�ZX�kaii��D'��      �   U   x�3�L2��*HW�)�4���(�|�k�B��ř���2�L2���B2�m8�0/]!�ᮅĻϘ3ɘ.�;��T��D��b���� }�N�      �     x���=N�0���9EN�6"��߁�A���З�r��v��6͊8+�؊{�&�tA�x�G/���R��Ԡꤰu��W�2��v�^<��z�`�L��@e����	��m�2��_!�f&t���)p��8��t@�M	âEp����)p�����4�C.���%�����r|>:���(�6���M�7����c���^<}�g��vf��v�e�>O'����s���PVf�;�y���_��β�6���2��7     