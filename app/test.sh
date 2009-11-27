#!/bin/sh

for f in `ls controllers/test`; do
  g=/test/`echo $f | sed 's/.php//'`
  php cmdline.php $g
done

