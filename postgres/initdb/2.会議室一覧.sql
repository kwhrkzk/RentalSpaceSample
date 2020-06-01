create table 会議室一覧
(
    会議室ID SERIAL NOT NULL,
    会議室名 text NOT NULL,
    住所 text NOT NULL,
    料金 int NOT NULL,
    収容人数 int,
    更新日 timestamp with time zone,
    PRIMARY KEY (会議室ID)
);
create table 貸与可能期間一覧
(
    会議室ID SERIAL NOT NULL,
    貸与可能期間自 int NOT NULL,
    貸与可能期間至 int NOT NULL,
    更新日 timestamp with time zone,
    foreign key (会議室ID) references 会議室一覧(会議室ID),
    PRIMARY KEY (会議室ID, 貸与可能期間自, 貸与可能期間至)
);
