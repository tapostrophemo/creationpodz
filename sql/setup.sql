create table accounts(
  id            int unsigned auto_increment,
  username      varchar(32) not null unique,
  passwd        varchar(40) not null,
  salt          varchar(32) not null,
  registered_on date not null,
  email         varchar(255) default null,
  theme         mediumint not null default 1,
  persistence_token varchar(255),
  is_admin      boolean default false,
  primary key(id)
);

create table creations(
  id          int unsigned auto_increment,
  account_id  int unsigned not null references accounts.id,
  name        varchar(32) not null,
  added_on    datetime not null,
  points      mediumint not null default 0,
  description mediumtext default null,
  primary key(id)
);

create table creation_photos(
  id          int unsigned auto_increment,
  creation_id int unsigned not null references creations.id,
  is_remote   boolean default false,
  image_url   varchar(255) not null,
  thumbnail   varchar(255) not null,
  primary key(id)
);

create table blogs(
  id         int unsigned auto_increment,
  account_id int unsigned not null references accounts.id,
  title      varchar(255) not null,
  posted_on  datetime not null,
  front_page boolean default false,
  entry      text not null,
  primary key(id)
);

