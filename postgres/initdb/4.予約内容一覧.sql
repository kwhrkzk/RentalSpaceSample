create table 予約内容一覧
(
    予約内容ID SERIAL NOT NULL,
    会議室ID int NOT NULL,
    利用者ID int NOT NULL,
    予約受付日 date NOT NULL,
    貸与期間自 timestamp with time zone NOT NULL,
    貸与期間至 timestamp with time zone NOT NULL,
    料金 int NOT NULL,
    更新日 timestamp with time zone,
    PRIMARY KEY (予約内容ID),
    foreign key (会議室ID) references 会議室一覧(会議室ID),
    foreign key (利用者ID) references 利用者一覧(利用者ID)
);
