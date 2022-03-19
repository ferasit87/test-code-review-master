CREATE TABLE project (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) Engine=InnoDB;

CREATE TABLE task (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    project_id INT NOT NULL, /* add constraint  project_id foreign key */
    title VARCHAR(255) NOT NULL,
    status VARCHAR(16) NOT NULL,  /* need  to add default or allow null value to make request in read me works. add task without status  */
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP /*  keep in mind DATETIME cannot be indexed */
) Engine=InnoDB;
