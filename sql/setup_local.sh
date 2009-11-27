#!/bin/sh

SQL_COMMAND="mysql -u cpodz_owner -pbob cpodz"

for f in teardown setup testdata; do
  $SQL_COMMAND < $f.sql
done
