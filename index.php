<?php
if (defined("__INDEX__")) : return false; endif;

define("__INDEX__", __FILE__);

define("__ROOT__", dirname(__INDEX__));

define("__BASE__", spl_autoload_register(function (string $class) {

	if (class_exists($class)) : return false; endif;

	$include_path = __ROOT__ . DIRECTORY_SEPARATOR . "include" . DIRECTORY_SEPARATOR;

	$file_format = ".php";

	$filename[] = str_replace("\\", ".", $class);

	$filename[] = str_replace("\\", DIRECTORY_SEPARATOR, $class);

	foreach ($filename as $basename) :

		if (!is_file($files = $include_path . $basename . $file_format)) : continue; endif;

		try { require_once $files; }

		catch (Throwable $error) { echo $error . PHP_EOL; }

		return true;
		
	endforeach;
	
}));

try {

	if (class_exists("system")) :

		$system = new \system(__ROOT__);

		if (is_callable($system)) :

			$system(new \init);

		endif;

	endif;

} catch (Throwable $error) {}