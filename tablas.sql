
CREATE TABLE users (
                       user_id   INT(8) NOT NULL AUTO_INCREMENT,
                       user_name	VARCHAR(30) NOT NULL,
                       user_pass  	VARCHAR(255) NOT NULL,
                       user_email	VARCHAR(255) NOT NULL,
                       user_date	DATETIME NOT NULL,
                       user_level	INT(8) NOT NULL,
                       UNIQUE INDEX user_name_unique (user_name),
                       PRIMARY KEY (user_id)
) ENGINE=INNODB;

CREATE TABLE topics
(
    topic_id      INT(8)       NOT NULL AUTO_INCREMENT,
    topic_subject VARCHAR(255) NOT NULL,
    topic_date    DATETIME     NOT NULL,
    topic_by      INT(8)       NOT NULL,
    PRIMARY KEY (topic_id),
    FOREIGN KEY (topic_by) REFERENCES users(user_id) ON DELETE RESTRICT ON UPDATE CASCADE

) ENGINE=INNODB;

CREATE TABLE posts (
                       post_id 		INT(8) NOT NULL AUTO_INCREMENT,
                       post_content		TEXT NOT NULL,
                       post_date 		DATETIME NOT NULL,
                       post_topic		INT(8) NOT NULL,
                       post_by		INT(8) NOT NULL,
                       PRIMARY KEY (post_id),
                       FOREIGN KEY (post_topic) REFERENCES topics(topic_id) ON DELETE CASCADE ON UPDATE CASCADE,
                       FOREIGN KEY (post_by) REFERENCES users(user_id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=INNODB;