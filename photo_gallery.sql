create Database photo_gallery;

use photo_gallery;


CREATE TABLE images(
    id int primary key auto_increment,
    title varchar(100),
    description text,
    filename varchar(100),
    upload_date timestamp default current_timestamp;
)