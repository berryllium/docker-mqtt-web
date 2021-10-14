CREATE USER 'py'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON test.* to 'py@*' IDENTIFIED BY 'password';