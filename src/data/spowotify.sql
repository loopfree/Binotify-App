-- Untuk Connect ke Database
-- host=localhost port=5432 dbname=tubesIF3110 user=postgres password=admin

CREATE TABLE IF NOT EXISTS public."User"
(
    user_id integer NOT NULL,
    email character(256) COLLATE pg_catalog."default" NOT NULL,
    password character(256) COLLATE pg_catalog."default" NOT NULL,
    username character(256) COLLATE pg_catalog."default" NOT NULL,
    is_admin boolean NOT NULL,
    CONSTRAINT "User_pkey" PRIMARY KEY (user_id)
);

CREATE TABLE IF NOT EXISTS public."Album"
(
    album_id integer NOT NULL,
    judul character(64) COLLATE pg_catalog."default" NOT NULL,
    penyanyi character(64) COLLATE pg_catalog."default" NOT NULL,
    total_duration integer NOT NULL,
    image_path character(256) COLLATE pg_catalog."default" NOT NULL,
    tanggal_terbit date NOT NULL,
    genre character(64) COLLATE pg_catalog."default",
    CONSTRAINT "Album_pkey" PRIMARY KEY (album_id)
);

CREATE TABLE IF NOT EXISTS public."Song"
(
    song_id integer NOT NULL,
    judul character(64) COLLATE pg_catalog."default" NOT NULL,
    penyanyi character(128) COLLATE pg_catalog."default",
    tanggal_terbit date NOT NULL,
    genre character(64) COLLATE pg_catalog."default",
    duration integer NOT NULL,
    audio_path character(256) COLLATE pg_catalog."default" NOT NULL,
    image_path character(256) COLLATE pg_catalog."default",
    album_id integer,
    CONSTRAINT "Song_pkey" PRIMARY KEY (song_id),
    CONSTRAINT fk_album FOREIGN KEY (album_id)
        REFERENCES public."Album" (album_id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);

-- Initial query untuk akun admin
INSERT INTO "User" VALUES (531, 'admin@mail.com', 'a', 'admin', true);