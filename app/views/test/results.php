<html>
<head>
<title>Unit test results for <?=$modelname?></title>
<style type="text/css">
* { font-family: Arial, sans-serif; font-size: 9pt }
h1 { font-size: 14pt }
.err, .pas { color: white; font-weight: bold; padding: 0 0.3em; margin: 1px }
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

<strong>All tests completed in <?=$this->benchmark->elapsed_time('total_execution_time_start', 'total_execution_time_end')?> seconds.</strong>

</body>
</html>

