insert into accounts(username, password, salt, registered_on)
  values ('Sam', '12215009ee90139199c76b637ea6abedc5830366', 'asdf', NOW());
insert into blogs(account_id, title, posted_on, entry)
  values (1, 'first blog post', NOW(), 'this is a test; it is only a test...');
insert into blogs(account_id, title, posted_on, entry)
  values (1, 'next blog post', NOW(), '...do not pass go; do not collect $200');

insert into accounts(username, password, salt, registered_on)
  values ('Daddy', '12215009ee90139199c76b637ea6abedc5830366', 'asdf', now());
insert into creations(account_id, name, added_on, description)
  values (2, 'dph', NOW(), 'Dofus P. Hollingsworth is his full name');
insert into creation_photos(creation_id, image_url, thumbnail)
  values (1, 'DSC06536.JPG', 'cp_right.jpg');
insert into creation_photos(creation_id, image_url, thumbnail)
  values (1, 'DSC06537.JPG', 'cp_left.jpg');

