create table 利用者一覧
(
    利用者ID SERIAL NOT NULL,
    利用者名 text NOT NULL,
    更新日 timestamp with time zone,
    PRIMARY KEY (利用者ID)
);
