DELIMITER $$

create trigger insert_likes
After insert
on likes
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,new.userId,new.documentId,'Le dio Like a un Documento',new.created_at,new.updated_at);
END$$
DELIMITER;





DELIMITER $$

create trigger insert_comments
After insert on comments
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,new.userId,new.id,'Realizo un Comentario',new.created_at,new.updated_at);
END$$
DELIMITER ;


DELIMITER $$

create trigger update_comments
after update on comments
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,new.userId,new.id,'Edito un Comentario',new.created_at, new.updated_at);
END$$
DELIMITER ;


DELIMITER  $$

create trigger delete_comments
after delete on comments
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',old.id,'Elimino un Comentario',old.created_at, old.updated_at);
END$$
DELIMITER ;





DELIMITER $$

create trigger insert_roles
After insert on roles
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',new.id,'Creo un Rol',new.created_at, new.updated_at);
END$$
DELIMITER ;


DELIMITER $$

create trigger update_roles
after update on roles
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',new.id,'Edito un Rol',new.created_at, new.updated_at);
END$$
DELIMITER ;


DELIMITER $$

delete
create trigger delete_roles
after delete on roles
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',old.id,'Elimino un Rol',old.created_at, old.updated_at);
END$$
DELIMITER ;





DELIMITER $$

create trigger insert_forums
After insert on forums
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId, new.userId, new.id, 'Creo un Foro',new.created_at, new.updated_at);
END$$
DELIMITER ;


DELIMITER $$

create trigger update_forums
after update on forums
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',new.id,'Edito un Foro',new.created_at, new.updated_at);
END$$
DELIMITER ;


DELIMITER $$

create trigger delete_forums
after delete on forums
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',old.id,'Elimino un Foro',old.created_at, old.updated_at);
END$$
DELIMITER ;





DELIMITER $$

create trigger insert_download
After insert on downloads
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,new.userId,new.documentId,'Descargo un Documento',new.created_at, new.updated_at);
END$$
DELIMITER ;





DELIMITER $$

create trigger insert_categories
After insert on categories
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',new.id,'Creo una Categoria',new.created_at, new.updated_at);
END$$
DELIMITER ;


DELIMITER $$

create trigger update_categories
after update on categories
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',new.id,'Edito una Categoria',new.created_at, new.updated_at);
END$$
DELIMITER ;


DELIMITER $$

create trigger delete_categories
after delete on categories
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',old.id,'Elimino una Categoria',old.created_at, old.updated_at);
END$$
DELIMITER ;





DELIMITER $$

create trigger 
After insert on managements
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',new.id,'Creo una Gestion',new.created_at, new.updated_at);
END$$
DELIMITER  ;


DELIMITER $$

create trigger update_managements
after update on managements
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',new.id,'Edito una Gestion',new.created_at, new.updated_at);
END$$
DELIMITER ;


DELIMITER $$

create trigger delete_managements
after delete on managements
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',old.id,'Elimino una Gestion',old.created_at, old.updated_at);
END$$
DELIMITER ;





DELIMITER $$

create trigger insert_subjects
After insert on subjects
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',new.id,'Creo una Materia',new.created_at, new.updated_at);
END$$
DELIMITER ;


DELIMITER $$

create trigger update_subjects
after update on subjects
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',new.id,'Edito una Materia',new.created_at, new.updated_at);
END$$
DELIMITER ;


DELIMITER $$

create trigger delete_subjects
after delete on subjects
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',old.id,'Elimino una Materia',old.created_at, old.updated_at);
END$$
DELIMITER ;





DELIMITER $$

create trigger insert_editorials
After insert on editorials
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',new.id,'Creo una Materia',new.created_at, new.updated_at);
END$$
DELIMITER ;


DELIMITER $$

create trigger update_editorials
after update on editorials
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',new.id,'Edito una Materia',new.created_at, new.updated_at);
END$$
DELIMITER ;


DELIMITER $$

create trigger delete_editorials
after delete on editorials
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',old.id,'Elimino una Materia',old.created_at, old.updated_at);
END$$
DELIMITER ;





DELIMITER $$

create trigger insert_languages
After insert on languages
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',new.id,'Creo un Idioma',new.created_at, new.updated_at);
END$$
DELIMITER ;


DELIMITER $$

create trigger update_languages
after update on languages
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',new.id,'Edito un Idioma',new.created_at, new.updated_at);
END$$
DELIMITER ;


DELIMITER $$

create trigger delete_languages
after delete on languages
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',old.id,'Elimino un Idioma',old.created_at, old.updated_at);
END$$
DELIMITER ;





DELIMITER $$

create trigger insert_authors
After insert on authors
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',new.id,'Creo un Autor',new.created_at, new.updated_at);
END$$
DELIMITER ;


DELIMITER $$

create trigger update_authors
after update on authors
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',new.id,'Edito un Autor',new.created_at, new.updated_at);
END$$
DELIMITER ;


DELIMITER $$

create trigger delete_authors
after delete on authors
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',old.id,'Elimino un Autor',old.created_at, old.updated_at);
END$$
DELIMITER ;


DELIMITER $$

create trigger insert_books
After insert on books
for each row
BEGIN
    declare 
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',new.id,'Añadio un Libro',new.created_at, new.updated_at);
END$$
DELIMITER ;


DELIMITER $$

create trigger update_books
after update on books
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',new.id,'Edito un Libro',new.created_at, new.updated_at);
END$$
DELIMITER ;


DELIMITER $$

create trigger delete_books
after delete on books
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',old.id,'Elimino un Libro',old.created_at, old.updated_at);
END$$
DELIMITER ;


DELIMITER $$

create trigger insert_notes
After insert on notes
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',new.id,'Añadio un Apunte',new.created_at, new.updated_at);
END$$
DELIMITER ;


DELIMITER $$

create trigger update_notes
after update on notes
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(1,'arreglar',new.id,'Edito un Apunte',new.created_at, new.updated_at);
END$$
DELIMITER ;


DELIMITER $$

create trigger delete_notes
after delete on notes
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',old.id,'Elimino un Apunte',old.created_at, old.updated_at);
END$$
DELIMITER ;





DELIMITER $$

create trigger insert_theses
After insert on theses
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',new.id,'Añadio una Tesis',new.created_at, new.updated_at);
END$$
DELIMITER  ;


DELIMITER $$

create trigger update_theses
after update on theses
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',new.id,'Edito una Tesis',new.created_at, new.updated_at);
END$$
DELIMITER ;


DELIMITER  $$

create trigger delete_theses
after delete on theses
for each row
BEGIN
    declare newId int;
    set newId=(SELECT MAX(id) from logs);
    set newId=newId+1;
    insert into logs values(newId,'arreglar',old.id,'Elimino una Tesis',old.created_at, old.updated_at);
END$$
DELIMITER ;

DELIMITER $$

CREATE TRIGGER trigger_name
    AFTER Insert
    ON likes FOR EACH ROW
BEGIN
    declare nombreUsuario varchar(30);
    set nombreUsuario=(select username from users where users.id=new.id);
    insert into logs values(1,1,new.id,nombreUsuario,new.created_at, new.updated_at);
END$$;    

DELIMITER ;