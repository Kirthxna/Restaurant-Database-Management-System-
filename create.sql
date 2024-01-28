
-- Table: public.Customers

-- DROP TABLE IF EXISTS public."Customers";

CREATE TABLE IF NOT EXISTS public."Customers"
(
    customer_id integer NOT NULL,
    name character varying COLLATE pg_catalog."default" NOT NULL,
    phone_number character varying COLLATE pg_catalog."default",
    email_address character varying COLLATE pg_catalog."default",
    address character varying COLLATE pg_catalog."default",
    CONSTRAINT "Customer_pkey" PRIMARY KEY (customer_id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public."Customers"
    OWNER to postgres;

-- Table: public.Employees

-- DROP TABLE IF EXISTS public."Employees";

CREATE TABLE IF NOT EXISTS public."Employees"
(
    employee_id integer NOT NULL,
    phone_number character varying COLLATE pg_catalog."default",
    name character varying COLLATE pg_catalog."default" NOT NULL,
    hire_date date NOT NULL,
    salary numeric NOT NULL,
    email_address character varying COLLATE pg_catalog."default",
    "position" character varying COLLATE pg_catalog."default",
    CONSTRAINT "Employee_pkey" PRIMARY KEY (employee_id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public."Employees"
    OWNER to postgres;

-- Table: public.Items

-- DROP TABLE IF EXISTS public."Items";

-- Table: public.Orders

-- DROP TABLE IF EXISTS public."Orders";

CREATE TABLE IF NOT EXISTS public."Orders"
(
    order_id integer NOT NULL,
    customer_id integer NOT NULL,
    employee_id integer NOT NULL,
    date date NOT NULL,
    total_price numeric,
    payment_method character varying COLLATE pg_catalog."default",
    status character varying COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "Orders_pkey" PRIMARY KEY (order_id),
    CONSTRAINT "Orders_customer_id_fkey" FOREIGN KEY (customer_id)
        REFERENCES public."Customers" (customer_id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "Orders_employee_id_fkey" FOREIGN KEY (employee_id)
        REFERENCES public."Employees" (employee_id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public."Orders"
    OWNER to postgres;
-- Index: idx_orders_customer_id_total_price

-- DROP INDEX IF EXISTS public.idx_orders_customer_id_total_price;

CREATE INDEX IF NOT EXISTS idx_orders_customer_id_total_price
    ON public."Orders" USING btree
    (customer_id ASC NULLS LAST, total_price ASC NULLS LAST)
    TABLESPACE pg_default;


CREATE TABLE IF NOT EXISTS public."Items"
(
    item_id integer NOT NULL,
    name character varying COLLATE pg_catalog."default" NOT NULL,
    price numeric(5,2) NOT NULL,
    category character varying COLLATE pg_catalog."default",
    CONSTRAINT "Items_pkey" PRIMARY KEY (item_id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public."Items"
    OWNER to postgres;

-- Table: public.Order_items

-- DROP TABLE IF EXISTS public."Order_items";

CREATE TABLE IF NOT EXISTS public."Order_items"
(
    item_id integer NOT NULL,
    order_id integer NOT NULL,
    quantity integer NOT NULL,
    CONSTRAINT order_items_pkey PRIMARY KEY (item_id, order_id),
    CONSTRAINT order_items_item_id_fkey FOREIGN KEY (item_id)
        REFERENCES public."Items" (item_id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT order_items_order_id_fkey FOREIGN KEY (order_id)
        REFERENCES public."Orders" (order_id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public."Order_items"
    OWNER to postgres;


-- Table: public.Payroll

-- DROP TABLE IF EXISTS public."Payroll";

CREATE TABLE IF NOT EXISTS public."Payroll"
(
    payroll_id integer NOT NULL,
    employee_id integer NOT NULL,
    pay_period_start_date date NOT NULL,
    pay_period_end_date date NOT NULL,
    hours_worked numeric,
    hourly_rate numeric NOT NULL,
    gross_pay numeric,
    taxes numeric,
    net_pay numeric,
    CONSTRAINT "Payroll_pkey" PRIMARY KEY (payroll_id),
    CONSTRAINT "Payroll_employee_id_fkey" FOREIGN KEY (employee_id)
        REFERENCES public."Employees" (employee_id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public."Payroll"
    OWNER to postgres;

-- Table: public.Reservations

-- DROP TABLE IF EXISTS public."Reservations";

CREATE TABLE IF NOT EXISTS public."Reservations"
(
    reservation_id integer NOT NULL,
    customer_id integer NOT NULL,
    employee_id integer NOT NULL,
    date date NOT NULL,
    "time" time without time zone NOT NULL,
    party_size integer,
    CONSTRAINT "Reservations_pkey" PRIMARY KEY (reservation_id),
    CONSTRAINT "Reservations_customer_id_fkey" FOREIGN KEY (customer_id)
        REFERENCES public."Customers" (customer_id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "Reservations_employee_id_fkey" FOREIGN KEY (employee_id)
        REFERENCES public."Employees" (employee_id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public."Reservations"
    OWNER to postgres;
-- Index: index_party_size

-- DROP INDEX IF EXISTS public.index_party_size;

CREATE INDEX IF NOT EXISTS index_party_size
    ON public."Reservations" USING btree
    (party_size ASC NULLS LAST)
    TABLESPACE pg_default;

-- Table: public.Tables

-- DROP TABLE IF EXISTS public."Tables";

CREATE TABLE IF NOT EXISTS public."Tables"
(
    table_id integer NOT NULL,
    capacity integer,
    status character varying COLLATE pg_catalog."default",
    CONSTRAINT "Tables_pkey" PRIMARY KEY (table_id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public."Tables"
    OWNER to postgres;


