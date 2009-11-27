<html>
<head>
<title>creationpodz tests</title>
<style type="text/css">
body { font-family: sans-serif }
</style>
</head>
<body>

<h1>creationpodz tests</h1>

<p><a href="functional_tests.php">functional tests</a></p>

<p><b>unit tests</b></p>
<ul>

<?php
function cleanup($name) {
  $name = basename($name);
  return substr($name, 0, strlen($name) - 4);
}

$unitTests = array_map('cleanup', glob('../app/controllers/test/*test.php'));
?>
<?php foreach ($unitTests as $test): ?>
 <li><a href="../test/<?=$test?>"><?=$test?></a></li>
<?php endforeach; ?>

</ul>

</body>
</html>

