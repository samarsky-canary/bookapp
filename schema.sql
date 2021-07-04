CREATE TABLE IF NOT EXISTS passport (
    id serial PRIMARY KEY,
    firstname varchar(50) NOT NULL,
    secondname varchar(50) NOT NULL,
    thirdname varchar (50),
    passport_series varchar(4) NOT NULL,
    passport_code varchar(6) NOT NULL
);

CREATE TABLE IF NOT EXISTS client (
    id serial PRIMARY KEY ,
    id_passport int REFERENCES passport(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS employee (
    id serial PRIMARY KEY ,
    id_passport int REFERENCES passport(id) ON DELETE CASCADE,
    position varchar (40) NOT NULL
);
