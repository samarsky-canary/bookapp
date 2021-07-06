DROP TABLE IF EXISTS users CASCADE;
CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(30) NOT NULL UNIQUE,
    password text NOT NULL
);

DROP TABLE IF EXISTS passport CASCADE;
CREATE TABLE IF NOT EXISTS passport (
    firstname VARCHAR(50) NOT NULL,
    secondname VARCHAR(50) NOT NULL,
    thirdname VARCHAR (50),
    passport_series VARCHAR(4) NOT NULL,
    passport_code VARCHAR(6) NOT NULL,
    UNIQUE (passport_code, passport_series)
);

/*UNIQUE constrants not work with inheritance, above is workaround*/
CREATE function unique_passport_check(_series_ varchar(4), _code_ varchar(6))
RETURNS
    boolean AS
    $$ SELECT 0 IN (SELECT count(*) FROM passport WHERE passport_series = _series_ AND passport_code = _code_);
    $$
STABLE LANGUAGE SQL;

ALTER TABLE passport
    ADD CONSTRAINT unique_check
        CHECK ( unique_passport_check(passport_series, passport_code) );
/*END UNIQUE constrants not work with inheritance, above is workaround*/


DROP TABLE IF EXISTS employee CASCADE;
CREATE TABLE IF NOT EXISTS employee (
    id SERIAL PRIMARY KEY,
    post VARCHAR(30) NOT NULL
) INHERITS (passport);

DROP TABLE IF EXISTS customer CASCADE;
CREATE TABLE IF NOT EXISTS customer (
    id SERIAL PRIMARY KEY
) INHERITS (passport);


DROP TABLE IF EXISTS book;
CREATE TABLE IF NOT EXISTS book (
    id SERIAL PRIMARY KEY,
    title varchar(50) NOT NULL,
    author VARCHAR(50) NOT NULL,
    vendor_code varchar(40) NOT NULL,
    date_arrived DATE NOT NULL,
    available BOOLEAN NOT NULL DEFAULT true,
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


INSERT INTO users (username, password) values (
    'Administrator', 'Administrator'
);

set datestyle to 'DMY';
show datestyle ;
INSERT INTO book (title, author, vendor_code, date_arrived, available)
VALUES
    ('Евгений Онегин', 'А.С. Пушкин', '34602313', '20-06-2021', true),
    ('Война и мир', 'Л.Н. Толстой', '41412313', '18-06-2021', true),
    ('Преступление и наказание', 'Ф.М. Достоевский', '98481313', '25-06-2021', true),
    ('Том Сойер', 'М. Твен', '23130932', '10-06-2020', true),
    ('Ведьмак. Башня ласточки', 'А. Сапковский', '54882313', '20-05-2021', true)
;


INSERT INTO employee (firstname, secondname, thirdname, passport_series, passport_code, post)
VALUES
    ('Иванов', 'Иван' , 'Иванович', '1122', '123456', 'Библиотекарь'),
    ('Иванова', 'Наталья' , 'Ивановна', '1123', '123456', 'Стажёр-библиотекарь')
;


INSERT INTO customer (firstname, secondname, thirdname, passport_series, passport_code)
VALUES
    ('Петров', 'Петр' , 'Петрович', '1023', '123456'),
    ('Иванова', 'Наталья' , 'Ивановна', '1022', '123457')
;

