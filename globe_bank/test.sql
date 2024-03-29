CREATE TABLE pages (
    id int(11) NOT NULL AUTO_INCREMENT,
    subject_id INT(11),
    menu_name VARCHAR(255),
    position INT(3),
    visible TINYINT(1),
    content TEXT,
    PRIMARY KEY (id)
    );

ALTER TABLE pages ADD INDEX fk_subject_id (subject_id);

INSERT INTO pages (subject_id, menu_name, position, visible)
VALUES
(1, 'Globe Bank', 1, 1),
(1, 'History', 2, 1),
(1, 'Leadership', 3, 1),
(1, 'Contact Us', 4, 1),
(2, 'Banking', 1, 1),
(2, 'Credit cards', 2, 1),
(2, 'Mortgages', 3, 1),
(3, 'Checking', 1, 1),
(3, 'Loans', 2, 1),
(3, 'Merchant', 3, 1);