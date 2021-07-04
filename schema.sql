DROP TABLE IF EXISTS users CASCADE;
CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    login VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(50) NOT NULL,
    role VARCHAR(30) NOT NULL
);

DROP TABLE IF EXISTS passport CASCADE;
CREATE TABLE IF NOT EXISTS passport (
    id SERIAL PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    secondname VARCHAR(50) NOT NULL,
    thirdname VARCHAR (50),
    passport_series VARCHAR(4) NOT NULL,
    passport_code VARCHAR(6) NOT NULL,
    UNIQUE (passport_code, passport_series)
);

DROP TABLE IF EXISTS employee CASCADE;
CREATE TABLE IF NOT EXISTS employee (
    id SERIAL PRIMARY KEY,
    passport_id INT NOT NULL,
    post VARCHAR(30) NOT NULL,
    FOREIGN KEY (passport_id) references passport(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS customer CASCADE;
CREATE TABLE IF NOT EXISTS customer (
    id SERIAL PRIMARY KEY,
    passport_id INT NOT NULL ,
    FOREIGN KEY (passport_id) REFERENCES passport(id) ON DELETE CASCADE
);


DROP TABLE IF EXISTS book;
CREATE TABLE IF NOT EXISTS book (
    id SERIAL PRIMARY KEY,
    title varchar(50) NOT NULL,
    author VARCHAR(50) NOT NULL,
    vendor_code varchar(40) NOT NULL,
    date_arrived DATE NOT NULL,
    available BOOLEAN NOT NULL,
    condition INT NOT NULL CHECK ( condition BETWEEN 0 AND 100) DEFAULT 100
);


CREATE TABLE IF NOT EXISTS LendBook (
    id SERIAL PRIMARY KEY,
    book_id INT NOT NULL,
    customer_id INT NOT NULL,
    employee_id INT NOT NULL,
    date_lending DATE NOT NULL,
    date_expire_at DATE NOT NULL,
    date_actual_return DATE,
    condition_arrived INT
);

DROP FUNCTION IF EXISTS book_return();
CREATE OR REPLACE FUNCTION book_return () RETURNS TRIGGER AS
    $$
    BEGIN
       IF (NEW.condition_arrived > (SELECT condition FROM book WHERE book.id = NEW.book_id))
           THEN RAISE EXCEPTION 'book condition on arrival can`t be greater than it was given';
        END IF;
       RETURN NEW;
    END;
    $$
language plpgsql;

CREATE TRIGGER book_return_trigger BEFORE UPDATE ON LendBook
    FOR EACH ROW EXECUTE PROCEDURE book_return();