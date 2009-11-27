<html>
<head>
<title>Unit test results for <?=$modelname?></title>
<style type="text/css">
* { font-family: Arial, sans-serif; font-size: 9pt }
h1 { font-size: 14pt }
.err, .pas { color: white; font-weight: bold; padding: 0 0.3em; border: 1px solid white }
.err { background-color: red }
.pas { background-color: green }
</style>
</head>
<body>
<h1>Unit test results for <?=$modelname?></h1>

<ol>
<?php foreach ($results as $result): ?>
<li>

<?php if ($result['Result'] == 'Passed') { ?>
<div class="pas"><?=$result['Test Name']?></div>
<?php } else { ?>
<div class="err"><pre><?php print_r($result); ?></pre></div>
<?php } ?>

</li>
<?php endforeach; ?>
</ol>

<script type="text/javascript">
var results = document.getElementsByTagName("DIV");
for (var i = 0; i < results.length; i++) {
  if ("err" == results[i].className) {
    document.body.className = "err";
    break;
  }
}
</script>

<strong>All tests completed in <?=$this->benchmark->elapsed_time('total_execution_time_start', 'total_execution_time_end')?> seconds.</strong>

</body>
</html>

