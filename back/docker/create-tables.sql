DROP TABLE IF EXISTS "peak";

CREATE TABLE peak (
      id serial PRIMARY KEY,
      lat FLOAT NOT NULL,
      lon FLOAT NOT NULL,
      altitude INT NOT NULL,
      name varchar NOT NULL
);

