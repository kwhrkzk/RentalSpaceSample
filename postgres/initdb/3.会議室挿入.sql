insert into 会議室一覧 (会議室名, 住所, 料金, 収容人数, 更新日) VALUES 
('会議室A', '東京都なにがし', 10000, 10, current_timestamp),
('会議室B', '大阪府どこそこ', 8000, null, current_timestamp),
('会議室C', '愛知県あれそれ', 5000, 5, current_timestamp)
;

insert into 貸与可能期間一覧 (会議室ID, 貸与可能期間自, 貸与可能期間至, 更新日) VALUES 
(1, 0, 11, current_timestamp),
(1, 13, 17, current_timestamp),
(2, 0, 23, current_timestamp),
(3, 0, 8, current_timestamp),
(3, 13, 17, current_timestamp),
(3, 19, 22, current_timestamp)
;
